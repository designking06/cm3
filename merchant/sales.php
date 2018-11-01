<?php
require 'inc/merchant.required.php';
//set page
$actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<?php
if(isset($_POST['neworder'])){
  //step 1: Customer registry
  $custemail = $_POST['custemail'];
  $compID = $_POST['compID'];
  $notes  = $_POST['notes'];
  $date = $_POST['date'];
  $o = 1;
  $order['$o'] = array(
    'orderid'=>$o,
    'custemail' => $custemail,
    'notes'=>$notes,
    'date' => $date,
  );
  //check db for existing email field, if found, grab id, if not found, insert new and get last id
  $custid = checkexistingemail($pdo,$custemail,$compID);
  //step 2: Order Registry
  //needed variables custid, date
  $orderid = insertneworder($pdo,$compID,$custid,$custemail,$notes,$date);
  //calculate product totals
  //calculate order total, insert each sold product and quantity into table products.purchased and order info into table sales
  $i = 1;
  $p = 1;
  if(empty($_POST['product'])){
    $product = NULL;
    $status = "fail";
    $alert = "Please Specify Which Products Were Purchased.";
    header('location:sales.php?status='.$status.'&alert='.$alert);
    exit;
  }
  else{
    //submitted product form array
    $product = $_POST['product'];
    $productecho = "";
    //start calculating order total
    $ordertotal = 0;
    foreach($product as $product=>$value){
      global $i;
        //grab purchased product quantity
        $productqty = $_POST[$value];
        //grab product info
        $order['$o']['product']['$i'] = array(
            'id'=>$value,
            'qty' => $productqty,
        );
        //insert product purchase info into db
        insertpurchasedproducts($pdo,$orderid,$value,$productqty);
        $productecho .= "Product ID: ".$order['$o']['product']['$i']['id']." Qty:".$order['$o']['product']['$i']['qty']."<br>";
        $i++;
        $p++;
    }//end foreach
  }//end else

  //successfully created sale, great job!
  $status = "success";
  $compecho = "Company: ".$compID."<br>";
  $orderidecho = "Order ID:".$orderid."<br>";
  $custemailecho = "Customer Email: ".$order['$o']['custemail']."<br>";
  $ordernotesecho = "Order Notes: ".$order['$o']['notes']."<br>";
  $orderdateecho = "Order Date: ".$date."<br>";
  header('location:salesstatus.php?status='.$status.'&comp='.$compecho.'&orderid='.$orderidecho.'&custemail='.$custemailecho.'&ordernotes='.$ordernotesecho.'&date='.$orderdateecho.'&products='.$productecho);
}
?>
<!--Retrieve Head info -->
<div id="body" class="w3-light-grey" style="max-width:100%;padding-bottom: 20px;">
  <!-- Navbar -->
  <?php getHeader(); ?>
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
                    <?php getusercompanyinfo($pdo,$_SESSION['compID']);?>
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
                    <th scope="col" colspan="1"></th>
                  </tr>
                  <tr class="thead-dark">
                    <th scope="col">First</th>
                    <th scope="col" class="w3-border-right">Last</th>
                    <th scope="col">Email</th>
                  </tr>
                <?php getcustomers($pdo,$_SESSION['compID']);?>
              </table>
                <div class="col-sm-12 w3-border-bottom">
                    crawley@email
                </div>

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
                <?php retrievesales($pdo,$_SESSION['compID']);?>
              </table>
            </div>
        </div>
    </div>
        <?php //echo $groupMember_Insert_Error; ?>
        <div class="container w3-white w3-card w3-padding">
              <button id="controller" class="btn w3-margin">
                <h2 class="w3-text-blue">New Sale</h2>
                <p>Touch To Start</p>
              </button>
            <div class="alert alert-warning">
              <p>
                <?php
                    if(isset($_GET['status'])){
                    switch($_GET['status']){
                      case "success":{?>
                        <?php echo $_GET['comp'];?><br>
                        <?php echo $_GET['orderid'];?><br>
                        <?php echo $_GET['custemail'];?><br>
                        <?php echo $_GET['products'];?><br>
                        <?php echo $_GET['ordernotes'];?><br>
                        <?php echo $_GET['date'];?><br>
                        <?php
                        break;
                      }
                      case "fail":{?>
                      <h4 class="w3-text-blue"><?php echo $_GET['alert'];?></h4>
                      <?php  break;
                      }
                    }
                  }else{
                    ?><p class="text-center">Check Here For Error Messages</p><?php
                  }
                ?>
          </div>
          <form id="panel" method="post">
                  <div class="w3-padding">
                    <h3>1. Customer</h3>
                    <div class="w3-margin">
                      <div class="w3-padding">
                        <button id="toggler" class="btn w3-green"><p class="">Enter Customer Email</p></button>
                        <div id="slider" class="w3-light-grey">
                          <input type="email" name="custemail" class="form-control" placeholder="New Customer's Email" value="" required>
                        </div>
                      </div>
                    </div>
                  </div>
                         <hr>
                    <h3>2. What Was Purchased?</h3>
                    <p>Check Products From List & Specify Quantity Sold</p>
                    <div class="dropdown">
                      <button class="btn btn-primary dropdown-toggle form-control" type="button" data-toggle="dropdown">Choose Product</button>
                      <ul class="dropdown-menu form-control row" style="height:150px;overflow-y:auto;">
                        <!-- select all company products from table -->
                          <!-- How will you keep track of how many of each were sold?-->
                          <li class="alert-danger w3-padding text-center">Make Sure To Check A Box and Specify Quantity</li>
                            <?php displayProductsInListWithCheckbox($pdo,$_SESSION['compID']);?>
                      </ul>
                    </div>
                    <br>
                    <h4>3. Notes</h4>
                    <textarea class="form-control" name="notes"></textarea><br>
                    <input type="hidden" name="date" value="<?php echo date('Y-m-d');?>">
                    <input type="hidden" name="compID" value="<?php echo $_SESSION['compID'];?>">
                    <input type="submit" name="neworder" value="Submit Sale" class="form-control w3-green">
                </form>
<?php getMtFooter();?>
