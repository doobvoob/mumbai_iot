#include <ESP8266WiFi.h>

const char* ssid = "Benji";
const char* password = "Benjamin";
bool  wificonnect = false;

void setup ()
{
 
  Serial.begin(115200);
  WiFi.begin(ssid, password);
 
  while (WiFi.status() != WL_CONNECTED) 
  {
 
    delay(1000);
    Serial.println("Connecting..");
 
  }
 
  Serial.println(WiFi.localIP());
 
}

void loop ()
{
  if(WiFi.status() == WL_CONNECTED)
  {
  Serial.print(ssid);  
  Serial.println(" connected");
  wificonnect = true;
  digitalWrite(D1,HIGH); // data sending to delta
  }
  else 
  {
    Serial.println("nahi hua bey :(");
  }
 }

