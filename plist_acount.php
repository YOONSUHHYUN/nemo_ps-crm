<?php
require("config/config.php");
require("lib/db.php");
$conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);

$num = $_GET['num'];

$sql = "SELECT * FROM plist WHERE 업체아이디 = '$num'  ORDER BY 그룹 DESC ";


$result = mysqli_query($conn, $sql);

// Fetch all the rows from the result set as an associative array
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// Close the database connection
mysqli_close($conn);

// Return the data as JSON
header('Content-Type: application/json');
echo json_encode($data);
?>