<?php


require("config/config.php");
require("lib/db.php");
$conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);

$phonenum = $_GET['phonenum'];


// 입력한 연락처가 이미 데이터베이스에 존재하는지 확인
$sql = "SELECT COUNT(*) AS count FROM target WHERE 연락처 = '$phonenum'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$count = $row['count'];

// 중복 여부에 따라 응답을 보냄
if ($count > 0) {
  echo 'duplicate';
} else {
  echo 'not_duplicate';
}


?>
