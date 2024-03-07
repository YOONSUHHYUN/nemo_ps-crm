<?php

require("config/config.php");
require("lib/db.php");

// db_init 함수를 사용하여 MySQL 서버에 연결
$conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);

// 연결 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 쿼리 작성
$sql = "SELECT 
Year,
Month,
네모콜,
네모SMS,
직방,
네모콜 + 네모SMS + 직방 AS '합',
(네모콜 + 네모SMS + 직방) - LAG((네모콜 + 네모SMS + 직방), 1, 0) OVER (ORDER BY Year ASC, Month ASC)  AS '등락'
FROM (
SELECT 
    YEAR(요청일) AS Year,
    MONTH(요청일) AS Month,
    SUM(IF(분류 = '네모콜', 1, 0)) AS '네모콜',
    SUM(IF(분류 = '네모SMS', 1, 0)) AS '네모SMS',
    SUM(IF(분류 = '직방', 1, 0)) AS '직방'
FROM
(		
    (SELECT `중개업소아이디`, `중개업소명`,  `통화시작` as `요청일`, '네모콜' as 분류
    FROM call_list
    WHERE `중개업소아이디` = '8d7852b5-3698-4f48-90b2-3e0ce8f9ca88')

    UNION ALL		

    (SELECT `아이디` as `중개업소아이디`, `중개업소명`, `요청일`, '네모SMS' as 분류
    FROM sms_list
    WHERE `중개업소명` = '커피한잔공인중개사사무소' and `대표자명` = '손별')

    UNION ALL

    (SELECT `업체고유키` as `중개업소아이디`, `중개업소명`, `요청일`, '직방' as 분류
    FROM zig_sms
    WHERE `업체고유키` = '8d7852b5-3698-4f48-90b2-3e0ce8f9ca88')		
) AS combine_call
GROUP BY 
    YEAR(요청일), MONTH(요청일)
) AS subquery
ORDER BY 
Year DESC, Month DESC";

// 쿼리 실행
$result = $conn->query($sql);

// 결과를 배열로 변환
$data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// 결과 출력 (JSON 형태로)
echo json_encode($data);

// 연결 종료
$conn->close();
?>
