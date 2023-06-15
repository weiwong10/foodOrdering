<?php 
	include ('../connect.php');
	session_start();
	$id = $_SESSION['username'];
?>
<!DOCTYPE html>
<html>
<head>

	<title>Manage Menu</title>
	<!-- CSS only -->

<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>
<body>

<?php include("headerAdmin.php") ?>

<br><br><br><br><br>
    <div class="container" >
        <button class="btn btn-primary my-"><a href="addMenu.php" style="text-decoration: none" class="text-light">Add New Menu </a></button>

        <br>
        <table class="table table-light table-striped">
        <thead>
            <tr>
            <th scope="col">Item ID</th>
            <th scope="col">Item Name</th>
            <th scope="col">Unit Price</th>
            <th scope="col">Ingredient</th>
            <th scope="col">Image</th>
            <th scope="col">Operations</th>
            </tr>
        </thead>
        <tbody>


            <?php

            $sql = "SELECT * FROM item";
            $result = mysqli_query($conn,$sql);
            
            if(mysqli_num_rows($result) >= 1){
                while($row=mysqli_fetch_assoc($result)){
                    echo '<tr>
                    <th scope="row">'.$row['itemID'].'</th>
                    <td>'.$row['itemName'].'</td>
                    <td>' .$row['unitPrice'].'</td>
                    <td>'.$row['ingredient'].'</td>
                    <td><img src="data:image;base64,'.base64_encode($row['image']).'"alt="Image"; " width="125px" height="125px""></td>
                    <td>
                    <button class="btn btn-primary"><a href="menuProcess.php?itemID='.$row['itemID'].'&action=update" class="text-light">Update</a></button>
                    </td>
                    </tr>';
                }
            }
            else{
                echo '<td colspan="5">No Record Found </td>';
            }
            
            ?>
        </tbody>
        </table>
    </div>
  

 
<hr>



</body>
</html>