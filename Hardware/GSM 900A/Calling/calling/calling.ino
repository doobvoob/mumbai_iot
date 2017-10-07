#include <SoftwareSerial.h>

SoftwareSerial mySerial(9, 10); // RX, TX

void setup()
{

Serial.begin(9600);


}

void loop() // run over and over
{
  Serial.println("Calling through GSM Modem");

// set the data rate for the SoftwareSerial port
mySerial.begin(9600);
delay(400);
mySerial.println("ATD9769838471;"); // ATDxxxxxxxxxx; -- watch out here for semicolon at the end!!

Serial.println("Called ATD9769838471");
// print response over serial port
if (mySerial.available())
Serial.write(mySerial.read());
}
