<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x"
      crossorigin="anonymous"
    />
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
      crossorigin="anonymous"
    ></script>

    <!-- JavaScript to change iframe src -->
    <script>
      function changeIframeSrc(src) {
        document.getElementById("iframe-container").src = src;
      }
    </script>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


<style>
.material-symbols-outlined {
  font-variation-settings:
  'FILL' 0,
  'wght' 400,
  'GRAD' 0,
  'opsz' 24
}

.nav-link{
  color: #000 !important;
}

</style>



  </head>

  <body>
  <div class="container-fluid border-bottom" style="height:70px;">
  <a href="main.php">
  <img width="100px" src="logo.png" class="rounded float-start"></a>
  <a>CRM.. beta version 1.03 / 2024-01-05</a>
  <center><h1 class="red">Platform Sales</h1></center>
  </div>



    <div class="container-fluid">
      <div class="row d-flex align-items-stretch">
        <div
          class="col-md-1 bg-light border-end"
          style="padding-right: 0px; padding-left: 0px; "
        >
          <ul class="nav flex-column"></br>
            <a style="padding-left: 20px;">신규영업관리</a>
            
            <li class="nav-item">
              <a class="nav-link" href="javascript:void(0);" onclick="changeIframeSrc('dashboard_all.php');"> <i class="material-icons">bar_chart</i><span>&nbsp;대쉬보드</span></a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="javascript:void(0);" onclick="changeIframeSrc('crm_summary.php');"> <i class="material-icons">event</i><span>&nbsp;CRM</span></a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="javascript:void(0);" onclick="changeIframeSrc('sms_page.html');"> <i class="material-icons">sms</i><span>&nbsp;SMS List</span></a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="javascript:void(0);" onclick="changeIframeSrc('agent_page.html');"> <i class="material-icons">account_circle</i><span>&nbsp;AGENT</span></a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="javascript:void(0);" onclick="changeIframeSrc('price_list.html');"><i class="material-icons">calculate</i><span>&nbsp;상품금액계산기</span></a>
            </li>

            <hr width="80%" />
            <a style="padding-left: 20px;">중개업소 관리</a>
            <li class="nav-item">
              <a class="nav-link" href="javascript:void(0);" onclick="changeIframeSrc('repayment.html');"><i class="material-icons">calendar_month</i><span>&nbsp;당월재결제 리스트</span></a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="javascript:void(0);" onclick="changeIframeSrc('admin_customer.html');"><i class="material-icons">person</i><span>&nbsp;가입업체 리스트</span></a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="javascript:void(0);" onclick="changeIframeSrc('refund.html');"><i class="material-icons">paid</i><span>&nbsp;환불금액조회</span></a>
            </li>

            <!-- Add more navigation items as needed -->
          </ul>
        </div>

        <div
          class="col-md-11 bg-danger"
          style="position: -webkit-sticky; position: sticky; top: 0; padding-left: 0px; padding-right: 0px;"
        >
          <div id="content-container" style="padding-left: 0px; padding-right: 0px;">
            <iframe
              id="iframe-container"
              class="container-fluid"
              src="dashboard_all.php"
              style="padding-left: 0px; padding-right: 0px; width: 100%; height: 100vh; overflow: auto;"
            ></iframe>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
