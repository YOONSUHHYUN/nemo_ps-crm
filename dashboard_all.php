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



  <title>NEW Account Dash board</title>
</head>

<body>



  <div>


    </br></br>
    <h1>
      <center>NEW Account Dash Board</center>
    </h1>


    <center>
      <form method="post" action="">
        Select a date: <input type="date" name="selected_date">
        <input type="submit" name="submit" value="Submit">
      </form>
    </center>

    <div class="container-fluid">
      <div class="row">
        <div class='col'>
          <?php require ("dashboard.php"); ?>
        </div>

        <div class='col'>
          <?php require ("dashboard2.php"); ?>
        </div>
      </div>
    </div>

    </br></br></br></br>



</body>

</html>