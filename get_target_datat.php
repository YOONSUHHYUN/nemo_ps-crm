<?php
require("config/config.php");
require("lib/db.php");
$conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);

$searchQuery = $_GET['search'];

// Modify the SQL query to include the search condition
$sql = "SELECT * FROM target LEFT JOIN agent ON target.num = agent.num WHERE
        대표자명 LIKE '%" . mysqli_real_escape_string($conn, $searchQuery) . "%' OR
        업체명 LIKE '%" . mysqli_real_escape_string($conn, $searchQuery) . "%' OR
        연락처 LIKE '%" . mysqli_real_escape_string($conn, $searchQuery) . "%'
        ORDER BY agent.컨택일 DESC";
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