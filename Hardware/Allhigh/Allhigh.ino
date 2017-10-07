#include <ESP8266WiFi.h>
#include <WiFiClient.h>
 
// WiFi information
const char ssid[] = "MotoG";   
const char password[]  = "12345678"; 
String line="";

//Only used if using Static IP
IPAddress ip(192, 168, 0, 6); //IP
IPAddress gatewayDNS(192, 168, 0, 1);//DNS and Gewateway
IPAddress netmask(255, 255, 255,0); //Netmask

//Server IP or domain name
const char* host = "mumbaiiot.000webhostapp.com";
//http://<my-local-subnet-host>:80/foo.html
 


// constants
int counter,i,j,b;   //wow it was in sleep mode 
float t1,t2;
boolean wificonnect = false;
char webstring [2];
boolean gtfo =false;
const char* check="z";
int a[5];
// Global variables
WiFiClient client;
 
void setup() {
  
  // Set up serial console to read web page
  Serial.begin(115200);
  pinMode(D0,OUTPUT);
  pinMode(D1,OUTPUT);
  pinMode(D2,OUTPUT);
  pinMode(D3,OUTPUT);
  pinMode(D4,OUTPUT);
  pinMode(D5,OUTPUT);
  pinMode(D6,OUTPUT);
  pinMode(D7,OUTPUT);
  
  
  Serial.println("************");
  Serial.println("begin");
  // Connect to WiFi
  connectWiFi();

  digitalWrite(D7,HIGH);
  
}
 
void loop() {
   delay(500);
  
         }
 
// Attempt to connect to WiFi
void connectWiFi() {
  Serial.println("Connecting to Wifi");
  WiFi.mode(WIFI_STA);
//  WiFi.config(ip, gateway, subnet); 
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) 
  {
    digitalWrite(D1,HIGH);
    if(counter > 15)
    {
      Serial.println("- can't connect, going to sleep");
       wificonnect = false;
       digitalWrite(D1,LOW);    
      // hibernate(failConnectRetryInterval);
    }
   delay(300);
    digitalWrite(D1,LOW);
    Serial.print(".");
    delay(300);
    digitalWrite(D1,HIGH);
    counter++;
  }
  if(WiFi.status() == WL_CONNECTED)
  {
  Serial.print(ssid);  
  Serial.println(" connected");
  wificonnect = true;
  digitalWrite(D1,HIGH);
  digitalWrite(D2,HIGH); 
  digitalWrite(D3,HIGH);
  digitalWrite(D4,HIGH);
  digitalWrite(D5,HIGH);
  digitalWrite(D6,HIGH);
  digitalWrite(D7,HIGH);// data sending to delta
  }
  }
