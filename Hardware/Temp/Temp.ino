#include<dht.h>   // Including library for dht
#include<LiquidCrystal.h>
LiquidCrystal lcd(2, 3, 4, 5, 6, 7);
#define dht_dpin 12
dht DHT;
#define pwm 9

void setup()
{
 lcd.begin(16, 2);
 
 lcd.clear();
 lcd.print("  Led Intensity  ");
 lcd.setCursor(0,1);
 lcd.print("  Controlling ");
 delay(2000);
 analogWrite(pwm, 255);
 lcd.clear();
 lcd.print("Dr. House ");
 delay(2000);
}
void loop()
{
  DHT.read11(dht_dpin);
  int temp=DHT.temperature;
  lcd.setCursor(0,0);
  lcd.print("Temperature:");
  lcd.print(temp);   // Printing temperature on LCD
  
  lcd.print("oC");
  lcd.setCursor(0,1);
  if(temp <26 )
    { 
      analogWrite(9,0);
      lcd.print("Led OFF ");
      delay(100);
    }
    
    else if(temp==26)
    {
      analogWrite(pwm, 51);
      lcd.print("Led at: 20%   ");
      delay(100);
    }
    
     else if(temp==27)
    {
      analogWrite(pwm, 102);
      lcd.print("Led at: 40%   ");
      delay(100);
    }
    
     else if(temp==28)
    {
      analogWrite(pwm, 153);
      lcd.print("Led at: 60%   ");
      delay(100);
    }
    
    else if(temp==29)
    {
      analogWrite(pwm, 204);
      lcd.print("Led at: 80%    ");
      delay(100);
    }
     else if(temp>29)
    {
      analogWrite(pwm, 255);
      lcd.print("Led at: 100%   ");
      delay(100);
    } 
  delay(3000);
}

