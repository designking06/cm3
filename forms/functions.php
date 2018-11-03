<?php
//functions

//user & company functions
function getusercompany(PDO $pdo,$uid){
        ?>
        <div class="container w3-card w3-white">
            <div class="row">
                <div class="col-sm-12 text-center"><h2>Choose Your Company</h2></div>
                <div class="col-sm-12 text-center">
                <?php
                //grab company info
                $stmt = $pdo->prepare("SELECT * FROM companies WHERE uid = ?");
                $stmt->execute([$uid]);
                foreach($stmt as $comp){
                  ?>
                    <div id="<?php echo $comp['CompID'];?>">
                           <a href="dash.php?compID=<?php echo $comp['CompID'];?>"><div class="w3-margin w3-padding">
                             <h4 class="w3-text-lightgrey"><?php echo $comp['CompName'];?></h4>
                           </div>
                        </a>
                    </div><hr>
                <?php }?>
              </div>
            </div>
              <div class="row"><div class="col-sm-12  text-center">Add New Company</div></div>
            </div>
<?php }
function getusercompanyinfo(PDO $pdo,$compID){
        //grab company info
        $stmt = "SELECT * FROM companies WHERE CompID = ?";
        $select = $pdo->prepare($stmt);
        $select->execute([$compID]);
        foreach($select as $comp){
            $_SESSION['compname'] = $comp['CompName'];
            echo "Managing: ".$_SESSION['compname'];
        }
}
function siteLogo(PDO $pdo,$uid){
  $stmt = "SELECT CompLogo FROM companies WHERE UserID = ? LIMIT 1";
  $select = $pdo->prepare($stmt);
  if($select->execute([$uid])){
      foreach($select as $row){
          $CompLogo = $row["CompLogo"];
          $CompName = $row["CompName"];
      echo "<img src='images/".$CompLogo."' alt='".$CompName."' class='w3-image w3-circle w3-padding' width='inherit'>";
      }
    }else{
      //no comp logo found
  }
  }
//cm3 functions
function newtask(PDO $pdo,$uid,$tn,$td,$ict,$compID,$dd,$ds){
      $stmt = "INSERT INTO tasks (task,description,CompTask,CompID,uid,dateDue,dateSet) VALUES (?,?,?,?,?,?,?)";
      $insert = $pdo->prepare($stmt);
      if($insert->execute([$tn,$td,$ict,$compID,$uid,$dd,$ds])){
        return TRUE;
      }else{
        return FALSE;
      }
}
function deletetask(PDO $pdo,$taskID){
  $stmt = "DELETE FROM tasks WHERE id = ?";
  $delete = $pdo->prepare($stmt);
  if($delete->execute([$taskID])){
    return TRUE;
  }else{
    return FALSE;
  }
}
function selectTask(PDO $pdo,$compID){
  $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
      try{
      $stmt = "SELECT * FROM tasks WHERE CompID = ?";
      $select = $pdo->prepare($stmt);
      $select->execute([$compID]);
      $count = $select->rowCount();
      if($count > 0){
        while($row = $select->fetch()){
          ?>
            <div class="row w3-border-bottom justify-content-between">
              <div class="">
              <div class="col-sm-4 w3-cell">
                <a onclick="document.getElementById('<?php echo $row['id'];?>').style.display='block'"><h4><?php echo $row["task"]; ?></h4></a>
                <p id="<?php echo $row['id'];?>" style="display:none;" onclick="document.getElementById('<?php echo $row['id'];?>').style.display='none'"><?php echo $row["description"]; ?></p>
              </div>
              <div class="col-sm-4 w3-cell text-right">
              <form method="post" action="<?php $_SERVER['PHP_SELF'];?>">
                <input type="hidden" name="taskID" value="<?php echo $row['id'];?>">
                <input type="hidden" name="page" value="<?php echo $actual_link;?>">
                <input class="w3-btn w3-red" type="submit" name="deleteTask" value="Delete"></form>
              </div></div>
            </div><br>
          <?php
          //endwhile
        }
        //endif $result
      }
      //end function selectTask
    }catch(PDOException $e){
     echo $e->getMessage();
    }
}
//merchant functions
function loginuserMerchant(PDO $pdo,$usuname,$uspwd){
    $stmt = $pdo->prepare("SELECT * FROM users WHERE uname = ? && merchant = ?");
    $stmt->execute([$usuname,1]);
    $user = $stmt->fetch();
    if ($user && password_verify($uspwd, $user['pwd']))
    {
        //set session variables
        $_SESSION['uid'] = $user['uid'];
        $uid = $_SESSION['uid'];
        $_SESSION['uname'] = $user['uname'];
        $_SESSION['name'] = $user['fname']." ".$user['lname'];
        header("location:choosecomp.php");
    }
    else{
        $alert = "login unsuccessful, try again";
        $_SESSION['badpass'] = $_SESSION['badpass'] +1;
        header("location:index.php?alert=".$alert);
    }
}

//products and product lines
//add/delete
function newProduct(PDO $pdo,$pn,$pp,$pi,$pd,$pLID,$compID,$uid){
        $stmt = "INSERT INTO products (ProductName,ProductPrice,ProductImage,ProductDescription,ProductLineID,CompID,uid) VALUES(?,?,?,?,?,?,?)";
        $insert = $pdo->prepare($stmt);
        $insert->execute([$pn,$pp,$pi,$pd,$pLID,$compID,$uid]);
         if($insert){//new product upload successful
           $alert = "Successfully created product".$pn."<br>";
           //insert product image to directory
                $target_dir = "../../media/images/";
                $target_file = $target_dir . basename($pi);
               if(move_uploaded_file($_FILES["productImage"]["tmp_name"], $target_file)){
                 $alert = 'Image Successfully uploaded';
               }else{
                 $alert= "Image upload unsuccessful.";
               }
         }else{
           //unsuccessful
           $alert = "Hm.. Something went wrong";
         }
         ;

}
function newProductLine(PDO $pdo,$pLN,$compID,$uid){
      $stmt = "SELECT * FROM productlines WHERE ProductLineName = ?";
      $select = $pdo->prepare($stmt);
      $select->execute([$pLN]);
      $count = $select->rowCount();
      if($count = 0){
      $stmt = "INSERT INTO productlines (ProductLineName,CompID,uid) VALUES(?,?,?)";
      $insert = $pdo->prepare($stmt);
      $insert->execute([$pLN,$compID,$uid]);
      $GLOBALS['insert'] = TRUE;
      $alert = "Successfully created productline".$pLN."<br>";
      ;
    }else{
      //product line already exists
     //do nothing, continue
     $alert = "Product Line was not created successfully created <br>";
    }
}

//display
function getProductLineIdByName(PDO $pdo,$pLN){

            //grab productlineID from product line table with product line name from form
              $grabPl = "SELECT * FROM productlines WHERE productLineName = ?";
              $selectPl = $pdo->prepare($grabPl);
              $selectPl->execute([$pLN]);
              $count = $selectPl->rowCount();
              if($count > 0){//productline EXISTS in db, grab id and insert into products
                foreach($selectPl as $row){
                    $GLOBALS['status'] = TRUE;
                    $GLOBALS['pLID'] = $row['ProductLineID'];//insert form data into products

                }
              }
}
function displayProductsInListWithCheckbox(PDO $pdo,$compID){
  $stmt = "SELECT * FROM products WHERE CompID = ?";
  $select = $pdo->prepare($stmt);
  $select->execute([$compID]);
  foreach($select as $product){
  ?>
  <li class="w3-padding text-center" style="">
    <div class="col-sm-6"><input type="checkbox" name="product[]" value="<?php echo $product['ProductID'];?>" class=""><?php echo $product['ProductName'];?></div>
    <div class="col-sm-6"><input type="number" name="<?php echo $product['ProductID'];?>" value="1" min="1" max="99"> Qty Sold</div>
  </li>
  <hr>
  <?php
  }
}

//customer functions
function insertNewCustomer(PDO $pdo,$fname,$lname,$email,$compID){
  $date = date('Y-m-d');
  //does customer email already exist in db?
  $stmt = "SELECT * FROM customers WHERE email = ? LIMIT 1";
  $select = $pdo->prepare($stmt);
  $select->execute([$email]);
  $count = $select->rowCount();
  if($count > 0){
    //customer email already exists in db.
    //grab id associated with email
    foreach($select as $cust){
      $newcustid =  $cust['id'];
      return $newcustid;
    }
  }
  else{
    //customer email not found, insert new customer
    $stmt = "INSERT INTO customers (fname,lname,email,date) VALUES (?,?,?,?)";
    $insert = $pdo->prepare($stmt);
    $insert->execute([fname,lname,email,date]);
    $newcustid = $pdo->lastInsertId();
    return $newcustid;
  }
}
function checkexistingemail(PDO $pdo,$email,$compID){
  $stmt = "SELECT id,email FROM customers WHERE email = ?";
  $select = $pdo->prepare($stmt);
  $select->execute([$email]);
  $count = $select->rowCount();
  if($count > 0){
    foreach($select as $cust){
      $custid = $cust['id'];
      return $custid;
    }
  }else{
    //insert into db
    $stmt = "INSERT INTO customers (email,CompID) VALUES (?,?)";
    $insert = $pdo->prepare($stmt);
    if($insert->execute([$email,$compID])){
      $custid = $pdo->lastInsertId();
      return $custid;
    }
  }
}
function getcustomers(PDO $pdo,$compID){
  $stmt = "SELECT * FROM customers WHERE CompID = ?";
  $select = $pdo->prepare($stmt);
  $select->execute([$compID]);
  $count = $select->rowCount();
  if($count > 0){
    foreach($select as $cust){
      $fname = $cust['fname'];
      if(empty($fname)){
        $fname = "No Data";
      }
      $lname = $cust['lname'];
      if(empty($lname)){
        $lname = "No Data";
      }
      $email = $cust['email'];
      ?>
      <tr>
        <td class=""><?php echo $fname;?></td>
        <td class=""><?php echo $lname;?></td>
        <td class=""><?php echo $email;?></td>
        <td class="">Edit/Update</td>
      </tr>
      <?php
    }
  }
}
function grabcustomerIDwithEmail(PDO $pdo,$email){
  //does customer email already exist in db?
  $stmt = "SELECT * FROM customers WHERE email = ? LIMIT 1";
  $select = $pdo->prepare($stmt);
  $select->execute([$email]);
  $count = $select->rowCount();
  if($count > 0){
    //customer email already exists in db.
    //grab id associated with email

    foreach($select as $cust){
      $newcustid =  $cust['id'];
      return $custid;

    }
  }else{
    //no customer found with that email
  }
}

//sales
function insertneworder(PDO $pdo,$compID,$custid,$custemail,$notes,$date){
  $stmt = "INSERT INTO sales (CompID,customerid,customeremail,ordernotes,orderdate) VALUES(?,?,?,?,?)";
  $insert = $pdo->prepare($stmt);
  if($insert->execute([$compID,$custid,$custemail,$notes,$date])){
    return $pdo->lastInsertId();
  }else{
    $alert = "error occurred inserting new order into db";
    header('location:salesstatus.php?status=fail&alert='.$alert);
    exit;
  }
}
function insertpurchasedproducts(PDO $pdo,$orderid,$productid,$quantity){
  $stmt = "INSERT INTO productspurchased (orderid,productid,quantity) VALUES (?,?,?)";
  $insert = $pdo->prepare($stmt);
  if($insert->execute([$orderid,$productid,$quantity])){
  //successfully inserted, continue
  }
  else{
    //Failed
    $alert = "failed inserting new products into db";
    header('location:salesstatus.php?status=fail&alert='.$alert);
    exit;
  }
}
function retrievesales(PDO $pdo,$compID){
                  //grab customer email with orderid command from table sales
                  $stmt= "SELECT * FROM sales WHERE CompID = ?";
                  $select = $pdo->prepare($stmt);
                  $select->execute([$compID]);
                  $count = $select->rowCount();
                  if($count > 0){
                    //display each order info
                    $i = 1;
                    foreach($select as $sale){
                      $orderid = $sale['id'];
                      $date = $sale['orderdate'];
                      $custid = $sale['customerid'];
                      $custemail = $sale['customeremail'];
                      ?>
                      <tr id="saleNum<?php echo $orderid;?>">
                        <th scope="row" class="w3-light-grey"><?php echo $i;?></th>
                        <td class="w3-hide-small"><?php echo $orderid;?></td>
                        <td><?php echo $custemail;?></td>
                        <td><?php echo $date;?></td>
                        <td><a href="">View</a></td>
                      </tr>
                      <?php
                      $i++;
                    }
                  }else{
                    //no sales
                    ?>
                    <h3>No Recorded Sales</h3>
                    <?php
                  }
                  //grab purchased products with order id
                  //grab customer info with customer id,if insufficient info, display modal to fill in missing info
                }
//settings forms
function brandForm(PDO $pdo,$uid){
        $sql = 'SELECT * FROM  userbrand WHERE uid = :uid';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
          ':uid' => $uid
        ));
        $count = $stmt->rowCount();
        if($count > 0){
        $data = $stmt->fetchAll();
        foreach($data as $row){
          $bio = $row['bio'];
          $stageName = $row['stageName'];
          $youtube = $row['youtube'];
          $soundcloud = $row['soundcloud'];
          $instagram = $row['instagram'];
          $snap = $row['snapchat'];
          $twitter = $row['twitter'];
          echo '
            <div id="stageName" class="input-group">
            Stage Name<br>
            <input class="form-control" type="text" name="stageName" value="'.$stageName.'">
            </div>
            <div id="bio" class="input-group">
            Bio<br>
            <textarea class="form-control" type="text" name="bio">'.$bio.'</textarea><br>
            </div>
            <div id="youtube" class="input-group">
            Youtube:<br>
            <input type="text" name="youtube" class="form-control" value="'.$youtube.'"><br>
            </div>
            <div id="soundcloud" class="input-group">
              Soundcloud:<br>
              <input type="text" name="soundcloud" class="form-control" value="'.$soundcloud.'"><br>
            </div>
            <div id="instagram" class="input-group">
              Instagram:<br>
              <input type="text" name="instagram" class="form-control" value="'.$instagram.'"><br>
            </div>
            <div id="snapchat" class="input-group">
              snapchat:<br>
              <input type="text" name="snapchat" class="form-control" value="'.$snap.'"><br>
            </div>
            <div id="twitter" class="input-group">
              Twitter:<br>
              <input type="text" name="twitter" class="form-control" value="'.$twitter.'"><br>
            </div>
            <div id="soundcloud" class="input-group">
              <input type="hidden" name="uid" value="'.$uid.'">
              <input type="submit" name="brandUpdate" value="Update Brand" class="form-control">
            </div>
            ';
        }}else{
          echo '
            <div id="stageName" class="input-group">
            Stage Name<br>
            <input class="form-control" type="text" name="stageName" value="">
            </div>
            <div id="bio" class="input-group">
            Bio<br>
            <textarea class="form-control" type="text" name="bio" placeholder=""></textarea><br>
            </div>
            <div id="youtube" class="input-group">
            Youtube:<br>
            <input type="text" name="youtube" class="form-control" value=""><br>
            </div>
            <div id="soundcloud" class="input-group">
              Soundcloud:<br>
              <input type="text" name="soundcloud" class="form-control" value=""><br>
            </div>
            <div id="instagram" class="input-group">
              Instagram:<br>
              <input type="text" name="instagram" class="form-control" value=""><br>
            </div>
            <div id="snapchat" class="input-group">
              snapchat:<br>
              <input type="text" name="snapchat" class="form-control" value=""><br>
            </div>
            <div id="twitter" class="input-group">
              Twitter:<br>
              <input type="text" name="twitter" class="form-control" value=""><br>
            </div>
            <div id="soundcloud" class="input-group">
              <input type="hidden" name="uid" value="'.$uid.'">
              <input type="submit" name="brandUpdate" value="Update Brand" class="form-control">
            </div>
            ';
        }
  }
function contactForm(PDO $pdo,$uid){
    $sql = 'SELECT email,phone FROM  users WHERE uid = :uid';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
      ':uid' => $uid
    ));
    //only one row expected, use fetch, not fetchAll
    $data = $stmt->fetchALL();
    foreach($data as $row){
      $email = $row['email'];
      $phone = $row['phone'];
      echo '
      email<br>
      <input class="form-control" type="text" name="email" value="'.$email.'"><br>
      phone number<br>
      <input class="form-control" type="text" name="phone" value="'.$phone.'"><br>
      <div id="soundcloud" class="input-group">
      <input type="hidden" name="uid" value="'.$uid.'">
      <input class="form-control" type="submit" name="contactUpdate" value="Update Contact">
      </div>
        ';
    }
  }
function generalForm(PDO $pdo,$uid){
          $sql = 'SELECT fname, lname FROM  users WHERE uid = :uid';
          $stmt = $pdo->prepare($sql);
          $stmt->execute(array(
            ':uid' => $uid
          ));
          //only one row expected, use fetch, not fetchAll
          $data = $stmt->fetchALL();
          foreach($data as $row){
            $name = $row['fname']. ' '.$row['lname'];
            echo '
            <form id="generalForm" class="w3-form" style="max-width:300px;">
            <b>UserName:</b><br>
            <input class="form-control" type="text" name="name" value="'.$_SESSION['uname'].'" disabled><br>
            <b>Name</b>:<br>
            <input class="form-control" type="text" name="name" value="'.$name.'" disabled><br>
            <br>
            <input class="form-control" type="submit" name="generalUpdate" value="Update Info">
          </form>
              ';
          }
        }
function companyForm(PDO $pdo,$uid){
                $sql = 'SELECT * FROM companies WHERE uid = :uid';
                $stmt = $pdo->prepare($sql);
                $stmt->execute(array(
                  ':uid' => $uid
                ));
                //only one row expected, use fetch, not fetchAll
                $data = $stmt->fetchALL();
                $count = $stmt->rowCount();
                if($count >0){
                foreach($data as $row){
                  echo '
                  <b>Name:</b><br>
                  <input class="form-control" type="text" name="name" value="'.$row['CompName'].'" disabled><br>
                  <b>Address</b>:<br>
                  <input class="form-control" type="text" name="address" value="'.$row['CompAddress'].'"><br>
                  <br>
                  <b>Phone Number</b>:<br>
                  <input class="form-control" type="tel" name="tel" value="'.$row['CompNum'].'"><br>
                  <br>
                  <b>Email</b>:<br>
                  <input class="form-control" type="email" name="email" value="'.$row['CompEmail'].'"><br>
                  <br>
                  <b>Description</b>:<br>
                  <input class="form-control" type="text" name="description" value="'.$row['CompDesc'].'"><br>
                  <br>
                  <b>Web Address</b>:<br>
                  <input class="form-control" type="url" name="website" value="'.$row['CompSite'].'"><br>
                  <br>
                  <b>Industry</b>:<br>
                  <input class="form-control" type="text" name="industry" value="'.$row['CompInd'].'"><br>
                  <br>
                  <input type="hidden" name="id" value="'.$row['CompID'].'">
                  <input class="form-control" type="submit" name="companyUpdate" value="Update Info">
                    ';
                }}else{
                  echo '
                  <b>Name:</b><br>
                  <input class="form-control" type="text" name="name"><br>
                  <b>Address</b>:<br>
                  <input class="form-control" type="text" name="address"><br>
                  <br>
                  <b>Phone Number</b>:<br>
                  <input class="form-control" type="tel" name="tel"><br>
                  <br>
                  <b>Email</b>:<br>
                  <input class="form-control" type="email" name="email"><br>
                  <br>
                  <b>Description</b>:<br>
                  <input class="form-control" type="text" name="description"><br>
                  <br>
                  <b>Web Address</b>:<br>
                  <input class="form-control" type="url" name="website"><br>
                  <br>
                  <b>Industry</b>:<br>
                  <input class="form-control" type="text" name="industry"><br>
                  <br>
                  <input type="hidden" name="id">
                  <input class="form-control" type="submit" name="companyUpdate" value="Update Info">
                    ';
                }
              }

//admin functions
function insertUser(){}
function registerPd(PDO $pdo,$fn,$ln,$em,$u,$pwd,$pm){
    $mt = "1";//merchant permissions
    $cr = "0";//creator permissions
    $stmt = "INSERT INTO users (fname,lname,email,uname,pwd,permissions,merchant,creator) VALUES (?,?,?,?,?,?,?,?)";
    $insert = $pdo->prepare($stmt);
    $insert->execute([$fn,$ln,$em,$u,$pwd,$pm,$mt,$cr]);
        if($insert){
        //success
        $alert = "You have successfully signed up, your membership is being reviewed.";
        header('location:../merchant/merchant.register.php?alert='.$alert);
        exit;
        }else{
        //fail
        $alert = "CM3 encountered an issue processing ";
        header('location:../merchant/merchant.register.php?alert='.$alert);
        exit;
        }
}
?>
