<?php
require("config/config.php");
require("lib/db.php");
$conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);

$searchQuery = $_GET['search'];

// Modify the SQL query to include the search condition
//$sql = "SELECT * FROM target LEFT JOIN agent ON target.num = agent.num 
$sql = "SELECT 
combined.num,
combined.업체명,
combined.대표자명,
combined.시도,
combined.시군구,
combined.연락처,
combined.고유키,
combined.담당자,
combined.수신,
combined.회사소개,
combined.상품소개,
combined.결제여부,
combined.관심도,
combined.현상태,
combined.메모,
combined.컨택일,
combined.voc1,
combined.voc2
FROM (
SELECT 
    customer.`고유키` as num,
    customer.`중개업소명` as 업체명,
    customer.`대표자명`,
    customer.`시` as 시도,
    customer.`구` as 시군구,
    customer.`휴대폰번호` as 연락처,
    customer.`고유키`,
    agent.`담당자`,
    agent.`수신`,
    agent.`회사소개`,
    agent.`상품소개`,
    agent.`결제여부`,
    agent.`관심도`,
    agent.`현상태`,
    agent.`메모`,
    agent.`컨택일`,
    agent.`voc1`,
    agent.`voc2`
FROM customer
LEFT JOIN agent ON customer.고유키 = agent.num 

UNION ALL

SELECT 
    target.num,
    target.`업체명`,
    target.`대표자명`,
    target.`시도`,
    target.`시군구`,
    target.`연락처`,
    target.`고유키`,
    agent.`담당자`,
    agent.`수신`,
    agent.`회사소개`,
    agent.`상품소개`,
    agent.`결제여부`,
    agent.`관심도`,
    agent.`현상태`,
    agent.`메모`,
    agent.`컨택일`,
    agent.`voc1`,
    agent.`voc2`
FROM target 
LEFT JOIN agent ON target.num = agent.num
) AS combined
WHERE
        대표자명 LIKE '%" . mysqli_real_escape_string($conn, $searchQuery) . "%' OR
        업체명 LIKE '%" . mysqli_real_escape_string($conn, $searchQuery) . "%' OR
        연락처 LIKE '%" . mysqli_real_escape_string($conn, $searchQuery) . "%'
        ORDER BY combined.컨택일 DESC;
";

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