<?php
require_once("../../files/assign2personaldata.php");

// Check if the request method is PUT
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // Get the data from the request body
    $putdata = file_get_contents('php://input');
    $data = json_decode($putdata, true);

    // Check if bookingnumber is provided in the data
    if (isset($data['bookingnumber'])) {
        // Establish database connection
        $conn = mysqli_connect($local_host, $user, $password, $database);

        if (!$conn) {
            die("Connection failed");
        } else {
            $bookingnumber = mysqli_real_escape_string($conn, $data['bookingnumber']);

            // Construct SQL query to update assign status
            $updateQuery = "UPDATE $table SET status = 'assigned' WHERE bookingnumber = '$bookingnumber'";
            $updateResult = mysqli_query($conn, $updateQuery); // execute sql query

            if ($updateResult) {
                // Send success response
                echo json_encode(array("success" => true));
            } else {
                // Send error response
                echo json_encode(array("success" => false, "error" => "Error updating assign status: " . mysqli_error($conn)));
            }
        }
    } else {
        // Send error response
        echo json_encode(array("success" => false, "error" => "Booking number not provided in the request data."));
    }
} else {
    // Send error response
    echo json_encode(array("success" => false, "error" => "Invalid request method. This endpoint only accepts PUT requests."));
}
?>