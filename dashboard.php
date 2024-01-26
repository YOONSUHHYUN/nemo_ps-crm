


<center><h3>Action</h3></center>




<center>
<div class="col-6">
  <table class="table">
    <thead>
      <tr>
        <th>담당자</th>
        <th>누적</th>
        <th>문자전송</th>
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
                  $query = "SELECT count(DATE_FORMAT(`컨택일`, '%Y-%m-%d')) AS contact_count
                            FROM agent
                            WHERE `담당자`='윤서현' AND DATE_FORMAT(`컨택일`, '%Y-%m-%d') = '$selected_date'";

                  // Execute the query
                  $result = $conn->query($query);

                  if ($result->num_rows > 0) {
                      // Output data of the first row
                      $row = $result->fetch_assoc();
                      $contact_count = $row['contact_count'];

                      echo "$contact_count";
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
                  $queryhyun2 = "SELECT count(DATE_FORMAT(`컨택일`, '%Y-%m-%d')) AS contact_count
                            FROM agent
                            WHERE `담당자`='윤서현' AND `수신`='문자' AND DATE_FORMAT(`컨택일`, '%Y-%m-%d') = '$selected_date'";

                  // Execute the query
                  $resulthyun2 = $conn->query($queryhyun2);

                  if ($resulthyun2->num_rows > 0) {
                      // Output data of the first row
                      $rowhyun2 = $resulthyun2->fetch_assoc();
                      $contact_counthyun2 = $rowhyun2['contact_count'];

                      echo " $contact_counthyun2 ";
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
                  $queryhyun2 = "SELECT count(DATE_FORMAT(`컨택일`, '%Y-%m-%d')) AS contact_count
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
                  $queryhyun3 = "SELECT count(DATE_FORMAT(`컨택일`, '%Y-%m-%d')) AS contact_count
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
                  $queryhyun4 = "SELECT count(DATE_FORMAT(`컨택일`, '%Y-%m-%d')) AS contact_count
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
                  $queryhyun5 = "SELECT count(DATE_FORMAT(`컨택일`, '%Y-%m-%d')) AS contact_count
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
                $queryda = "SELECT count(DATE_FORMAT(`컨택일`, '%Y-%m-%d')) AS contact_count
                            FROM agent
                            WHERE `담당자`='이다영' AND DATE_FORMAT(`컨택일`, '%Y-%m-%d') = '$selected_date'";

                // Execute the query
                $resultda = $conn->query($queryda);

                if ($resultda->num_rows > 0) {
                    // Output data of the first row
                    $rowda = $resultda->fetch_assoc();
                    $contact_countda = $rowda['contact_count'];

                    echo " $contact_countda";
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
                  $queryda2 = "SELECT count(DATE_FORMAT(`컨택일`, '%Y-%m-%d')) AS contact_count
                            FROM agent
                            WHERE `담당자`='이다영' AND `수신`='문자' AND DATE_FORMAT(`컨택일`, '%Y-%m-%d') = '$selected_date'";

                  // Execute the query
                  $resultda2 = $conn->query($queryda2);

                  if ($resultda2->num_rows > 0) {
                      // Output data of the first row
                      $rowda2 = $resultda2->fetch_assoc();
                      $contact_countda2 = $rowda2['contact_count'];

                      echo " $contact_countda2 ";
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
                  $queryda2 = "SELECT count(DATE_FORMAT(`컨택일`, '%Y-%m-%d')) AS contact_count
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
                  $queryda3 = "SELECT count(DATE_FORMAT(`컨택일`, '%Y-%m-%d')) AS contact_count
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
                  $queryda4 = "SELECT count(DATE_FORMAT(`컨택일`, '%Y-%m-%d')) AS contact_count
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
                  $queryda5 = "SELECT count(DATE_FORMAT(`컨택일`, '%Y-%m-%d')) AS contact_count
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
              $queryhyo = "SELECT count(DATE_FORMAT(`컨택일`, '%Y-%m-%d')) AS contact_count
                          FROM agent
                          WHERE `담당자`='최효주' AND DATE_FORMAT(`컨택일`, '%Y-%m-%d') = '$selected_date'";

              // Execute the query
              $resulthyo = $conn->query($queryhyo);

              if ($resulthyo->num_rows > 0) {
                  // Output data of the first row
                  $rowhyo = $resulthyo->fetch_assoc();
                  $contact_counthyo = $rowhyo['contact_count'];

                  echo " $contact_counthyo";
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
                  $queryhyo2 = "SELECT count(DATE_FORMAT(`컨택일`, '%Y-%m-%d')) AS contact_count
                            FROM agent
                            WHERE `담당자`='최효주' AND `수신`='문자' AND DATE_FORMAT(`컨택일`, '%Y-%m-%d') = '$selected_date'";

                  // Execute the query
                  $resulthyo2 = $conn->query($queryhyo2);

                  if ($resulthyo2->num_rows > 0) {
                      // Output data of the first row
                      $rowhyo2 = $resulthyo2->fetch_assoc();
                      $contact_counthyo2 = $rowhyo2['contact_count'];

                      echo " $contact_counthyo2";
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
                  $queryhyo2 = "SELECT count(DATE_FORMAT(`컨택일`, '%Y-%m-%d')) AS contact_count
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
                  $queryhyo3 = "SELECT count(DATE_FORMAT(`컨택일`, '%Y-%m-%d')) AS contact_count
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
                  $queryhyo4 = "SELECT count(DATE_FORMAT(`컨택일`, '%Y-%m-%d')) AS contact_count
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
                  $queryhyo5 = "SELECT count(DATE_FORMAT(`컨택일`, '%Y-%m-%d')) AS contact_count
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
                  $queryhyun7 = "SELECT count(DATE_FORMAT(`컨택일`, '%Y-%m-%d')) AS contact_count
                            FROM agent
                            WHERE `담당자`='윤서현' AND `현상태`='관리1' AND DATE_FORMAT(`컨택일`, '%Y-%m-%d') = '$selected_date'";

                  // Execute the query
                  $resulthyun7 = $conn->query($queryhyun7);

                  if ($resulthyun7->num_rows > 0) {
                      // Output data of the first row
                      $rowhyun7 = $resulthyun7->fetch_assoc();
                      $contact_counthyun7 = $rowhyun7['contact_count'];

                      echo " $contact_counthyun7";
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
                  $queryhyun8 = "SELECT count(DATE_FORMAT(`컨택일`, '%Y-%m-%d')) AS contact_count
                            FROM agent
                            WHERE `담당자`='윤서현' AND `현상태`='관리2' AND DATE_FORMAT(`컨택일`, '%Y-%m-%d') = '$selected_date'";

                  // Execute the query
                  $resulthyun8 = $conn->query($queryhyun8);

                  if ($resulthyun8->num_rows > 0) {
                      // Output data of the first row
                      $rowhyun8 = $resulthyun8->fetch_assoc();
                      $contact_counthyun8 = $rowhyun8['contact_count'];

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
                  $queryhyun9 = "SELECT count(DATE_FORMAT(`컨택일`, '%Y-%m-%d')) AS contact_count
                            FROM agent
                            WHERE `담당자`='윤서현' AND `현상태`='관리3' AND DATE_FORMAT(`컨택일`, '%Y-%m-%d') = '$selected_date'";

                  // Execute the query
                  $resulthyun9 = $conn->query($queryhyun9);

                  if ($resulthyun9->num_rows > 0) {
                      // Output data of the first row
                      $rowhyun9 = $resulthyun9->fetch_assoc();
                      $contact_counthyun9 = $rowhyun9['contact_count'];

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
                  $queryhyun10= "SELECT count(DATE_FORMAT(`컨택일`, '%Y-%m-%d')) AS contact_count
                            FROM agent
                            WHERE `담당자`='윤서현' AND `현상태`='결제성공' AND DATE_FORMAT(`컨택일`, '%Y-%m-%d') = '$selected_date'";

                  // Execute the query
                  $resulthyun10 = $conn->query($queryhyun10);

                  if ($resulthyun10->num_rows > 0) {
                      // Output data of the first row
                      $rowhyun10 = $resulthyun10->fetch_assoc();
                      $contact_counthyun10 = $rowhyun10['contact_count'];

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
                  $queryda7 = "SELECT count(DATE_FORMAT(`컨택일`, '%Y-%m-%d')) AS contact_count
                            FROM agent
                            WHERE `담당자`='이다영' AND `현상태`='관리1' AND DATE_FORMAT(`컨택일`, '%Y-%m-%d') = '$selected_date'";

                  // Execute the query
                  $resultda7 = $conn->query($queryda7);

                  if ($resultda7->num_rows > 0) {
                      // Output data of the first row
                      $rowda7 = $resultda7->fetch_assoc();
                      $contact_countda7 = $rowda7['contact_count'];

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
                  $queryda8 = "SELECT count(DATE_FORMAT(`컨택일`, '%Y-%m-%d')) AS contact_count
                            FROM agent
                            WHERE `담당자`='이다영' AND `현상태`='관리2' AND DATE_FORMAT(`컨택일`, '%Y-%m-%d') = '$selected_date'";

                  // Execute the query
                  $resultda8 = $conn->query($queryda8);

                  if ($resultda8->num_rows > 0) {
                      // Output data of the first row
                      $rowda8 = $resultda8->fetch_assoc();
                      $contact_countda8 = $rowda8['contact_count'];

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
                  $queryda9 = "SELECT count(DATE_FORMAT(`컨택일`, '%Y-%m-%d')) AS contact_count
                            FROM agent
                            WHERE `담당자`='이다영' AND `현상태`='관리3' AND DATE_FORMAT(`컨택일`, '%Y-%m-%d') = '$selected_date'";

                  // Execute the query
                  $resultda9 = $conn->query($queryda9);

                  if ($resultda9->num_rows > 0) {
                      // Output data of the first row
                      $rowda9 = $resultda9->fetch_assoc();
                      $contact_countda9 = $rowda9['contact_count'];

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
                  $queryda10 = "SELECT count(DATE_FORMAT(`컨택일`, '%Y-%m-%d')) AS contact_count
                            FROM agent
                            WHERE `담당자`='이다영' AND `현상태`='결제성공' AND DATE_FORMAT(`컨택일`, '%Y-%m-%d') = '$selected_date'";

                  // Execute the query
                  $resultda10 = $conn->query($queryda10);

                  if ($resultda10->num_rows > 0) {
                      // Output data of the first row
                      $rowda10 = $resultda10->fetch_assoc();
                      $contact_countda10 = $rowda10['contact_count'];

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
                  $queryhyo7 = "SELECT count(DATE_FORMAT(`컨택일`, '%Y-%m-%d')) AS contact_count
                            FROM agent
                            WHERE `담당자`='최효주' AND `현상태`='관리1' AND DATE_FORMAT(`컨택일`, '%Y-%m-%d') = '$selected_date'";

                  // Execute the query
                  $resulthyo7 = $conn->query($queryhyo7);

                  if ($resulthyo7->num_rows > 0) {
                      // Output data of the first row
                      $rowhyo7 = $resulthyo7->fetch_assoc();
                      $contact_counthyo7 = $rowhyo7['contact_count'];

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
                  $queryhyo8 = "SELECT count(DATE_FORMAT(`컨택일`, '%Y-%m-%d')) AS contact_count
                            FROM agent
                            WHERE `담당자`='최효주' AND `현상태`='관리2' AND DATE_FORMAT(`컨택일`, '%Y-%m-%d') = '$selected_date'";

                  // Execute the query
                  $resulthyo8 = $conn->query($queryhyo8);

                  if ($resulthyo8->num_rows > 0) {
                      // Output data of the first row
                      $rowhyo8 = $resulthyo8->fetch_assoc();
                      $contact_counthyo8 = $rowhyo8['contact_count'];

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
                  $queryhyo9 = "SELECT count(DATE_FORMAT(`컨택일`, '%Y-%m-%d')) AS contact_count
                            FROM agent
                            WHERE `담당자`='최효주' AND `현상태`='관리3' AND DATE_FORMAT(`컨택일`, '%Y-%m-%d') = '$selected_date'";

                  // Execute the query
                  $resulthyo9 = $conn->query($queryhyo9);

                  if ($resulthyo9->num_rows > 0) {
                      // Output data of the first row
                      $rowhyo9 = $resulthyo9->fetch_assoc();
                      $contact_counthyo9 = $rowhyo9['contact_count'];

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
                  $queryhyo10 = "SELECT count(DATE_FORMAT(`컨택일`, '%Y-%m-%d')) AS contact_count
                            FROM agent
                            WHERE `담당자`='최효주' AND `현상태`='결제성공' AND DATE_FORMAT(`컨택일`, '%Y-%m-%d') = '$selected_date'";

                  // Execute the query
                  $resulthyo10 = $conn->query($queryhyo10);

                  if ($resulthyo10->num_rows > 0) {
                      // Output data of the first row
                      $rowhyo10 = $resulthyo10->fetch_assoc();
                      $contact_counthyo10 = $rowhyo10['contact_count'];

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









