<?php
session_start();
 if (!isset ($_SESSION["number"])) { // check if session variable exists
          $_SESSION["number"] = 0; // create the session variable
          }
         $num = $_SESSION["number"]; // copy the value to a variable
$num++; // increment the value
$_SESSION["number"] = $num; // update the session variable


require_once("../../files/assign2personaldata.php");

$conn = mysqli_connect($local_host, $user, $password, $database);

 if (!$conn) // if there is no connection, connection failed
{
            die("Connection failed");
        } 
            else 
{
if(isset($_POST['cname']) && isset($_POST['phone']) && isset($_POST['snumber'])
   && isset($_POST['stname']) && isset($_POST['date']) && isset($_POST['time'])) // if these input is set
      {
        $l = "BRN";
        $d = str_pad($_SESSION["number"], 5, '0', STR_PAD_LEFT);
        $bookingreference = $l. $d;
      	$cname = $_POST['cname'];
	$phone = $_POST['phone'];
        $unumber = isset($_POST['unumber']) ? $_POST['unumber'] : NULL;
        $snumber = $_POST['snumber'];
        $stname = $_POST['stname'];
        $sbname = isset($_POST['sbname']) ? $_POST['sbname'] : NULL;
        $dsbname = isset($_POST['dsbname']) ? $_POST['dsbname'] : NULL;
        $date = $_POST['date'];
        $time = $_POST['time'];
     
        $insertquery = "INSERT INTO `taxibooking`(bookingnumber, date, time, cname, phone, unumber, snumber, stname, sbname, dsbname) 
     VALUES ('$bookingreference','$date','$time','$cname','$phone','$unumber','$snumber','$stname','$sbname','$dsbname')";

     $result = mysqli_query($conn, $insertquery ); // execute sql query 
     $fetchquery = "SELECT * FROM $table WHERE bookingnumber='$bookingreference' AND date ='$date' AND time ='$time'";
     $result2 = mysqli_query($conn, $fetchquery); // execute sql query 
        if($result)
         {
               if($row = mysqli_fetch_assoc($result2)) // fetch sql row by matching booking reference number, date and time
             {
             echo"Thank you for your booking! 

                  Booking reference number: {$row['bookingnumber']}
                  Pickup time:                       {$row['time']}
                  Pickup date:                       {$row['date']}";    
             }    
                } 
                 else 
                {
                    $error = mysqli_error($conn);
    echo "Failed to submit your request. Please try again" . $error;
                }

                 
       }
   }
// Close database connection
        mysqli_close($conn);

?>