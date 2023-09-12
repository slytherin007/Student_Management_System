<?php
include 'dbconnect.php';
session_start();
if(!$_SESSION['email']){
$_SESSION['login_first']="Please login first"; header('Location:index.php');
}

$error = "";
$success = "";

if (isset($_POST['add'])) {
    $fname = mysqli_real_escape_string($con, $_POST['fname']);
    $lname = mysqli_real_escape_string($con, $_POST['lname']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $fathername = mysqli_real_escape_string($con, $_POST['fathername']);
    $birthdate = mysqli_real_escape_string($con, $_POST['birthdate']);
    $gender = mysqli_real_escape_string($con, $_POST['gender']);
    $city = mysqli_real_escape_string($con, $_POST['city']);
    $district = mysqli_real_escape_string($con, $_POST['district']);
    $nationality = mysqli_real_escape_string($con, $_POST['nationality']);
    $state = mysqli_real_escape_string($con, $_POST['state']);
    $mobile = mysqli_real_escape_string($con, $_POST['mobile']);

    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $image_size = $_FILES['image']['size'];
    $image_type = $_FILES['image']['type'];

    // Check image format and size
    if (($image_type !== 'image/jpeg' && $image_type !== 'image/png') || $image_size > 2000000) {
        $error = "Invalid image format or size. Image format should be JPEG or PNG and size should be less than 2MB.";
    } else {
        // Upload image file
        $upload_path = "st_image/" . basename($image);
        if (move_uploaded_file($image_tmp, $upload_path)) {
            // Insert student data into the database
            $sql = "INSERT INTO student_detail (fname, lname, father_name, email, mobile, birthdate, gender, district, city, state, nation, photo) VALUES ('$fname', '$lname', '$fathername', '$email', '$mobile', '$birthdate', '$gender', '$district', '$city', '$state', '$nationality', '$image')";

            if (mysqli_query($con, $sql)) {
                $success = "Student data submitted successfully.";
            } else {
                $error = "Unable to submit data. Please try again.";
            }
        } else {
            $error = "Failed to upload image.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Student</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4wzcARtqDJH5OrEZu0qoQOB17" crossorigin="anonymous"></script>
    
</head>
<body>
    <div class="container mt-13">
    <a href="menu.php" class="text text-center text-decoration-none">
    <i class="fa fa-step-backward" aria-hidden="true"></i> Back to Dashboard</a> 
    </div>


<div class="container mt-5 text-primary">
        <h2>Add Student</h2>
        <?php if ($error) : ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <?php if ($success) : ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php endif; ?>
        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="fname" class="form-label">First Name</label>
                <input type="text" class="form-control" id="fname" name="fname" required>
            </div>
            <div class="mb-3">
                <label for="lname" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="lname" name="lname" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="fathername" class="form-label">Father's Name</label>
                <input type="text" class="form-control" id="fathername" name="fathername" required>
            </div>
            <div class="mb-3">
                <label for="birthdate" class="form-label">Birthdate</label>
                <input type="date" class="form-control" id="birthdate" name="birthdate" required>
            </div>
            <div class="mb-3">
                <label for="gender" class="form-label">Gender</label>
                <select class="form-select" id="gender" name="gender" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="city" class="form-label">City</label>
                <input type="text" class="form-control" id="city" name="city" required>
            </div>
            <div class="mb-3">
                <label for="district" class="form-label">District</label>
                <input type="text" class="form-control" id="district" name="district" required>
            </div>
            <div class="mb-3">
                <label for="nationality" class="form-label">Nationality</label>
                <input type="text" class="form-control" id="nationality" name="nationality" required>
            </div>
            <div class="mb-3">
                <label for="state" class="form-label">State</label>
                <input type="text" class="form-control" id="state" name="state" required>
            </div>
            <div class="mb-3">
                <label for="mobile" class="form-label">Mobile</label>
                <input type="tel" class="form-control" id="mobile" name="mobile" pattern="[0-9]{10}" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Photo</label>
                <input
type="file" class="form-control" id="image" name="image" required>
</div>
<button type="submit" class="btn btn-primary" name="add">Submit</button>
</form>
</div>

</body>
</html>
