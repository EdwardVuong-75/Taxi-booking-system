My WEB DEV assignment 2 has 12 files:
- 2 html files: booking.html and admin.html
- 2 javascript files: bookingvalidation.js and bookingsearch.js
- 2 css files: style.css and style2.css
- 3 php files: data.php , adminserver.php and assigned.php
- 1 sql file stores all sql queries in this assignment: mysqlcommand.txt
- 1 jpg file for back ground decoration in booking.html
- readme.txt

Instruction:
- For the client side:
+ First, client will input their information in form located in booking.html
+ In order to submit the form request, these mandatory fields client need to fill are: Customer name, phone number, Street Number, Street Name, Pick up date, Pick up time
and the rest are optional: Unit Number, Destination Suburb and Suburb
+ Phone number field need to be filled as number only with a length from 10 to 12
+ Then, the system will give client a booking reference number with their pick up time and pick up date right after they submit the form

- For the admin side:
+ Admin will search correct booking reference number from the system.
+ The admin must input correct format start with "BRN" follows with 5 digits
+ If user input is empty, then a list of bookings with a pickup time within 2 hours from the current time 
+ If there is a booking with correct format, they will see a booking reference number and other client information
+ Change the status from “unassigned” to “assigned” for the matching record by clicking a button "assign"
+ After that, a confirmation message should be returned