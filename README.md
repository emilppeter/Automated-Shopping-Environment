# Automated-Shopping-Environment
An automated shopping environment is designed which consists of two modules- Smart drawer and Automated trolley.The smart drawer updates the database with the name and quantity of each item placed/removed from the drawer.A webpage displays the items that are present in the drawer.Order to buy certain items can be placed online through a webpage and this list of items to be purchased is then send to the automated trolley designed.The trolley moves from one stop to another stop where the items to be purchased are placed,following the track designed for the trolley. Hence a single trolley will contain all the items ordered by a customer ready for home delivery. The bill for the items purchased is generated online.

Working-

•Smart Drawer:

  Arduino Uno is interfaced to a Load Cell and a barcode scanner.The former detects change in weight of the drawer, while the         latter detects the item that is being placed/removed from the drawer.Arduino serially transmits the information about the item     that is being placed/removed from the drawer to the GSM module interfaced with it, which in turn updates the database based on     this information.
  
•Automated Trolley:

  It is a line following robot designed to move from stop to stop along the track based on the list of items received from the       webpage.The list of items is send to the ESP8266 WiFi module over the WiFi network, which in turn serially transmits this           information to the Arduino.
  
•Webpage:

  A webpage is designed to display the items in the smart drawer alongwith their respective quantities,and where order can be         placed for items. A public URL was generated for the webpage using ngrok. 
