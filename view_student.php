<?php
include 'dbconnect.php';
session_start();
if(!$_SESSION['email']){
$_SESSION['login_first']="Please login first"; header('Location:index.php');
}

// Retrieve student data from the database
$sql = "SELECT * FROM student_detail";
$result = mysqli_query($con, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View Student</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" type="text/CSS" href="menu.css">
</head>

<body>
    <div class="container mt-13">
        <a href="menu.php" class="text text-center text-decoration-none">
            <i class="fa fa-step-backward" aria-hidden="true"></i> Back to Dashboard</a>
    </div>
    <div class="container" id="formsetting">
        <h3 class="text-center text-primary pb-4 pt-2 font-weight-bold">View Student Details</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>SR No.</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Father's Name</th>
                    <th>Gender</th>
                    <th>Email</th>
                    <th>Birthdate</th>
                    <th>Mobile</th>
                    <th>City</th>
                    <th>District</th>
                    <th>State</th>
                    <th>Nationality</th>
                    <th>Photo</th>
                    <th>Action</th>

                </tr>
            </thead>
            <?php
            $sql="select * from student_detail";
            $run=mysqli_query($con,$sql);
            $i=1;
            while($row = mysqli_fetch_assoc($run))
            {
            
            ?>

            <tbody>
                <tr>

            <td><?php echo $i++;?></td>
            <td><?php echo $row['fname']; ?></td>
            <td><?php echo $row['lname'];  ?></td>
            <td><?php echo $row['father_name']; ?></td>
            <td><?php echo $row['gender']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['birthdate']; ?></td>
            <td><?php echo $row['mobile']; ?></td>
            <td><?php echo $row['city']; ?></td>
            <td><?php echo $row['district']; ?></td>
            <td><?php echo $row['state']; ?></td>
            <td><?php echo $row['nation']; ?></td>
            
            <td>    
            <a href="st_image/<?php echo $row['photo']; ?>">
            <img src="st_image/<?php echo $row['photo']; ?>" width="50"
            height="50"></a></td>

            <td>
                <a style="text-decoration:none;" href="edit_student_detail.php?edit_student=<?php echo $row['st_id' ]; ?>">Edit</a> |
                <a style="text-decoration:none;" href="delete_student_detail.php?delete_student=<?php echo $row['st_id']; ?>">Delete</a></td>
            </tr>
            </tbody>
            <?php }?>
        </table>
    </div>


</body>

</html>