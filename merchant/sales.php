<?php
require 'inc/merchant.required.php';
if(!isset($_SESSION['uid'])){
  session_destroy();
  header('location:index.php');
  exit;
}
//set page
$actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<!--Retrieve Head info -->
<div id="body" class="w3-light-grey" style="max-width:100%;padding-bottom: 20px;">
  <!-- Navbar -->
  <?php getHeader("merchant"); ?>
  <!-- Navbar on small screens -->
  <!-- End Navbars -->
  <!-- Start Page Content -->
      <header class="" style="padding-top:40px;padding-bottom:50px;">
        <div class="container w3-white w3-card w3-padding">
              <div class="row text-center">
                  <div class="col-sm-12"><img src="../../media/images/ccaBlue.png" class="w3-image" style=""/></div>
              </div>
              <!-- Welcome user & display general company information -->
              <div class="row text-center">
                <div class="col-sm-12">
                    <?php if($_SESSION['permissions']['merchant']){getusercompanyinfo($pdo,$_SESSION['compID']);}?>
                </div>
              </div>
        </div>
      </header>
    <div class="container w3-card w3-white w3-padding">
        <div class="row">
            <div class="col-sm-6">
                <div class="col-sm-8 w3-cell"><h4>Customers</h4></div>
                <div class="col-sm-4 w3-cell"><button class="btn w3-small">New</button></div>
                <table class="table">
                  <tr class="thead-dark">
                    <th scope="col" colspan="2" class="w3-border-right">Name</th>
                  </tr>
                  <tr class="thead-dark">
                    <th scope="col">First</th>
                    <th scope="col" class="w3-border-right">Last</th>
                    <th scope="col">Email</th>
                    <th scope="col">Action</th>
                  </tr>
                <?php if($_SESSION['permissions']['merchant']){getcustomers($pdo,$_SESSION['compID']);}?>
              </table>
            </div>
            <div class="col-sm-6">
                <div class="col-sm-8 w3-cell"><h4>Sales</h4></div>
                <div class="col-sm-4 w3-cell"><button class="btn w3-small">New</button></div>
              <table class="table" style="width:100%;">
                <tr class="thead-dark">
                <th scope="col" class="">#</th>
                <th scope="col" class="w3-hide-small">Order ID</th>
                <th scope="col" class="">Email</th>
                <th scope="col" class="">Date</th>
                <th scope="col" class="">Action</th>
              </tr>
              <!-- Sales function, order by email & date -->
                <?php if($_SESSION['permissions']['merchant']){retrievesales($pdo,$_SESSION['compID']);}?>
              </table>
            </div>
        </div>
    </div>
        <?php //echo $groupMember_Insert_Error; ?>
        <div class="container w3-white w3-card w3-padding">
              <button id="" class="btn w3-margin" onclick="window.location.href='new.sale.php'">
                <h2 class="w3-text-blue">New Sale</h2>
                <p>Touch To Start</p>
              </button>
                <hr>
<?php getFooter("merchant");?>
