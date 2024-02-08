

<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once 'config/config.php';
    $conn = new mysqli($config['host'], $config['duser'], $config['dpw'], $config['dname']);
    if ($conn->connect_error) {
        die("데이터베이스 연결 실패: " . $conn->connect_error);
    }

    if ((isset($_POST['selected_agent']) && $_POST['selected_agent'] !== 'null') && isset($_POST['selected_status'])) {
        // 선택한 담당자와 현상태
    $selectedAgent = $_POST['selected_agent'];    $selectedStatus = isset($_POST['selected_status']) ? $_POST['selected_status'] : $_GET['selected_status'];
    $selectedAddress1 = isset($_POST['selected_address1']) ? $_POST['selected_address1'] : $_GET['selected_address1'];
    $selectedAddress2 = isset($_POST['selected_address2']) ? $_POST['selected_address2'] : $_GET['selected_address2'];
    $selectedDate = isset($_POST['selected_Date']) ? $_POST['selected_Date'] : $_GET['selected_Date'];
        $sql222 = "
        

SELECT 		
combined2.구분,
combined2.num,
combined2.업체명,
combined2.대표자명,
combined2.시도,
combined2.시군구,
combined2.연락처,
combined2.고유키,
combined2.담당자,
combined2.수신,
combined2.회사소개,
combined2.상품소개,
combined2.결제여부,
combined2.관심도,
combined2.현상태,
combined2.메모,
combined2.문자동의,
combined2.컨택일,
combined2.rn
FROM (
SELECT 
    combined.`구분`,
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
    combined.문자동의,
    combined.컨택일,
    ROW_NUMBER() OVER (PARTITION BY `연락처` ORDER BY `컨택일` DESC) AS rn
FROM (
    SELECT 
        customer.`구분`,
        customer.`고유키` as num,
        customer.`중개업소명` as 업체명,
        customer.`대표자명`,
        customer.`시` as 시도,
        customer.`구` as 시군구,
        customer.`휴대폰번호` as 연락처,
        customer.고유키,
        agent.`담당자`,
        agent.`수신`,
        agent.`회사소개`,
        agent.`상품소개`,
        agent.`결제여부`,
        agent.`관심도`,
        agent.`현상태`,
        agent.`메모`,
        agent.`문자동의`,
        agent.`컨택일`
    FROM customer
    LEFT JOIN agent ON customer.고유키 = agent.num 

    UNION ALL

    SELECT 
        target.`구분`,
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
        agent.`문자동의`,
        agent.`컨택일`
    FROM target 
    LEFT JOIN agent ON target.num = agent.num
) AS combined
ORDER BY combined.컨택일 DESC
) AS combined2
WHERE rn = 1 and (구분 = '무료' or 구분 is null) and 수신 = '문자' and `문자동의` = 'O' ";

        if (!empty($selectedAgent)) {
            $selectedAgent = mysqli_real_escape_string($conn, $selectedAgent);
            $sql222 .= " AND `담당자` = '$selectedAgent'";
        }

        if (!empty($selectedStatus)) {
            $selectedStatus = mysqli_real_escape_string($conn, $selectedStatus);
            if ($selectedStatus == 1) {
                $sql222 .= " AND `현상태` <> '결제성공'";
            } else {
                $sql222 .= " AND `현상태` = '$selectedStatus'";
            }
        }

 

        if (!empty($selectedAddress1)) {
            $selectedAddress1 = mysqli_real_escape_string($conn, $selectedAddress1);
            $sql222 .= " AND `시도` = '$selectedAddress1'";
        }
        
        if (!empty($selectedAddress2)) {
            $selectedAddress2 = mysqli_real_escape_string($conn, $selectedAddress2);
            $sql222 .= " AND `시군구` = '$selectedAddress2'";
        }
        
        if (!empty($selectedDate)) {
            $selectedDate = mysqli_real_escape_string($conn, $selectedDate);
            $sql222 .= " AND DATE_FORMAT(`컨택일`, '%Y-%m-%d') <= '$selectedDate'";
        }

        $sql222 .= " ORDER BY combined2.컨택일 DESC";
        $result222 = $conn->query($sql222);



        if (!$result222) {
            die("쿼리 실행 실패: " . $conn->error); 
        }


        // 총 페이지 수 계산
        $itemsPerPage = 20;
        $totalPages = ceil($result222->num_rows / $itemsPerPage);

        // 현재 페이지 번호 가져오기 (기본값: 1)
        $pageNumber = isset($_POST['page']) ? intval($_POST['page']) : 1;

        // 가져올 데이터의 시작 인덱스 계산
        $startIndex = ($pageNumber - 1) * $itemsPerPage;

        // 수정된 SQL 쿼리
        $sql222 .= " LIMIT $startIndex, $itemsPerPage";
        //페이지게이션 디버깅
        //echo "startIndex: $startIndex<br>";
        //echo "itemsPerPage: $itemsPerPage<br>";
        // SQL 쿼리 실행
        $result222 = $conn->query($sql222);

        if (isset($_POST['selected_agent']) && $_POST['selected_agent'] !== 'null' || isset($_POST['selected_status'])) {
            // 선택한 담당자와 현상태
            $selectedAgent = $_POST['selected_agent'];
            //echo "selectedAgent: $selectedAgent<br>"; // 디버깅용 출력




        if ($result222->num_rows > 0) {
            echo '<div class="table-responsive">';
            echo '<table class="table table-bordered table-striped">';
            echo '<thead>';
            echo '<tr>';
            
            echo '<th>NUM</th>';
            echo '<th>업체명</th>';
            echo '<th>대표자명</th>';
            echo '<th><button id="copyContactsButton">연락처 복사</button></th>';
            echo '<th>주소1</th>';
            echo '<th>주소2</th>';
            echo '<th>구분(유/무료)</th>';
            echo '<th>메모</th>';
            echo '<th>문자동의</th>';
            echo '<th>담당자</th>';
            echo '<th>컨택일</th>';
            echo '</tr>';
            echo '</thead>';

            echo '<script>';
            echo 'var modalId = "";'; 
            echo '</script>';

            echo '<tbody>';
            while ($row221 = $result222->fetch_assoc()) {
                echo '<tr>';
                $modalId = 'modal' . ($row221['고유키'] ?: $row221['num']);
            
                echo '<td>';
                echo '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#' . $modalId . '">';
                echo $row221['고유키'] ? '기가입' : $row221['num'];
                echo '</button>';
                echo '</td>';
            echo '<td>' . $row221['업체명'] . '</td>';
            echo '<td>' . $row221['대표자명'] . '</td>';
            echo '<td data-contact="' . $row221['연락처'] . '">' . $row221['연락처'] . '</td>';
            echo '<td>' . $row221['시도'] . '</td>';
            echo '<td>' . $row221['시군구'] . '</td>';
            echo '<td>' . $row221['구분'] . '</td>';
            echo '<td>' . (strlen($row221['메모']) > 30 ? substr($row221['메모'], 0, 40) . "..." : $row221['메모']) . '</td>';
            echo '<td>' . $row221['문자동의'] . '</td>';
            echo '<td>' . $row221['담당자'] . '</td>';
            echo '<td>' . $row221['컨택일'] . '</td>';
            echo '</tr>';
            echo '<script>';
            echo 'var modalId = "' . $modalId . '";';
            echo 'var modal = document.createElement("div");';
            echo 'modal.className = "modal fade";';
            echo 'modal.id = modalId;';
            echo 'modal.setAttribute("data-bs-keyboard", "false");';
            echo 'modal.setAttribute("tabindex", "-1");';
            echo 'modal.setAttribute("aria-labelledby", modalId + "Label");';
            echo 'modal.setAttribute("aria-hidden", "true");';
            echo 'modal.innerHTML = `';
            echo '<div class="modal-dialog modal-xl">';
            echo '<div class="modal-content" style="width:1500px;">';
            echo '<div class="modal-header">';
            echo '<h1 class="modal-title fs-5" id="${modalId}Label">Modal title</h1>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body" style="height: 800px;" id="${modalId}Content">';
            echo '<iframe src="' . ($row221['고유키'] ? 'update_customer.php?num=' . urlencode($row221['고유키']) : 'update_target.php?num=' . urlencode($row221['num'])) . '" class="num-link" frameborder="0" width="100%" height="750px"></iframe>';
            echo '</div>';
            echo '<div class="modal-footer">';
            echo '<button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>`;';
            echo 'document.body.appendChild(modal);';
            echo '</script>';
        }
        echo '</tbody>';
        echo '</table>';

        // 페이지 버튼 생성
        echo '<div id="pagination">';
        echo '<nav aria-label="Page navigation example">';
        echo '<ul class="pagination justify-content-center">';
        
        // 이전 페이지 링크 출력
        if ($pageNumber > 1) {
            echo '<li class="page-item"><a class="page-link" href="#" onclick="goToPage('.($pageNumber - 1).')">이전</a></li>';
        }
        
        // 페이지 번호 출력
        $startPage = max(1, min($pageNumber - 10, $totalPages - 19));
        $endPage = min($startPage + 19, $totalPages);
        for ($i = $startPage; $i <= $endPage; $i++) {
            $class = ($i == $pageNumber) ? 'active' : '';
            echo '<li class="page-item '.$class.'"><a class="page-link" href="#" onclick="goToPage('.$i.')">'.$i.'</a></li>';
        }
        
        // 다음 페이지 링크 출력
        if ($pageNumber < $totalPages) {
            echo '<li class="page-item"><a class="page-link" href="#" onclick="goToPage('.($pageNumber + 1).')">다음</a></li>';
        }
        
        echo '</ul>';
        echo '</nav>';
        
echo '</div>';
        } else {
            echo "결과가 없습니다.";
        }

        $conn->close();
    } else {
        echo "선택한 담당자가 없습니다.";
    }
}}
?>
 
 <script>
    // 총 페이지 수 계산
    var totalPages = <?php echo $totalPages; ?>;
    var currentPage = <?php echo $pageNumber; ?>;

    // 페이지 버튼을 생성하고 이벤트 처리를 추가하는 함수
    function createPaginationButtons() {
        var paginationContainer = document.getElementById('pagination');

        for (var i = 1; i <= totalPages; i++) {
            var button = document.createElement('button');
            button.textContent = i;
            button.addEventListener('click', function() {
                getPageData(parseInt(this.textContent));
            });
            paginationContainer.appendChild(button);
        }
    }

    // 페이지 데이터 가져오는 함수
    function getPageData(page) {
        var selectedAgent = $("#agent").val();
        var selectedStatus = $("#status").val();
        var selectedAddress1 = $("#address1").val();
        var selectedAddress2 = $("#address2").val();
        var selectedDate = $("#selectdate").val();
        var selectedSearch = $("#selectsearch").val();

        $.ajax({
            type: "POST",
            url: "sms_search.php",
            data: {
                page: page,
                selected_agent: selectedAgent,
                selected_status: selectedStatus,
                selected_address1: selectedAddress1,
                selected_address2: selectedAddress2,
                selected_Date: selectedDate,
                selected_Search: selectedSearch
            },
            success: function(response) {
                $("#result").html(response);
                currentPage = page;
            },
            error: function(xhr, status, error) {
                console.error("Ajax 요청 실패:", error);
            }
        });
    }

    // 페이지 버튼 생성 호출
    //createPaginationButtons();

    function goToPage(page) {
    getPageData(page);
}
</script>




 <script>

        var address1Select = document.getElementById("address1");
        var address2Select = document.getElementById("address2");

        
        const address2Options = {
        '주소1': ['주소2'],
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



    <script>
        // 복사 버튼을 클릭할 때 실행될 함수를 정의합니다.
        document.getElementById('copyContactsButton').addEventListener('click', function() {
            // 테이블에서 모든 연락처 정보를 가져옵니다.
            var contacts = document.querySelectorAll('td[data-contact]');

            // 연락처 정보를 문자열로 모아둘 변수를 초기화합니다.
            var contactText = '';

            // 모든 연락처 정보를 순회하면서 문자열에 추가합니다.
            contacts.forEach(function(contact) {
                contactText += contact.getAttribute('data-contact') + '\n';
            });

            // 연락처 정보를 클립보드로 복사합니다.
            copyToClipboard(contactText);
        });

        // 클립보드로 복사하는 함수를 정의합니다.
        function copyToClipboard(text) {
            var textarea = document.createElement('textarea');
            textarea.value = text;
            document.body.appendChild(textarea);
            textarea.select();
            document.execCommand('copy');
            document.body.removeChild(textarea);
            alert('연락처가 클립보드에 복사되었습니다.');
        }
    </script>
