<?php
require_once("../../files/assign2personaldata.php");

header('Content-Type: application/json');

$conn = mysqli_connect($local_host, $user, $password, $database);

if (!$conn) {
    echo json_encode(['error' => 'Connection failed']);
    exit;
}

$Bsearch = $_GET['bsearch'] ?? '';
$searchingquery = "SELECT *, CONCAT(date, ' ', time) as datetime FROM $table WHERE CONCAT(date, ' ', time) BETWEEN NOW() AND NOW() + INTERVAL 2 HOUR AND status = 'unassigned'";
$result = mysqli_query($conn, $searchingquery);

$searchingbookingno = "SELECT *, CONCAT(date, ' ', time) as datetime FROM $table WHERE bookingnumber = '$Bsearch'";
$result2 = mysqli_query($conn, $searchingbookingno);

if ($Bsearch) {
    if (!preg_match("/^BRN\d{5}$/", $Bsearch)) // check if the input is matched as format
{
        echo json_encode(['error' => "Wrong format! The status code must start with 'BRN' followed by 5 digits, like 'BRN00001'."]);
        exit;
    } else {
        if ($row = mysqli_fetch_assoc($result2)) // if the booking reference number is matched, it will fetch the data from database and show to html web
        {
            echo json_encode([$row]);
            exit;
        } else {
            echo json_encode([]);
            exit;
        }
    }
} else {
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    echo json_encode($rows);
}?>