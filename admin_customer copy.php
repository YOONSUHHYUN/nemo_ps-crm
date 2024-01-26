

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
        $selectedAddress1 = isset($_POST['selected_address1']) ? $_POST['selected_address1'] : '';
        $selectedAddress2 = isset($_POST['selected_address2']) ? $_POST['selected_address2'] : '';
        $selectedDate = isset($_POST['selected_Date']) ? $_POST['selected_Date'] : '';

        // SQL 쿼리 생성
        $sql222 = "SELECT A.*, B.*
        FROM customer A
        left join (
            SELECT `업체아이디`, MAX(`edate`) AS max_edate
            FROM plist
            GROUP BY `업체아이디`
        ) B 
        ON A.고유키 = B.`업체아이디`
        where 1=1 ";

        //if (!empty($selectedAgent)) {
        //    $selectedAgent = mysqli_real_escape_string($conn, $selectedAgent);
         //   $sql222 .= " AND `관리담당자` = '$selectedAgent'";
        //}

        if (!empty($selectedAgent)) {
            $selectedAgent = mysqli_real_escape_string($conn, $selectedAgent);
        
            $퇴사자List = array('퇴사자');
            if (in_array($selectedAgent, $퇴사자List)) {
                $sql222 .= " AND (`관리담당자` NOT IN ('윤서현', '이다영', '최효주', '이민성', '김윤석', '홍석환', '이수복') OR `관리담당자` IS NULL)";
            } else {
                $sql222 .= " AND `관리담당자` = '$selectedAgent'";
            }
        }

        if (!empty($selectedStatus)) {
            $selectedStatus = mysqli_real_escape_string($conn, $selectedStatus);
            $sql222 .= " AND `구분` = '$selectedStatus'";
        }

        
 

        if (!empty($selectedAddress1)) {
            $selectedAddress1 = mysqli_real_escape_string($conn, $selectedAddress1);
            $sql222 .= " AND `시` = '$selectedAddress1'";
        }
        
        if (!empty($selectedAddress2)) {
            $selectedAddress2 = mysqli_real_escape_string($conn, $selectedAddress2);
            $sql222 .= " AND `구` = '$selectedAddress2'";
        }
        
        if (!empty($selectedDate)) {
            $selectedDate = mysqli_real_escape_string($conn, $selectedDate);
            $sql222 .= " AND DATE_FORMAT(`컨택일`, '%Y-%m-%d') <= '$selectedDate'";
        }

        $sql222 .= "AND `테스트계정` <> '테스트' and `관리담당자` <> '샘플' ORDER BY b.max_edate DESC ";

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
            
            echo '<th>고유키</th>';
            echo '<th>중개업소명</th>';
            echo '<th>대표자명</th>';
            echo '<th><button id="copyContactsButton">연락처 복사</button></th>';
            echo '<th>주소1</th>';
            echo '<th>주소2</th>';
            echo '<th>구분</th>';
            echo '<th>상품종료일</th>';
            echo '<th>가입일</th>';
            echo '<th>관리담당자</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            while ($row221 = $result222->fetch_assoc()) {
                echo '<tr>';
                echo '<td><a href="update_customer.php?num=' . $row221['고유키'] . '" class="num-link">' . $row221['고유키'] . '</a></td>';
                echo '<td>' . $row221['중개업소명'] . '</td>';
                echo '<td>' . $row221['대표자명'] . '</td>';
                echo '<td data-contact="' . $row221['휴대폰번호'] . '">' . $row221['휴대폰번호'] . '</td>';
                echo '<td>' . $row221['시'] . '</td>';
                echo '<td>' . $row221['구'] . '</td>';
                echo '<td>' . $row221['구분'] . '</td>';
                echo '<td>' . $row221['max_edate'] . '</td>';
                echo '<td>' . $row221['가입일'] . '</td>';
                //echo '<td>' . (strlen($row221['메모']) > 30 ? substr($row221['메모'], 0, 40) . "..." : $row221['메모']) . '</td>';
                //echo '<td>' . $row221['문자동의'] . '</td>';
                echo '<td>' . $row221['관리담당자'] . '</td>';
                //echo '<td>' . $row221['컨택일'] . '</td>';
               
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
            echo '</div>';
        } else {
            echo "결과가 없습니다.";
        }

        $conn->close();
    } else {
        echo "선택한 담당자가 없습니다.";
    }
}
?>
 




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


    <!-- JavaScript 코드를 추가합니다. -->
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

