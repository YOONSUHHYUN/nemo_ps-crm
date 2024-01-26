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
.box1,
  .box2 {
    width: 48%; /* Adjust the width as needed */
    float: left;
    margin-right: 2%; /* Adjust the margin between the boxes as needed */
  }

  .memo-input {
    width: 100%; /* Adjust the width as needed */
    padding: 70px; /* Adjust the padding as needed */}

    .memo-input2 {
    width: 100%; /* Adjust the width as needed */
    padding: 20px; /* Adjust the padding as needed */}



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
  
 
    if (isset($_POST["button2"])) {
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
      $targetUrl = "update_customer.php?num=" . urlencode($num);



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

$sql = "SELECT * FROM customer WHERE 고유키 = '$num'";
$result = $conn->query($sql);

$sql2 = "SELECT A.*, B.*
FROM customer A
LEFT JOIN (
    SELECT `업체아이디`, MAX(`edate`) AS max_edate
    FROM plist
    GROUP BY `업체아이디`
) B 
ON A.고유키 = B.`업체아이디`
WHERE A.고유키 = '$num'";
$result2 = $conn->query($sql2);
$row2 = $result2->fetch_assoc();

$sql3 = "SELECT * FROM target WHERE 고유키 = '$num'";
$result3 = $conn->query($sql3);
$row3 = $result3->fetch_assoc();
?>
<div class="container">


<?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $currentCompanyName = $row['중개업소명'];
        $currentCEOName = $row['대표자명'];
        $currentContact = $row['휴대폰번호'];
        $currentContact3 = $row['전화번호'];
        $currentContact2 = $row3['연락처'];
        $currentCity = $row['시'];
        $currentDistrict = $row['구'];
        $currentStatus = $row['구분'];
        $currentExpire = $row2['max_edate'];
        $currentjoindate = $row2['가입일'];
    }
    
    echo "<table>";
    echo "<tr><th>num</th><th>업체명</th><th>대표자명</th><th>연락처1Admin</th><th>연락처2Admin</th><th>연락처</th><th>시도</th><th>시군구</th><th>유/무료</th><th>상품종료일</th><th>가입일</th></tr>";
    echo "<tr>";
    echo "<td>$num</td>";
    echo "<td>$currentCompanyName</td>";
    echo "<td>$currentCEOName</td>";
    echo "<td >$currentContact</td>";
    echo "<td >$currentContact3</td>";
    echo "<td >$currentContact2</td>";
    echo "<td>$currentCity</td>";
    echo "<td>$currentDistrict</td>";
    echo "<td>$currentStatus</td>";
    echo "<td>$currentExpire</td>";
    echo "<td>$currentjoindate</td>";
    echo "</tr>";
    echo "</table>";
    
    
} else {
    echo "No data found.";
}

$conn->close();
?>
</div>


<div style="width: 100%;">
  <div class="box1">
    
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
        

        <input type='text' id='autoSizingSelect' placeholder="메모" name='메모' class='memo-input2'>
        <select name="agent" id="agent">
                <option value="">담당자</option>
                <option value="윤서현">윤서현</option>
                <option value="이다영">이다영</option>
                <option value="최효주">최효주</option>

            </select>
            <select name="문자동의" id="문자동의">
                <option value="">문자동의</option>
                <option value="O">O</option>
                <option value="X">X</option>
            </select> 
        <input type = 'hidden' value = <?php echo $num; ?> name = 'num2'/>
            <input type='submit' value = 'UPDATE' class='btn btn-outline-secondary' name='button2' form='update-form'>
            </center>
           </form>
  </div>

  <div class="box2">

            <div id="statusFormContainer">
                <select name="address1" id="address1" class="form-control">
                
                <option value="일반문의">일반문의</option>
                <option value="상품문의">상품문의</option>
                <option value="컴플레인">컴플레인</option>
                <option value="해피콜">해피콜</option>
            </select>
            </div>

        <div id="statusFormContainer">
            <select name="address2" id="address2" class="form-control"></select>
        </div>
        <input type='text' id='autoSizingSelect' placeholder="메모" name='메모' class='memo-input'>


  </div>
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


<center><input type="button" value="이전페이지" onClick="history.go(-1)"></center>


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
    xhr.open('GET', 'get_target_data_agent2.php?num=<?php echo urlencode($_GET['num']); ?>', true);
    xhr.send();
  }

  // Call the function initially and set an interval to refresh the data periodically
  fetchTargetData();
  setInterval(fetchTargetData, 500000); // Refresh every 5 seconds (adjust as needed)
</script>



<script>

    var address1Select = document.getElementById("address1");
    var address2Select = document.getElementById("address2");

    
    const address2Options = {
    '일반문의': ['매물관리','플랫폼문의','계정관리'],
    '상품문의': ['추가/변경','환불'],
    '컴플레인': ['네모인','효과미미','오류','마케팅'],
    '해피콜': ['매물등록독려','프로모션안내','검수관련']

        };

    // 주소1 선택이 변경될 때 이벤트를 등록합니다.
    address1Select.addEventListener("change", function () {
        // 선택한 주소1 값을 가져옵니다.
        var selectedAddress1 = address1Select.value;

        // 주소1 선택에 따라 주소2를 업데이트합니다.
        updateAddress2Options(selectedAddress1);
    });

    // 주소2 옵션을 업데이트하는 함수
    function updateAddress2Options(selectedAddress1) {
        // 선택한 주소1에 해당하는 주소2 옵션을 가져옵니다.
        var options = address2Options[selectedAddress1] || [];

        // 주소2 선택 옵션을 초기화합니다.
        address2Select.innerHTML = "";

        // 주소2 옵션을 추가합니다.
        for (var i = 0; i < options.length; i++) {
            var option = document.createElement("option");
            option.value = options[i];
            option.textContent = options[i];
            address2Select.appendChild(option);
        }
    }
</script>
