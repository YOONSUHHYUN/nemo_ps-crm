<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once 'config/config.php';

    // 데이터베이스 연결
    $conn = new mysqli($config['host'], $config['duser'], $config['dpw'], $config['dname']);

    // 데이터베이스 연결 오류 처리
    if ($conn->connect_error) {
        die("데이터베이스 연결 실패: " . $conn->connect_error);
    }

    if (isset($_POST['selected_agent']) || isset($_POST['selected_status'])) {
        // 선택한 담당자와 현상태
        $selectedAgent = $_POST['selected_agent'];
        $selectedStatus = isset($_POST['selected_status']) ? $_POST['selected_status'] : '';

        // SQL 쿼리 생성
        $sql222 = "SELECT * FROM agent A LEFT JOIN target B ON A.num = B.num WHERE 1=1";

        if (!empty($selectedAgent)) {
            $sql222 .= " AND `담당자` = '$selectedAgent'";
        }

        if (!empty($selectedStatus)) {
            $sql222 .= " AND `현상태` = '$selectedStatus'";
        }

        $sql222 .= " AND (`관심도` = '관심3' OR `관심도` = '관심4') ORDER BY `컨택일` DESC";

        // SQL 쿼리 실행
        $result222 = $conn->query($sql222);

        // Check for query execution success
        if (!$result222) {
            die("쿼리 실행 실패: " . $conn->error); // Add error handling to show the query error message
        }

        // 쿼리 결과 처리
        if ($result222->num_rows > 0) {
            echo '<div class="table-responsive">';
            echo '<table class="table table-bordered table-striped">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>NUM</th>';
            echo '<th>업체명</th>';
            echo '<th>대표자명</th>';
            echo '<th>연락처</th>';
            echo '<th>주소1</th>';
            echo '<th>주소2</th>';
            echo '<th>관심도</th>';
            echo '<th>현상태</th>';
            echo '<th>메모</th>';
            echo '<th>문자동의</th>';
            echo '<th>담당자</th>';
            echo '<th>컨택일</th>';
            // Add other column headers as needed
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            while ($row221 = $result222->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row221['num'] . '</td>';
                echo '<td>' . $row221['업체명'] . '</td>';
                echo '<td>' . $row221['대표자명'] . '</td>';
                echo '<td>' . $row221['연락처'] . '</td>';
                echo '<td>' . $row221['시도'] . '</td>';
                echo '<td>' . $row221['시군구'] . '</td>';
                echo '<td>' . $row221['관심도'] . '</td>';
                echo '<td>' . $row221['현상태'] . '</td>';
                echo '<td>' . (strlen($row221['메모']) > 10 ? substr($row221['메모'], 0, 10) . "..." : $row221['메모']) . '</td>';
                echo '<td>' . $row221['문자동의'] . '</td>';
                echo '<td>' . $row221['담당자'] . '</td>';
                echo '<td>' . $row221['컨택일'] . '</td>';
                // 필요한 열에 대해 이와 같이 추가하면 됩니다.
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
            echo '</div>';
        } else {
            echo "결과가 없습니다.";
        }

        // 데이터베이스 연결 해제
        $conn->close();
    } else {
        echo "선택한 담당자가 없습니다.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" >
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-vtXRMe3mGCbOeY7l30aIg8H9p3GdeSe4IFlP6G8JMa7o7lXvnz3GFKzPxzJdPfGK" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <title>Platform Sales CRM ..ETC..</title>
</head>
<body>

<div id="agentFormContainer">
        <h1>담당자 선택하기</h1>
        <select name="selected_agent" id="agent">
            <option value="윤서현">윤서현</option>
            <option value="이다영">이다영</option>
            <option value="이지나">이지나</option>
            <option value="최효주">최효주</option>
        </select>
        
    </div>

    <div id="statusFormContainer">
        <h1>현상태 선택하기9</h1>
        <select name="selected_status" id="status">
            <option value="">전체</option>
            <option value="관리1">관리1</option>
            <option value="관리2">관리2</option>
            <option value="관리3">관리3</option>
            <option value="결제성공">결제성공</option>
            <option value="이탈">이탈</option>
        </select>
        <input type="submit" name="statusSearch" value="검색">
    </div>

    <div id="result"></div>



</br></br></br>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        var request;

        function getSelectedData() {
            var selectedAgent = $("#agent").val();
            var selectedStatus = $("#status").val();
            return { selected_agent: selectedAgent, selected_status: selectedStatus };
        }

        function fetchResults() {
            if (request && request.readyState !== 4) {
                request.abort();
            }

            // Ajax request for both selected agent and selected status
            request = $.ajax({
                type: "POST",
                url: "<?php echo $_SERVER['PHP_SELF']; ?>",
                data: getSelectedData(),
                success: function (response) {
                    $("#result").html(response);
                },
                error: function (xhr, status, error) {
                    console.error("Ajax 요청 실패:", error);
                }
            });
        }

        // Additional event handling to trigger AJAX request when the select option is changed
        $("#agent, #status").on("change", function () {
            // Clear the previous results before fetching new ones
            $("#result").html("");
            fetchResults();
        });

        // Trigger the AJAX request when the page loads to display initial results
        fetchResults();
    });
</script>



    





</body>
</html>
