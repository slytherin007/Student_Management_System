<?php
session_start();
if(!$_SESSION['email']){
$_SESSION['login_first']="Please login first"; header('Location:index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/CSS" href="menu.css">

    <script>
        jQuery(document).ready(function($) {
            $('#toggler').click(function(event) {
                {
                    event.preventDefault();
                    $('#wrap').toggleClass('toggled');
                }
            });
        });
    </script>

</head>

<body>

    <div class="d-flex" id="wrap">

        <div class="sidebar bg-light border-light">

            <div class="sidebar-heading">
                <p class="text-center">Manage Students</p>
            </div>
            <ul class="list-group list-group-flush">
                <a href="menu.php" class="list-group-item list-group-item-action">
                    <i class="fa fa-vcard-o"></i> Dashboard</a>

                <a href="add_student.php" class="list-group-item list-group-item-action">
                    <i class="fa fa-user"></i> Add Student</a>

                <a href="view_student.php" class="list-group-item list-group-item-action">
                    <i class="fa fa-eye"></i> View Student</a>

                <a href="view_student.php" class="list-group-item list-group-item-action">
                    <i class="fa fa-pencil"></i> Edit Student</a>

                <a href="logout.php" class="list-group-item list-group-item-action">
                    <i class="fa fa-sign-out"></i> Logout</a>
            </ul>

        </div>
        <div class="main-body">
            <button class="btn btn-outline-light mt-3" id="toggler">
                <i class="fa fa-bars"></i>
            </button>
        </div>
    </div>

    <div class="container text-center">
        <div class="row align-items-center">
            <div class="col box">
            <a href="add_student.php" class="text text-center text-decoration-none"><i class="fa fa-user"></i> Add student detail</a>
            </div>
            <div class="col box">
            <a href="view_student.php" class="text text-center text-decoration-none"><i class="fa fa-pencil"></i> Edit student detail</a>
            </div>
            <div class="col box">
            <a href="view_student.php" class="text text-center text-decoration-none"><i class="fa fa-eye"></i> View student detail</a>
            </div>
        </div>
    </div>


</body>

</html>