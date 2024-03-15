<?php
$searchQuery = $_GET['search'];
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

    if ((isset($_POST['selected_agent']) && $_POST['selected_agent'] !== 'null')) {
        // 선택한 담당자와 현상태
        $selectedAgent = isset($_POST['selected_agent']) ? $_POST['selected_agent'] : '';
        $selectedAddress1 = isset($_POST['selected_address1']) ? $_POST['selected_address1'] : '';
        $selectedAddress2 = isset($_POST['selected_address2']) ? $_POST['selected_address2'] : '';
        $selectedDate = isset($_POST['selected_Date']) ? $_POST['selected_Date'] : '';
        $selectedSearch2 = isset($_POST['selected_Search']) ? $_POST['selected_Search'] : '';

        // SQL 쿼리 생성
        $sql222 = "SELECT * FROM plist
        where 1=1  ";


        if (!empty($selectedAgent)) {
            $selectedAgent = mysqli_real_escape_string($conn, $selectedAgent);
            $sql222 .= "AND `관리담당자` = '$selectedAgent'";
        }


        if (!empty($selectedAddress1)) {
            $selectedAddress1 = mysqli_real_escape_string($conn, $selectedAddress1);
            $sql222 .= " AND `지역시` = '$selectedAddress1'";
        }

        if (!empty($selectedAddress2)) {
            $selectedAddress2 = mysqli_real_escape_string($conn, $selectedAddress2);
            $sql222 .= " AND `지역` = '$selectedAddress2'";
        }

        if (!empty($selectedDate)) {
            $selectedDate = mysqli_real_escape_string($conn, $selectedDate);
            $sql222 .= " AND DATE_FORMAT(`결제일`, '%Y-%m-%d') = '$selectedDate'";
        }

        $sql222 .= "
        AND (대표자명 LIKE '%" . mysqli_real_escape_string($conn, $selectedSearch2) . "%' OR
        업체명 LIKE '%" . mysqli_real_escape_string($conn, $selectedSearch2) . "%'
        )
        ORDER BY 그룹 DESC ";

        // SQL 쿼리 실행
        $result222 = $conn->query($sql222);

        // Check for query execution success
        if (!$result222) {
            die("쿼리 실행 실패: " . $conn->error); // Add error handling to show the query error message
        }

        // 총 페이지 수 계산
        $itemsPerPage = 40;
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

        if (isset($_POST['selected_agent']) && $_POST['selected_agent'] !== 'null') {
            // 선택한 담당자와 현상태
            $selectedAgent = $_POST['selected_agent'];
            //echo "selectedAgent: $selectedAgent<br>"; // 디버깅용 출력


            // 쿼리 결과 처리
            if ($result222->num_rows > 0) {
                echo '<div class="table-responsive">';
                echo '<table class="table table-borderless">';
                echo '<thead>';
                echo '<tr>';
                echo '<th>그룹</th>';
                echo '<th>중개업소명/대표자명</th>';
                echo '<th>상품코드</th>';
                echo '<th>상품상세</th>';
                echo '<th>기간</th>';
                echo '<th>결제금액</th>';
                echo '<th>결제일</th>';
                echo '<th>상태</th>';
                echo '<th>담당자</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<script>';
                echo 'var modalId = "";';
                echo '</script>';
                echo '<tbody>';

                $prevGroup = null; // 이전 그룹 저장 변수
                $prevCompany = null; // 이전 중개업소명/대표자명 저장 변수

                while ($row221 = $result222->fetch_assoc()) {
                    echo '<tr>';
                    $modalId = 'modal' . $row221['업체아이디'];

                    // 현재 그룹과 이전 그룹, 중개업소명/대표자명이 같지 않은 경우에만 출력
                    if ($row221['그룹'] != $prevGroup || $row221['업체명'] . '/' . $row221['대표자명'] != $prevCompany) {
                        echo '<td style="border-top: 2px solid #ddd;">' . $row221['그룹'] . '</td>';
                        echo '<td style="border-top: 2px solid #ddd;">';
                        echo '<button style="background-color: #fe2b54;" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#' . $modalId . '">';
                        echo $row221['업체명'] . '/' . $row221['대표자명'];
                        echo '</button>';
                        echo '</td>';
                        $prevGroup = $row221['그룹']; // 이전 그룹 업데이트
                        $prevCompany = $row221['업체명'] . '/' . $row221['대표자명']; // 이전 중개업소명/대표자명 업데이트
                    } else {
                        echo '<td></td>'; // 같은 그룹이면 빈 열 출력
                        echo '<td></td>'; // 같은 중개업소명/대표자명이면 빈 열 출력
                    }

                    echo '<td style="border-top: 2px solid #ddd;">' . $row221['num'] . '</td>';
                    echo '<td style="border-top: 2px solid #ddd;">';
                    // 상품구분 라벨
                    if ($row221['상품구분'] == '일반') {
                        echo '<span class="label label-info">일반</span>';
                    } elseif ($row221['상품구분'] == '동') {
                        echo '<span class="label label-success">동</span>';
                    } elseif ($row221['상품구분'] == '지하철') {
                        echo '<span class="label label-primary">지하철</span>';
                    } elseif ($row221['상품구분'] == '레드프리미엄') {
                        echo '<span class="label label-danger">레드프리미엄</span>';
                    } elseif ($row221['상품구분'] == '레드추천') {
                        echo '<span class="label label-warning">레드추천</span>';
                    }

                    // 상가사무실 라벨
                    if ($row221['상가사무실'] == '상가') {
                        echo '<span class="label label-primary">상가</span>';
                    } elseif ($row221['상가사무실'] == '사무실') {
                        echo '<span class="label label-success">사무실</span>';
                    } elseif ($row221['상가사무실'] == '상가+사무실') {
                        echo '<span class="label label-warning">사무실+상가</span>';
                    }

                    echo $row221['상품'] . '</td>';
                    echo '<td style="border-top: 2px solid #ddd;">' . $row221['sdate'] . '~' . $row221['edate'] . '</td>';
                    $label_class = ($row221['결제방법'] == '카드') ? 'label-warning' : 'label-danger';
                    echo '<td style="border-top: 2px solid #ddd;"><span class="label ' . $label_class . '">' . $row221['결제방법'] . '</span>' . number_format($row221['금액']) . '</td>';
                    echo '<td style="border-top: 2px solid #ddd;">' . $row221['결제일'] . '</td>';
                    $label_class = '';
                    switch ($row221['신규/재결제']) {
                        case '신규':
                        case '복귀':
                            $label_class = 'label-info';
                            break;
                        case '추가':
                        case '연장':
                            $label_class = 'label-primary';
                            break;
                        case '재결제30':
                        case '재결제60':
                        case '재결제90':
                            $label_class = 'label-success';
                            break;
                        default:
                            // 기본값 설정
                            $label_class = 'label-default';
                    }
                    if ($row221['환불여부'] == '환불') {
                        $label_class = 'label-warning';
                    }

                    echo '<td style="border-top: 2px solid #ddd;">';

                    // 라벨 출력
                    echo '<span class="label ' . $label_class . '">' . $row221['신규/재결제'] . '</span>';

                    // 환불 여부 출력
                    if ($row221['환불여부'] == '환불') {
                        echo '</br>';
                        echo ' <span class="label label-warning">' . $row221['환불여부'] . $row221['환불일'] . '(' . number_format($row221['환불금액']) . ')' . '</span>';
                    }
                    echo '<td style="border-top: 2px solid #ddd;">' . $row221['관리담당자'] . '</td>';
                    echo '</td>';
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
                    echo '<iframe src="' . 'update_customer.php?num=' . urlencode($row221['업체아이디']) . '" class="num-link" frameborder="0" width="100%" height="750px"></iframe>';
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
                    echo '<li class="page-item"><a class="page-link" href="#" onclick="goToPage(' . ($pageNumber - 1) . ')">이전</a></li>';
                }

                // 페이지 번호 출력
                $startPage = max(1, min($pageNumber - 10, $totalPages - 19));
                $endPage = min($startPage + 19, $totalPages);
                for ($i = $startPage; $i <= $endPage; $i++) {
                    $class = ($i == $pageNumber) ? 'active' : '';
                    echo '<li class="page-item ' . $class . '"><a class="page-link" href="#" onclick="goToPage(' . $i . ')">' . $i . '</a></li>';
                }

                // 다음 페이지 링크 출력
                if ($pageNumber < $totalPages) {
                    echo '<li class="page-item"><a class="page-link" href="#" onclick="goToPage(' . ($pageNumber + 1) . ')">다음</a></li>';
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
    }
}
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
            button.addEventListener('click', function () {
                getPageData(parseInt(this.textContent));
            });
            paginationContainer.appendChild(button);
        }
    }

    // 페이지 데이터 가져오는 함수
    function getPageData(page) {
        var selectedAgent = $("#agent").val();

        var selectedAddress1 = $("#address1").val();
        var selectedAddress2 = $("#address2").val();
        var selectedDate = $("#selectdate").val();
        var selectedSearch = $("#selectsearch").val();

        $.ajax({
            type: "POST",
            url: "plist.php",
            data: {
                page: page,
                selected_agent: selectedAgent,

                selected_address1: selectedAddress1,
                selected_address2: selectedAddress2,
                selected_Date: selectedDate,
                selected_Search: selectedSearch
            },
            success: function (response) {
                $("#result").html(response);
                currentPage = page;
            },
            error: function (xhr, status, error) {
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


<!-- JavaScript 코드를 추가합니다. -->
<script>
    // 복사 버튼을 클릭할 때 실행될 함수를 정의합니다.
    document.getElementById('copyContactsButton').addEventListener('click', function () {
        // 테이블에서 모든 연락처 정보를 가져옵니다.
        var contacts = document.querySelectorAll('td[data-contact]');

        // 연락처 정보를 문자열로 모아둘 변수를 초기화합니다.
        var contactText = '';

        // 모든 연락처 정보를 순회하면서 문자열에 추가합니다.
        contacts.forEach(function (contact) {
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