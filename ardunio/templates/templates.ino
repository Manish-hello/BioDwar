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
#define BUFF_SZ     768

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
        Serial.println("Did not find fingerprint sensor :(");
        while (1) yield();
    }
}

int16_t getInput(){
    int16_t fid = 0;
    while (Serial.read() != -1);
    while (true) {
        while (! Serial.available()) yield();
        char c = Serial.read();
        if (! isdigit(c)) break;
        fid *= 10;
        fid += c - '0';
        yield();
    }
    return fid;
}
void loop()
{
    Serial.println("Enter the template ID # you want to get...");
    int16_t fid = getInput();
    
    if(fid==300){
      // enroll fp in slot id 0
      int16_t status=enroll_finger(0);
      if(status==0)return;
      else{
        uint16_t total_read = read_template(fid, template_buffer, BUFF_SZ);

        delete_template(fid);
        //send template_buffer to pc
      }
    }

    
    /* read the template from its location into the buffer 
    uint16_t total_read = read_template(fid, template_buffer, BUFF_SZ);
    if (!total_read)
        return;

    /* delete it from that location 
    delete_template(fid);



    Serial.println("Enter the template's new ID...");
    int16_t new_id = getInput();

    /* copy it from the buffer to its new location 
    move_template(new_id, template_buffer, total_read);
    */
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
    Serial.println("---------------------------------------------");
    for (int row = 0; row < num_rows; row++) {
        for (int col = 0; col < 16; col++) {
            Serial.print(buffer[row * 16 + col], HEX);
            Serial.print(" ");
        }
        Serial.println();
        yield();
    }
    Serial.println("--------------------------------------------");

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
            Serial.println("Could not delete from that location");
            break;
        case FPM_FLASHERR:
            Serial.println("Error writing to flash");
            break;
        default:
            Serial.print("Unknown error: "); 
            Serial.println(p);
            break;
    }
    return;
}


int16_t enroll_finger(int16_t fid) {
    int16_t p = -1;
    Serial.println("Waiting for valid finger to enroll");
    while (p != FPM_OK) {
        p = finger.getImage();
        switch (p) {
            case FPM_OK:
                Serial.println("Image taken");
                break;
            case FPM_NOFINGER:
                Serial.println(".");
                break;
            case FPM_PACKETRECIEVEERR:
                Serial.println("Communication error");
                break;
            case FPM_IMAGEFAIL:
                Serial.println("Imaging error");
                break;
            case FPM_TIMEOUT:
                Serial.println("Timeout!");
                break;
            case FPM_READ_ERROR:
                Serial.println("Got wrong PID or length!");
                break;
            default:
                Serial.println("Unknown error");
                break;
        }
        yield();
    }
    // OK success!

    p = finger.image2Tz(1);
    switch (p) {
        case FPM_OK:
            Serial.println("Image converted");
            break;
        case FPM_IMAGEMESS:
            Serial.println("Image too messy");
            return p;
        case FPM_PACKETRECIEVEERR:
            Serial.println("Communication error");
            return p;
        case FPM_FEATUREFAIL:
            Serial.println("Could not find fingerprint features");
            return p;
        case FPM_INVALIDIMAGE:
            Serial.println("Could not find fingerprint features");
            return p;
        case FPM_TIMEOUT:
            Serial.println("Timeout!");
            return p;
        case FPM_READ_ERROR:
            Serial.println("Got wrong PID or length!");
            return p;
        default:
            Serial.println("Unknown error");
            return p;
    }

    Serial.println("Remove finger");
    delay(2000);
    p = 0;
    while (p != FPM_NOFINGER) {
        p = finger.getImage();
        yield();
    }

    p = -1;
    Serial.println("Place same finger again");
    while (p != FPM_OK) {
        p = finger.getImage();
        switch (p) {
            case FPM_OK:
                Serial.println("Image taken");
                break;
            case FPM_NOFINGER:
                Serial.print(".");
                break;
            case FPM_PACKETRECIEVEERR:
                Serial.println("Communication error");
                break;
            case FPM_IMAGEFAIL:
                Serial.println("Imaging error");
                break;
            case FPM_TIMEOUT:
                Serial.println("Timeout!");
                break;
            case FPM_READ_ERROR:
                Serial.println("Got wrong PID or length!");
                break;
            default:
                Serial.println("Unknown error");
                break;
        }
        yield();
    }

    // OK success!

    p = finger.image2Tz(2);
    switch (p) {
        case FPM_OK:
            Serial.println("Image converted");
            break;
        case FPM_IMAGEMESS:
            Serial.println("Image too messy");
            return p;
        case FPM_PACKETRECIEVEERR:
            Serial.println("Communication error");
            return p;
        case FPM_FEATUREFAIL:
            Serial.println("Could not find fingerprint features");
            return p;
        case FPM_INVALIDIMAGE:
            Serial.println("Could not find fingerprint features");
            return p;
        case FPM_TIMEOUT:
            Serial.println("Timeout!");
            return false;
        case FPM_READ_ERROR:
            Serial.println("Got wrong PID or length!");
            return false;
        default:
            Serial.println("Unknown error");
            return p;
    }


    // OK converted!
    p = finger.createModel();
    if (p == FPM_OK) {
        Serial.println("Prints matched!");
    } else if (p == FPM_PACKETRECIEVEERR) {
        Serial.println("Communication error");
        return p;
    } else if (p == FPM_ENROLLMISMATCH) {
        Serial.println("Fingerprints did not match");
        return p;
    } else if (p == FPM_TIMEOUT) {
        Serial.println("Timeout!");
        return p;
    } else if (p == FPM_READ_ERROR) {
        Serial.println("Got wrong PID or length!");
        return p;
    } else {
        Serial.println("Unknown error");
        return p;
    }

    Serial.print("ID "); Serial.println(fid);
    p = finger.storeModel(fid);
    if (p == FPM_OK) {
        Serial.println("Stored!");
        return 0;
    } else if (p == FPM_PACKETRECIEVEERR) {
        Serial.println("Communication error");
        return p;
    } else if (p == FPM_BADLOCATION) {
        Serial.println("Could not store in that location");
        return p;
    } else if (p == FPM_FLASHERR) {
        Serial.println("Error writing to flash");
        return p;
    } else if (p == FPM_TIMEOUT) {
        Serial.println("Timeout!");
        return p;
    } else if (p == FPM_READ_ERROR) {
        Serial.println("Got wrong PID or length!");
        return p;
    } else {
        Serial.println("Unknown error");
        return p;
    }
}


