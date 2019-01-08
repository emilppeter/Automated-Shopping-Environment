/*-------definning Inputs------*/
#define LS 2      // left sensor
#define RS 3      // right sensor

/*-------definning Outputs------*/
#define LM1 4       // left motor
#define LM2 5       // left motor
#define RM1 6       // right motor
#define RM2 7       // right motor
#define E2 10  
#define E1  9
struct lookUp
{
  char item;
  int priority;
  };
struct lookUp look[]={{'T',1},{'C',2},{'L',3},{'M',4}};  
String data,data1="",data2;
void search(void);
int count3=0;
int quantity[4]; 
int stops[4];
int count=0;
int no_stops=0;
void moveForward(void);
void turnRight(void);
void turnLeft(void);
void stopThere(void);
void setup()
{
  Serial.begin(9600);
  pinMode(LS, INPUT);     //initializing the pins
  pinMode(RS, INPUT);
  pinMode(LM1, OUTPUT);
  pinMode(LM2, OUTPUT);
  pinMode(RM1, OUTPUT);
  pinMode(RM2, OUTPUT);
  pinMode(E1, OUTPUT);
  pinMode(E2, OUTPUT);
  
}

void loop()
{
  if (Serial.read()=='@')
  {   
      data=Serial.readStringUntil('#');  //receiving data from the WiFi module
      Serial.println(data);    
      count++;
      delay(9000); 
 }
  int i,j=0;
 for(j=0;j<4;j++)
 {                                    
  stops[j]=0;                          //assigning stops     
  //quantity[j]='0';
    for(i=0;i<data.length();i++)
  {   
      if (data[i]==look[j].item)
      {
                   stops[j]=1;
                  //quantity[j]=data[i+1];                               
      }
    }
 }
  analogWrite(E1,120);
  analogWrite(E2,120);
  if(digitalRead(LS) && digitalRead(RS))     // Move Forward
  {
    moveForward();
    
  }
  
  if(!(digitalRead(LS)) && digitalRead(RS))     // Turn right
  {
    turnRight();
    
  }
  
  if(digitalRead(LS) && !(digitalRead(RS)))     // turn left
  {
    turnLeft();
    
  }
  
  if(!(digitalRead(LS)) && !(digitalRead(RS)))     // stop
  {  
   switch(no_stops)                                   
    {
      case 0:if (no_stops==0 && count==1)
              { 
                
                moveForward();             
                delay(500);
                no_stops++;
              }
              break;
      case 1:if (stops[0]==1)           //check if tomato is needed
              { 
                stopThere();
                delay(2000);
                moveForward();     
                delay(500);                
                no_stops++;
              }else
              {
                 moveForward();
                 delay(500);
                 no_stops++;
              
                }
              break;
      case 2: if (stops[1]==1)           //check if limca is needed
              { 
                stopThere();
                delay(2000);
                moveForward();
                delay(500);
                no_stops++;
              }
              else
              {
                 moveForward();
                 delay(500);
                 no_stops++;
                }              
              break;
       case 3: if (stops[2]==1)          //check if lays is needed
              { 
                stopThere();
                delay(2000);
                moveForward();
                delay(500);
                no_stops++;
              } else
              {
                 moveForward();
                 delay(500);
                 no_stops++;
                }
              break;
       case 4: if (stops[3]==1)         //check if minute maid is needed
              { 
                stopThere();
                delay(2000);
                moveForward();             
                delay(500);
                no_stops++;
              } 
              else
              {
                 moveForward();
                 delay(500);
                 no_stops++;
                }
              break;
       case 5: stopThere();           //return back to starting line and resets counts and waits for new data
               delay(2000);
               count=0;
               no_stops=0;
               break;     
       default: moveForward(); 
                delay(500);
                break;                  
      }
    
  }
}
void search()                         //segregating the required items from the received data
{
 int i,j;
 for(j=0;j<4;j++)
 {
  stops[j]=0;
  quantity[j]='0';
    for(i=0;i<data.length();i++)
  {   
      if (data[i]==look[j].item)
      {
                  stops[j]=1;
                  //quantity[j]=data[i+1];                               
      }
    }
 }
 }
void moveForward()
{
    digitalWrite(LM1, HIGH);
    digitalWrite(LM2, LOW);
    digitalWrite(RM1, HIGH);
    digitalWrite(RM2, LOW);  
  }
void turnRight()
{
    digitalWrite(LM1, LOW);
    digitalWrite(LM2, LOW);
    digitalWrite(RM1, HIGH);
    digitalWrite(RM2, LOW); 
  }  
void turnLeft()
{
    digitalWrite(LM1, HIGH);
    digitalWrite(LM2, LOW);
    digitalWrite(RM1, LOW);
    digitalWrite(RM2, LOW);
  }    
void stopThere()
{
    digitalWrite(LM1, LOW);
    digitalWrite(LM2, LOW);
    digitalWrite(RM1, LOW);
    digitalWrite(RM2, LOW);
    
  }      
