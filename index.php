<!DOCTYPE html>
<html lang="en">
<head>
    <title>Food Ordering System</title>
    <link rel="stylesheet" href="css/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

</head>
<body>

    <div class="main">
        <div class="navbar">
            <div class="icon">
                <h3 class="logo">Food<span>Ordering</span></h3>
            </div>

            <div class="menu">
                <ul>
                    <li><a href="#"></a></li>
                    <li><a href="#"></a></li>
                    <li><a href="#"></a></li>
                    <li><a href="#"></a></li>
                    <li><a href="#"></a></li>
                </ul>
            </div>

        </div> 
        <div class="content">
            <h1>Food<br><span>Ordering</span> System</h1>
            <p class="par"> <br> 
            A food ordering system designed for a single restaurant is an online platform <br>
            that enables customers to browse the menu, select their desired dishes,<br> 
            and place orders specifically from that restaurant. It offers a streamlined <br> 
            and user-friendly interface tailored to the restaurant's offerings, providing <br>
            convenience and efficiency for customers to order their meals with ease.            
            </p>

                <button class="cn"><a href="register.php">JOIN US</a></button>

                <div class="form">
                <div class="container d-flex justify-content-around align-items-center" style="min-height: 100vh;">
                    <form id="border" class="border shadow p-3 rounded" action="loginProcess.php" method="post" style="width: 450px; background-color: #05445E;">

                    <h1 class="text-center p-3">Login</h1>
                
                    <!--To show the error message when the required area is blank-->
                    
                    <?php if (isset($_GET['error'])) { ?>
                    <div class="alert alert-warning" role="alert">
                        <?=$_GET['error']?>
                    </div>
                    <?php } ?>
                    
                    <div class="mb-3">
                        <label for="username" class="form-label">Email</label>
                        <input type="text" name="username" class="form-control" id="username">
                    </div>
                    
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password">	   
                    </div>

                    <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Login</button>
                    </div>

                    <br> 
                    <p align="center">Forget password?
                    <a href="#" onclick="window.open('password-reset.php')"; >
                        Reset Now
                    </a>
                    </p>
                        
                    <p align="center">Do not have an Account?
                    <a href="#" onclick="window.open('register.php')"; >
                        Register Now
                    </a>
                    </p>
                    

                    </form>
                </div>
                </div>
                <!---->

                    </div>
                </div>
        </div>
    </div>
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
</body>
</html>