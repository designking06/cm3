<?php
session_start();
include_once('../inc/pdo.php');
$output = NULL;

//check form
if(isset($_SESSION['loggedin'])){
       header("Location: admin.php");
    }
if(isset($_POST['logSub'])){

    $uid = $_POST['uid'];
    $pwd = $_POST['pwd'];

    if(empty($uid) OR empty($pwd)){
        $output = "Fill in both fields, then submit.";
    }else{

        $uid = $pdo->real_escape_string($uid);
        $pwd = $pdo->real_escape_string($pwd);
        $stmt = "SELECT * FROM users WHERE uid = ?";
        $select = $pdo->prepare($stmt);
        $select->execute([$uid]);
        if($select->rowCount() == 0){
            $output = "Invalid username/password.";
        }elseif($select->rowCount() > 0){
            while($row = $query->fetch_assoc()){
            //successful login
            $check = $row["pwd"];
            }
        $verify = password_verify($pwd,$check);
        if($verify == TRUE){
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['user'] = $uid;
            $_SESSION['pass'] = $row["pwd"];
            header("location: admin.php");
        }}else {
            //unsuccessful login
            $output = "wrong username/password.";
        }}}?>

<html>
<head>
<link rel="stylesheet" href="css/new_w3.css">
<link rel="stylesheet" href="css/bootstrap336.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<meta name="viewport" content="width=device-width, initial-scale= 1">
</head>
    <style>
    #grad {
background-color: ghostwhite;
background-repeat: no-repeat;
        }
    </style>
<body id="grad">

<?php
//Log In Script
if(!isset($_SESSION['loggedin'])){
?>
<!-- HEADER -->
    <header>
        <table class="container-fluid align-center"  style="width:100%;margin-top:20px;">
        <tr style="height: 110px;">
            <td class="col-sm-12  text-center"><img id="#ccaLogo" src="images/CCAwg.svg" class="w3-image" style="height: 90px;"/></td>
        </tr>
        </table>
        </header>
    <div id="body" class="container-fluid" style="width: 100%;padding-bottom: 20px;">
    <div class="row" style="text-align: center; padding-top: 30px;">
        <h2 class="w3-jumbo w3-text-blue">Welcome</h2><h3 class="w3-text-grey">Please sign in.</h3>
    </div>
<!-- END HEADER -->
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-4">
                <div class="w3-white w3-border w3-border-blue w3-opacity" style="min-height:210px;">
                    <h3 class="w3-padding text-left">
                        The revolutionary management app, created to help anyone faced with making decisions.<br>Take advantage of our statistics capabilities, storage space, customer service, client management and more.
                    </h3>
                </div>
            </div>
            <div class="col-sm-6">
<!-- LOGIN -->
                <div id="form" style="text-align: center; margin-left: 4%; margin-right: 4%; padding-top: 40px;">
<!-- LOGIN HERE -->
                          <div class="col-sm-9">

                              <form method="POST">
                                      <div class="input-group">
                                               <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                                <input id="uid" type="text" class="form-control" name="uid">

                                      </div>
                                      <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                                <input id="password" type="password" class="form-control" name="pwd" placeholder="Password">
                                      </div>
    <br>
                                      <div class="input-group">
                                               <input id="loginSubmit" type="submit" class="form-control" name="logSub" placeholder="Enter">
                                      </div>
                              </form>
                                  <div class="row">
                                      <div class="col-sm-4"></div><!-- div class="col-sm-4"><a href="CCA_register.php"><button class="w3-btn w3-grey">Register</button></a></div-->
                                      <div class="col-sm-4"></div>
                                  </div>
                        </div>
<!-- END LOGIN HERE -->
                            <div class="col-sm-3"></div>
                </div>

<!-- END LOGIN -->
            </div>
        </div>
<?php } ?>

<div class="w3-text-red"><?php echo $output; ?></div>
</div></body></html>
