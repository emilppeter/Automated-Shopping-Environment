#include <Keyboard.h>
#include <avr/pgmspace.h>
#include <Usb.h>
#include <usbhub.h>
#include <avr/pgmspace.h>
#include <hidboot.h>
#include <hid.h>
#include <hiduniversal.h>
#include <spi4teensy3.h>
#include <HX711_ADC.h> 
#include <Wire.h> 
String data;
int count=0;
float i,j;
struct lookUp
{
  String Id;
  char item;
  };
struct lookUp look[4]={{"8906039450828",'T'},{"89007662",'R'},{"8901764395154",'G'},{"8906002485796",'C'}};  
HX711_ADC LoadCell(3, 6); // parameters: dt pin, sck pin
USB     Usb;
USBHub     Hub(&Usb);
HIDUniversal    Hid(&Usb);
HIDBoot<USB_HID_PROTOCOL_KEYBOARD>    Keyboard(&Usb); 
class KbdRptParser : public KeyboardReportParser
{
   void PrintKey(uint8_t mod, uint8_t key); 
protected:
  virtual void OnKeyDown  (uint8_t mod, uint8_t key);
  virtual void OnKeyPressed(uint8_t key);
};
 
void KbdRptParser::OnKeyDown(uint8_t mod, uint8_t key)  
{
    uint8_t c = OemToAscii(mod, key);
    if (c)
        {OnKeyPressed(c);
        LoadCell.update();                         // retrieves data from the load cell
        j = LoadCell.getData();}       
}
 
/* what to do when symbol arrives */
void KbdRptParser::OnKeyPressed(uint8_t key)  
{
    
   data+=(char)key;   
    
 }; 
KbdRptParser Prs; 
void setup()
{
    Serial.begin(9600);
    Serial.println("Start");
    LoadCell.begin();                 // start connection to HX711
    LoadCell.start(2000);             // load cells gets 2000ms of time to stabilize
    LoadCell.setCalFactor(-80.0);     // calibration factor for load cell => strongly dependent on your individual setup
    if (Usb.Init() == -1) 
    {
        Serial.println("OSC did not start.");
    }
    delay( 200 ); 
    Hid.SetReportParser(0, (HIDReportParser*)&Prs);
    Serial.println("");
    Serial.println("");
    Serial.println("");
    Serial.println("");
    /*Initializing gsm module*/
    Serial.println("AT");
    delay(2000);
    Serial.println("AT+CGATT=1");
    delay(3000);
    Serial.println("AT+CIPMUX=0");
    delay(3000);
    Serial.println("AT+SAPBR=3,1,\"CONTYPE\",\"GPRS\"");
    delay(3000);
    Serial.println("AT+SAPBR=3,1,\"APN\",\"airtelgprs.com\"");
    delay(3000);
    Serial.println("AT+SAPBR=1,1");
    delay(3000);
}
 
void loop()
{ 
  Usb.Task();                                                                                        //polling for barcode scanner input
  if ((j-i)>10)                                                                                     //check if the weight has decreased 
  {    
      for(int n=0;n<4;n++)
      { 
         if (look[n].Id==data)
        { 
            Serial.println("AT+HTTPINIT");
            delay(3000);
            Serial.println("AT+HTTPPARA=\"CID\",1");
            delay(3000);
            Serial.print("AT+HTTPPARA=\"URL\",\"http://845a8fc1.ngrok.io/amazon/test2.php?data=");
            Serial.print('$');                                                                      //weight has decreased
            Serial.print(look[n].item);
            Serial.print("\"\r\n");
            delay(3000);
            Serial.println("AT+HTTPACTION=0");
            delay(3000);
            Serial.println("AT+HTTPREAD");
            delay(4000);
            Serial.println("AT+HTTTPTERM");
            delay(3000);
            data="";
          }
          
        }
    
    }
  else if ((i-j)>10)                                                                               //check if the weight has increased 
  {
       for(int n=0;n<4;n++)
      { 
        if (look[n].Id==data)
        {
            Serial.println("AT+HTTPINIT");
            delay(3000);
            Serial.println("AT+HTTPPARA=\"CID\",1");
            delay(3000); 
            Serial.print("AT+HTTPPARA=\"URL\",\"http://845a8fc1.ngrok.io/amazon/test2.php?data=");
            Serial.print('@');//weight has increased
            Serial.print(look[n].item);
            Serial.print("\"\r\n");
            delay(3000);
            Serial.println("AT+HTTPACTION=0");
            delay(3000);
            Serial.println("AT+HTTPREAD");
            delay(4000);
            Serial.println("AT+HTTTPTERM");
            delay(3000);
           data="";
          }
        }      
      }      
      LoadCell.update();                                                                            // retrieves data from the load cell and stores it as initial weight
      i = LoadCell.getData();
      
      
 }

