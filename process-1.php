
<?php #등록기간
  require("config/config.php");
  require("lib/db.php");
  $conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);
  require("db_customer.php");
  require("result/refund_cal.php");
  preg_match('~인(.*?)=~',$row['상세내역'],$output);
?>



<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <link rel="stylesheet" type="text/css" href="style.css">

  <link href="bootstrap-3.3.4-dist/css/bootstrap.min.css" rel="stylesheet">
  <title>환불내역서</title>
  </head>
  <body>
    <h1><center>환불내역서</center></h1>

  <h3>1.계약업체</h3>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th scope="col" style='text-align: center; vertical-align : middle;'>법인명</th>
           <td colspan="1">(주)슈가힐</td>
        </tr>
      </thead>
      <thead>
        <tr>
          <th scope="col" style='text-align: center; vertical-align : middle;'>대표자명</th>
           <td colspan="1">이용일</td>
        </tr>
      </thead>
      <thead>
        <tr>
          <th scope="col" style='text-align: center; vertical-align : middle;'>사업자번호</th>
           <td colspan="1">661-87-00655</td>
        </tr>
      </thead>
      <thead>
        <tr>
          <th scope="col" style='text-align: center; vertical-align : middle;'>주소</th>
           <td colspan="1">서울특별시 강남구 강남대로 408,11층(역삼동,YBM강남센터)</td>
        </tr>
      </thead>
    </table>

    <h3>2.계약부동산</h3>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th scope="col" style='text-align: center; vertical-align : middle;'>부동산명</th>
           <td colspan="1"><?php echo $row['업체명']; ?></td>
        </tr>
      </thead>
      <thead>
        <tr>
          <th scope="col" style='text-align: center; vertical-align : middle;'>대표자명</th>
           <td colspan="1"><?php echo $row['대표자명']; ?></td>
        </tr>
      </thead>
      <thead>
        <tr>
          <th scope="col" style='text-align: center; vertical-align : middle;'>사업자번호</th>
           <td colspan="1"><?php echo $row['사업자등록번호']; ?></td>
        </tr>
      </thead>
      <thead>
        <tr>
          <th scope="col" style='text-align: center; vertical-align : middle;'>중개사번호</th>
           <td colspan="1"><?php echo $row['중개사등록번호']; ?></td>
        </tr>
      </thead>
      <thead>
        <tr>
          <th scope="col" style='text-align: center; vertical-align : middle;'>주소</th>
           <td colspan="1"><?php echo $row15['주소']; ?></td>
        </tr>
      </thead>
    </table>


    <h3>3.계약사항</h3>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th scope="col" style='text-align: center; vertical-align : middle;'>계약상품</th>
          <td colspan="5"><?php echo htmlspecialchars($rowproduct['product']).htmlspecialchars($row['상품']).htmlspecialchars($rowproduct2['product2']).' '.htmlspecialchars($row['상가사무실'])." [".date('n',strtotime($row['sdate']))."월 잔여(".number_format($row7['smp'])."원X".$row13['sprice']."일)+".($row9['middleM']+1)."개월(".htmlspecialchars(number_format($row3['정가']))."원"."X".($row9['middleM']+1).")]X입점할인".$output[1]."=".htmlspecialchars(number_format($row['금액']))."원"; ?></td>
        </tr>
      </thead>
      <thead>
        <tr>
          <th scope="col" style='text-align: center; vertical-align : middle;'>결제일</th>
          <td colspan="1"><p text align="right"><?php echo $row['결제일']; ?></p></td>
          <th scope="col" style='text-align: center; vertical-align : middle;'>결제방법</th>
          <td colspan="1"><p text align="right"><?php echo $row['결제방법']; ?></p></td>
          <th scope="col" style='text-align: center; vertical-align : middle;'>결제금액</th>
          <td colspan="1"><p text align="right"><?php echo (number_format($row['금액'])); ?>원</p></td>
        </tr>
      </thead>
      <thead>
        <tr>
          <th scope="col" style='text-align: center; vertical-align : middle;'>상품시작일</th>
          <td colspan="1"><p text align="right"><?php echo $row['sdate']; ?></p></td>
          <th scope="col" style='text-align: center; vertical-align : middle;'>상품종료일</th>
          <td colspan="1"><p text align="right"><?php echo $row['edate']; ?></p></td>
          <th scope="col" style='text-align: center; vertical-align : middle;'>상품기간</th>
          <td colspan="1"><p text align="right"><?php echo $row['등록기간']; ?>일</p></td>
        </tr>
      </thead>
      <thead>
        <tr>
          <th scope="col" style='text-align: center; vertical-align : middle;'>특약사항</th>
          <td colspan="5">해당사항 없음</td>

        </tr>
      </thead>
    </table>




    <h3>4.환불내역</h3>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th scope="col" style='text-align: center; vertical-align : middle;'>계약상품</th>
          <td colspan="5"><?php echo htmlspecialchars($rowproduct['product']).htmlspecialchars($row['상품']).htmlspecialchars($rowproduct2['product2']).' '.htmlspecialchars($row['상가사무실'])." [".date('n',strtotime($row['sdate']))."월 잔여(".number_format($row7['smp'])."원X".$row13['sprice']."일)+".($row9['middleM']+1)."개월(".htmlspecialchars(number_format($row3['정가']))."원"."X".($row9['middleM']+1).")]X입점할인".$output[1]."=".htmlspecialchars(number_format($row['금액']))."원";?></td>
        </tr>
      </thead>
      <thead>
        <tr>
          <th scope="col" style='text-align: center; vertical-align : middle;'>결제일</th>
          <td colspan="1"><?php echo $row['결제일']; ?></td>
          <th scope="col" style='text-align: center; vertical-align : middle;'>결제방법</th>
          <td colspan="1"><?php echo $row['결제방법']; ?></td>
          <th scope="col" style='text-align: center; vertical-align : middle;'>1개월 원가</th>
          <td colspan="1"><?php
          $realprice = "SELECT CASE
          when '".$row3['정가']."' = 0
              then '".$row['금액']."'
            else '".$row3['정가']."'
            end realprice
          ";
          $realpriceresult =  mysqli_query($conn,$realprice) or die(mysqli_error($conn));
          $row24 = mysqli_fetch_assoc($realpriceresult);



          echo (number_format($row24['realprice'])); ?>원</td>
        </tr>
      </thead>
      <thead>
        <tr>
          <th scope="col" style='text-align: center; vertical-align : middle;'>상품시작일</th>
          <td colspan="1"><?php echo $row['sdate']; ?></td>
          <th scope="col" style='text-align: center; vertical-align : middle;'>환불요청일</th>
          <td colspan="1"><?php echo $_GET['rdate']; ?></td>
          <th scope="col" style='text-align: center; vertical-align : middle;'>총 사용일자</th>
          <td colspan="1"><?php echo $row['사용일자']; ?>일</td>
        </tr>
      </thead>
      <thead>
        <tr>
          <th scope="col" style='text-align: center; vertical-align : middle;'>시작월 일할계산</th>
          <td colspan="1"><?php echo (number_format($row7['smp'])); ?>원</td>
          <th scope="col" style='text-align: center; vertical-align : middle;'>사용일자</th>
          <td colspan="1"><?php
          $sprice = "SELECT CASE
                      WHEN
                        DATE_FORMAT('".$row['sdate']."','%m') = DATE_FORMAT('".$_GET['rdate']."','%m')
                      THEN
                        '0'
                      ELSE
                        '".$row4['s']."'
                      END sprice
                        ";
          $result13 = mysqli_query($conn,$sprice) or die(mysqli_error($conn));
          $row13 = mysqli_fetch_assoc($result13);
          echo $row13['sprice']; ?>일</td>
          <th scope="col" style='text-align: center; vertical-align : middle;'>사용금액</th>
          <td colspan="1"><?php echo (number_format($row7['smp'] * $row13['sprice'])); ?>원</td>
        </tr>
      </thead>
      <thead>
        <tr>
          <th scope="col" style='text-align: center; vertical-align : middle;'>환불월 일할계산</th>
          <td colspan="1"><?php echo (number_format($row8['lmp'])); ?>원</td>
          <th scope="col" style='text-align: center; vertical-align : middle;'>사용일자</th>
          <td colspan="1"><?php echo $row5['e']; ?>일</td>
          <th scope="col" style='text-align: center; vertical-align : middle;'>사용금액</th>
          <td colspan="1"><?php echo (number_format($row8['lmp'] * $row5['e'])); ?>원</td>
        </tr>
      </thead>
      <thead>
        <tr>
          <th scope="col" style='text-align: center; vertical-align : middle;'>월정산개월</th>
          <td colspan="1"><?php echo $row9['middleM']; ?>개월</td>
          <th scope="col" style='text-align: center; vertical-align : middle;'>사용금액</th>
          <td colspan="1"><?php
            $uprice = "SELECT CASE
            	WHEN
            		DATE_FORMAT('".$row['sdate']."','%m') = DATE_FORMAT('".$_GET['rdate']."','%m')
            	THEN
            		(SELECT CASE
            				WHEN
            					('".$row['사용일자']."') < 8
            				THEN
            					('".$row['사용일자']."' * '".$row8['lmp']."')
            				ELSE
            					('".$row['사용일자']."' * '".$row8['lmp']."')
            				END)
            	ELSE
            		('".$row4['s']."' * '".$row7['smp']."') + ('".$row5['e']."' * '".$row8['lmp']."') + ('".$row3['정가']."'* '".$row9['middleM']."')
            	END as uprice";
            $result14 = mysqli_query($conn,$uprice) or die(mysqli_error($conn));
            $row14 = mysqli_fetch_assoc($result14);
            echo (number_format($row14['uprice']));
           ?>원</td>
          <th scope="col" style='text-align: center; vertical-align : middle;'>위약금</th>
          <td colspan="1"><?php
          $exitpay = "SELECT case
            when ('".$row['사용일자']."' < 8)
            then (select 0)
            else (select '".$row['금액']."' /10)
            end as exitpay";
            $resultexitpay = mysqli_query($conn,$exitpay) or die(mysqli_error($conn));
            $rowexitpay = mysqli_fetch_assoc($resultexitpay);
          echo (number_format($rowexitpay['exitpay'])); ?>원</td>
        </tr>
      </thead>
      <thead>
        <tr>
          <th scope="col" style='text-align: center; vertical-align : middle;'>공제금액</th>
          <td colspan="5"><p text align="right"><?php echo (number_format($row10['deduction'])); ?>원</p></td>
        </tr>
      </thead>
      <thead>
        <tr>
          <th scope="col" style='text-align: center; vertical-align : middle;'>환불금액</th>

          <td colspan="5"><p text align="right"><?php
          echo "<font color=red>";
          echo (number_format($row11['repund'])); ?>원</p></td>

        </tr>
      </thead>
      <thead>
        <tr>
          <th scope="col" style='text-align: center; vertical-align : middle;'>안내사항<p></th>
          <td colspan="5">
            </br>
            (1) 1개월 원가=계약 상품의 1개월 원가 금액.</br>
            (2) 시작월 일할계산=1개월 원가/시작월 총 일수.</br>
            (3) 환불월 일할계산=1개월 원가/환불월 총 일수.</br>
            (4) 월정산개월=일할계산 되지 않고 한 달을 모두 사용한 개월 수.</br>
            (5) 총사용금액=시작월 사용금액+환불월 사용금액+(월정산개월x1개월 결제 금액)</br>
            (6) 위약금=결제금액의 10%금액.</br>
            (7) 공제금액=사용금액+위약금.</br>
            (8) 일할계산=상품원가/상품 계약 기간.</br>
            </br>
           *환불방법</br>
            - 카드 결제 건의 경우 : 환불금액 부분 취소 처리.</br>
            - 계좌 이체 건의 경우 : 통장사본, 입금확인서 수취 후 환불금액 입금.</br>
            </br>
          </td>
        </tr>
      </thead>
    </table>
<div><center>
</br>
(주)슈가힐은 상기 부동산과의 환불내역이 틀림없음을 확인하였습니다.</br>
</br>
<?php
echo date("Y년m월d일");
 ?>
 <h3>(주) 슈 가 힐<img src="슈가힐직인.png"></h3>
</center></div>




</br>
</br>
</br>
</br>
</br>
</br>
<center><input type="button" value="인쇄하기 : 배율='맞춤설정' -> '60'" id="print" onclick="window.print()"/></center>
</br>
</br>
</br>
</br>
</br>
</br>
<table class="table table-bordered">
<thead>
  <tr>
    <th scope="col"><p text align="center"><center>기안 비고</br></br></br></br></br></br></center><p></th>
    <td colspan="5">
      <?php
#preg_match('~인(.*?)=~',$row['상세내역'],$output);
        echo '<h4>'.'1.계약상품:',htmlspecialchars($rowproduct['product']).htmlspecialchars($row['상품']).htmlspecialchars($rowproduct2['product2']).' '.htmlspecialchars($row['상가사무실'])." [".date('n',strtotime($row['sdate']))."월 잔여(".number_format($row7['smp'])."원X".$row13['sprice']."일)+".($row9['middleM']+1)."개월(".htmlspecialchars(number_format($row3['정가']))."원"."X".($row9['middleM']+1).")]X입점할인".$output[1]."=".htmlspecialchars(number_format($row['금액']))."원".'</h4>';
        echo '<h4>'.'2.환불상품:',htmlspecialchars($rowproduct['product']).htmlspecialchars($row['상품']).htmlspecialchars($rowproduct2['product2']).' '.htmlspecialchars($row['상가사무실'])." [".date('n',strtotime($row['sdate']))."월 잔여(".number_format($row7['smp'])."원X".$row13['sprice']."일)+".($row9['middleM']+1)."개월(".htmlspecialchars(number_format($row3['정가']))."원"."X".($row9['middleM']+1).")]X입점할인".$output[1]."=".htmlspecialchars(number_format($row['금액']))."원".'</h4>';
        echo '<h4>'.'3.상품원가:',htmlspecialchars($rowproduct['product']).htmlspecialchars($row['상품']).htmlspecialchars($rowproduct2['product2']).' '.htmlspecialchars(number_format($row3['정가']))."원".'</h4>';
        echo '<h4>'.'4.',date('n',strtotime($row['sdate'])).'월 일할계산:'.htmlspecialchars(number_format($row3['정가']))."원"."(원가)/".$row12['startday']."일(계약기간)=".number_format($row7['smp'])."원".'</h4>';
        echo '<h4>'.'5.',date('n',strtotime($row['sdate'])).'월 이용금액:'.number_format($row7['smp'])."원"."(".date('n',strtotime($row['sdate']))."월 일할금액)*".$row13['sprice']."일 =".(number_format($row7['smp'] * $row13['sprice']))."원".'</h4>';
        echo '<h4>'.'6.',date('n',strtotime($_GET['rdate'])).'월 일할계산:'.htmlspecialchars(number_format($row3['정가']))."원"."(원가)/".$row6['lastday']."일(계약기간)=".number_format($row8['lmp'])."원".'</h4>';
        echo '<h4>'.'7.',date('n',strtotime($_GET['rdate'])).'월 이용금액:'.number_format($row8['lmp'])."원"."(".date('n',strtotime($_GET['rdate']))."월 일할금액)*".$row5['e']."일 =".(number_format($row8['lmp'] * $row5['e']))."원".'</h4>';
        echo '<h4>'.'8.위약금:',number_format($rowexitpay['exitpay'])."원".'</h4>';
        echo '<h4>'.'9.공제금액:',number_format($row10['deduction'])."원(이용금액+위약금)".'</h4>';
        echo '<h4>'.'10.환불금액:',number_format($row11['repund'])."원".'</h4>';
        echo '<h4>'.'11.환불사유:','</h4>';
       ?>



    </td>
  </tr>
</thead>
</table>


<center><input type="button" value="이전페이지" onClick="history.go(-1)"></center>
</br>  <center><input type="button" value="HOME" onClick="location.href='index_backup.html'"></center>
</br>
</br>
</br>





  </body>
</html>
