<?php #등록기간
  require("config/config.php");
  require("lib/db.php");
  $conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);

  require("db_customer2.php");
?>


<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" >
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <link rel="stylesheet" type="text/css" href="style.css">

  <link href="bootstrap-3.3.4-dist/css/bootstrap.min.css" rel="stylesheet">
  <title>재결제 상품 메모</title>
  </head>
  <body>
    <h1><center>재결제 상품 메모</center></h1>

          <table class="table table-bordered">
            <thead><tr>
            <th scope='col'>업체명</th>
            <td colspan='1'><?php echo $_GET['cname'] ?></td>
            <th scope='col'>대표자명</th>
            <td colspan='1'><?php echo $_GET['name'] ?></td>
            <th scope='col'>상품</th>
            <td colspan='1'><?php echo $_GET['product'] ?></td>
            <th scope='col'>상품구분</th>
            <td colspan='1'><?php echo $_GET['option'] ?></td>


            </tr></thead>
              <thead><tr>
            <th scope='col'>메모</th>
            <td colspan='7'>



-일할계산: <?php echo number_format($_GET['cp']); ?>원/<?php echo $_GET['days']; ?>일=<?php echo number_format($_GET['cp']/$_GET['days']); ?>원</br>
-[<?php $dateString = date("n", strtotime($_GET['date']));
 echo $dateString + 1;
 ?>월 잔여(<?php echo number_format($_GET['cp']/$_GET['days']); ?>원X<?php echo $_GET['days']; ?>일)X입점할인<?php echo $_GET['discount']; ?>%=<?php echo $_GET['ab5']; ?>원



            </td>

        </tr></thead>



          </table>

<center><a href='https://admin.nemoapp.kr/ArticleItem/AgentItemIndex?agentId=<?php echo $_GET['agentId']."&name=".$_GET['cname']." ' target='_blank' " ?>' > <input type="button" value="등록"  style=font-size:1.5em; > </a></center>
</br>
  <center><input type="button" value="이전페이지" onClick="history.go(-1)"></center>

</br>  <center><input type="button" value="HOME" onClick="location.href='index_backup.html'"></center>



  </body>
</html>
