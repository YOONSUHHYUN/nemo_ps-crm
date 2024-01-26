<?php

// Insert data into target table
$update3 = mysqli_query($conn, "INSERT INTO target(업체명, 대표자명, 연락처, 시도, 시군구) VALUES ('".$_GET['company']."','".$_GET['owner']."','".$_GET['phonenum']."','".$_GET['address1']."','".$_GET['address2']."')");

// Get the last inserted num from the target table
$lastInsertedNum = mysqli_insert_id($conn);

// Get the current date and time in the desired format (e.g., 'Y-m-d H:i:s')
date_default_timezone_set('Asia/Seoul');
$currentDateTime = date('Y-m-d H:i:s');

// Insert data into agent table with the same num and current date/time for 컨택일
$updateAgent = mysqli_query($conn, "INSERT INTO agent(num, 담당자, 수신, 회사소개, 상품소개, 결제여부, 컨택일, 관심도, 현상태, 메모, 문자동의) VALUES ('$lastInsertedNum', '".$_GET['agent']."', '".$_GET['수신']."', '".$_GET['회사소개']."', '".$_GET['상품소개']."', '".$_GET['결제여부']."', '$currentDateTime', '".$_GET['관심도']."', '".$_GET['현상태']."', '".$_GET['메모']."', '".$_GET['문자동의']."')");

$deleteAgentZero = mysqli_query($conn, "DELETE FROM agent WHERE num = 0");
?>
