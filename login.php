<?php include_once("includes/header.php"); ?>
<?php include_once("configs/db_connection.php"); ?>

<?php

if (isset($_SESSION['email']) && !empty($_SESSION['email'])) {
    header("location: dashboard.php");
}

if (isset($_POST['btn_login'])) {

    if (isset($_POST['email']) && !empty($_POST['email'])) {
        $email = $_POST['email'];
    } else {
        $error_email = "Email field is required";
    }

    if (isset($_POST['password']) && !empty($_POST['password'])) {
        $password = md5($_POST['password']);
    } else {
        $error_password = "password field is required";
    }

    if (isset($email) && isset($password)) {
        $sql = "select * from tbl_users where status=1 and email='$email' and password='$password'";
        $result = $connection->query($sql);

        if ($result->num_rows != 0) {

            $user_data = $result->fetch_assoc();

            // echo "<pre>";
            // print_r($user_data);
            // echo "</pre>";

            // sesstion
            session_start();
            $_SESSION['name'] = $user_data['name'];
            $_SESSION['email'] = $user_data['email'];
            $_SESSION['image'] = $user_data['image'] ? $user_data['image'] : '';

            // redirect to dashboard
            header("location:dashboard.php");
        } else {
            $error_login = "Invalid email or password";
        }
    }
}

?>
<main>
    <div class="container">
        <div class="auth-form">
            <h1>Login Form</h1>
            <?php if (isset($error_login)) {
                echo "<p class='alert alert-danger'>$error_login</p>";
            } ?>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                <button type="submit" name="btn_login" class="btn btn-warning">Submit</button>
            </form>
            <p>Not yet an account? <a href="./register.php">Register</a></p>
        </div>
    </div>
</main>

<?php include_once("includes/footer.php"); ?>