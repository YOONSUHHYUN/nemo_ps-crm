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
    width: 60%; /* Adjust the width as needed */
    padding: 70px; /* Adjust the padding as needed */}

    .memo-input2 {
    width: 60%; /* Adjust the width as needed */
    padding: 20px; /* Adjust the padding as needed */
    margin : 25px 0;

  }

.box_margin01{
  margin-left: 42%;
}


.box_margin02{
  margin-right: 38%;
}

/*--------------------------*/
/* Style the tab container */



.tab {
  display: flex; /* 탭 버튼을 가로로 정렬합니다. */
  overflow: hidden; /* 버튼의 내용이 넘칠 경우 숨깁니다. */
  
}

/* Style the left button */
.tab button.left {
  flex: 1; /* 왼쪽 버튼이 컨테이너의 50%를 차지하도록 설정합니다. */
  border-top-right-radius: 0; /* 오른쪽 상단 모서리를 둥글게 만듭니다. */
  border-bottom-right-radius: 0; /* 오른쪽 하단 모서리를 둥글게 만듭니다. */

}

/* Style the right button */
.tab button.right {
  flex: 1; /* 오른쪽 버튼이 컨테이너의 50%를 차지하도록 설정합니다. */
  border-top-left-radius: 0; /* 왼쪽 상단 모서리를 둥글게 만듭니다. */
  border-bottom-left-radius: 0; /* 왼쪽 하단 모서리를 둥글게 만듭니다. */

}

/* Style the buttons */
.tab button {
  background-color: #f2f2f2; /* 배경색 */
  border: none; /* 테두리 제거 */
  outline: none; /* 포커스시 테두리 제거 */
  cursor: pointer; /* 커서 모양 변경 */
  padding: 10px 20px; /* 안쪽 여백 설정 */
  transition: background-color 0.3s; /* 배경색 전환에 대한 전이 효과 */
  font-size: 16px; /* 글꼴 크기 설정 */
  font-weight: bold; /* 글꼴 굵기 설정 */
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #fe2b54; /* 호버 상태일 때 배경색 변경 */
}



/*--------------------------*/

.label {
    display: inline;
    padding: .2em .6em .3em;
    font-size: 75%;
    font-weight: 700;
    line-height: 1;
    color: #fff;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: .25em
}

a.label:focus,a.label:hover {
    color: #fff;
    text-decoration: none;
    cursor: pointer
}

.label:empty {
    display: none
}

.btn .label {
    position: relative;
    top: -1px
}

.label-default {
    background-color: #222
}

.label-default[href]:focus,.label-default[href]:hover {
    background-color: #090909
}

.label-primary {
    background-color: #2780e3
}

.label-primary[href]:focus,.label-primary[href]:hover {
    background-color: #1967be
}

.label-success {
    background-color: #3fb618
}

.label-success[href]:focus,.label-success[href]:hover {
    background-color: #2f8912
}

.label-info {
    background-color: #9954bb
}

.label-info[href]:focus,.label-info[href]:hover {
    background-color: #7e3f9d
}

.label-warning {
    background-color: #ff7518
}

.label-warning[href]:focus,.label-warning[href]:hover {
    background-color: #e45c00
}

.label-danger {
    background-color: #ff0039
}

.label-danger[href]:focus,.label-danger[href]:hover {
    background-color: #cc002e
}

/* Add border styles to table cells */
table {
    border-collapse: collapse;
    width: 100%;
  }
  tr, th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
  }
  th {
    background-color: #f2f2f2;
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
    $voc1 = $_POST['voc1'];
    $voc2 = $_POST['voc2'];
    date_default_timezone_set('Asia/Seoul');
    $currentDateTime = date('Y-m-d H:i:s');
    $targetUrl = "update_customer.php?num=" . urlencode($num);



    $sql2234 = "INSERT INTO agent(num, 담당자, 수신, 회사소개, 상품소개, 결제여부, 컨택일, 관심도, 현상태, 메모, 문자동의, voc1, voc2) 
    VALUES ('$num', '$agent', '$receive', '$introduction', '$pduction', '$pstatus', '$currentDateTime', '$interest', '$cstate', '$memo', '$amessage', '$voc1', '$voc2')";
  if ($conn->query($sql2234) === TRUE) {
    echo "<script>alert('버튼2 등록이완료되었습니다.');</script>";
    header("Location: " . $targetUrl);
    
} else {
    echo "Error updating record: " . $conn->error;
    echo "er". $num;
}}

}

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
<div style='width: 100%; margin: 0 auto;'>


<?php
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
      $currentCompanyName = $row['중개업소명'];
      $currentCEOName = $row['대표자명'];
      $currentContact = $row['휴대폰번호'];
      $currentContact3 = $row['전화번호'];
      $currentCity = $row['시'];
      $currentDistrict = $row['구'];
      $currentStatus = $row['구분'];
      $currentExpire = $row2['max_edate'];
      $currentjoindate = $row2['가입일'];
  }
  
  echo "<table style='width: 100%;'>";
  echo "<tr><th>num</th><th>업체명</th><th>대표자명</th><th>연락처1Admin</th><th>연락처2Admin</th><th>연락처</th><th>시도</th><th>시군구</th><th>유/무료</th><th>상품종료일</th><th>가입일</th></tr>";
  echo "<tr>";
  echo "<td>$num</td>";
  echo "<td>$currentCompanyName</td>";
  echo "<td>$currentCEOName</td>";
  echo "<td>$currentContact</td>";
  echo "<td>$currentContact3</td>";
  
  // $result3에서 데이터를 다시 가져오기
  $result3 = $conn->query($sql3);
  
  if ($result3->num_rows > 0) {
    echo "<td>";  // 시작 태그 추가
    $contacts = array();  // 연락처를 저장할 배열 초기화
    while ($row3 = $result3->fetch_assoc()) {
      $contacts[] = "<a href='update_target.php?num={$row3['num']}'>" . $row3['연락처'] . "</a>";
    }
    echo implode(",</br> ", $contacts);  // 쉼표로 구분된 문자열로 변환 후 출력
    echo "</td>";  // 종료 태그 추가
} else {
    echo "<td></td>"; // 데이터가 없을 경우 빈 셀을 출력
}
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
          <center><h2 class="box_margin01">신규영업 관리</h2></center>
            <form method='POST' id='update-form' class="box_margin01">
            
          
       
        
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
  </div>
  <div class="box2">
  <center><h2 class="box_margin02">유료업체 관리</h2></center>
        <div id="statusFormContainer" class="box_margin02">
             <form method='POST' id='update-form2'>
                <select name="voc1" id="voc1" class="form-control">
                <option value="">/VOC/</option>
                <option value="일반문의">일반문의</option>
                <option value="상품문의">상품문의</option>
                <option value="컴플레인">컴플레인</option>
                <option value="해피콜">해피콜</option>
                </select>
              
            </div>

        <div id="statusFormContainer" class="box_margin02">
            <select name="voc2" id="voc2" class="form-control"></select>
        </div>
  </div>

        <div>
        <center>
        <input type='text' id='autoSizingSelect' placeholder="메모" name='메모' class='memo-input2'></br>
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
        </div>
           </form>
  </div>



<!-- Tab buttons -->
<div class="tab">
  <button class="left" onclick="openTab(event, 'tab1')" id="defaultOpen">히스토리</button>
  
<button class="right" onclick="openTab(event, 'tab2')">상품리스트</button>
</div>

<!-- Tab content -->
<div id="tab1" class="tabcontent">
  <div style="width: 100%;">
    <table class="table">
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
              <th>VOC1</th>
              <th>VOC2</th>
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

    </table>
  </div>
</div>

<div id="tab2" class="tabcontent">
  <div style="width: 100%;">
  <table class="table">
          <thead>
            <tr>
            <div class="table-responsive">
            <table class="table table-borderless">
            <thead>
            <tr>
            <th>그룹</th>
            <th>중개업소명/대표자명</th>
            <th>상품상세</th>
            <th>기간</th>
            <th>결제금액</th>
            <th>결제일</th>
            <th>상태</th>
            <th>담당자</th>
            </tr>
            </thead>
              <!-- Add other column headers as needed -->
            </tr>
          </thead>
          <tbody id="targetTable2">
            <!-- This table body will be populated dynamically using JavaScript -->
          </tbody>
        </table>
        
    <!-- Content will be loaded here -->
  </div>
</div>

<script>
// Function to open tab content
function openTab(evt, tabName) {
  var i, tabcontent, tablinks;

  // Hide all tab content
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Remove "active" class from all tab buttons
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  // Show the specific tab content
  document.getElementById(tabName).style.display = "block";

  // Add the "active" class to the button that opened the tab
  evt.currentTarget.className += " active";
}

// Open the default tab on page load
document.getElementById("defaultOpen").click();
</script>






      


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
            newRow.insertCell().innerText = row['voc1'];
            newRow.insertCell().innerText = row['voc2'];
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
  function fetchTargetData() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          // Parse the JSON response
          var targetData = JSON.parse(xhr.responseText);

          // Manipulate the HTML to display the data
          var targetTable = document.getElementById('targetTable2');
          targetTable.innerHTML = ''; // Clear existing table data

          targetData.forEach(function(row) {
            var newRow = targetTable.insertRow();
            
            // Add columns to the table dynamically
            var groupCell = newRow.insertCell();
            groupCell.innerText = row['그룹'];

            var companyCell = newRow.insertCell();
            var button = document.createElement('button');
            button.classList.add('btn', 'btn-primary');
            button.style.backgroundColor = '#fe2b54';
            button.type = 'button';
            button.setAttribute('data-bs-toggle', 'modal');
            button.setAttribute('data-bs-target', '#modal' + row['업체아이디']);
            button.innerText = row['업체명'] + '/' + row['대표자명'];
            companyCell.appendChild(button);

            
            var productTypeLabel = document.createElement('span');
            productTypeLabel.classList.add('label');
            var typeCell = newRow.insertCell();
var typeLabel = document.createElement('span');
typeLabel.classList.add('label');



// '상품구분'과 '상가사무실'에 해당하는 라벨을 합쳐서 표시하기
var typeString = '';

// '상품구분' 값에 따른 라벨 추가
if (row['상품구분'] === '일반') {
  typeString += '<span class="label label-info">일반</span>';
} else if (row['상품구분'] === '동') {
  typeString += '<span class="label label-success">동</span>';
} else if (row['상품구분'] === '지하철') {
  typeString += '<span class="label label-primary">지하철</span>';
} else if (row['상품구분'] === '레드프리미엄') {
  typeString += '<span class="label label-danger">레드프리미엄</span>';
} else if (row['상품구분'] === '레드추천') {
  typeString += '<span class="label label-warning">레드추천</span>';
}

// '상가사무실' 값에 따른 라벨 추가
if (row['상가사무실'] === '상가') {
  typeString += '<span class="label label-primary">상가</span>';
} else if (row['상가사무실'] === '사무실') {
  typeString += '<span class="label label-success">사무실</span>';
} else if (row['상가사무실'] === '상가+사무실') {
  typeString += '<span class="label label-warning">사무실+상가</span>';
}




// 결과 문자열을 label 요소에 할당하여 화면에 출력
typeLabel.innerHTML = typeString;



var productText = row['상품']; // '상품' 값을 텍스트로 할당
// 결과 문자열을 label 요소에 할당하여 화면에 출력
typeCell.innerText = productText; // 해당 셀에 텍스트로 출력

typeCell.appendChild(typeLabel);
            newRow.insertCell().innerText = row['sdate'] + '~' + row['edate'];

            var paymentCell = newRow.insertCell();
            var paymentLabel = document.createElement('span');
            paymentLabel.classList.add('label');
            // Add appropriate class based on payment method
            var paymentClass = row['결제방법'] === '카드' ? 'label-warning' : 'label-danger';
            paymentLabel.classList.add(paymentClass);
            paymentLabel.innerText = row['결제방법'] + ' ' + Number(row['금액']).toLocaleString();
            paymentCell.appendChild(paymentLabel);

            newRow.insertCell().innerText = row['결제일'];

            var renewalCell = newRow.insertCell();
            var renewalLabel = document.createElement('span');
            renewalLabel.classList.add('label');
            // Add appropriate class based on renewal type
            var renewalClass = '';
            switch (row['신규/재결제']) {
              case '신규':
              case '복귀':
                renewalClass = 'label-info';
                break;
              case '추가':
              case '연장':
                renewalClass = 'label-primary';
                break;
              case '재결제30':
              case '재결제60':
              case '재결제90':
                renewalClass = 'label-success';
                break;
              default:
                renewalClass = 'label-default';
            }
            if (row['환불여부'] === '환불') {
              renewalClass = 'label-warning';
            }
            renewalLabel.classList.add(renewalClass);
            renewalLabel.innerText = row['신규/재결제'];
            // Add refund information if applicable
            if (row['환불여부'] === '환불') {
              renewalLabel.innerText += ' ' + row['환불여부'] + row['환불일'] + '(' + Number(row['환불금액']).toLocaleString() + ')';
            }
            renewalCell.appendChild(renewalLabel);

            newRow.insertCell().innerText = row['관리담당자'];
          });
        } else {
          // Handle request failure
          console.error('Failed to fetch target data.');
        }
      }
    };

    // Send AJAX request to the PHP script that fetches the data
    xhr.open('GET', 'plist_acount.php?num=<?php echo urlencode($_GET['num']); ?>', true);
    xhr.send();
  }

  // Call the function initially and set an interval to refresh the data periodically
  fetchTargetData();
  setInterval(fetchTargetData, 5000); // Refresh every 5 seconds (adjust as needed)
</script>


<script>
    var address1Select = document.getElementById("voc1");
    var address2Select = document.getElementById("voc2");

    const address2Options = {
        '일반문의': ['매물관리', '플랫폼문의', '계정관리'],
        '상품문의': ['추가/변경', '환불'],
        '컴플레인': ['네모인', '효과미미', '오류', '마케팅'],
        '해피콜': ['매물등록독려', '프로모션안내', '검수관련']
    };

    address1Select.addEventListener("change", function () {
        var selectedAddress1 = address1Select.value;
        updateAddress2Options(selectedAddress1);
    });

    function updateAddress2Options(selectedAddress1) {
        var options = address2Options[selectedAddress1] || [];
        address2Select.innerHTML = "";

        for (var i = 0; i < options.length; i++) {
            var option = document.createElement("option");
            option.value = options[i];
            option.textContent = options[i];
            address2Select.appendChild(option);
        }
    }
</script>