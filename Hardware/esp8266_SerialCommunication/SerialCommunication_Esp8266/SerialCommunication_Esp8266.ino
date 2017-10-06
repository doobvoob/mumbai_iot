#include <ESP8266WiFi.h>
#include <WiFiClient.h>
 
// WiFi information
const char ssid[] = "Redmi";   
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
  digitalWrite(D7,LOW);
  Serial.println("************");
  Serial.println("begin");
  // Connect to WiFi
  connectWiFi();
  
   
}
 
void loop() {
   delay(500);
   connecthost(); 
  
         
 
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
  digitalWrite(D1,HIGH); // data sending to delta
  }
  }
void connecthost()
{
  counter=0;
  gtfo=false;
  Serial.print("connecting to ");
  Serial.println(host);
  
  WiFiClient client; //Client to handle TCP Connection
  const int httpPort = 80;
  if (!client.connect(host, httpPort)) { //Connect to server using port httpPort
    Serial.println("connection failed");
    //return;
    digitalWrite(D7,HIGH);}

    String url = "https://mumbaiiot.000webhostapp.com/view.php"; //https://stackoverflow.com/questions/1336126/does-every-web-request-send-the-browser-cookies
    //File or Server page you want to communicate with. along with data
  //<html><head><title>Firewall Authentication</title></head><body>Redirected to the secure channel.<a href="
  // This will send the request to the server 
  //client.print(String("https://grofers.com/443:s/?q=chocolate&suggestion_type=0&t=1"));
  
  client.print(String("GET ") + url + " HTTP/1.1\r\n" +
               "Host: " + host + "\r\n" +
               "Accept: */*"+"\r\n"+
               "Connection: close\r\n\r\n");
                t1=millis();
  //
  //"Cookie: session-id=258-7260461-6798324; Path=/, session-id-time=2082787201l;Path=/, ubid-acbin=257-2177933-4523207;Path=/, session-token=RU1jPReKBv9ZMzZBMx/ULhzm+T7A3jViY0oe01ssiQqAEfvn6yRz3sSiqRaEESSsDXN8We7FEU3f0tnPJD3VSvs0MGB1igdEYx6NmIx7n/wwbhtUG3E7U8ghz4m31ob9sAGQkoOD6uAWuDgiZrY6N7Mf57WURs5ekccRxwHTr/xUfQKd+DSS5r/mH5klRVyp;Path=/;"+ "\r\n"+
                
  unsigned long timeout = millis();
  while (client.available() == 0) {
    if (millis() - timeout > 25000) { //Try to fetch response for 25 seconds
      Serial.println(">>> Client Timeout !");
      client.stop();
      return;
    }
  }
  
  // Read all the lines of the reply from server and print them to Serial
  counter=0;
  while(client.available())
  {
    
    // String line = client.readStringUntil('\r');
    
    char in1 = client.read();
    line+=in1;
    counter++;
//    led=true;
    
    }
    //Serial.print(line);
    Serial.println("");
    Serial.println("********************************");
   //Serial.print(line);
  Serial.println();
  Serial.println("closing connection");
  client.stop(); //Close Connection
  t2=millis();
  t1=t2-t1;
  Serial.print("Time Taken ");
  Serial.println(t1/1000);
  Serial.print("Total String Length ");
  Serial.println(counter);
  checkfunc();
}
void checkfunc()
{
  i=0;
 while(gtfo==false)
  {
  
  webstring[0]=line[i];
  b=strcmp(webstring,check);
  if(b==0)
   {
    gtfo=true;
   }
  i++;
  }
  Serial.println(line[i]);
  Serial.println(" ");
  Serial.println("*************************");
  for(j=i;j<i+5;j++)
  {
  Serial.println(line[j]);
  a[j-i]=line[j]-'0';
  }
  Serial.println(" the array is ");
  for(i=0;i<5;i++)
  {
    Serial.print(a[i]);
    Serial.print(" ");
  }
  Serial.print(" ");
 if(a[0]==0)
 {
  digitalWrite(D0,LOW); 
 }
 else if(a[0]==1)
 {
  digitalWrite(D0,HIGH);
  Serial.print("D0 is On"); 
 }
 if(a[1]==0)
 {
  digitalWrite(D1,LOW); 
 }
 else if(a[1]==1)
 {
  digitalWrite(D1,HIGH);
  Serial.print("D1 is On"); 
 }
 if(a[2]==0)
 {
  digitalWrite(D2,LOW); 
 }
 else if(a[2]==1)
 {
  digitalWrite(D2,HIGH);
  Serial.print("D2 is On"); 
 }
 if(a[3]==0)
 {
  digitalWrite(D3,LOW);
   
 }
 else if(a[3]==1)
 {
  digitalWrite(D3,HIGH); 
  Serial.print("D3 is On");
 }
 if(a[4]==0)
 {
  digitalWrite(D4,LOW); 
 }
 else if(a[4]==1)
 {
  digitalWrite(D4,HIGH); 
  Serial.print("D4 is On");
 }
line="";
}




