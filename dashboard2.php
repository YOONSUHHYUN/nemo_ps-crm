
<center><h3>UNIQUE</h3></center>

<center>
<div class="col-6">
  <table class="table">
    <thead>
      <tr>
        <th>담당자</th>
        <th>컨택업체수</th>
        <th>수신(성공)</th>
        <th>회사소개(성공)</th>
        <th>상품소개(성공)</th>
        <th>결제여부(성공)</th>
      </tr>
    </thead>
    <tbody>
      <!-- Add rows and cells here to populate the table with data -->
      <tr>
        <td>윤서현</td>
        
          <td>
              <?php
              // Check if the form is submitted
              if (isset($_POST['submit'])) {
                  // Get the selected date from the form
                  $selected_date = $_POST['selected_date'];

                  // Prepare the SQL query
                  $queryhyun1 = "SELECT COUNT(DISTINCT num) AS contact_count
                            FROM agent
                            WHERE `담당자`='윤서현' AND `수신`<>'문자' AND (voc1 = '' OR voc1 IS NULL) AND DATE_FORMAT(`컨택일`, '%Y-%m-%d') = '$selected_date'";

                  // Execute the query
                  $resulthyun1 = $conn->query($queryhyun1);

                  if ($resulthyun1->num_rows > 0) {
                      // Output data of the first row
                      $rowhyun1 = $resulthyun1->fetch_assoc();
                      $contact_counthyun1 = $rowhyun1['contact_count'];

                      echo " $contact_counthyun1 ->";
                  } else {
                      echo "No contacts found on $selected_date";
                  }
              }
              ?>



        
          </td>


        <td>
              <?php
              // Check if the form is submitted
              if (isset($_POST['submit'])) {
                  // Get the selected date from the form
                  $selected_date = $_POST['selected_date'];

                  // Prepare the SQL query
                  $queryhyun2 = "SELECT COUNT(DISTINCT num) AS contact_count
                            FROM agent
                            WHERE `담당자`='윤서현' AND `수신`='성공' AND DATE_FORMAT(`컨택일`, '%Y-%m-%d') = '$selected_date'";

                  // Execute the query
                  $resulthyun2 = $conn->query($queryhyun2);

                  if ($resulthyun2->num_rows > 0) {
                      // Output data of the first row
                      $rowhyun2 = $resulthyun2->fetch_assoc();
                      $contact_counthyun2 = $rowhyun2['contact_count'];

                      echo " $contact_counthyun2 ->";
                  } else {
                      echo "No contacts found on $selected_date";
                  }
              }
              ?>



        
          </td>
          <td>
              <?php
              // Check if the form is submitted
              if (isset($_POST['submit'])) {
                  // Get the selected date from the form
                  $selected_date = $_POST['selected_date'];

                  // Prepare the SQL query
                  $queryhyun3 = "SELECT COUNT(DISTINCT num) AS contact_count
                            FROM agent
                            WHERE `담당자`='윤서현' AND `회사소개`='성공' AND DATE_FORMAT(`컨택일`, '%Y-%m-%d') = '$selected_date'";

                  // Execute the query
                  $resulthyun3 = $conn->query($queryhyun3);

                  if ($resulthyun3->num_rows > 0) {
                      // Output data of the first row
                      $rowhyun3 = $resulthyun3->fetch_assoc();
                      $contact_counthyun3 = $rowhyun3['contact_count'];

                      echo " $contact_counthyun3 ->";
                  } else {
                      echo "No contacts found on $selected_date";
                  }
              }
              ?>




          </td>
          <td>
          <?php
              // Check if the form is submitted
              if (isset($_POST['submit'])) {
                  // Get the selected date from the form
                  $selected_date = $_POST['selected_date'];

                  // Prepare the SQL query
                  $queryhyun4 = "SELECT COUNT(DISTINCT num) AS contact_count
                            FROM agent
                            WHERE `담당자`='윤서현' AND `상품소개`='성공' AND DATE_FORMAT(`컨택일`, '%Y-%m-%d') = '$selected_date'";

                  // Execute the query
                  $resulthyun4 = $conn->query($queryhyun4);

                  if ($resulthyun4->num_rows > 0) {
                      // Output data of the first row
                      $rowhyun4 = $resulthyun4->fetch_assoc();
                      $contact_counthyun4 = $rowhyun4['contact_count'];

                      echo " $contact_counthyun4 ->";
                  } else {
                      echo "No contacts found on $selected_date";
                  }
              }
              ?>
          </td>
          <td>
          <?php
              // Check if the form is submitted
              if (isset($_POST['submit'])) {
                  // Get the selected date from the form
                  $selected_date = $_POST['selected_date'];

                  // Prepare the SQL query
                  $queryhyun5 = "SELECT COUNT(DISTINCT num) AS contact_count
                            FROM agent
                            WHERE `담당자`='윤서현' AND `결제여부`='성공' AND DATE_FORMAT(`컨택일`, '%Y-%m-%d') = '$selected_date'";

                  // Execute the query
                  $resulthyun5 = $conn->query($queryhyun5);

                  if ($resulthyun5->num_rows > 0) {
                      // Output data of the first row
                      $rowhyun5 = $resulthyun5->fetch_assoc();
                      $contact_counthyun5 = $rowhyun5['contact_count'];

                      echo " $contact_counthyun5";
                  } else {
                      echo "No contacts found on $selected_date";
                  }
              }
              ?>
          </td>
</tr>
      <tr>
      <td>이다영</td>
      <td>
              <?php
              // Check if the form is submitted
              if (isset($_POST['submit'])) {
                  // Get the selected date from the form
                  $selected_date = $_POST['selected_date'];

                  // Prepare the SQL query
                  $queryda1 = "SELECT COUNT(DISTINCT num) AS contact_count
                            FROM agent
                            WHERE `담당자`='이다영' AND `수신`<>'문자' AND (voc1 = '' OR voc1 IS NULL) AND DATE_FORMAT(`컨택일`, '%Y-%m-%d') = '$selected_date'";

                  // Execute the query
                  $resultda1 = $conn->query($queryda1);

                  if ($resultda1->num_rows > 0) {
                      // Output data of the first row
                      $rowda1 = $resultda1->fetch_assoc();
                      $contact_countda1 = $rowda1['contact_count'];

                      echo " $contact_countda1 ->";
                  } else {
                      echo "No contacts found on $selected_date";
                  }
              }
              ?>



        
          </td>
        <td>
        <?php
              // Check if the form is submitted
              if (isset($_POST['submit'])) {
                  // Get the selected date from the form
                  $selected_date = $_POST['selected_date'];

                  // Prepare the SQL query
                  $queryda2 = "SELECT COUNT(DISTINCT num) AS contact_count
                            FROM agent
                            WHERE `담당자`='이다영' AND `수신`='성공' AND DATE_FORMAT(`컨택일`, '%Y-%m-%d') = '$selected_date'";

                  // Execute the query
                  $resultda2 = $conn->query($queryda2);

                  if ($resultda2->num_rows > 0) {
                      // Output data of the first row
                      $rowda2 = $resultda2->fetch_assoc();
                      $contact_countda2 = $rowda2['contact_count'];

                      echo " $contact_countda2 ->";
                  } else {
                      echo "No contacts found on $selected_date";
                  }
              }
              ?>


        </td>
            <td>
            <?php
              // Check if the form is submitted
              if (isset($_POST['submit'])) {
                  // Get the selected date from the form
                  $selected_date = $_POST['selected_date'];

                  // Prepare the SQL query
                  $queryda3 = "SELECT COUNT(DISTINCT num) AS contact_count
                            FROM agent
                            WHERE `담당자`='이다영' AND `회사소개`='성공' AND DATE_FORMAT(`컨택일`, '%Y-%m-%d') = '$selected_date'";

                  // Execute the query
                  $resultda3 = $conn->query($queryda3);

                  if ($resultda3->num_rows > 0) {
                      // Output data of the first row
                      $rowda3 = $resultda3->fetch_assoc();
                      $contact_countda3 = $rowda3['contact_count'];

                      echo " $contact_countda3 ->";
                  } else {
                      echo "No contacts found on $selected_date";
                  }
              }
              ?>




            </td>
            <td>
            <?php
              // Check if the form is submitted
              if (isset($_POST['submit'])) {
                  // Get the selected date from the form
                  $selected_date = $_POST['selected_date'];

                  // Prepare the SQL query
                  $queryda4 = "SELECT COUNT(DISTINCT num) AS contact_count
                            FROM agent
                            WHERE `담당자`='이다영' AND `상품소개`='성공' AND DATE_FORMAT(`컨택일`, '%Y-%m-%d') = '$selected_date'";

                  // Execute the query
                  $resultda4 = $conn->query($queryda4);

                  if ($resultda4->num_rows > 0) {
                      // Output data of the first row
                      $rowda4 = $resultda4->fetch_assoc();
                      $contact_countda4 = $rowda4['contact_count'];

                      echo " $contact_countda4 ->";
                  } else {
                      echo "No contacts found on $selected_date";
                  }
              }
              ?>
            </td>
            <td>
            <?php
              // Check if the form is submitted
              if (isset($_POST['submit'])) {
                  // Get the selected date from the form
                  $selected_date = $_POST['selected_date'];

                  // Prepare the SQL query
                  $queryda5 = "SELECT COUNT(DISTINCT num) AS contact_count
                            FROM agent
                            WHERE `담당자`='이다영' AND `결제여부`='성공' AND DATE_FORMAT(`컨택일`, '%Y-%m-%d') = '$selected_date'";

                  // Execute the query
                  $resultda5 = $conn->query($queryda5);

                  if ($resultda5->num_rows > 0) {
                      // Output data of the first row
                      $rowda5 = $resultda5->fetch_assoc();
                      $contact_countda5 = $rowda5['contact_count'];

                      echo " $contact_countda5";
                  } else {
                      echo "No contacts found on $selected_date";
                  }
              }
              ?>
            </td>
        </tr>
      
      <tr>
        <td>최효주</td>
        <td>
              <?php
              // Check if the form is submitted
              if (isset($_POST['submit'])) {
                  // Get the selected date from the form
                  $selected_date = $_POST['selected_date'];

                  // Prepare the SQL query
                  $queryhyo1 = "SELECT COUNT(DISTINCT num) AS contact_count
                            FROM agent
                            WHERE `담당자`='최효주' AND `수신`<>'문자' AND (voc1 = '' OR voc1 IS NULL) AND DATE_FORMAT(`컨택일`, '%Y-%m-%d') = '$selected_date'";

                  // Execute the query
                  $resulthyo1 = $conn->query($queryhyo1);

                  if ($resulthyo1->num_rows > 0) {
                      // Output data of the first row
                      $rowhyo1 = $resulthyo1->fetch_assoc();
                      $contact_counthyo1 = $rowhyo1['contact_count'];

                      echo " $contact_counthyo1 ->";
                  } else {
                      echo "No contacts found on $selected_date";
                  }
              }
              ?>



        
          </td>
        <td>
        <?php
              // Check if the form is submitted
              if (isset($_POST['submit'])) {
                  // Get the selected date from the form
                  $selected_date = $_POST['selected_date'];

                  // Prepare the SQL query
                  $queryhyo2 = "SELECT COUNT(DISTINCT num) AS contact_count
                            FROM agent
                            WHERE `담당자`='최효주' AND `수신`='성공' AND DATE_FORMAT(`컨택일`, '%Y-%m-%d') = '$selected_date'";

                  // Execute the query
                  $resulthyo2 = $conn->query($queryhyo2);

                  if ($resulthyo2->num_rows > 0) {
                      // Output data of the first row
                      $rowhyo2 = $resulthyo2->fetch_assoc();
                      $contact_counthyo2 = $rowhyo2['contact_count'];

                      echo " $contact_counthyo2 ->";
                  } else {
                      echo "No contacts found on $selected_date";
                  }
              }
              ?>




        </td>
        <td>
        <?php
              // Check if the form is submitted
              if (isset($_POST['submit'])) {
                  // Get the selected date from the form
                  $selected_date = $_POST['selected_date'];

                  // Prepare the SQL query
                  $queryhyo3 = "SELECT COUNT(DISTINCT num) AS contact_count
                            FROM agent
                            WHERE `담당자`='최효주' AND `회사소개`='성공' AND DATE_FORMAT(`컨택일`, '%Y-%m-%d') = '$selected_date'";

                  // Execute the query
                  $resulthyo3 = $conn->query($queryhyo3);

                  if ($resulthyo3->num_rows > 0) {
                      // Output data of the first row
                      $rowhyo3 = $resulthyo3->fetch_assoc();
                      $contact_counthyo3 = $rowhyo3['contact_count'];

                      echo " $contact_counthyo3 ->";
                  } else {
                      echo "No contacts found on $selected_date";
                  }
              }
              ?>



        </td>
        <td>
        <?php
              // Check if the form is submitted
              if (isset($_POST['submit'])) {
                  // Get the selected date from the form
                  $selected_date = $_POST['selected_date'];

                  // Prepare the SQL query
                  $queryhyo4 = "SELECT COUNT(DISTINCT num) AS contact_count
                            FROM agent
                            WHERE `담당자`='최효주' AND `상품소개`='성공' AND DATE_FORMAT(`컨택일`, '%Y-%m-%d') = '$selected_date'";

                  // Execute the query
                  $resulthyo4 = $conn->query($queryhyo4);

                  if ($resulthyo4->num_rows > 0) {
                      // Output data of the first row
                      $rowhyo4 = $resulthyo4->fetch_assoc();
                      $contact_counthyo4 = $rowhyo4['contact_count'];

                      echo " $contact_counthyo4 ->";
                  } else {
                      echo "No contacts found on $selected_date";
                  }
              }
              ?>
        </td>
        <td>
        <?php
              // Check if the form is submitted
              if (isset($_POST['submit'])) {
                  // Get the selected date from the form
                  $selected_date = $_POST['selected_date'];

                  // Prepare the SQL query
                  $queryhyo5 = "SELECT COUNT(DISTINCT num) AS contact_count
                            FROM agent
                            WHERE `담당자`='최효주' AND `결제여부`='성공' AND DATE_FORMAT(`컨택일`, '%Y-%m-%d') = '$selected_date'";

                  // Execute the query
                  $resulthyo5 = $conn->query($queryhyo5);

                  if ($resulthyo5->num_rows > 0) {
                      // Output data of the first row
                      $rowhyo5 = $resulthyo5->fetch_assoc();
                      $contact_counthyo5 = $rowhyo5['contact_count'];

                      echo " $contact_counthyo5";
                  } else {
                      echo "No contacts found on $selected_date";
                  }
              }
              ?>
        </td>
      </tr>
              






      <!-- Add more rows as needed -->
    </tbody>
  </table>
</div>
</center>















<!-- 전체관리현황 -->






<center>
<div class="col-6">
  <table class="table">
    <thead>
      <tr>
        <th>담당자</th>
        <th>총관리중업체</th>
        <th>관리1(이탈)</th>
        <th>관리2(애매)</th>
        <th>관리3(긍정)</th>
        <th>결제성공</th>
      </tr>
    </thead>
    <tbody>
      <!-- Add rows and cells here to populate the table with data -->
      <tr>
        <td>윤서현</td>
        <td>
    <?php
    // Check if the form is submitted
    if (isset($_POST['submit'])) {
        // Get the selected date from the form
        $selected_date = $_POST['selected_date'];

        // Prepare the SQL query
        $queryhyun7a1 = "SELECT COUNT(DISTINCT num)
        FROM (
            SELECT *,
                ROW_NUMBER() OVER (PARTITION BY num ORDER BY `컨택일` DESC) as row_num
            FROM agent
            WHERE `수신` NOT IN ('실패', '문자') 
                AND (`현상태` = '관리1' or `현상태` = '관리2' or `현상태` = '관리3' or `현상태` = '결제성공')
                AND DATE_FORMAT(`컨택일`, '%Y-%m-%d') <= '$selected_date'
        ) AS ranked
        WHERE row_num = 1 
            AND 담당자 ='윤서현' 
            AND `현상태` <> '관리1' 
            AND `현상태` <> '결제성공'";

        // Execute the query
        $resulthyun7a1 = $conn->query($queryhyun7a1);

        if ($resulthyun7a1->num_rows > 0) {
            // Output data of the first row
            $rowhyun7a1 = $resulthyun7a1->fetch_assoc();
            $contact_count = $rowhyun7a1['COUNT(DISTINCT num)']; // Modify this line

            echo " $contact_count";
        } else {
            echo "No contacts found on $selected_date";
        }
    }
    ?>

<?php
    // Check if the form is submitted
    if (isset($_POST['submit'])) {
        // Get the selected date from the form
        $selected_date = $_POST['selected_date'];
        
        // Convert selected_date to a DateTime object
        $date = new DateTime($selected_date);
        
        // Subtract one day
        $date->modify('-1 day');
        
        // Get the modified date as a string
        $modified_date = $date->format('Y-m-d');

        // ... (Your existing code continues)
        $queryhyun7b1 = "SELECT COUNT(DISTINCT num)
        FROM (
            SELECT *,
                ROW_NUMBER() OVER (PARTITION BY num ORDER BY `컨택일` DESC) as row_num
            FROM agent
            WHERE `수신` NOT IN ('실패', '문자') 
                AND (`현상태` = '관리1' or `현상태` = '관리2' or `현상태` = '관리3' or `현상태` = '결제성공')
                AND DATE_FORMAT(`컨택일`, '%Y-%m-%d') <= '$modified_date'
        ) AS ranked
        WHERE row_num = 1 
            AND 담당자 ='윤서현' 
            AND `현상태` <> '관리1' 
            AND `현상태` <> '결제성공'";
        
       // Execute the query
       $resulthyun7b1 = $conn->query($queryhyun7b1);

       if ($resulthyun7b1->num_rows > 0) {
           // Output data of the first row
           $rowhyun7b1 = $resulthyun7b1->fetch_assoc();
           $contact_count2 = $rowhyun7b1['COUNT(DISTINCT num)']; // Modify this line
           $result = $contact_count - $contact_count2;


           if ($result == 0) {
            $result = " "; // 0인 경우 공백 할당
        } elseif ($result > 0) {
            $result = "+$result"; // 양수인 경우 "+" 기호를 붙임
        }
           // 색상 설정
           $color = 'black'; // 기본값은 검정색
           
           if ($result > 0) {
               $color = 'red'; // 양수는 빨간색
           } elseif ($result < 0) {
               $color = 'blue'; // 음수는 파란색
           }
       
           // 결과 출력
           echo "<span style='color: $color;'>$result</span>";
       } else {
           echo "No contacts found on $selected_date";
       }
   }
    ?>



</td>

<td>
              <?php
              // Check if the form is submitted
              if (isset($_POST['submit'])) {
                  // Get the selected date from the form
                  $selected_date = $_POST['selected_date'];

                  // Prepare the SQL query
                  $queryhyun8 = "SELECT COUNT(DISTINCT num)
                  FROM (
                      SELECT *,
                          ROW_NUMBER() OVER (PARTITION BY num ORDER BY `컨택일` DESC) as row_num
                      FROM agent
                      WHERE `수신` NOT IN ('실패', '문자') 
                          AND (`현상태` = '관리1' or `현상태` = '관리2' or `현상태` = '관리3' or `현상태` = '결제성공')
                          AND DATE_FORMAT(`컨택일`, '%Y-%m-%d') <= '$selected_date'
                  ) AS ranked
                  WHERE row_num = 1 
                      AND 담당자 ='윤서현' 
                      AND `현상태` = '관리1' 
                      AND `현상태` <> '결제성공'";
                  // Execute the query
                  $resulthyun8 = $conn->query($queryhyun8);

                  if ($resulthyun8->num_rows > 0) {
                      // Output data of the first row
                      $rowhyun8 = $resulthyun8->fetch_assoc();
                      $contact_counthyun8 = $rowhyun8['COUNT(DISTINCT num)'];

                      echo " $contact_counthyun8";
                  } else {
                      echo "No contacts found on $selected_date";
                  }
              }
              ?>




          </td>
          <td>
              <?php
              // Check if the form is submitted
              if (isset($_POST['submit'])) {
                  // Get the selected date from the form
                  $selected_date = $_POST['selected_date'];

                  // Prepare the SQL query
                  $queryhyun8 = "SELECT COUNT(DISTINCT num)
                  FROM (
                      SELECT *,
                          ROW_NUMBER() OVER (PARTITION BY num ORDER BY `컨택일` DESC) as row_num
                      FROM agent
                      WHERE `수신` NOT IN ('실패', '문자') 
                          AND (`현상태` = '관리1' or `현상태` = '관리2' or `현상태` = '관리3' or `현상태` = '결제성공')
                          AND DATE_FORMAT(`컨택일`, '%Y-%m-%d') <= '$selected_date'
                  ) AS ranked
                  WHERE row_num = 1 
                      AND 담당자 ='윤서현' 
                      AND `현상태` = '관리2' 
                      AND `현상태` <> '결제성공'";
                  // Execute the query
                  $resulthyun8 = $conn->query($queryhyun8);

                  if ($resulthyun8->num_rows > 0) {
                      // Output data of the first row
                      $rowhyun8 = $resulthyun8->fetch_assoc();
                      $contact_counthyun8 = $rowhyun8['COUNT(DISTINCT num)'];

                      echo " $contact_counthyun8";
                  } else {
                      echo "No contacts found on $selected_date";
                  }
              }
              ?>




          </td>
          <td>
          <?php
              // Check if the form is submitted
              if (isset($_POST['submit'])) {
                  // Get the selected date from the form
                  $selected_date = $_POST['selected_date'];

                  // Prepare the SQL query
                  $queryhyun9 = "SELECT COUNT(DISTINCT num)
                  FROM (
                      SELECT *,
                          ROW_NUMBER() OVER (PARTITION BY num ORDER BY `컨택일` DESC) as row_num
                      FROM agent
                      WHERE `수신` NOT IN ('실패', '문자') 
                          AND (`현상태` = '관리1' or `현상태` = '관리2' or `현상태` = '관리3' or `현상태` = '결제성공')
                          AND DATE_FORMAT(`컨택일`, '%Y-%m-%d') <= '$selected_date'
                  ) AS ranked
                  WHERE row_num = 1 
                      AND 담당자 ='윤서현' 
                      AND `현상태` = '관리3' 
                      AND `현상태` <> '결제성공'";
                  // Execute the query
                  $resulthyun9 = $conn->query($queryhyun9);

                  if ($resulthyun9->num_rows > 0) {
                      // Output data of the first row
                      $rowhyun9 = $resulthyun9->fetch_assoc();
                      $contact_counthyun9 = $rowhyun9['COUNT(DISTINCT num)'];

                      echo " $contact_counthyun9";
                  } else {
                      echo "No contacts found on $selected_date";
                  }
              }
              ?>
          </td>
          <td>
          <?php
              // Check if the form is submitted
              if (isset($_POST['submit'])) {
                  // Get the selected date from the form
                  $selected_date = $_POST['selected_date'];

                  // Prepare the SQL query
                  $queryhyun10= "SELECT COUNT(DISTINCT num)
                  FROM (
                      SELECT *,
                          ROW_NUMBER() OVER (PARTITION BY num ORDER BY `컨택일` DESC) as row_num
                      FROM agent
                      WHERE `수신` NOT IN ('실패', '문자') 
                          AND (`현상태` = '관리1' or `현상태` = '관리2' or `현상태` = '관리3' or `현상태` = '결제성공')
                          AND DATE_FORMAT(`컨택일`, '%Y-%m-%d') <= '$selected_date'
                  ) AS ranked
                  WHERE row_num = 1 
                      AND 담당자 ='윤서현' 
                      AND `현상태` <> '관리1' 
                      AND `현상태` = '결제성공'";

                  // Execute the query
                  $resulthyun10 = $conn->query($queryhyun10);

                  if ($resulthyun10->num_rows > 0) {
                      // Output data of the first row
                      $rowhyun10 = $resulthyun10->fetch_assoc();
                      $contact_counthyun10 = $rowhyun10['COUNT(DISTINCT num)'];

                      echo " $contact_counthyun10";
                  } else {
                      echo "No contacts found on $selected_date";
                  }
              }
              ?>
          </td>
</tr>
      <tr>
      <td>이다영</td>
      <td>
    <?php
    // Check if the form is submitted
    if (isset($_POST['submit'])) {
        // Get the selected date from the form
        $selected_date = $_POST['selected_date'];

        // Prepare the SQL query
        $queryda7a1 = "SELECT COUNT(DISTINCT num)
        FROM (
            SELECT *,
                ROW_NUMBER() OVER (PARTITION BY num ORDER BY `컨택일` DESC) as row_num
            FROM agent
            WHERE `수신` NOT IN ('실패', '문자') 
                AND (`현상태` = '관리1' or `현상태` = '관리2' or `현상태` = '관리3' or `현상태` = '결제성공')
                AND DATE_FORMAT(`컨택일`, '%Y-%m-%d') <= '$selected_date'
        ) AS ranked
        WHERE row_num = 1 
            AND 담당자 ='이다영' 
            AND `현상태` <> '관리1' 
            AND `현상태` <> '결제성공'";

        // Execute the query
        $resultda7a1 = $conn->query($queryda7a1);

        if ($resultda7a1->num_rows > 0) {
            // Output data of the first row
            $rowda7a1 = $resultda7a1->fetch_assoc();
            $contact_count = $rowda7a1['COUNT(DISTINCT num)']; // Modify this line

            echo " $contact_count";
        } else {
            echo "No contacts found on $selected_date";
        }
    }
    ?>


<?php
    // Check if the form is submitted
    if (isset($_POST['submit'])) {
        // Get the selected date from the form
        $selected_date = $_POST['selected_date'];
        
        // Convert selected_date to a DateTime object
        $date = new DateTime($selected_date);
        
        // Subtract one day
        $date->modify('-1 day');
        
        // Get the modified date as a string
        $modified_date = $date->format('Y-m-d');

        // ... (Your existing code continues)
        $queryda7b1 = "SELECT COUNT(DISTINCT num)
        FROM (
            SELECT *,
                ROW_NUMBER() OVER (PARTITION BY num ORDER BY `컨택일` DESC) as row_num
            FROM agent
            WHERE `수신` NOT IN ('실패', '문자') 
                AND (`현상태` = '관리1' or `현상태` = '관리2' or `현상태` = '관리3' or `현상태` = '결제성공')
                AND DATE_FORMAT(`컨택일`, '%Y-%m-%d') <= '$modified_date'
        ) AS ranked
        WHERE row_num = 1 
            AND 담당자 ='이다영' 
            AND `현상태` <> '관리1' 
            AND `현상태` <> '결제성공'";
        
       // Execute the query
       $resultda7b1 = $conn->query($queryda7b1);

       if ($resultda7b1->num_rows > 0) {
           // Output data of the first row
           $rowda7b1 = $resultda7b1->fetch_assoc();
           $contact_count2 = $rowda7b1['COUNT(DISTINCT num)']; // Modify this line
           $result = $contact_count - $contact_count2;


           if ($result == 0) {
            $result = " "; // 0인 경우 공백 할당
        } elseif ($result > 0) {
            $result = "+$result"; // 양수인 경우 "+" 기호를 붙임
        }

           // 색상 설정
           $color = 'black'; // 기본값은 검정색
           
           if ($result > 0) {
               $color = 'red'; // 양수는 빨간색
           } elseif ($result < 0) {
               $color = 'blue'; // 음수는 파란색
           }
       
           // 결과 출력
           echo "<span style='color: $color;'>$result</span>";
       } else {
           echo "No contacts found on $selected_date";
       }
   }
    ?>
</td>
        <td>
        <?php
              // Check if the form is submitted
              if (isset($_POST['submit'])) {
                  // Get the selected date from the form
                  $selected_date = $_POST['selected_date'];

                  // Prepare the SQL query
                  $queryda7 = "SELECT COUNT(DISTINCT num)
                  FROM (
                      SELECT *,
                          ROW_NUMBER() OVER (PARTITION BY num ORDER BY `컨택일` DESC) as row_num
                      FROM agent
                      WHERE `수신` NOT IN ('실패', '문자') 
                          AND (`현상태` = '관리1' or `현상태` = '관리2' or `현상태` = '관리3' or `현상태` = '결제성공')
                          AND DATE_FORMAT(`컨택일`, '%Y-%m-%d') <= '$selected_date'
                  ) AS ranked
                  WHERE row_num = 1 
                      AND 담당자 ='이다영' 
                      AND `현상태` = '관리1' 
                      AND `현상태` <> '결제성공'";
                  // Execute the query
                  $resultda7 = $conn->query($queryda7);

                  if ($resultda7->num_rows > 0) {
                      // Output data of the first row
                      $rowda7 = $resultda7->fetch_assoc();
                      $contact_countda7 = $rowda7['COUNT(DISTINCT num)'];

                      echo " $contact_countda7";
                  } else {
                      echo "No contacts found on $selected_date";
                  }
              }
              ?>


        </td>
            <td>
            <?php
              // Check if the form is submitted
              if (isset($_POST['submit'])) {
                  // Get the selected date from the form
                  $selected_date = $_POST['selected_date'];

                  // Prepare the SQL query
                  $queryda8 = "SELECT COUNT(DISTINCT num)
                  FROM (
                      SELECT *,
                          ROW_NUMBER() OVER (PARTITION BY num ORDER BY `컨택일` DESC) as row_num
                      FROM agent
                      WHERE `수신` NOT IN ('실패', '문자') 
                          AND (`현상태` = '관리1' or `현상태` = '관리2' or `현상태` = '관리3' or `현상태` = '결제성공')
                          AND DATE_FORMAT(`컨택일`, '%Y-%m-%d') <= '$selected_date'
                  ) AS ranked
                  WHERE row_num = 1 
                      AND 담당자 ='이다영' 
                      AND `현상태` = '관리2' 
                      AND `현상태` <> '결제성공'";

                  // Execute the query
                  $resultda8 = $conn->query($queryda8);

                  if ($resultda8->num_rows > 0) {
                      // Output data of the first row
                      $rowda8 = $resultda8->fetch_assoc();
                      $contact_countda8 = $rowda8['COUNT(DISTINCT num)'];

                      echo " $contact_countda8";
                  } else {
                      echo "No contacts found on $selected_date";
                  }
              }
              ?>




            </td>
            <td>
            <?php
              // Check if the form is submitted
              if (isset($_POST['submit'])) {
                  // Get the selected date from the form
                  $selected_date = $_POST['selected_date'];

                  // Prepare the SQL query
                  $queryda9 = "SELECT COUNT(DISTINCT num)
                  FROM (
                      SELECT *,
                          ROW_NUMBER() OVER (PARTITION BY num ORDER BY `컨택일` DESC) as row_num
                      FROM agent
                      WHERE `수신` NOT IN ('실패', '문자') 
                          AND (`현상태` = '관리1' or `현상태` = '관리2' or `현상태` = '관리3' or `현상태` = '결제성공')
                          AND DATE_FORMAT(`컨택일`, '%Y-%m-%d') <= '$selected_date'
                  ) AS ranked
                  WHERE row_num = 1 
                      AND 담당자 ='이다영' 
                      AND `현상태` = '관리3' 
                      AND `현상태` <> '결제성공'";

                  // Execute the query
                  $resultda9 = $conn->query($queryda9);

                  if ($resultda9->num_rows > 0) {
                      // Output data of the first row
                      $rowda9 = $resultda9->fetch_assoc();
                      $contact_countda9 = $rowda9['COUNT(DISTINCT num)'];

                      echo " $contact_countda9";
                  } else {
                      echo "No contacts found on $selected_date";
                  }
              }
              ?>
            </td>
            <td>
            <?php
              // Check if the form is submitted
              if (isset($_POST['submit'])) {
                  // Get the selected date from the form
                  $selected_date = $_POST['selected_date'];

                  // Prepare the SQL query
                  $queryda10 = "SELECT COUNT(DISTINCT num)
                  FROM (
                      SELECT *,
                          ROW_NUMBER() OVER (PARTITION BY num ORDER BY `컨택일` DESC) as row_num
                      FROM agent
                      WHERE `수신` NOT IN ('실패', '문자') 
                          AND (`현상태` = '관리1' or `현상태` = '관리2' or `현상태` = '관리3' or `현상태` = '결제성공')
                          AND DATE_FORMAT(`컨택일`, '%Y-%m-%d') <= '$selected_date'
                  ) AS ranked
                  WHERE row_num = 1 
                      AND 담당자 ='이다영' 
                      AND `현상태` <> '관리1' 
                      AND `현상태` = '결제성공'";

                  // Execute the query
                  $resultda10 = $conn->query($queryda10);

                  if ($resultda10->num_rows > 0) {
                      // Output data of the first row
                      $rowda10 = $resultda10->fetch_assoc();
                      $contact_countda10 = $rowda10['COUNT(DISTINCT num)'];

                      echo " $contact_countda10";
                  } else {
                      echo "No contacts found on $selected_date";
                  }
              }
              ?>
            </td>
        </tr>
      
      <tr>
        <td>최효주</td>
        <td>
    <?php
    // Check if the form is submitted
    if (isset($_POST['submit'])) {
        // Get the selected date from the form
        $selected_date = $_POST['selected_date'];

        // Prepare the SQL query
        $queryhyo7a1 = "SELECT COUNT(DISTINCT num)
        FROM (
            SELECT *,
                ROW_NUMBER() OVER (PARTITION BY num ORDER BY `컨택일` DESC) as row_num
            FROM agent
            WHERE `수신` NOT IN ('실패', '문자') 
                AND (`현상태` = '관리1' or `현상태` = '관리2' or `현상태` = '관리3' or `현상태` = '결제성공')
                AND DATE_FORMAT(`컨택일`, '%Y-%m-%d') <= '$selected_date'
        ) AS ranked
        WHERE row_num = 1 
            AND 담당자 ='최효주' 
            AND `현상태` <> '관리1' 
            AND `현상태` <> '결제성공'";

        // Execute the query
        $resulthyo7a1 = $conn->query($queryhyo7a1);

        if ($resulthyo7a1->num_rows > 0) {
            // Output data of the first row
            $rowhyo7a1 = $resulthyo7a1->fetch_assoc();
            $contact_count = $rowhyo7a1['COUNT(DISTINCT num)']; // Modify this line

            echo " $contact_count";
        } else {
            echo "No contacts found on $selected_date";
        }
    }
    ?>


<?php
    // Check if the form is submitted
    if (isset($_POST['submit'])) {
        // Get the selected date from the form
        $selected_date = $_POST['selected_date'];
        
        // Convert selected_date to a DateTime object
        $date = new DateTime($selected_date);
        
        // Subtract one day
        $date->modify('-1 day');
        
        // Get the modified date as a string
        $modified_date = $date->format('Y-m-d');

        // ... (Your existing code continues)
        $queryhyo7b1 = "SELECT COUNT(DISTINCT num)
        FROM (
            SELECT *,
                ROW_NUMBER() OVER (PARTITION BY num ORDER BY `컨택일` DESC) as row_num
            FROM agent
            WHERE `수신` NOT IN ('실패', '문자') 
                AND (`현상태` = '관리1' or `현상태` = '관리2' or `현상태` = '관리3' or `현상태` = '결제성공')
                AND DATE_FORMAT(`컨택일`, '%Y-%m-%d') <= '$modified_date'
        ) AS ranked
        WHERE row_num = 1 
            AND 담당자 ='최효주' 
            AND `현상태` <> '관리1' 
            AND `현상태` <> '결제성공'";
        
       // Execute the query
       $resulthyo7b1 = $conn->query($queryhyo7b1);

       if ($resulthyo7b1->num_rows > 0) {
           // Output data of the first row
           $rowhyo7b1 = $resulthyo7b1->fetch_assoc();
           $contact_count2 = $rowhyo7b1['COUNT(DISTINCT num)']; // Modify this line
           $result = $contact_count - $contact_count2;


           if ($result == 0) {
            $result = " "; // 0인 경우 공백 할당
        } elseif ($result > 0) {
            $result = "+$result"; // 양수인 경우 "+" 기호를 붙임
        }

           // 색상 설정
           $color = 'black'; // 기본값은 검정색
           
           if ($result > 0) {
               $color = 'red'; // 양수는 빨간색
           } elseif ($result < 0) {
               $color = 'blue'; // 음수는 파란색
           }
       
           // 결과 출력
           echo "<span style='color: $color;'>$result</span>";
       } else {
           echo "No contacts found on $selected_date";
       }
   }
    ?>
</td>
        <td>
        <?php
              // Check if the form is submitted
              if (isset($_POST['submit'])) {
                  // Get the selected date from the form
                  $selected_date = $_POST['selected_date'];

                  // Prepare the SQL query
                  $queryhyo7 = "SELECT COUNT(DISTINCT num)
                  FROM (
                      SELECT *,
                          ROW_NUMBER() OVER (PARTITION BY num ORDER BY `컨택일` DESC) as row_num
                      FROM agent
                      WHERE `수신` NOT IN ('실패', '문자') 
                          AND (`현상태` = '관리1' or `현상태` = '관리2' or `현상태` = '관리3' or `현상태` = '결제성공')
                          AND DATE_FORMAT(`컨택일`, '%Y-%m-%d') <= '$selected_date'
                  ) AS ranked
                  WHERE row_num = 1 
                      AND 담당자 ='최효주' 
                      AND `현상태` = '관리1' 
                      AND `현상태` <> '결제성공'";
          

                  // Execute the query
                  $resulthyo7 = $conn->query($queryhyo7);

                  if ($resulthyo7->num_rows > 0) {
                      // Output data of the first row
                      $rowhyo7 = $resulthyo7->fetch_assoc();
                      $contact_counthyo7 = $rowhyo7['COUNT(DISTINCT num)'];

                      echo " $contact_counthyo7";
                  } else {
                      echo "No contacts found on $selected_date";
                  }
              }
              ?>




        </td>
        <td>
        <?php
              // Check if the form is submitted
              if (isset($_POST['submit'])) {
                  // Get the selected date from the form
                  $selected_date = $_POST['selected_date'];

                  // Prepare the SQL query
                  $queryhyo8 = "SELECT COUNT(DISTINCT num)
                  FROM (
                      SELECT *,
                          ROW_NUMBER() OVER (PARTITION BY num ORDER BY `컨택일` DESC) as row_num
                      FROM agent
                      WHERE `수신` NOT IN ('실패', '문자') 
                          AND (`현상태` = '관리1' or `현상태` = '관리2' or `현상태` = '관리3' or `현상태` = '결제성공')
                          AND DATE_FORMAT(`컨택일`, '%Y-%m-%d') <= '$selected_date'
                  ) AS ranked
                  WHERE row_num = 1 
                      AND 담당자 ='최효주' 
                      AND `현상태` = '관리2' 
                      AND `현상태` <> '결제성공'";
          
                  // Execute the query
                  $resulthyo8 = $conn->query($queryhyo8);

                  if ($resulthyo8->num_rows > 0) {
                      // Output data of the first row
                      $rowhyo8 = $resulthyo8->fetch_assoc();
                      $contact_counthyo8 = $rowhyo8['COUNT(DISTINCT num)'];

                      echo " $contact_counthyo8";
                  } else {
                      echo "No contacts found on $selected_date";
                  }
              }
              ?>



        </td>
        <td>
        <?php
              // Check if the form is submitted
              if (isset($_POST['submit'])) {
                  // Get the selected date from the form
                  $selected_date = $_POST['selected_date'];

                  // Prepare the SQL query
                  $queryhyo9 = "SELECT COUNT(DISTINCT num)
                  FROM (
                      SELECT *,
                          ROW_NUMBER() OVER (PARTITION BY num ORDER BY `컨택일` DESC) as row_num
                      FROM agent
                      WHERE `수신` NOT IN ('실패', '문자') 
                          AND (`현상태` = '관리1' or `현상태` = '관리2' or `현상태` = '관리3' or `현상태` = '결제성공')
                          AND DATE_FORMAT(`컨택일`, '%Y-%m-%d') <= '$selected_date'
                  ) AS ranked
                  WHERE row_num = 1 
                      AND 담당자 ='최효주' 
                      AND `현상태` = '관리3' 
                      AND `현상태` <> '결제성공'";
          

                  // Execute the query
                  $resulthyo9 = $conn->query($queryhyo9);

                  if ($resulthyo9->num_rows > 0) {
                      // Output data of the first row
                      $rowhyo9 = $resulthyo9->fetch_assoc();
                      $contact_counthyo9 = $rowhyo9['COUNT(DISTINCT num)'];

                      echo " $contact_counthyo9";
                  } else {
                      echo "No contacts found on $selected_date";
                  }
              }
              ?>
        </td>
        <td>
        <?php
              // Check if the form is submitted
              if (isset($_POST['submit'])) {
                  // Get the selected date from the form
                  $selected_date = $_POST['selected_date'];

                  // Prepare the SQL query
                  $queryhyo10 = "SELECT COUNT(DISTINCT num)
                  FROM (
                      SELECT *,
                          ROW_NUMBER() OVER (PARTITION BY num ORDER BY `컨택일` DESC) as row_num
                      FROM agent
                      WHERE `수신` NOT IN ('실패', '문자') 
                          AND (`현상태` = '관리1' or `현상태` = '관리2' or `현상태` = '관리3' or `현상태` = '결제성공')
                          AND DATE_FORMAT(`컨택일`, '%Y-%m-%d') <= '$selected_date'
                  ) AS ranked
                  WHERE row_num = 1 
                      AND 담당자 ='최효주' 
                      AND `현상태` <> '관리1' 
                      AND `현상태` = '결제성공'";
          
                  // Execute the query
                  $resulthyo10 = $conn->query($queryhyo10);

                  if ($resulthyo10->num_rows > 0) {
                      // Output data of the first row
                      $rowhyo10 = $resulthyo10->fetch_assoc();
                      $contact_counthyo10 = $rowhyo10['COUNT(DISTINCT num)'];

                      echo " $contact_counthyo10";
                  } else {
                      echo "No contacts found on $selected_date";
                  }
              }
              ?>
        </td>
      </tr>

      
      <!-- Add more rows as needed -->
    </tbody>
  </table>
</div>
</center>









