<?php
session_start();
include 'dbconnect.php';

$email_error = $pwd_error = $message_unsuccess = $message_success = ' ';
if (isset($_POST['submit'])) {
    $f_name = $_POST['fname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    $pass=password_hash($password,PASSWORD_BCRYPT);
    $c_pass=password_hash($cpassword,PASSWORD_BCRYPT);

    $query = "select * from register where email='$email'";
    $run = mysqli_query($con, $query);
    $row = mysqli_num_rows($run);
    if ($row > 0) {
        $email_error = "Email already exists. Please choose another email Id.";
    } elseif ($password != $cpassword) {
        $pwd_error = "Password doesn't match.";
    } else {
        $sql = "insert into register(f_name,email,password,c_password)values('$f_name','$email','$pass','$c_pass')";
        $run = mysqli_query($con, $sql);
        if ($run) {
            $message_success = "Data Inserted Successfully.";
        } else {
            $message_unsuccess = "Data Insertion Unsuccessful.";
        }
    }
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stydent Management System</title>

    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script>
        function content1() {
            document.getElementById("div1").style.display = "block";
            document.getElementById("div2").style.display = "none";
        }

        function content2() {
            document.getElementById("div1").style.display = "none";
            document.getElementById("div2").style.display = "block";


        }
    </script>
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

    <section>
        <p class="text-center text-danger font-weight-bold"><?php echo @$_SESSION['login_first'];?></p>
        <h2 class="text-center text-success pt-5">Student Management System</h2>
        <p class="text-center text-danger pt-2"><?php echo @$_GET['error']?></p>

        <div class="container bg-light" id=" formsetting">

            <h3 class="text-warning text-center py-3">Admin Login | Register Panel</h3>
            <div class="row">

                <div class="col-md-7 col-sm-7 col-12">
                    <img src="Image/main_page_image.jpg" class="img-fluid">
                </div>

                <div class="col-md-5 col-sm-5 col-12">
                    <button class="btn btn-info px-5" onclick="content1()">Register</button>
                    <button class="btn btn-info px-5" onclick="content2()">Login</button>

                    <div id="div1" style="display:block" class="mt-4">

                        <form action="" method="post">
                            <div class="form-group">
                                <label class="text-primary">Full Name</label>
                                <input type="text" name="fname" placeholder="Enter your name" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label class="text-primary">Email</label>
                                <span class="float-right text-red font-weight-bold"><?php echo $email_error
                                                                                    ?></span>
                                <input type="email" name="email" placeholder="Enter your email" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label class="text-primary">Password</label>
                                <input type="password" name="password" placeholder="Enter your password" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label class="text-primary">Confirm Password</label>
                                <strong><span class="float-right text-red font-weight-bold"><?php echo $pwd_error ?></span></strong>
                                <input type="password" name="cpassword" placeholder="Enter your password" class="form-control" required>
                            </div>
                            <input type="submit" name="submit" value="Register" class="btn btn-success px-5 mt-3" required>
                            <span class="float-right text-red font-weight-bold">
                                <?php echo $message_success;
                                echo $message_unsuccess;
                                ?>
                            </span>

                        </form>
                    </div>
                    <div id="div2" style="display:none;" class="mt-4">
                        <form action="" method="post">

                            <div class="form-group">
                                <label class="text-primary">Email</label>
                                <input type="email" name="email" placeholder="Enter your email" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label class="text-primary">Password</label>
                                <input type="password" name="password" placeholder="Enter your password" class="form-control" required>
                            </div>
                            <input type="submit" name="login" value="Login" class="btn btn-success px-5 mt-3">
                    </div>
                </div>
            </div>


        </div>

    </section>
</body>

</html>


<?php
if(isset($_POST['login'])){
    $email=$_SESSION['email']=$_POST['email'];
    $pwd=$_POST['password'];
    $sql="select * from register where email='$email'";
    $run=mysqli_query($con,$sql);
    $row=mysqli_fetch_assoc($run);

    $pwd_fetch=$row['password'];
    $pwd_decode=password_verify($pwd,$pwd_fetch);

    if($pwd_decode){
        echo "<script>window.open('menu.php?success=Login Successful','_self')</script>";
    }
    else{
        echo "<script>window.open('index.php?error=Username or password is incorrect','_self')</script>";
    }

}
?>