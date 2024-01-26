<?php #등록기간
  require("config/config.php");
  require("lib/db.php");
  $conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);

  require("db_customer2.php");
    require("db_customer3.php");
?>


<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" >
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <link rel="stylesheet" type="text/css" href="style.css">

  <!--<link href="bootstrap-3.3.4-dist/css/bootstrap.min.css" rel="stylesheet">-->

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>





  <title>당월 재결제 대상</title>
  </head>
  <body>





</br></br>
  <h1><center>재결제 대상업체 리스트</center></h1>

  <h3><?php echo $_GET['date']."/".$_GET['name']; ?> 당월 재결제 대상</h3>


<!--검색기능 -->

<div style="width: 500px;" class="shadow p-3 mb-5 bg-body rounded" >


<form method="get" action="" role="form" class="form-inline">



<div class="input-group">

<a href="repayment2.php?name=<?php echo $_GET['name'];?>&date=<?php echo $_GET['date'] ?>" class="btn btn-dark">전체</a>

    <select name='status'>
    <option value="대기">대기</option>
    <option value="연장">연장</option>
    <option value="미연장">미연장</option>


    <input class="form-control" type="text" id="Keyword" name="Keyword" placeholder="대표자명 검색" value="">
      <div class="input-group-btn">
        <button type="submit" class="btn btn-primary">검색</button>
      </div>
    <input type = 'hidden' value = <?php echo $_GET['name'] ?> name = 'name'/>
    <input type = 'hidden' value = <?php echo $_GET['date'] ?> name = 'date'/>
  </div>
</form>
</div>













<!-- ↓카니형 이거 복사! ↓ -->

<div style="width: 3500px;">


          <table class="table table-bordered" id="tab">
            <thead ><tr>
              <th class="table-secondary" scope='col' style='text-align: center; vertical-align : middle;'>당월 업체수</th>
              <td colspan='1' style='text-align: center; vertical-align : middle;'><?php $countc = "SELECT count(distinct 업체아이디) countc from plist where `관리담당자`='".$_GET['name']."' and date_format(edate,'%Y-%m') = '".$_GET['date']."'  and 환불여부 <>'취소' and 환불여부 <>'환불'";
                                    $resultcountc = mysqli_query($conn,$countc); #or die(mysqli_error($conn));
                                    $rowcountc = mysqli_fetch_array($resultcountc);
                                    echo $rowcountc['countc'];?></td>
              <th class="table-secondary" scope='col' style='text-align: center; vertical-align : middle;'>당월 상품수</th>
              <td colspan='1' style='text-align: center; vertical-align : middle;'><?php $countp = "SELECT count(업체아이디) countp from plist where `관리담당자`='".$_GET['name']."' and date_format(edate,'%Y-%m') = '".$_GET['date']."'  and 환불여부 <>'취소' and 환불여부 <>'환불'";
                                    $resultcountp = mysqli_query($conn,$countp); #or die(mysqli_error($conn));
                                    $rowcountp = mysqli_fetch_array($resultcountp);
                                    echo $rowcountp['countp'];?></td>
              <th  class="table-secondary" scope='col' style='text-align: center; vertical-align : middle;'>잔여 업체수</th>
              <td colspan='1' style='text-align: center; vertical-align : middle;'><?php echo $rowremain['remain'];?></td>






            </tr>
          </thead>

            <thead><tr class="table-secondary">
            <td scope='col' style="text-align: center;"> </td>

            <th scope='col' style="text-align: center;">업체명</th>
            <td colspan='1' style="text-align: center;">대표자명</td>
            <td colspan='1' style="text-align: center;">지역<시/도></td>
            <td colspan='1' style="text-align: center;">지역<시/군/구></td>

            <td colspan='1' style="text-align: center;">상품</td>

            <td colspan='1' style="text-align: center;">상가사무실</td>



            <td colspan='1' style="text-align: center;">연장대상금액</td>

            <td colspan='1' style="text-align: center;">상품정가</td>
            <td colspan='1' style="text-align: center;">직전할인율</td>
            <td colspan='1' style="text-align: center;">이전결제금액</td>
            <td colspan='1' style="text-align: center;">결제방법</td>

            <td colspan='1' style="text-align: center;">시작일</td>
            <td colspan='1' style="text-align: center;">종료일</td>
            <td colspan='1' style="text-align: center;">프로모션건수</td>
            <td colspan='1' style="text-align: center;">상품구분</td>

            <td colspan='1' style="text-align: center;">상품번호</td>
            <td colspan='1' style="text-align: center;">상품등록메모</td>

            <td colspan='0' style="text-align: center;">상품상태</td>


          </tr></thead>


          <?php

$sum = 0;
$sum2 = 0;

           while($row = mysqli_fetch_array($result)){

            #정가검색A.`지역시` = NEW.`시`
            $price = "SELECT CASE
              WHEN (상품구분='일반') and (`업체 읍/면/동` = '오산동' or `업체 읍/면/동` = '영천동' or`업체 읍/면/동` = '석우동')
                THEN 215000 *	(상품-프로모션건수+서비스건수) / 10

            	WHEN 상품구분 = '일반'
            		THEN
            		(select
            			(select B.가격 `일반정가` from plist A
            			inner join
            			product_nomal B
            			on A.지역 = B.구
            			where num ='".$row['num']."' and A.지역시 = B.시 limit 1 )*
            			(상품-프로모션건수+서비스건수) / 10
            			from plist where num ='".$row['num']."' )

              WHEN 상품구분 = '레드프리미엄'
                  								THEN
                  								(SELECT SUM(`가격`) `프리미엄정가` FROM plist A
                              			INNER JOIN
                              			(SELECT B.`지역`,B.`시`, x.* FROM red_p B CROSS JOIN LATERAL (
                              			SELECT '상가+사무실', `상가사무실`
                              			union all select '상가',`상가`
                              			union all select '사무실',`사무실`
                              			) as x (상품, 가격)) NEW
                              			ON A.`상품` = NEW.`지역` and A.상가사무실 = NEW.상품 AND A.지역시 = NEW.시
                              			WHERE A.num='".$row['num']."' )


                  									WHEN 상품구분 = '레드추천'
                  								THEN
                  								(SELECT SUM(`가격`) `프리미엄정가` FROM plist A
                              			INNER JOIN
                              			(SELECT B.`지역`,B.`시`, x.* FROM red_good B CROSS JOIN LATERAL (
                              			SELECT '상가+사무실', `상가사무실`
                              			union all select '상가',`상가`
                              			union all select '사무실',`사무실`
                              			) as x (상품, 가격)) NEW
                              			ON A.`상품` = NEW.`지역` and A.상가사무실 = NEW.상품 AND A.지역시 = NEW.시
                              			WHERE A.num='".$row['num']."' )

            ELSE
            			(SELECT SUM(`가격`) `프리미엄정가` FROM plist A
            			INNER JOIN
            			(SELECT B.`지역`,B.`코드`, x.* FROM product_premium B CROSS JOIN LATERAL (
            			SELECT '상가+사무실', `상가사무실`
            			union all select '상가',`상가`
            			union all select '사무실',`사무실`
            			) as x (상품, 가격)) NEW
            			ON A.`상품` = NEW.`지역` and A.상가사무실 = NEW.상품 and A.`동코드` = NEW.`코드`
                  or A.`상품` = NEW.`지역` and A.상가사무실 = NEW.상품 and A.`지하철코드` = NEW.`코드`
            			WHERE A.num='".$row['num']."' )
            END AS `정가`
            					FROM plist
            					WHERE num ='".$row['num']."'";
            $result3 = mysqli_query($conn,$price);# or die(mysqli_error($conn));
            $row3 = mysqli_fetch_assoc($result3);
            #echo $row3['정가'];

            $ab4 = "SELECT 상세내역 FROM plist where num='".$row['num']."'";
            $resultab4 = mysqli_query($conn,$ab4) or die(mysqli_error($conn));
            $rowab4 = mysqli_fetch_assoc($resultab4);


            preg_match('~입점할인(.*?)%~',$rowab4['상세내역'],$output);
          #echo $output;

$ab6 = "SELECT

'".$output[1]."'
 as ab6";
$resultab6 = mysqli_query($conn,$ab6) or die(mysqli_error($conn));
$rowab6 = mysqli_fetch_assoc($resultab6);



  $ab5 = "SELECT CASE
  WHEN (select 상품구분 from plist where num = '".$row['num']."') = '일반'
  THEN truncate(truncate('".$row3['정가']."'/'".$row7['nextmonthdays']."',0)*'".$row7['nextmonthdays']."'*(1-('".$output[1]."'/100)),-1)
  ELSE (SELECT truncate(truncate('".$row3['정가']."'/'".$row7['nextmonthdays']."',0)*'".$row7['nextmonthdays']."'*(1-('".$output[1]."'/100)),-1))
  end as ab5 ";
  $resultab5 = mysqli_query($conn,$ab5) or die(mysqli_error($conn));
  $rowab5 = mysqli_fetch_assoc($resultab5);

  $sum= $sum + $rowab5['ab5'];


  $ab55 = "SELECT CASE
  WHEN (select 연장예상 from company_info where num = '".$row['num']."') = '상'
  THEN '".$rowab5['ab5']."' * 0.9
  WHEN (select 연장예상 from company_info where num = '".$row['num']."') = '중'
  THEN '".$rowab5['ab5']."' * 0.75
  WHEN (select 연장예상 from company_info where num = '".$row['num']."') = '하'
  THEN '".$rowab5['ab5']."' * 0.5
  ELSE '".$rowab5['ab5']."' * 0.9
  end as ab55 ";
  $resultab55 = mysqli_query($conn,$ab55) or die(mysqli_error($conn));
  $rowab55 = mysqli_fetch_assoc($resultab55);

  $sum2 = $sum2 + $rowab55['ab55'];






  $status2 = "SELECT 연장여부,이탈사유,연장예상 from company_info where num = '".$row['num']."'";
  $resultstatus2 = mysqli_query($conn,$status2) or die(mysqli_error($conn));
  $rowstatus2 = mysqli_fetch_assoc($resultstatus2);

          echo "<thead  style='text-align: center; vertical-align : middle;'>"."<tr>".
          "<td colspan='1' width='105' ><a href='https://admin.nemoapp.kr/Agent?agentId=".$row['업체아이디']."' target='_blank'><button type='button' class='btn btn-secondary btn-sm' style='font-size:10px;'>Admin</button></a></td>".

          "<th scope='col' width='300' ><a href='repayment2_kang.php?status=대기&Keyword=".$row['대표자명']."&name=".$_GET['name']."&date=".$_GET['date']."' >".$row['업체명']."</a>"."</th>".
          "<th scope='col' width='150' >".$row['대표자명']."</th>".

          #"<td colspan='1'>".$row['대표자명']."</td>".
          "<td colspan='1' width='150' >".$row['지역시']."</td>".
          "<td colspan='1' width='150' >".$row['지역']."</td>".

          "<td colspan='1' width='150' >".$row['상품']."</td>".

          "<td colspan='1' width='150' >".$row['상가사무실']."</td>".



          "<th scope='col' width='150' >".number_format($rowab5['ab5'])."원"."</th>".

          "<td colspan='1' style='background-color:#CEF6F5' width='150' >".number_format($row3['정가'])."원"."</td>".
          "<td colspan='1' style='background-color:#CEF6F5' width='150' >".$output[1]."%"."</td>".
          "<td colspan='1' style='background-color:#CEF6F5' width='150' >".number_format($row['금액'])."원"."</td>".
          "<td colspan='1' style='background-color:#CEF6F5' width='150' >".$row['결제방법']."</td>".

          "<td colspan='1' style='background-color:#CEF6F5' width='150' >".$row['sdate']."</td>".
          "<td colspan='1' style='background-color:#CEF6F5' width='150' >".$row['edate']."</td>".
          "<td colspan='1' style='background-color:#CEF6F5' width='150' >".$row['프로모션건수']."</td>".
          "<td colspan='1' style='background-color:#CEF6F5' width='200' >";

          if ($row['상품구분'] == '일반')
            {echo "<button type='button' class='btn btn-info pe-none'>일반</button>";}
          elseif ($row['상품구분'] == '동')
            {echo "<button type='button' class='btn btn-success pe-none'>동</button>";}
          elseif ($row['상품구분'] == '지하철')
            {echo "<button type='button' class='btn btn-primary pe-none'>지하철</button>";}
          elseif ($row['상품구분'] == '레드프리미엄')
            {echo "<button type='button' class='btn btn-danger pe-none'>레드프리미엄</button>";}
          else
            {echo "<button type='button' class='btn btn-warning pe-none'>레드추천</button>";}

          echo




          "</td>".
  "<td colspan='1' style='background-color:#CEF6F5' width='150' >".$row['num']."</td>".
          "<td colspan='1' style='background-color:#CEF6F5' width='120'>".
          "<form method='get' class='form-group' action='repayment_memo.php'>
            <input type = hidden value ='" .$row['업체명'].  "'name = 'cname'/>
            <input type = hidden value ='" .$row['업체아이디'].  "'name = 'agentId'/>
            <input type = hidden value ='" .$row['대표자명'].  "'name = 'name'/>
            <input type = hidden value ='" .$row3['정가'].  "'name = 'cp'/>
            <input type = hidden value ='" .$row7['nextmonthdays'].  "'name = 'days'/>
            <input type = hidden value ='" .$row['상품'].  "'name = 'product'/>
            <input type = hidden value ='" .$row['상가사무실'].  "'name = 'option'/>
            <input type = hidden value ='" .$rowab6['ab6'].  "'name = 'discount'/>
            <input type = hidden value ='" .number_format($rowab5['ab5']).  "'name = 'ab5'/>
            <input type = hidden value ='" .$_GET['date'].  "'name = 'date'/>

              <button type='submit' class='btn btn-primary'/>메모</button>
            </form>".



"<td colspan='1' style='background-color:#CEF6F5' width='150' >".$row['신규/재결제']."</td>".




          "</tr>"."</thead>";}


           ?>
           <td colspan='6' style='text-align: center; vertical-align : middle;'>국민은행 794001-04-145537 (주)슈가힐</td>
           <th class="table-secondary" scope='col' style='text-align: center; vertical-align : middle;'>총 연장금액</th>
           <td colspan='1' style='text-align: center; vertical-align : middle;'><?php echo number_format($sum) ?>원</td>




          </form>




          </td>

           </tr></thead>

          </table>

</div>


  <center><input type="button" value="이전페이지" onClick="history.go(-1)"></center>

</br>  <center><input type="button" value="HOME" onClick="location.href='index_backup.html'"></center>



  </body>
</html>
