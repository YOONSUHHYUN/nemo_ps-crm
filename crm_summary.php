<?php #등록기간
require ("config/config.php");
require ("lib/db.php");
$conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);


// 입력한 연락처가 이미 데이터베이스에 존재하는지 확인
$sql = "SELECT COUNT(*) AS count FROM target WHERE 연락처 = '$phonenum'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$count = $row['count'];



require ("db_target.php");

?>



<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <link rel="stylesheet" type="text/css" href="style.css">

  <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.css">
  <script type="text/javascript" src="bootstrap-5.3.3-dist/js/bootstrap.js"></script>


  <style>
    .modal-dialog.modal-fullsize {
      width: 100%;
      height: 100%;
      margin: 0;
      padding: 0;
    }

    .modal-content.modal-fullsize {
      height: auto;
      min-height: 100%;
      border-radius: 20px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, .5);
    }
  </style>


  <script>
    function showAlert() {
      var phonenum2 = document.getElementById('countnum').value;

      // 서버로 AJAX 요청을 보냄
      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            // 응답을 받았을 때 처리
            var response = xhr.responseText;
            if (response === 'not_duplicate2') {
              alert('등록 가능.');
            } else {
              // '담당자'와 '컨택일' 정보를 가져와서 메시지를 생성
              var contactInfo = response.split('|'); // '담당자'와 '컨택일'은 파이프(|)로 구분된 문자열
              var agentName = contactInfo[0];
              var contactDate = contactInfo[1];
              var message = agentName + ' 님이 ' + contactDate + '에 컨택중입니다.';
              alert(message);
            }
          } else {
            // 요청에 실패했을 때 처리
            alert('서버와의 통신에 실패했습니다.');
          }
        }
      };

      // GET 요청을 보냄 (중복 확인을 위한 서버의 php 파일 경로를 적절히 수정해주세요)
      xhr.open('GET', 'check_duplicate2.php?countnum=' + phonenum2, true);
      xhr.send();
    }
  </script>




  <script>
    function checkDuplicate() {
      var phonenum = document.getElementsByName('phonenum')[0].value;

      // 서버로 AJAX 요청을 보냄
      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            // 응답을 받았을 때 처리
            var response = xhr.responseText;
            if (response === 'duplicate') {
              alert('중복된 연락처 입니다.');
            } else {
              // 중복이 아니라면 폼을 서버로 제출
              document.querySelector('form').submit();
            }
          } else {
            // 요청에 실패했을 때 처리
            alert('서버와의 통신에 실패했습니다.');
          }
        }
      };

      // GET 요청을 보냄 (중복 확인을 위한 서버의 php 파일 경로를 적절히 수정해주세요)
      xhr.open('GET', 'check_duplicate.php?phonenum=' + phonenum, true);
      xhr.send();
    }
  </script>


  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const address1Dropdown = document.getElementsByName('address1')[0];
      const address2Dropdown = document.getElementsByName('address2')[0];

      const address2Options = {
        '서울특별시': ['종로구', '중구', '용산구', '성동구', '광진구', '동대문구', '중랑구', '성북구', '강북구', '도봉구', '노원구', '은평구', '서대문구', '마포구', '양천구', '강서구', '구로구', '금천구', '영등포구', '동작구', '관악구', '서초구', '강남구', '송파구', '강동구'],
        '부산광역시': ['중구', '서구', '동구', '영도구', '부산진구', '동래구', '남구', '북구', '해운대구', '사하구', '금정구', '강서구', '연제구', '수영구', '사상구', '기장군'],
        '대구광역시': ['중구', '동구', '서구', '남구', '북구', '수성구', '달서구', '달성군'],
        '인천광역시': ['중구', '동구', '연수구', '남동구', '부평구', '계양구', '서구', '미추홀구', '강화군', '옹진군'],
        '광주광역시': ['동구', '서구', '남구', '북구', '광산구'],
        '대전광역시': ['동구', '중구', '서구', '유성구', '대덕구'],
        '울산광역시': ['중구', '남구', '동구', '북구', '울주군'],
        '세종특별자치시': ['세종시'],
        '경기도': ['수원시 장안구', '수원시 권선구', '수원시 팔달구', '수원시 영통구', '성남시 수정구', '성남시 중원구', '성남시 분당구', '의정부시', '안양시 만안구', '안양시 동안구', '부천시', '광명시', '평택시', '동두천시', '안산시 상록구', '안산시 단원구', '고양시 덕양구', '고양시 일산동구', '고양시 일산서구', '과천시', '구리시', '남양주시', '오산시', '시흥시', '군포시', '의왕시', '하남시', '용인시 처인구', '용인시 기흥구', '용인시 수지구', '파주시', '이천시', '안성시', '김포시', '화성시', '광주시', '양주시', '포천시', '여주시', '연천군', '가평군', '양평군'],
        '강원특별자치도': ['춘천시', '원주시', '강릉시', '동해시', '태백시', '속초시', '삼척시', '홍천군', '횡성군', '영월군', '평창군', '정선군', '철원군', '화천군', '양구군', '인제군', '고성군', '양양군'],
        '충청북도': ['충주시', '제천시', '청주시 상당구', '청주시 서원구', '청주시 흥덕구', '청주시 청원구', '보은군', '옥천군', '영동군', '진천군', '괴산군', '음성군', '단양군', '증평군'],
        '충청남도': ['천안시 동남구', '천안시 서북구', '공주시', '보령시', '아산시', '서산시', '논산시', '계룡시', '당진시', '금산군', '부여군', '서천군', '청양군', '홍성군', '예산군', '태안군'],
        '전라북도': ['전주시 완산구', '전주시 덕진구', '군산시', '익산시', '정읍시', '남원시', '김제시', '완주군', '진안군', '무주군', '장수군', '임실군', '순창군', '고창군', '부안군'],
        '전라남도': ['목포시', '여수시', '순천시', '나주시', '광양시', '담양군', '곡성군', '구례군', '고흥군', '보성군', '화순군', '장흥군', '강진군', '해남군', '영암군', '무안군', '함평군', '영광군', '장성군', '완도군', '진도군', '신안군'],
        '경상북도': ['포항시 남구', '포항시 북구', '경주시', '김천시', '안동시', '구미시', '영주시', '영천시', '상주시', '문경시', '경산시', '군위군', '의성군', '청송군', '영양군', '영덕군', '청도군', '고령군', '성주군', '칠곡군', '예천군', '봉화군', '울진군', '울릉군'],
        '경상남도': ['진주시', '통영시', '사천시', '김해시', '밀양시', '거제시', '양산시', '창원시 의창구', '창원시 성산구', '창원시 마산합포구', '창원시 마산회원구', '창원시 진해구', '의령군', '함안군', '창녕군', '고성군', '남해군', '하동군', '산청군', '함양군', '거창군', '합천군'],
        '제주특별자치도': ['제주시', '서귀포시']
        // Add similar data for other regions as well.
      };
      function populateAddress2Dropdown() {
        const selectedAddress1 = address1Dropdown.value;
        const address2OptionsList = address2Options[selectedAddress1];

        // Clear existing options
        address2Dropdown.innerHTML = '';

        // Add new options
        address2OptionsList.forEach(option => {
          const optionElement = document.createElement('option');
          optionElement.value = option;
          optionElement.text = option;
          address2Dropdown.appendChild(optionElement);
        });
      }


      populateAddress2Dropdown();

      // Add an event listener to the address1 dropdown to repopulate address2 dropdown on change
      address1Dropdown.addEventListener('change', populateAddress2Dropdown);
    });

  </script>





  <script>
    // Add a new global variable to store the search query and current page
    var searchQuery = "";
    var currentPage = 1;
    var rowsPerPage = 20;

    // Function to update the search query and trigger data fetching
    function searchTarget() {
      searchQuery = document.getElementById('searchInput').value;
      currentPage = 1; // Reset to the first page when a new search is performed
      fetchTargetData();
    }

    // Modify the fetchTargetData() function to include pagination
    function fetchTargetData() {
      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            // Parse the JSON response
            var targetData = JSON.parse(xhr.responseText);

            // Manipulate the HTML to display the data
            var targetTable = document.getElementById('targetTable');
            targetTable.innerHTML = ''; // Clear existing table data

            // Calculate the start and end index for the current page
            var startIndex = (currentPage - 1) * rowsPerPage;
            var endIndex = Math.min(startIndex + rowsPerPage, targetData.length);

            // Loop through the data and add rows to the table for the current page
            for (var i = startIndex; i < endIndex; i++) {
              var row = targetData[i];
              var modalId = `staticBackdrop${i}`; // 각 행에 대한 고유한 모달 ID 생성
              var newRow = targetTable.insertRow();
              newRow.insertCell().innerHTML = `
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#${modalId}">
        ${row['고유키'] ? '기가입' : row['num']}
        </button>

        <!-- Modal -->
<div class="modal fade" id="${modalId}"  data-bs-keyboard="false" tabindex="-1" aria-labelledby="${modalId}Label" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content " style="width:1500px;">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="${modalId}Label">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body " style="height: 800px;" id="${modalId}Content">
            
            <iframe src="${row['고유키'] ? 'update_customer.php?num=' + encodeURIComponent(row['고유키']) : 'update_target.php?num=' + encodeURIComponent(row['num'])}" class="num-link" frameborder="0" width="100%" height="750px"></iframe>

            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
    `;



              newRow.insertCell().innerText = row['업체명'];
              newRow.insertCell().innerText = row['대표자명'];
              newRow.insertCell().innerText = row['연락처'];
              newRow.insertCell().innerText = row['시도'];
              newRow.insertCell().innerText = row['시군구'];
              newRow.insertCell().innerText = row['수신'];
              newRow.insertCell().innerText = row['회사소개'];
              newRow.insertCell().innerText = row['상품소개'];
              newRow.insertCell().innerText = row['관심도'];
              newRow.insertCell().innerText = row['현상태'];
              newRow.insertCell().innerText = row['결제여부'];
              newRow.insertCell().innerText = row['voc1'];
              newRow.insertCell().innerText = row['voc2'];
              var memo = row['메모'];
              var displayText = memo ? (memo.length > 10 ? memo.substr(0, 10) + "..." : memo) : '';
              newRow.insertCell().innerText = displayText;
              newRow.insertCell().innerText = row['담당자'];
              newRow.insertCell().innerText = row['컨택일'];
              // ... (rest of your code to populate the table)
            }

            // Update pagination controls
            updatePagination(targetData.length);

          } else {
            // Handle request failure
            console.error('Failed to fetch target data.');
          }
        }
      };

      // Send AJAX request to the PHP script that fetches the data with the search query and pagination
      var url = 'get_target_data.php?search=' + encodeURIComponent(searchQuery) +
        '&page=' + currentPage +
        '&perPage=' + rowsPerPage;
      xhr.open('GET', url, true);
      xhr.send();
    }

    // Function to update pagination controls
    function updatePagination(totalRows) {
      var totalPages = Math.ceil(totalRows / rowsPerPage);
      var paginationDiv = document.getElementById('pagination');
      paginationDiv.innerHTML = ''; // Clear existing pagination controls

      // Create pagination links
      for (var i = 1; i <= totalPages; i++) {
        var pageLink = document.createElement('a');
        pageLink.href = 'javascript:void(0);'; // Use JavaScript to prevent actual navigation
        pageLink.innerText = i;
        pageLink.addEventListener('click', function (page) {
          return function () {
            currentPage = page;
            fetchTargetData();
          }
        }(i));
        paginationDiv.appendChild(pageLink);
      }
    }

    // Call the function initially and set an interval to refresh the data periodically
    fetchTargetData();
    setInterval(fetchTargetData, 500000); // Refresh every 5 seconds (adjust as needed)

  </script>


  <title>Platform Sales CRM ..ETC.ver1.0</title>
</head>

<body>



  <div>



    </br></br>
    <h1>
      <center>Platform Sales CRM ..ETC..</center>
    </h1>



    <div class="container d-flex justify-content-center col-5">
      <form method='get' action='' role='form' class='form-inline'>
        <input type='text' id='countnum' placeholder="연락처" name='countnum'>
        <button type='submit' onclick='showAlert()'>중복여부 검색</button>
      </form>
    </div>



    <div class="container d-flex justify-content-center col-5">

      <form method='get' action='' role='form' class='form-inline'>
        <center>
          <input type='text' id='autoSizingSelect' placeholder="업체명" name='company'>
          <input type='text' id='autoSizingSelect' placeholder="대표자명" name='owner'>
          <input type='text' id='autoSizingSelect' placeholder="연락처" name='phonenum'>
          <select name="address1" id="address1" class="form-select" aria-label="Default select example">
            <option value="서울특별시">서울특별시</option>
            <option value="부산광역시">부산광역시</option>
            <option value="대구광역시">대구광역시</option>
            <option value="인천광역시">인천광역시</option>
            <option value="광주광역시">광주광역시</option>
            <option value="대전광역시">대전광역시</option>
            <option value="울산광역시">울산광역시</option>
            <option value="세종특별자치시">세종특별자치시</option>
            <option value="경기도">경기도</option>
            <option value="강원특별자치도">강원특별자치도</option>
            <option value="충청북도">충청북도</option>
            <option value="충청남도">충청남도</option>
            <option value="전라북도">전라북도</option>
            <option value="전라남도">전라남도</option>
            <option value="경상북도">경상북도</option>
            <option value="경상남도">경상남도</option>
            <option value="제주특별자치도">제주특별자치도</option>
          </select>

          <!-- Dropdown menu for address2 (Populated based on address1 selection) -->
          <select name="address2" id="address2" class="form-control">
            <!-- This part will be dynamically populated using JavaScript -->
          </select>



          <input type='hidden' value=<?php echo $agentr; ?> name='name' />

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
            <option value="최효주">최효주</option>
            <option value="정종형">정종형</option>
          </select>
          <select name="문자동의" id="문자동의">
            <option value="">문자동의</option>
            <option value="O">O</option>
            <option value="X">X</option>
          </select>

          <input type='text' id='autoSizingSelect' placeholder="메모" name='메모'>
          팔로우업 : <input type="date" name="follow">
          <input type='submit' value='UPDATE' class='btn btn-outline-secondary' onclick='checkDuplicate()'>
        </center>
      </form>


    </div>



    </br></br></br></br>

    <input type="text" id="searchInput" placeholder="Search by 대표자명, 업체명, or 연락처" style="width: 500px;">
    <button onclick="searchTarget()">Search</button>


    <div style="width: 3500px;">
      <table class="table">
        <thead>
          <tr>
            <th>NUM</th>
            <th>업체명</th>
            <th>대표자명</th>
            <th>연락처</th>
            <th>주소1</th>
            <th>주소2</th>
            <th>수신</th>
            <th>회사소개</th>
            <th>상품소개</th>
            <th>관심도</th>
            <th>현상태</th>
            <th>결제여부</th>
            <th>voc1</th>
            <th>voc2</th>
            <th>메모</th>
            <th>담당자</th>
            <th>컨택일</th>
            <!-- Add other column headers as needed -->
          </tr>
        </thead>
        <tbody id="targetTable" style="background-color: #ddd;">
          <!-- This table body will be populated dynamically using JavaScript -->
        </tbody>
      </table>
    </div>







    <!-- ↓카니형 이거 복사! ↓ -->

    <div style="width: 3500px;"></div>


    <div id="pagination" class="pagination d-flex justify-content-center">
      <span id="prevPage" class="page-link" onclick="prevPage()">Previous</span>
      <span id="nextPage" class="page-link" onclick="nextPage()">Next</span>
    </div>

    <script>
      // Function to go to the previous page
      function prevPage() {
        if (currentPage > 1) {
          currentPage--;
          fetchTargetData();
        }
      }

      // Function to go to the next page
      function nextPage() {
        var totalPages = Math.ceil(targetData.length / rowsPerPage);
        if (currentPage < totalPages) {
          currentPage++;
          fetchTargetData();
        }
      }

      function updatePagination(totalRows) {
        var totalPages = Math.ceil(totalRows / rowsPerPage);
        var paginationDiv = document.getElementById('pagination');
        paginationDiv.innerHTML = ''; // Clear existing pagination controls

        var prevPageLink = document.createElement('span');
        prevPageLink.className = 'page-link';
        prevPageLink.innerText = 'Previous';
        prevPageLink.onclick = prevPage;
        paginationDiv.appendChild(prevPageLink);

        // Create pagination links for up to 10 pages
        var startPage = Math.max(currentPage - 4, 1); // Show 4 pages before the current page
        var endPage = Math.min(startPage + 9, totalPages); // Show up to 10 pages

        for (var i = startPage; i <= endPage; i++) {
          var pageLink = document.createElement('span');
          pageLink.className = 'page-link';
          pageLink.innerText = i;
          pageLink.addEventListener('click', function (page) {
            return function () {
              currentPage = page;
              fetchTargetData();
            }
          }(i));
          paginationDiv.appendChild(pageLink);
        }

        var nextPageLink = document.createElement('span');
        nextPageLink.className = 'page-link';
        nextPageLink.innerText = 'Next';
        nextPageLink.onclick = nextPage;
        paginationDiv.appendChild(nextPageLink);
      }

    </script>


</body>

</html>