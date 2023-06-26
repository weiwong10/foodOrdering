<?php
include ('../connect.php');
session_start();
$id = $_SESSION['username'];

if(isset($_POST['submit']))
{
  $itemName=$_POST['itemName'];
  $unitPrice=$_POST['unitPrice'];
  $stock=$_POST['stock'];
  $pathFile=$_POST['pathFile'];

  $insert_image = $_FILES['image']['name'];
  $insert_image_size = $_FILES['image']['size'];
  $insert_image_tmp_name = $_FILES['image']['tmp_name'];
  
  if(!empty($insert_image)){
    if($insert_image_size > 100000){
        echo "<script>alert('Image is too big');</script>";
        echo "<script>window.location.href ='addMenu.php'</script>";
    }
    else{
        $image = addslashes(file_get_contents($insert_image_tmp_name));


            $query= "INSERT INTO item (itemName, unitPrice, stockQuantityProduct, image, staffID, pathFile) VALUE ('$itemName','$unitPrice','$stock','$image', '$id', '$pathFile')";
            mysqli_query($conn, $query);

            echo "<script>alert('Insert Success');</script>";
            echo "<script>window.location.href ='manageMenu.php'</script>";
        
        
    }
  }else{
    echo "<script>alert('Image is required');</script>";
    echo "<script>window.location.href ='addMenu.php'</script>";

  }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sweet Sensations</title>

  <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap 5 CDN-->

    <!-- bootstrap 5 Js bundle CDN-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

    <link rel="shortcut icon" type="image/png" href="../image/candy11.png">

</head>
<body>

<?php include("headerAdmin.php") ?>

<br><br>
<div class="d-flex justify-content-center
-align-items-center">
     <form action="addMenu.php" method="post" class="shadow p-4 rounded mt-5" style="width: 90%; max-width: 50rem;" enctype="multipart/form-data">

      <h1 class="text-center pb-5 display-4 fs-3">
        Add New Menu
      </h1>
    
      <div class="mb-3">
        <label class="form-label">Item Name</label>
        <input type="text" class="form-control" name="itemName" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Unit Price</label>
        <input type="text" class="form-control" name="unitPrice" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Stock Quantity</label>
        <input type="number" min="1" class="form-control" name="stock" required>
      </div>
      
      <div class="mb-3">
        <label class="form-label">Path File</label>
        <input type="text" class="form-control" name="pathFile" required>
      </div>

      <div class="form-group">
        <div class="col-sm-12">
            <h4><b>Upload Images</b></h4>
        </div>
      </div> 

      <div class="form-group">
        <div class="col-sm-4"><input type="file" name="image" require> 
      </div>

      <div class="mb-3">
      </div>
        <div class="hr-dashed"></div>                 
      </div>

      <button type="submit" name="submit" value="submit" class="btn btn-primary"> Submit </button>
     </form>
  </div>
</body>
</html>

