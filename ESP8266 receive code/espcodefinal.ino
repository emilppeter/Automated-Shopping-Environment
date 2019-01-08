#include <ESP8266WiFi.h>

const char* ssid     = "Pep";
const char* password = "emil7398";

const char* host = "192.168.43.32";

void setup() {
  Serial.begin(9600);
  delay(10);

  // We start by connecting to a WiFi network

  /*Serial.println();
  Serial.println();
 Serial.print("Connecting to ");
 Serial.println(ssid);*/ 
  WiFi.begin(ssid, password);
  
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
   // Serial.print(".");
  }

  /*Serial.println("");
  Serial.println("WiFi connected");  
  Serial.println("IP address: ");
  Serial.println(WiFi.localIP());*/
}

void loop() {
  delay(5000);
  /*Serial.print("connecting to ");
  Serial.println(host);*/
  
  // Use WiFiClient class to create TCP connections
  WiFiClient client;
  const int httpPort = 8012;
  if (!client.connect(host, httpPort)) {
    Serial.println("connection failed");
    return;
  }
  
  // We now create a URI for the request
  String url = "http://3703727d.ngrok.io/Amazon/read.txt";

  
  //Serial.print("Requesting URL: ");
 // Serial.println(url);
  
  // This will send the request to the server
  client.print(String("GET ") + url + " HTTP/1.1\r\n" +
               "Host: " + host + "\r\n" + 
               "Connection: close\r\n\r\n");
  unsigned long timeout = millis();
  while (client.available() == 0) {
    if (millis() - timeout > 5000) {
      Serial.println(">>> Client Timeout !");
      client.stop();
      return;
    }
  }
  
  // Read all the lines of the reply from server and print them to Serial
  while(client.available()){
   char line = client.read();

   if(line == '@')
   {
    //Serial.print(line);
     if(client.available())
     {
      String line = client.readStringUntil('#');
      int i=line.length();      
      Serial.println('@'+line+'#');
     }
   }
  
    //Serial.print(line);
  }
  
  //Serial.println();
  //Serial.println("closing connection");
}

