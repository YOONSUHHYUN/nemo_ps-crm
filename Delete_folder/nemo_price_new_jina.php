<?php #등록기간
  require("config/config.php");
  require("lib/db.php");
  $conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);
  require("result/nemo_cal.php");
  $discount111 = 0.2;
  $percentage = $discount111 * 100 .'%';


$today = date("Y-m-d");



#기준금액
$cp = "SELECT (SELECT 가격 FROM product_nomal WHERE 시 = '".$_GET['address1']."' and 구 = '".$address."' limit 1 )/10 * '".$number."' as cp";
$result2 = mysqli_query($conn,$cp) or die(mysqli_error($conn));
$row2 = mysqli_fetch_assoc($result2);
#echo htmlspecialchars($row2['cp']);



#시작월 일할계산
$sdprice = "SELECT TRUNCATE('".$row2['cp']."' / date_format(last_day('".$today."'),'%d'),0) as sdprice";
$result3 = mysqli_query($conn,$sdprice) or die(mysqli_error($conn));
$row3 = mysqli_fetch_assoc($result3);



#시작월 사용일수
$startdays = "SELECT DATE_FORMAT(last_day('".$today."'),'%d') - DATE_FORMAT('".$today."','%d')+1 as startdays";
$result4 = mysqli_query($conn,$startdays) or die(mysqli_error($conn));
$row4 = mysqli_fetch_assoc($result4);


  #할인율 적용전
  $nonedis21 = "SELECT CASE
  WHEN
  	(SELECT DATE_FORMAT('".$today."','%d')) < 6
  THEN
  	(SELECT ('".$row4['startdays']."'* '".$row3['sdprice']."'))
  ELSE
  	(SELECT ('".$row4['startdays']."' *'".$row3['sdprice']."') + '".$row2['cp']."')
  end as nonedis";
  $result921 = mysqli_query($conn,$nonedis21) or die(mysqli_error($conn));
  $row921 = mysqli_fetch_assoc($result921);






  #사용일수

  $usedays1 = "SELECT CASE
  WHEN (SELECT DATE_FORMAT('".$today."','%d')) < 6
  THEN
   (SELECT DATE_FORMAT(last_day('".$today."'),'%d') - DATE_FORMAT('".$today."','%d'))
  ELSE
   (SELECT DATE_FORMAT(last_day('".$today."'),'%d') - DATE_FORMAT('".$today."','%d')) + (SELECT date_format(last_day(DATE_ADD('".$today."', INTERVAL 1 MONTH)),'%d'))
  END as usedays";
  $result81 = mysqli_query($conn,$usedays1) or die(mysqli_error($conn));
  $row81 = mysqli_fetch_assoc($result81);

  #신규,복귀 일반금액
  $newnormalprice21 = "SELECT TRUNCATE('".$row921['nonedis']."' * (1 - '".$discount111."'),-1) as newnormalprice";
  $result1021 = mysqli_query($conn,$newnormalprice21) or die(mysqli_error($conn));
  $row1021 = mysqli_fetch_assoc($result1021);



  #1달 더하기
  $nextmonth1 = "SELECT DATE_ADD('".$today."', INTERVAL 1 MONTH) as nextmonth";
  $result61 = mysqli_query($conn,$nextmonth1) or die(mysqli_error($conn));
  $row61 = mysqli_fetch_assoc($result61);
  #echo htmlspecialchars($row6['nextmonth']);



  $enddate1 =
  "SELECT CASE
  WHEN (SELECT DATE_FORMAT('".$today."','%d')) < 6
  THEN (SELECT last_day('".$today."'))
  ELSE (SELECT last_day('".$row61['nextmonth']."'))
  end as enddate";
  $result111 = mysqli_query($conn,$enddate1) or die(mysqli_error($conn));
  $row111 = mysqli_fetch_assoc($result111);
  #echo htmlspecialchars($row11['enddate']);





?>


<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <link rel="stylesheet" type="text/css" href="style.css">

  <link href="bootstrap-3.3.4-dist/css/bootstrap.min.css" rel="stylesheet">
  <title>신규업체 일반금액</title>
  </head>
  <body>
    <h1><center>신규업체 상품금액</center></h1>

  <h3><center><td colspan="3"><?php echo $_GET['address1']." ".$address; ?></td> 상품금액</center></h3>
<h3><center>기간 : <?php

echo $today;
?> ~ <?php echo $row111['enddate']; ?> (<?php echo $row81['usedays']; ?>일) </center></h3>




<h3><center><p>일반매물 금액<span style="font-size:12px;">(VAT포함)</span></p></center></h3>
    <table class="table table-bordered">
      <thead>
        <tr>
           <th scope="col" style='text-align: center; vertical-align : middle;'>상품</th>
           <th scope="col" style='text-align: center; vertical-align : middle;'>정가</th>
           <th scope="col" style='text-align: center; vertical-align : middle;'>할인율</th>
           <th scope="col" style='text-align: center; vertical-align : middle;'>총 <?php echo $row81['usedays']; ?>일 사용금액</th>
        </tr>
      </thead>


      <thead>
        <tr>
            <td colspan="1" style='text-align: center; vertical-align : middle;'>일반매물<?php echo $number; ?>건</td>
            <td colspan="1" style='text-align: center; vertical-align : middle;'><?php echo number_format($row2['cp']); ?>원</td>
            <td colspan="1" style='text-align: center; vertical-align : middle;'><?php echo $percentage ?></td>
            <td colspan="1" style='text-align: center; vertical-align : middle;'><?php echo "<font color=red>"; echo number_format($row1021['newnormalprice']); ?>원</p></td>
        </tr>
      </thead>
    </table>



    <h3><center><p>프리미엄 (우선노출) 상품 금액<span style="font-size:12px;">(VAT포함)</span></p></center></h3>

<?php echo $row100['지역']; ?>



        <table class="table table-bordered">
          <thead>
            <tr>
               <th scope="col" style='text-align: center; vertical-align : middle;'>상품</th>
               <th scope="col" style='text-align: center; vertical-align : middle;'>단품(상가OR사무실)정가</th>
               <th scope="col" style='text-align: center; vertical-align : middle;'>패키지(상가+사무실)정가</th>
               <th scope="col" style='text-align: center; vertical-align : middle;'>할인율</th>
               <th scope="col" style='text-align: center; vertical-align : middle;'>단품(상가OR사무실) <?php echo $row81['usedays']; ?>일 사용금액</th>
               <th scope="col" style='text-align: center; vertical-align : middle;'>패키지(상가+사무실) <?php echo $row81['usedays']; ?>일 사용금액</th>

            </tr>
          </thead>

          <?php









          $codes = implode(",", range(0, 4000));  // 0부터 9999까지의 숫자 배열을 문자열로 변환
          $primeumprice = "SELECT * FROM `product_premium` WHERE `시` = '{$_GET['address1']}' AND `구` = '{$address}' AND `구분` IN ($codes)";
          $primeumprice_result = mysqli_query($conn, $primeumprice) or die(mysqli_error($conn));
          while ($row100 = mysqli_fetch_assoc($primeumprice_result)) {



#사용일수
$usedays = "SELECT CASE
WHEN (SELECT DATE_FORMAT('".$today."','%d')) < 6
THEN
 (SELECT DATE_FORMAT(last_day('".$today."'),'%d') - DATE_FORMAT('".$today."','%d'))
ELSE
 (SELECT DATE_FORMAT(last_day('".$today."'),'%d') - DATE_FORMAT('".$today."','%d')) + (SELECT date_format(last_day(DATE_ADD('".$today."', INTERVAL 1 MONTH)),'%d'))
END as usedays";
$result8 = mysqli_query($conn,$usedays) or die(mysqli_error($conn));
$row8 = mysqli_fetch_assoc($result8);



#단품 계산-----

#            $sdprice1 = "SELECT TRUNCATE('".$row100['사무실']."' / date_format(last_day('".$row8['usedays']."'),'%d'),0) as sdprice1";
#            $result101 = mysqli_query($conn,$sdprice1) or die(mysqli_error($conn));
#            $row101 = mysqli_fetch_assoc($result101);

            #시작월 일할계산
            $sdprice = "SELECT TRUNCATE('".$row100['사무실']."' / date_format(last_day('".$today."'),'%d'),0) as sdprice";
            $result3 = mysqli_query($conn,$sdprice) or die(mysqli_error($conn));
            $row3 = mysqli_fetch_assoc($result3);



            #시작월 사용일수
            $startdays = "SELECT DATE_FORMAT(last_day('".$today."'),'%d') - DATE_FORMAT('".$today."','%d')+1 as startdays";
            $result4 = mysqli_query($conn,$startdays) or die(mysqli_error($conn));
            $row4 = mysqli_fetch_assoc($result4);




            #할인율 적용전
            $nonedis = "SELECT CASE
            WHEN
            	(SELECT DATE_FORMAT('".$row8['usedays']."','%d')) < 6
            THEN
            	(SELECT ('".$row4['startdays']."'* '".$row3['sdprice']."'))
            ELSE
            	(SELECT ('".$row4['startdays']."' *'".$row3['sdprice']."') + '".$row100['사무실']."')
            end as nonedis";
            $result9 = mysqli_query($conn,$nonedis) or die(mysqli_error($conn));
            $row9 = mysqli_fetch_assoc($result9);



            #단품 프리미엄 계산금액
            $premiumprice = "SELECT TRUNCATE('".$row9['nonedis']."' * (1 - '".$discount111."'),-1) as premiumprice";
            $result10 = mysqli_query($conn,$premiumprice) or die(mysqli_error($conn));
            $row10 = mysqli_fetch_assoc($result10);


            #패키지 계산-----


                        #시작월 일할계산
                        $sdprice1 = "SELECT TRUNCATE('".$row100['상가사무실']."' / date_format(last_day('".$today."'),'%d'),0) as sdprice";
                        $result31 = mysqli_query($conn,$sdprice1) or die(mysqli_error($conn));
                        $row31 = mysqli_fetch_assoc($result31);



                        #시작월 사용일수
                        $startdays1 = "SELECT DATE_FORMAT(last_day('".$today."'),'%d') - DATE_FORMAT('".$today."','%d')+1 as startdays";
                        $result41 = mysqli_query($conn,$startdays1) or die(mysqli_error($conn));
                        $row41 = mysqli_fetch_assoc($result41);




                        #할인율 적용전
                        $nonedis1 = "SELECT CASE
                        WHEN
                        	(SELECT DATE_FORMAT('".$row81['usedays']."','%d')) < 6
                        THEN
                        	(SELECT ('".$row41['startdays']."'* '".$row31['sdprice']."'))
                        ELSE
                        	(SELECT ('".$row41['startdays']."' *'".$row31['sdprice']."') + '".$row100['상가사무실']."')
                        end as nonedis";
                        $result91 = mysqli_query($conn,$nonedis1) or die(mysqli_error($conn));
                        $row91 = mysqli_fetch_assoc($result91);



                        #패키지 프리미엄 계산금액
                        $premiumprice1 = "SELECT TRUNCATE('".$row91['nonedis']."' * (1 - '".$discount111."'),-1) as premiumprice";
                        $result101 = mysqli_query($conn,$premiumprice1) or die(mysqli_error($conn));
                        $row101 = mysqli_fetch_assoc($result101);

echo
"<thead>".
"<tr>".
   "<td colspan='1' style='text-align: center; vertical-align : middle;'>".$row100['지역']."</td>".
   "<td colspan='1' style='text-align: center; vertical-align : middle;'>".number_format($row100['사무실'])."</td>".
   "<td colspan='1' style='text-align: center; vertical-align : middle;'>".number_format($row100['상가사무실'])."</td>".
   "<td colspan='1' style='text-align: center; vertical-align : middle;'>".$percentage."</td>".
   "<td colspan='1' style='text-align: center; vertical-align : middle;'>"."<font color=red>".
   number_format($row10['premiumprice'])."</td>".
   "<td colspan='1' style='text-align: center; vertical-align : middle;'>"."<font color=red>".
   number_format($row101['premiumprice'])."</td>".

"</tr>".
"</thead>";
              }







          ?>



        </table>


      </br></br></br></br>

      <center><a href="sms:01090547434" target="_blank"><img
      src="button_01.png"
      alt="문의하기" ></a></center>




  </body>
</html>
