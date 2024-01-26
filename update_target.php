<!DOCTYPE html>
<html>
<head>
<style>
table {
  border-collapse: collapse;
  width: 100%;
  margin-bottom: 20px;
}

th, td {
  border: 1px solid black;
  padding: 8px;
  text-align: left;
}

th {
  background-color: #f2f2f2;
}

/* 추가된 스타일 */
.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 20px;
}

.form-container {
  background-color: #f5f5f5;
  padding: 20px;
  border: 1px solid #ddd;
  border-radius: 5px;
}
</style>






</head>
<body>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-vtXRMe3mGCbOeY7l30aIg8H9p3GdeSe4IFlP6G8JMa7o7lXvnz3GFKzPxzJdPfGK" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

  






<?php
require("config/config.php");
require("lib/db.php");
$conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST["button1"])){

    $num = $_POST['num'];
    $companyName = $_POST['companyName'];
    $ceoName = $_POST['ceoName'];
    $city = $_POST['city'];
    $district = $_POST['district'];
    $primarykey = $_POST['primarykey'];

 
    


    $sql = "UPDATE target SET 업체명='$companyName', 대표자명='$ceoName', 시도='$city', 시군구='$district', 고유키='$primarykey' WHERE num='$num'";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('수정이완료되었습니다.');</script>";
        
    } else {
        echo "Error updating record: " . $conn->error;
    }}
    elseif (isset($_POST["button2"])) {
      $num = $_POST['num2'];
      $receive = $_POST['수신'];
      $introduction = $_POST['회사소개'];
      $pduction = $_POST['상품소개'];
      $pstatus = $_POST['결제여부'];
      $interest = $_POST['관심도'];
      $cstate = $_POST['현상태'];
      $agent = $_POST['agent'];
      $amessage = $_POST['문자동의'];
      $memo = $_POST['메모'];
      date_default_timezone_set('Asia/Seoul');
      $currentDateTime = date('Y-m-d H:i:s');
      $targetUrl = "update_target.php?num=" . urlencode($num);



      $sql2234 = "INSERT INTO agent(num, 담당자, 수신, 회사소개, 상품소개, 결제여부, 컨택일, 관심도, 현상태, 메모, 문자동의) 
        VALUES ('$num', '$agent', '$receive', '$introduction', '$pduction', '$pstatus', '$currentDateTime', '$interest', '$cstate', '$memo', '$amessage')";
      if ($conn->query($sql2234) === TRUE) {
        echo "<script>alert('버튼2 등록이완료되었습니다.');</script>";
        header("Location: " . $targetUrl);
        
    } else {
        echo "Error updating record: " . $conn->error;
        echo "er". $num;

    }
}}

$num = $_GET['num'];

$sql = "SELECT * FROM target WHERE num = '$num'";
$result = $conn->query($sql);
?>
<div class="container d-flex justify-content-center col-5" style="width:100%;">


<?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $currentCompanyName = $row['업체명'];
        $currentCEOName = $row['대표자명'];
        $currentContact = $row['연락처'];
        $currentCity = $row['시도'];
        $currentDistrict = $row['시군구'];
        $primarykey = $row['고유키'];
    }
    echo "<form method='POST' >"; // 폼을 POST 방식으로 변경
    echo "<table style='width: 100%;'>";
    echo "<tr><th>num</th><th>업체명</th><th>대표자명</th><th>연락처</th><th>시도</th><th>시군구</th><th>고유키</th></tr>";
    echo "<tr>";
    echo "<td>$num</td>";
    echo "<td class='editable' data-field='업체명' data-num='$num'><input type='text' name='companyName' value='$currentCompanyName'></td>";
    echo "<td class='editable' data-field='대표자명' data-num='$num'><input type='text' name='ceoName' value='$currentCEOName'></td>";
    echo "<td >$currentContact</td>";
    echo "<td class='editable' data-field='시도' data-num='$num'><input type='text' name='city' value='$currentCity'></td>";
    echo "<td class='editable' data-field='시군구' data-num='$num'><input type='text' name='district' value='$currentDistrict'></td>";
    echo "<td class='editable' data-field='고유키' data-num='$num'><input type='text' name='primarykey' value='$primarykey'></td>";
    echo "</tr>";
    echo "</table>";
    echo "<input type='hidden' name='num' value='$num'>";
    echo "<center><button type='submit' name='button1'>수정</button></center>";
    echo "</form>";
    
} else {
    echo "No data found.";
}

$conn->close();
?>
</div>


<div class="container d-flex justify-content-center col-5">
    
            <form method='POST' id='update-form'>
            <center>
          
       
        
        <select name="수신" id="수신" class="form-control">
          <option value=""> /수신/ </option>
          <option value="성공">성공</option>
          <option value="지연">지연</option>
          <option value="실패">실패</option>
          <option value="문자">문자</option> 
        </select>
        <select name="회사소개" id="회사소개" class="form-control">
          <option value=""> /회사소개/ </option>
          <option value="성공">성공</option>
          <option value="지연">지연</option>
          <option value="실패">실패</option> 
        </select>
        <select name="상품소개" id="상품소개" class="form-control">
          <option value=""> /상품소개/ </option>
          <option value="성공">성공</option>
          <option value="지연">지연</option>
          <option value="실패">실패</option> 
        </select>
        <select name="결제여부" id="결제여부" class="form-control">
          <option value=""> /결제여부/ </option>
          <option value="성공">성공</option>
          <option value="지연">지연</option>
          <option value="실패">실패</option> 
        </select>
        <select name="관심도" id="관심도" class="form-control">
          <option value=""> /관심도/ </option>
          <option value="관심0">관심0(연락거절)</option>
          <option value="관심1">관심1(이용안해요)</option>
          <option value="관심2">관심2(문자로보내주세요)</option>
          <option value="관심3">관심3(가격안내+문자요청)</option>
          <option value="관심4">관심4(컨설팅+문자전송)</option> 
        </select>
        <select name="현상태" id="현상태" class="form-control">
          <option value=""> /현상태/ </option>
          <option value="관리1">관리1(이탈)</option>
          <option value="관리2">관리2(애매)</option>
          <option value="관리3">관리3(긍정)</option>
          <option value="결제성공">결제성공</option>
        
        </select>
        <select name="agent" id="agent">
                <option value="">담당자</option>
                <option value="윤서현">윤서현</option>
                <option value="이다영">이다영</option>
                <option value="이지나">이지나</option>
                <option value="최효주">최효주</option>
                <option value="정종형">정종형</option>
            </select>
            <select name="문자동의" id="문자동의">
                <option value="">문자동의</option>
                <option value="O">O</option>
                <option value="X">X</option>
            </select> 

        <input type='text' id='autoSizingSelect' placeholder="메모" name='메모'>
        <input type = 'hidden' value = <?php echo $num; ?> name = 'num2'/>
            <input type='submit' value = 'UPDATE' class='btn btn-outline-secondary' name='button2' form='update-form'>
            </center>
           </form>


</div>




<div style="width: 100%;">
  <table class="table">
    <thead>
      <tr>
        <th>수신</th>
        <th>회사소개</th>
        <th>상품소개</th>
        <th>관심도</th>
        <th>현상태</th>
        <th>결제여부</th>
        <th>메모</th>
        <th>담당자</th>
        <th>문자동의</th>
        <th>컨택일</th>
        <!-- Add other column headers as needed -->
      </tr>
    </thead>
    <tbody id="targetTable">
      <!-- This table body will be populated dynamically using JavaScript -->
    </tbody>
  </table>
</div>




<script>
  function fetchTargetData() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          // Parse the JSON response
          var targetData = JSON.parse(xhr.responseText);

          // Manipulate the HTML to display the data
          var targetTable = document.getElementById('targetTable');
          targetTable.innerHTML = ''; // Clear existing table data

          targetData.forEach(function(row) {
            var newRow = targetTable.insertRow();
            
            newRow.insertCell().innerText = row['수신'];
            newRow.insertCell().innerText = row['회사소개'];
            newRow.insertCell().innerText = row['상품소개'];
            newRow.insertCell().innerText = row['관심도'];
            newRow.insertCell().innerText = row['현상태'];
            newRow.insertCell().innerText = row['결제여부'];
            newRow.insertCell().innerText = row['메모'];
            newRow.insertCell().innerText = row['담당자'];
            newRow.insertCell().innerText = row['문자동의'];
            newRow.insertCell().innerText = row['컨택일'];
            // Add other columns as needed
          });
        } else {
          // Handle request failure
          console.error('Failed to fetch target data.');
        }
      }
    };

    // Send AJAX request to the PHP script that fetches the data
    xhr.open('GET', 'get_target_data_agent.php?num=<?php echo urlencode($_GET['num']); ?>', true);
    xhr.send();
  }

  // Call the function initially and set an interval to refresh the data periodically
  fetchTargetData();
  setInterval(fetchTargetData, 500000); // Refresh every 5 seconds (adjust as needed)
</script>