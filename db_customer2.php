<?php

#$ab = "SELECT num,결제일,상품,상품구분,상가사무실,금액,업체명,대표자명,지역시,지역,sdate,edate,상세내역,관리담당자,프로모션건수,업체아이디
#FROM plist where if('".$_GET['Keyword']."' = '',`관리담당자`='".$_GET['name']."' and date_format(edate,'%Y-%m') = '".$_GET['date']."' and 상품종료여부 <> '종료' and 환불여부 <>'취소' and 환불여부 <>'환불',
#대표자명 = '".$_GET['Keyword']."' and `관리담당자`='".$_GET['name']."' and date_format(edate,'%Y-%m') = '".$_GET['date']."' and 상품종료여부 <> '종료' and 환불여부 <>'취소' and 환불여부 <>'환불')
#ORDER BY 대표자명 asc
#";


$ab = "SELECT A.*,B.연장여부
FROM plist A
left join company_info B
on A.num = B.num
where if('".$_GET['Keyword']."' = '' and '".$_GET['status']."' = '', `관리담당자`='".$_GET['name']."' and date_format(edate,'%Y-%m') = '".$_GET['date']."'  and 환불여부 <>'취소' and 환불여부 <>'환불',
if('".$_GET['Keyword']."' = '',
연장여부 = '".$_GET['status']."'  and `관리담당자`='".$_GET['name']."' and date_format(edate,'%Y-%m') = '".$_GET['date']."'  and 환불여부 <>'취소' and 환불여부 <>'환불',
연장여부 = '".$_GET['status']."' and 대표자명 = '".$_GET['Keyword']."' and `관리담당자`='".$_GET['name']."' and date_format(edate,'%Y-%m') = '".$_GET['date']."' and 환불여부 <>'취소' and 환불여부 <>'환불'
))
ORDER BY 대표자명 asc
";




$result = mysqli_query($conn,$ab); #or die(mysqli_error($conn));
#$row4 = mysqli_fetch_assoc($result4);

#1달 더하기
$nextmonth = "SELECT DATE_ADD('".$_GET['date']."''-01', INTERVAL 1 MONTH) as nextmonth";
$result6 = mysqli_query($conn,$nextmonth) or die(mysqli_error($conn));
$row6 = mysqli_fetch_assoc($result6);
#echo $row6['nextmonth'];

#1달후 마지막일
$nextmonthdays = "SELECT date_format(last_day('".$row6['nextmonth']."'),'%d') as nextmonthdays";
$result7 = mysqli_query($conn,$nextmonthdays) or die(mysqli_error($conn));
$row7 = mysqli_fetch_assoc($result7);
#echo $row7['nextmonthdays'];


$remain = "SELECT count(distinct(업체아이디)) as remain from plist A
left join company_info B
on A.num = B.num
where B.연장여부 = '대기' and A.관리담당자 = '".$_GET['name']."' and date_format(edate,'%Y-%m') = '".$_GET['date']."' and 환불여부 <> '환불' and 환불여부 <> '취소' ";
$resultremain = mysqli_query($conn,$remain) or die(mysqli_error($conn));
$rowremain = mysqli_fetch_assoc($resultremain);





?>
