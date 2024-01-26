
  <table class="table table-bordered" id="tab">
    <thead ><tr>
      <th class="table-secondary" scope='col' style='text-align: center; vertical-align : middle;'></th>
      <th class="table-secondary" scope='col' style='text-align: center; vertical-align : middle;'>윤길상</th>
      <th class="table-secondary" scope='col' style='text-align: center; vertical-align : middle;'>윤서현</th>
      <th class="table-secondary" scope='col' style='text-align: center; vertical-align : middle;'>이수복</th>
      <th class="table-secondary" scope='col' style='text-align: center; vertical-align : middle;'>이서영</th>
      <th class="table-secondary" scope='col' style='text-align: center; vertical-align : middle;'>강부장</th>
      <th class="table-secondary" scope='col' style='text-align: center; vertical-align : middle;'>부산</th>
  </thead>
  <thead>
      <th class="table-secondary" scope='col' style='text-align: center; vertical-align : middle;'>연장업체수</th>
      <td colspan='1' style='text-align: center; vertical-align : middle;'><?php
      $countc = "SELECT count(distinct 업체아이디) countc from plist where `관리담당자`='윤길상' and date_format(edate,'%Y-%m') = '".$_GET['date']."' and 상품종료여부 <> '종료' and 환불여부 <>'취소' and 환불여부 <>'환불'";
                           $resultcountc = mysqli_query($conn,$countc); #or die(mysqli_error($conn));
                           $rowcountc = mysqli_fetch_array($resultcountc);
                           echo $rowcountc['countc'];
       ?></td>
      <td colspan='1' style='text-align: center; vertical-align : middle;'><?php
      $countc = "SELECT count(distinct 업체아이디) countc from plist where `관리담당자`='윤서현' and date_format(edate,'%Y-%m') = '".$_GET['date']."' and 상품종료여부 <> '종료' and 환불여부 <>'취소' and 환불여부 <>'환불'";
                           $resultcountc = mysqli_query($conn,$countc); #or die(mysqli_error($conn));
                           $rowcountc = mysqli_fetch_array($resultcountc);
                           echo $rowcountc['countc'];
       ?></td>
      <td colspan='1' style='text-align: center; vertical-align : middle;'><?php
      $countc = "SELECT count(distinct 업체아이디) countc from plist where `관리담당자`='이수복' and date_format(edate,'%Y-%m') = '".$_GET['date']."' and 상품종료여부 <> '종료' and 환불여부 <>'취소' and 환불여부 <>'환불'";
                           $resultcountc = mysqli_query($conn,$countc); #or die(mysqli_error($conn));
                           $rowcountc = mysqli_fetch_array($resultcountc);
                           echo $rowcountc['countc'];
       ?></td>
      <td colspan='1' style='text-align: center; vertical-align : middle;'><?php
      $countc = "SELECT count(distinct 업체아이디) countc from plist where `관리담당자`='이서영' and date_format(edate,'%Y-%m') = '".$_GET['date']."' and 상품종료여부 <> '종료' and 환불여부 <>'취소' and 환불여부 <>'환불'";
                           $resultcountc = mysqli_query($conn,$countc); #or die(mysqli_error($conn));
                           $rowcountc = mysqli_fetch_array($resultcountc);
                           echo $rowcountc['countc'];
       ?></td>
      <td colspan='1' style='text-align: center; vertical-align : middle;'><?php
      $countc = "SELECT count(distinct 업체아이디) countc from plist where (`관리담당자`='이민성' or `관리담당자`='김윤석') and date_format(edate,'%Y-%m') = '".$_GET['date']."' and 상품종료여부 <> '종료' and 환불여부 <>'취소' and 환불여부 <>'환불'";
                           $resultcountc = mysqli_query($conn,$countc); #or die(mysqli_error($conn));
                           $rowcountc = mysqli_fetch_array($resultcountc);
                           echo $rowcountc['countc'];
       ?></td>
      <td colspan='1' style='text-align: center; vertical-align : middle;'><?php
      $countc = "SELECT count(distinct 업체아이디) countc from plist where `관리담당자`='슈가힐 부산' and date_format(edate,'%Y-%m') = '".$_GET['date']."' and 상품종료여부 <> '종료' and 환불여부 <>'취소' and 환불여부 <>'환불'";
                           $resultcountc = mysqli_query($conn,$countc); #or die(mysqli_error($conn));
                           $rowcountc = mysqli_fetch_array($resultcountc);
                           echo $rowcountc['countc'];
      ?></td>
</thead>
<thead>
    <th class="table-secondary" scope='col' style='text-align: center; vertical-align : middle;'>잔여업체수</th>
    <td colspan='1' style='text-align: center; vertical-align : middle;'><?php
    $remain = "SELECT count(distinct(업체아이디)) as remain from plist A
    left join company_info B
    on A.num = B.num
    where B.연장여부 = '대기' and A.관리담당자 = '윤길상' and date_format(edate,'%Y-%m') = '".$_GET['date']."' and 환불여부 <> '환불' and 환불여부 <> '취소' and 상품종료여부 <> '종료'
    ";
    $resultremain = mysqli_query($conn,$remain) or die(mysqli_error($conn));
    $rowremain = mysqli_fetch_assoc($resultremain);
    echo $rowremain['remain'];
      ?></td>
    <td colspan='1' style='text-align: center; vertical-align : middle;'><?php
    $remain = "SELECT count(distinct(업체아이디)) as remain from plist A
    left join company_info B
    on A.num = B.num
    where B.연장여부 = '대기' and A.관리담당자 = '윤서현' and date_format(edate,'%Y-%m') = '".$_GET['date']."' and 환불여부 <> '환불' and 환불여부 <> '취소' and 상품종료여부 <> '종료'
    ";
    $resultremain = mysqli_query($conn,$remain) or die(mysqli_error($conn));
    $rowremain = mysqli_fetch_assoc($resultremain);
    echo $rowremain['remain'];
        ?></td>
    <td colspan='1' style='text-align: center; vertical-align : middle;'><?php
    $remain = "SELECT count(distinct(업체아이디)) as remain from plist A
    left join company_info B
    on A.num = B.num
    where B.연장여부 = '대기' and A.관리담당자 = '이수복' and date_format(edate,'%Y-%m') = '".$_GET['date']."' and 환불여부 <> '환불' and 환불여부 <> '취소' and 상품종료여부 <> '종료'
    ";
    $resultremain = mysqli_query($conn,$remain) or die(mysqli_error($conn));
    $rowremain = mysqli_fetch_assoc($resultremain);
    echo $rowremain['remain'];
       ?></td>
    <td colspan='1' style='text-align: center; vertical-align : middle;'><?php
    $remain = "SELECT count(distinct(업체아이디)) as remain from plist A
    left join company_info B
    on A.num = B.num
    where B.연장여부 = '대기' and A.관리담당자 = '이서영' and date_format(edate,'%Y-%m') = '".$_GET['date']."' and 환불여부 <> '환불' and 환불여부 <> '취소' and 상품종료여부 <> '종료'
    ";
    $resultremain = mysqli_query($conn,$remain) or die(mysqli_error($conn));
    $rowremain = mysqli_fetch_assoc($resultremain);
    echo $rowremain['remain'];
      ?></td>
    <td colspan='1' style='text-align: center; vertical-align : middle;'>-</td>
    <td colspan='1' style='text-align: center; vertical-align : middle;'>-</td>
</thead>
<thead>



<th class="table-secondary" scope='col' style='text-align: center; vertical-align : middle;'>전월결제금액</th>
<td colspan='1' style='text-align: center; vertical-align : middle;'><?php
$string22 = $_GET['date'];
$string222 = substr($string22,-2);
$allcost = "SELECT sum(금액)-sum(환불금액) as allcost
from plist
where `관리담당자` = '윤길상' and month(edate) = $string222 ";
  $resultalcost = mysqli_query($conn,$allcost) or die(mysqli_error($conn));
$rowallcost = mysqli_fetch_assoc($resultalcost);
echo number_format($rowallcost['allcost']);
  ?></td>
  <td colspan='1' style='text-align: center; vertical-align : middle;'><?php
  $string22 = $_GET['date'];
  $string222 = substr($string22,-2);
  $allcost = "SELECT sum(금액)-sum(환불금액) as allcost
  from plist
  where `관리담당자` = '윤서현' and month(edate) = $string222 ";
    $resultalcost = mysqli_query($conn,$allcost) or die(mysqli_error($conn));
  $rowallcost = mysqli_fetch_assoc($resultalcost);
  echo number_format($rowallcost['allcost']);
    ?></td>
    <td colspan='1' style='text-align: center; vertical-align : middle;'><?php
    $string22 = $_GET['date'];
    $string222 = substr($string22,-2);
    $allcost = "SELECT sum(금액)-sum(환불금액) as allcost
    from plist
    where `관리담당자` = '이수복' and month(edate) = $string222 ";
      $resultalcost = mysqli_query($conn,$allcost) or die(mysqli_error($conn));
    $rowallcost = mysqli_fetch_assoc($resultalcost);
    echo number_format($rowallcost['allcost']);
      ?></td>
      <td colspan='1' style='text-align: center; vertical-align : middle;'><?php
      $string22 = $_GET['date'];
      $string222 = substr($string22,-2);
      $allcost = "SELECT sum(금액)-sum(환불금액) as allcost
      from plist
      where `관리담당자` = '이서영' and month(edate) = $string222 ";
        $resultalcost = mysqli_query($conn,$allcost) or die(mysqli_error($conn));
      $rowallcost = mysqli_fetch_assoc($resultalcost);
      echo number_format($rowallcost['allcost']);
        ?></td>
        <td colspan='1' style='text-align: center; vertical-align : middle;'><?php
        $string22 = $_GET['date'];
        $string222 = substr($string22,-2);
        $allcost = "SELECT sum(금액)-sum(환불금액) as allcost
        from plist
        where (`관리담당자` = '김윤석' or `관리담당자` = '이민성') and month(edate) = $string222 ";
          $resultalcost = mysqli_query($conn,$allcost) or die(mysqli_error($conn));
        $rowallcost = mysqli_fetch_assoc($resultalcost);
        echo number_format($rowallcost['allcost']);
          ?></td>
          <td colspan='1' style='text-align: center; vertical-align : middle;'><?php
          $string22 = $_GET['date'];
          $string222 = substr($string22,-2);
          $allcost = "SELECT sum(금액)-sum(환불금액) as allcost
          from plist
          where `관리담당자` = '슈가힐 부산' and month(edate) = $string222 ";
            $resultalcost = mysqli_query($conn,$allcost) or die(mysqli_error($conn));
          $rowallcost = mysqli_fetch_assoc($resultalcost);
          echo number_format($rowallcost['allcost']);
            ?></td>
            </thead>
<thead>
<th class="table-secondary" scope='col' style='text-align: center; vertical-align : middle;'>당월결제금액</th>
<td colspan='1' style='text-align: center; vertical-align : middle;'><?php

 ?></td>
</thead>





  </table>


    </tr>
  </thead>
