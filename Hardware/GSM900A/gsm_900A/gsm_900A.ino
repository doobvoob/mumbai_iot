
#include <SoftwareSerial.h>

SoftwareSerial mySerial(9, 10);

byte byteRead[500];
void setup() 
{
  
  mySerial.begin(9600);   // Setting the baud rate of GSM Module  
  Serial.begin(9600);    // Setting the baud rate of Serial Monitor (Arduino)
  delay(1000);

  Serial.print("AT+CNETSCAN\r");
  Serial.flush();
  //Serial.print("AT+MON1=7\r\n");
  //Serial.print("AT+CREG=2\r\n");

  //Serial.print("AT+CENG=3\r\n");
  //delay(1000);
  Serial.print("AT+CENG=2,0\r");
}

void loop() 
{
  static char buffer[2000];
  //checks if the data has been sent from the computer
  if(Serial.available())
  {
     for(int i=0;i<500;i++)
     {
      //read the most recent byte
      byteRead[i]=Serial.read();
      //Echo that value back to the serial port
      Serial.write(byteRead[1]);
     }
  }
}

