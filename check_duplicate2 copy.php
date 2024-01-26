<?php


require("config/config.php");
require("lib/db.php");
$conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);

$phonenum2 = $_GET['countnum'];
$sql21 = "SELECT COUNT(*) AS count FROM target WHERE 연락처 = '$phonenum2'";
$result21 = mysqli_query($conn, $sql21);

if (!$result21) {
    // 쿼리 실행 실패 시 처리
    echo 'query_error';
} else {
    $row21 = mysqli_fetch_assoc($result21);
    $count2 = $row21['count'];

    if ($count2 > 0) {
        echo 'duplicate2';
    } else {
        echo 'not_duplicate2';
    }
}


$sql22 = "SELECT * FROM agent A
        LEFT JOIN target B ON A.num = B.num
        WHERE 연락처 = '$phonenum2'
        ORDER BY 컨택일 DESC
        LIMIT 1";

// 쿼리 실행
$result22 = $conn->query($sql22);

if ($result22->num_rows > 0) {
    $row22 = $result22->fetch_assoc();
    $agentName = $row22['담당자'];
    $contactDate = $row22['컨택일'];
    echo $agentName . '|' . $contactDate; // '담당자'와 '컨택일'을 파이프(|)로 구분하여 반환
} else {
    echo 'not_duplicate2';
}





mysqli_close($conn);

?>
