<?php
include_once('../../inc/pdo.php');
?>
<?php
if(isset($_POST['updateProductInfo'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $compID = $_POST['compID'];
    try{
    $stmt = "UPDATE products SET ProductName = ?, ProductPrice = ?, ProductDescription = ? WHERE ProductID = ?";
    $update = $pdo->prepare($stmt);
    if($update->execute([$name,$price,$description,$id])){
    $status = "Successfully Updated";
     header('location:../products.php?compID='.$compID.'&updatedproduct='.$name.'&status='.$status);
    }else{
    $status = "Uuccessfully Updated";
     header('location:../products.php?compID='.$compID.'&updatedproduct='.$name.'&status='.$status);
    }
    }catch(PDOException $e){
    echo $e->getMessage();
    }
    }
?>
