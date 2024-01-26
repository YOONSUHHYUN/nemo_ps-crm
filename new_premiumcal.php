<?php #등록기간
  require("config/config.php");
  require("lib/db.php");
  $conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);
  require("result/nemo_premiumcal.php");
?>


<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <link rel="stylesheet" type="text/css" href="style.css">

  <link href="bootstrap-3.3.4-dist/css/bootstrap.min.css" rel="stylesheet">
  <title>프리미엄 금액 견적서</title>
  </head>
  <body>
    <h1><center>프리미엄금액</center></h1>

  <h3>상품금액</h3>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th scope="col" style='text-align: center; vertical-align : middle;'>지역</th>
           <td colspan="3"><?php echo $address1; ?> <?php echo $address; ?></td>
           <th scope="col" style='text-align: center; vertical-align : middle;'>정가</th>
            <td colspan="3"><?php echo number_format($row2['cp']); ?>원</td>
        </tr>
    </thead>
    <thead>
      <tr>
        <th scope="col" style='text-align: center; vertical-align : middle;'>상품</th>
         <td colspan="1"><?php echo $_GET['option'] ?> 프리미엄</td>
         <th scope="col" style='text-align: center; vertical-align : middle;'>시작일</th>
          <td colspan="1"><?php echo $startingdate; ?></td>
          <th scope="col" style='text-align: center; vertical-align : middle;'>종료일</th>
           <td colspan="1"><?php echo $row11['enddate']; ?></td>
         <th scope="col" style='text-align: center; vertical-align : middle;'>할인율</th>
          <td colspan="1"><?php echo $rowcount['count'] * 100; ?>%</td>
      </tr>
    </thead>
    <thead>
      <tr>
        <th scope="col" style='text-align: center; vertical-align : middle;'>등록일수</th>
         <td colspan="1"><?php echo $row8['usedays']; ?>일</td>
         <th scope="col" style='text-align: center; vertical-align : middle;'>상품원가</th>
          <td colspan="1"><?php echo number_format($row9['nonedis']); ?>원</td>
          <th scope="col" style='text-align: center; vertical-align : middle;'>당월 일할금액</th>
           <td colspan="1"><?php echo number_format($row3['sdprice']); ?>원</td>
         <th scope="col" style='text-align: center; vertical-align : middle;'>일할 계산금액</th>
          <td colspan="1"><?php echo number_format($row12['firstmonth']); ?>원</td>
      </tr>
    </thead>
    <thead>
      <tr>
        <th scope="col" style='text-align: center; vertical-align : middle;'>최종금액</th>
         <td colspan="7"><p text align="right"><?php
         echo "<font color=red>";
         echo number_format($row10['premiumprice']); ?>원</p></td>
      </tr>
    </thead>
    <thead>
      <tr>
        <th scope="col" style='text-align: center; vertical-align : middle;'>메모</th>
         <td colspan="7"></p>
<?php echo $row13['memo1'] ?></br>
-일할계산: <?php echo number_format($row2['cp']); ?>원/<?php echo $row5['startmonthdays']; ?>일=<?php echo number_format($row3['sdprice']); ?>원</br>
-[5월 잔여(<?php echo number_format($row3['sdprice']); ?>원X<?php echo $row4['startdays']; ?>일)+1개월(<?php echo number_format($row2['cp']); ?>원)]X입점할인<?php echo $rowcount['count'] * 100; ?>%=<?php echo number_format($row10['premiumprice']); ?>원


         </td>
      </tr>
    </thead>
  </table>
  <center><a href='https://admin.nemoapp.kr/ArticleItem/AgentItemRegister' > <input type="button" value="등록"  style=font-size:1.5em; > </a></center>
  </br>
  <center><input type="button" value="이전페이지" onClick="history.go(-1)"></center>

</br>  <center><input type="button" value="HOME" onClick="location.href='index_backup.html'"></center>



  </body>
</html>
