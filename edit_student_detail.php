<?php
include 'dbconnect.php';
session_start();
if(!$_SESSION['email']){
$_SESSION['login_first']="Please login first"; header('Location:index.php');
}


$error = "";
$success = "";

if (isset($_GET['edit_student'])) {
    $edit_st_id = $_GET['edit_student'];
    $query = "SELECT * FROM student_detail WHERE st_id='$edit_st_id'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        $error = "Student not found.";
    }
}

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

    // Update the student details
    $query = "UPDATE student_detail SET fname='$fname', lname='$lname', email='$email', father_name='$fathername', birthdate='$birthdate', gender='$gender', city='$city', district='$district', nation='$nationality', state='$state', mobile='$mobile' WHERE st_id='$edit_st_id'";
    $result = mysqli_query($con, $query);

    if ($result) {
        $success = "Student details updated successfully.";
    } else {
        $error = "Failed to update student details. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Student Detail</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container mt-3">
        <a href="menu.php" class="text-decoration-none">
            <i class="fa fa-step-backward" aria-hidden="true"></i> Back to Dashboard
        </a>
    </div>

    <div class="container mt-5 text-primary">
        <h2>Edit Student Detail</h2>
        <?php if ($error) : ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <?php if ($success) : ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php endif; ?>

        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="fname" class="form-label">First Name</label>
                <input type="text" class="form-control" id="fname" name="fname" required value="<?php echo isset($row['fname']) ? $row['fname'] : ''; ?>">
            </div>
            <div class="mb-3">
                <label for="lname" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="lname" name="lname" required value="<?php echo isset($row['lname']) ? $row['lname'] : ''; ?>">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required value="<?php echo isset($row['email']) ? $row['email'] : ''; ?>">
            </div>
            <div class="mb-3">
                <label for="fathername" class="form-label">Father's Name</label>
                <input type="text" class="form-control" id="fathername" name="fathername" required value="<?php echo isset($row['father_name']) ? $row['father_name'] : ''; ?>">
            </div>
            <div class="mb-3">
                <label for="birthdate" class="form-label">Birthdate</label>
                <input type="date" class="form-control" id="birthdate" name="birthdate" required value="<?php echo isset($row['birthdate']) ? $row['birthdate'] : ''; ?>">
            </div>
            <div class="mb-3">
                <label for="gender" class="form-label">Gender</label>
                <select class="form-select" id="gender" name="gender" required>
                    <option value="Male" <?php if (isset($row['gender']) && $row['gender'] == 'Male') echo 'selected'; ?>>Male</option>
                    <option value="Female" <?php if (isset($row['gender']) && $row['gender'] == 'Female') echo 'selected'; ?>>Female</option>
                    <option value="Other" <?php if (isset($row['gender']) && $row['gender'] == 'Other') echo 'selected'; ?>>Other</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="city" class="form-label">City</label>
                <input type="text" class="form-control" id="city" name="city" required value="<?php echo isset($row['city']) ? $row['city'] : ''; ?>">
            </div>
            <div class="mb-3">
                <label for="district" class="form-label">District</label>
                <input type="text" class="form-control" id="district" name="district" required value="<?php echo isset($row['district']) ? $row['district'] : ''; ?>">
            </div>
            <div class="mb-3">
                <label for="nationality" class="form-label">Nationality</label>
                <input type="text" class="form-control" id="nationality" name="nationality" required value="<?php echo isset($row['nation']) ? $row['nation'] : ''; ?>">
            </div>
            <div class="mb-3">
                <label for="state" class="form-label">State</label>
                <input type="text" class="form-control" id="state" name="state" required value="<?php echo isset($row['state']) ?

                                                                                                    $row['state'] : ''; ?>">
            </div>
            <div class="mb-3">
                <label for="mobile" class="form-label">Mobile</label>
                <input type="tel" class="form-control" id="mobile" name="mobile" pattern="[0-9]{10}" required value="<?php echo isset($row['mobile']) ? $row['mobile'] : ''; ?>">
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Photo</label>
                <input type="file" class="form-control" id="image" name="image" required>
            </div>
            <button type="submit" class="btn btn-primary" name="add">Submit</button>
        </form>
    </div>

</body>

</html>