<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Chart.js로 MySQL 데이터 시각화하기</title>
  <!-- Chart.js CDN 링크 -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<?php
// MySQL 연결 설정
$servername = "localhost";
$username = "root";
$password = "five2324";
$dbname = "nemo_refund";

// MySQL 연결 생성
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// MySQL 쿼리 실행
$sql5 = "
SELECT 
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
    Year DESC, Month DESC;
";
$result5 = $conn->query($sql5);

// 결과를 배열로 변환
$data = array();
if ($result5->num_rows > 0) {
  while($row5 = $result5->fetch_assoc()) {
    $data[] = $row5;
  }
}

// MySQL 연결 닫기
$conn->close();
?>


<script>
  // MySQL 쿼리 결과 데이터
  const data = <?php echo json_encode($data); ?>;

  // 차트 그리기
  const ctx = document.getElementById("myChart").getContext("2d");
  const myChart = new Chart(ctx, {
    type: "line",
    data: {
      labels: data.map((item) => `${item.Year}-${item.Month}`),
      datasets: [
        {
          label: "네모콜",
          data: data.map((item) => item.네모콜),
          backgroundColor: "rgba(255, 99, 132, 0.2)",
          borderColor: "rgba(255, 99, 132, 1)",
          borderWidth: 1,
        },
        {
          label: "네모SMS",
          data: data.map((item) => item.네모SMS),
          backgroundColor: "rgba(54, 162, 235, 0.2)",
          borderColor: "rgba(54, 162, 235, 1)",
          borderWidth: 1,
        },
        {
          label: "직방",
          data: data.map((item) => item.직방),
          backgroundColor: "rgba(255, 206, 86, 0.2)",
          borderColor: "rgba(255, 206, 86, 1)",
          borderWidth: 1,
        },
        {
          label: "합",
          data: data.map((item) => item.합),
          backgroundColor: "rgba(75, 192, 192, 0.2)",
          borderColor: "rgba(75, 192, 192, 1)",
          borderWidth: 1,
        },
      
      ],
    },
    options: {
      scales: {
        yAxes: [
          {
            ticks: {
              beginAtZero: true,
            },
          },
        ],
      },
      // 데이터 라벨 설정
      plugins: {
        datalabels: {
          anchor: 'end',
          align: 'top',
          formatter: function(value, context) {
            return context.chart.data.datasets[context.datasetIndex].data[context.dataIndex];
          }
        }
      }
    },
  });
</script>
</body>
</html>
