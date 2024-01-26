<?php
require("config/config.php");
require("lib/db.php");
$conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);

// Get the current date and time in the desired format (e.g., 'Y-m-d H:i:s')
date_default_timezone_set('Asia/Seoul');
$currentDateTime = date('Y-m-d H:i:s');

// Insert data into agent table with the same num and current date/time for 컨택일
$updateAgent = mysqli_query($conn, "INSERT INTO agent(num, 담당자, 수신, 회사소개, 상품소개, 결재여부, 컨택일, 관심도, 현상태, 메모, 문자동의) VALUES ('".$_GET['num']."', '".$_GET['agent']."', '".$_GET['수신']."', '".$_GET['회사소개']."', '".$_GET['상품소개']."', '".$_GET['결재여부']."', '$currentDateTime', '".$_GET['관심도']."', '".$_GET['현상태']."', '".$_GET['메모']."', '".$_GET['문자동의']."')");

$deleteAgentZero = mysqli_query($conn, "DELETE FROM agent WHERE num = 0");
?>
