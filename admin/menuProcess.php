<?php
include ('../connect.php');
session_start();
$id = $_SESSION['username'];


if(isset($_GET['itemID']) && isset($_GET['action']) && $_GET['action'] == "update"){
    $itemID = $_GET['itemID'];

    $query=mysqli_query($conn,"SELECT * FROM item WHERE itemID ='$itemID'");
    $row=mysqli_fetch_assoc($query);

    if(isset($_POST['submit'])){
       
        $itemID = $_POST['itemID'];
        $itemName=$_POST['itemName'];
        $unitPrice=$_POST['unitPrice'];
        $stock =$_POST['stock'];
      
      
        $insert_image = $_FILES['image']['name'];
        $insert_image_size = $_FILES['image']['size'];
        $insert_image_tmp_name = $_FILES['image']['tmp_name'];
        
        if(!empty($insert_image)){
          if($insert_image_size > 100000){
              echo "<script>alert('Image is too big');</script>";
              echo "<script>window.location.href ='menuProcess.php?itemID=".$itemID."&action=update'</script>";
          }
          else{
              $image = addslashes(file_get_contents($insert_image_tmp_name));

                $sql = "UPDATE item SET image = '$image' where itemID ='$itemID'";
                $image_update_query = mysqli_query($conn, $sql) or die(mysqli_error($conn));


                $query= "UPDATE item SET itemName = '$itemName', unitPrice = '$unitPrice', stockQuantityProduct = '$stock' WHERE itemID='$itemID'";
                mysqli_query($conn, $query);

                echo "<script>alert('Update Success');</script>";
                echo "<script>window.location.href ='manageMenu.php'</script>";
            
              
          }
        }
        else{

            $query= "UPDATE item SET itemName = '$itemName', unitPrice = '$unitPrice', stockQuantityProduct = '$stock' WHERE itemID ='$itemID'";
            mysqli_query($conn, $query);

            echo "<script>alert('Update Success');</script>";
            echo "<script>window.location.href ='manageMenu.php'</script>"; 
              
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sweet Sensations</title>

  <link rel="shortcut icon" type="image/png" href="../image/candy11.png">

  <link rel="stylesheet" type="text/css" href="css/common.css">
  <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap 5 CDN-->

    <!-- bootstrap 5 Js bundle CDN-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

</head>
<body>

<?php include("headerAdmin.php") ?>
<br><br><br>
<div class="d-flex justify-content-center
-align-items-center">
     <form action='menuProcess.php?itemID=<?php $itemID?>&action=update' method="post" class="shadow p-4 rounded mt-5" style="width: 90%; max-width: 50rem;" enctype="multipart/form-data">

      <h1 class="text-center pb-5 display-4 fs-3">
        Update Menu
      </h1>
    
      <div class="mb-3">
        <label class="form-label">Item ID</label>
        <input type="text" class="form-control" name="itemID" value="<?php echo $row['itemID']?>" required readonlys>
      </div>

      <div class="mb-3">
        <label class="form-label">Item Name</label>
        <input type="text" class="form-control" name="itemName" value="<?php echo $row['itemName']?>" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Unit Price</label>
        <input type="text" class="form-control" name="unitPrice" value="<?php echo $row['unitPrice']?>" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Stock Quantity</label>
        <input type="number" class="form-control" name="stock" value="<?php echo $row['stockQuantityProduct']?>" required>
      </div>

      <div class="form-group">
        <div class="col-sm-12">
            <h4><b>Upload Images</b></h4>
        </div>
      </div> 

      <div class="form-group">
        <div class="col-sm-4"><input type="file" name="image" > 
      </div>

      <div class="mb-3">
      </div>
        <div class="hr-dashed"></div>                 
      </div>
      
      <input type="hidden" class="form-control" name="itemID" value="<?php echo $row['itemID']?>">
      <button type="submit" name="submit" value="submit" class="btn btn-primary"> Update </button>
     </form>
  </div>
</body>
</html>

