<?php
require("config/config.php");
require("lib/db.php");
$conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);

$num = $_GET['num'];

//$sql = "SELECT * FROM agent2 WHERE num = '$num' ORDER BY 컨택일 DESC";

$sql = "SELECT AAA.고유키, AAA.`수신`, AAA.`회사소개`, AAA.`상품소개`, AAA.`결제여부`, AAA.`관심도`, AAA.`현상태`, AAA.`메모`, AAA.`담당자`, AAA.`문자동의`, AAA.`컨택일` FROM
    (SELECT  a.고유키, a.연락처, aa.num, aa.담당자, aa.수신, aa.회사소개, aa.상품소개, aa.결제여부, aa.관심도, aa.현상태, aa.메모, aa.문자동의, aa.컨택일 FROM target a
    LEFT JOIN agent aa ON a.num = aa.num
    WHERE a.고유키 = '$num') AAA 
UNION ALL 
SELECT BBB.고유키, BBB.`수신`, BBB.`회사소개`, BBB.`상품소개`, BBB.`결제여부`, BBB.`관심도`, BBB.`현상태`, BBB.`메모`, BBB.`담당자`, BBB.`문자동의`, BBB.`컨택일` FROM
    (SELECT b.고유키, b.휴대폰번호, bb.num, bb.담당자, bb.수신, bb.회사소개, bb.상품소개, bb.결제여부, bb.관심도, bb.현상태, bb.메모, bb.문자동의, bb.컨택일 FROM customer b
    LEFT JOIN agent bb ON b.고유키 = bb.num
    WHERE b.고유키 = '$num') BBB ORDER BY 컨택일 DESC ";



//$sql = "SELECT AAA.고유키, AAA.`수신`, AAA.`메모`, AAA.`담당자`, AAA.`문자동의`, AAA.`컨택일` FROM
//    (SELECT  a.고유키, aa.수신, aa.메모, aa.담당자, aa.문자동의, aa.컨택일 FROM target a
//   LEFT JOIN agent aa ON a.num = aa.num
//    WHERE a.고유키 = '$num') AAA 
//UNION ALL 
//SELECT BBB.고유키, BBB.`수신`, BBB.`메모`, BBB.`담당자`, BBB.`문자동의`, BBB.`컨택일` FROM
 //   (SELECT b.고유키, b.휴대폰번호, bb.수신, bb.메모, bb.담당자, bb.문자동의, bb.컨택일 FROM customer b
//    LEFT JOIN agent bb ON b.고유키 = bb.num
//    WHERE b.고유키 = '$num') BBB ORDER BY 컨택일 DESC ";



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