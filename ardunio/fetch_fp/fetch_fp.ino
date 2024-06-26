#include <SoftwareSerial.h>
#include <FPM.h>

/* Read, delete and move a fingerprint template within the database */

/*  pin #2 is IN from sensor (GREEN wire)
    pin #3 is OUT from arduino  (WHITE/YELLOW wire)
*/
SoftwareSerial fserial(3, 4);

FPM finger(&fserial);
FPM_System_Params params;

/* this should be equal to the template size for your sensor but
 * some sensors have 512-byte templates while others have template sizes as
 * high as 1024 bytes. So check the printed result of read_template()
 * to determine the case for your module and adjust the needed buffer
 * size below accordingly. If it doesn't work at first, try increasing
 * this value to 1024
 */
#define BUFF_SZ     1024

uint8_t template_buffer[BUFF_SZ];

void setup()
{
    Serial.begin(9600);
    Serial.println("TEMPLATES test");
    fserial.begin(57600);

    if (finger.begin()) {
        finger.readParams(&params);
        Serial.println("Found fingerprint sensor!");
        Serial.print("Capacity: "); Serial.println(params.capacity);
        Serial.print("Packet length: "); Serial.println(FPM::packet_lengths[params.packet_len]);
    } else {
        Serial.println("no fingerprint sensor ");
        while (1) yield();
    }
}

void loop()
{
    int16_t fid = 0;
    while (Serial.read() != -1);
    Serial.println("Enter char to Fetching FP");
    while (Serial.available() == 0) yield();

    fid=1;
    /* read the template from its location into the buffer */
    uint16_t total_read = read_template(fid, template_buffer, BUFF_SZ);
    if (!total_read)
        return;
    else{
      Serial.println("\t\t\tmc");
      Serial.write(template_buffer, total_read);
    }

    /* delete it from that location */
    //delete_template(fid);
}

uint16_t read_template(uint16_t fid, uint8_t * buffer, uint16_t buff_sz)
{
    int16_t p = finger.loadModel(fid);
    switch (p) {
        case FPM_OK:
            Serial.print("Template "); Serial.print(fid); Serial.println(" loaded");
            break;
        case FPM_PACKETRECIEVEERR:
            Serial.println("Communication error");
            return 0;
        case FPM_DBREADFAIL:
            Serial.println("Invalid template");
            return 0;
        default:
            Serial.print("Unknown error: "); Serial.println(p);
            return 0;
    }

    // OK success!

    p = finger.downloadModel();
    switch (p) {
        case FPM_OK:
            break;
        default:
            Serial.print("Unknown error: "); Serial.println(p);
            return 0; 
    }

    bool read_finished;
    int16_t count = 0;
    uint16_t readlen = buff_sz;
    uint16_t pos = 0;

    while (true) {
        bool ret = finger.readRaw(FPM_OUTPUT_TO_BUFFER, buffer + pos, &read_finished, &readlen);
        if (ret) {
            count++;
            pos += readlen;
            readlen = buff_sz - pos;
            if (read_finished)
                break;
        }
        else {
            Serial.print("Error receiving packet ");
            Serial.println(count);
            return 0;
        }
        yield();
    }
    
    uint16_t total_bytes = count * FPM::packet_lengths[params.packet_len];
    
    /* just for pretty-printing */
    uint16_t num_rows = total_bytes / 16;
    
    Serial.println("Printing template:");

    Serial.print(total_bytes); Serial.println(" bytes read.");
    return total_bytes;
}

void delete_template(uint16_t fid) {
    int16_t p = finger.deleteModel(fid);
    switch (p) {
        case FPM_OK:
            Serial.print("Template "); Serial.print(fid); Serial.println(" deleted");
            break;
        case FPM_PACKETRECIEVEERR:
            Serial.println("Comms error");
            break;
        case FPM_BADLOCATION:
            Serial.println("Could not delete ");
            break;
        case FPM_FLASHERR:
            Serial.println("Err writ to flash");
            break;
        default:
            Serial.print("Unknown error: "); 
            Serial.println(p);
            break;
    }
    return;
}