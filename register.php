<?php include_once("includes/header.php"); ?>
<?php include_once("configs/db_connection.php"); ?>
<?php

if (isset($_SESSION['email']) && !empty($_SESSION['email'])) {
    header("location: dashboard.php");
}

if (isset($_POST['btn_register'])) {

    if (isset($_POST['name']) && !empty($_POST['name'])) {
        $name = $_POST['name'];
    } else {
        $error_nam = "Name field is required";
    }

    if (isset($_POST['email']) && !empty($_POST['email'])) {
        $email = $_POST['email'];
    } else {
        $error_nam = "Email field is required";
    }

    if (isset($_POST['username']) && !empty($_POST['username'])) {
        $username = $_POST['username'];
    } else {
        $error_nam = "Username field is required";
    }

    if (isset($_POST['phone']) && !empty($_POST['phone'])) {
        $phone = $_POST['phone'];
    } else {
        $error_nam = "phone field is required";
    }

    if (isset($_POST['password']) && !empty($_POST['password'])) {
        $password = md5($_POST['password']);
    } else {
        $error_nam = "password field is required";
    }

    if (isset($_POST['gender']) && !empty($_POST['gender'])) {
        $gender = $_POST['gender'];
    } else {
        $error_nam = "Gender field is required";
    }

    if (isset($_POST['dob']) && !empty($_POST['dob'])) {
        $dob = $_POST['dob'];
    } else {
        $error_nam = "Date of birth field is required";
    }

    $status = 1;

    if (
        isset($name) &&
        isset($email) &&
        isset($password) &&
        isset($username) &&
        isset($phone) &&
        isset($dob) &&
        isset($gender) &&
        isset($status)
    ) {
        $sql = "INSERT into tbl_users
                (name,email,password,username,phone,dob,gender,status)
                VALUES('$name','$email','$password','$username',phone,$dob,'$gender',$status)";
        $connection->query($sql);
    }
}

?>
<main>
    <div class="container">
        <div class="auth-form">
            <h1>Register Form</h1>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="phone ">Phone</label>
                    <input type="tel" id="phone" name="phone" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="username">username</label>
                    <input type="text" id="username" name="username" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="dob">Date of Birth</label>
                    <input type="date" name="dob" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select name="gender" id="gender" class="form-control" required>
                        <option value="">Select Gender</option>
                        <option value="female">Female</option>
                        <option value="male">Male</option>
                    </select>
                </div>
                <button type="submit" name="btn_register" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</main>

<?php include_once("includes/footer.php"); ?>