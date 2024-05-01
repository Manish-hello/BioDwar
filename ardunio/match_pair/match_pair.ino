#include <SoftwareSerial.h>
#include <FPM.h>

/* Match 2 templates */

/*  pin #2 is IN from sensor (GREEN wire)
    pin #3 is OUT from arduino  (WHITE/YELLOW wire)
*/
SoftwareSerial fserial(3, 4);

FPM finger(&fserial);
FPM_System_Params params;

#define BUFF_SZ     768

uint8_t template_buffer[BUFF_SZ];

void setup()
{
    pinMode(12, OUTPUT);
    Serial.begin(9600);
    Serial.println("PAIR MATCH test");
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

  while(Serial.available() > 0) {
    char t = Serial.read();
  }
}

String getInput(){
  String readString="";
  while (Serial.available()) {
          delay(3);  //delay to allow buffer to fill 
          if (Serial.available() >0) {
            char c = Serial.read();  //gets one byte from serial buffer
            readString += c; //makes the string readString
          } 
  }
  return readString;

}

char msg[4];

void loop()
{
    int16_t fid = 1;
    while (Serial.available()){
      char c = Serial.read();
      if(c=='M'){
        while(!Serial.available());
        char m=Serial.read();
        if(m=='A'){
          delay(3);
          Serial.println("okmc");
          Serial.readBytes(template_buffer,BUFF_SZ);
          Serial.write(template_buffer,BUFF_SZ);
          delay(3);
          move_template(fid, template_buffer, 768);
          match_prints(fid);
          Serial.println("bybymc");

        }

        
      }
      
    }
    
  /*  delay(2*1000);
    //Serial.println("reading..");
    size_t s;
    while(s=Serial.readBytes(template_buffer,768) !=-1){
      Serial.println(s);
    };
    Serial.write(template_buffer,768);
    move_template(fid, template_buffer, 768);
    match_prints(fid);
    Serial.println("\t\t\tmcbc");
    */

}

/* capture a print, load it into slot 1, 
 *  load a second print #fid into the slot 2,
 *  and check if they match
 */
void match_prints(int16_t fid) {
    int16_t p = -1;

    /* first get the finger image */
    Serial.println("Waiting for valid finger");
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
                return;
            default:
                Serial.println("Unknown error");
                return;
        }
        yield();
    }

    /* convert it and place in slot 1*/
    p = finger.image2Tz(1);
    switch (p) {
        case FPM_OK:
            Serial.println("Image converted");
            break;
        case FPM_IMAGEMESS:
            Serial.println("Image too messy");
            return;
        case FPM_PACKETRECIEVEERR:
            Serial.println("Communication error");
            return;
        default:
            Serial.println("Unknown error");
            return;
    }

    Serial.println("Remove finger");
    p = 0;
    while (p != FPM_NOFINGER) {
        p = finger.getImage();
        yield();
    }
    Serial.println();

    /* read template into slot 2 */
    p = finger.loadModel(fid, 2);
    switch (p) {
        case FPM_OK:
            Serial.print("Template "); Serial.print(fid); Serial.println(" loaded.");
            break;
        case FPM_PACKETRECIEVEERR:
            Serial.println("Communication error");
            return;
        case FPM_DBREADFAIL:
            Serial.println("Invalid template");
            return;
        default:
            Serial.print("Unknown error "); Serial.println(p);
            return;
    }
    
    uint16_t match_score = 0;
    p = finger.matchTemplatePair(&match_score);
    switch (p) {
        case FPM_OK:
            Serial.print("Prints matched. Score: "); Serial.println(match_score);
              digitalWrite(12,HIGH);
              Serial.println("[+] Door Opened ");
              delay(5000);
              digitalWrite(12,LOW);

            break;
        case FPM_NOMATCH:
            Serial.println("Prints did not match.");
            break;
        default:
            Serial.println("Unknown error");
            return;
    }
}

void move_template(uint16_t fid, uint8_t * buffer, uint16_t to_write) {
    int16_t p = finger.uploadModel();
    switch (p) {
        case FPM_OK:
            Serial.println("Starting template upload");
            break;
        case FPM_PACKETRECIEVEERR:
            Serial.println("Comms error");
            return;
        case FPM_PACKETRESPONSEFAIL:
            Serial.println("Did not receive packet");
            return;
        default:
            Serial.print("Unknown error: "); 
            Serial.println(p);
            return;
    }

    yield();
    finger.writeRaw(buffer, to_write);

    p = finger.storeModel(fid);
    switch (p) {
        case FPM_OK:
            Serial.print("Template moved to ID "); Serial.println(fid);
            break;
        case FPM_PACKETRECIEVEERR:
            Serial.println("Comms error");
            break;
        case FPM_BADLOCATION:
            Serial.println("Could not store in that location");
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
