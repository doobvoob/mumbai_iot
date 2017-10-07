#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>

const char* ssid = "Redmi";
const char* password = "12345678";
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
    
    HTTPClient http; // creating http object
    Serial.println("Hey i am entering the website");
    http.begin("https://notepad.pw/604MILAN");//website url to request
    int httpCode = http.GET();
                 if (httpCode > 0)
                  {
                    String payload = http.getString();
                    Serial.println(payload); 
                  }
                  http.end(); 
 }
  else 
  {
    Serial.println("nahi hua bey :(");
  }
  
    delay(30000);
 }

