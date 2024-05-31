<?php 

include 'components/connect.php';

if(isset($_COOKIE['user_id'])){
    $user_id = $_COOKIE['user_id'];
}else {
    $user_id = '';
}

if(isset($_POST['submit'])) {
    $id = create_unique_id();
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $number = $_POST['number'];
    $number = filter_var($number, FILTER_SANITIZE_STRING);
    $pass = sha1($_POST['pass']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);
    $c_pass = sha1($_POST['c_pass']);
    $c_pass = filter_var($c_pass, FILTER_SANITIZE_STRING);
    
    $select_email = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
    $select_email->execute([$email]);

    if($select_email-> rowCount() > 0) {
        $warning_msg[] = 'email aready exists!';
    }else {
        if($pass != $c_pass) {
            $warning_msg[] = 'Passwords do not match';
        }else {
            $insert_user = $conn->prepare("INSERT INTO `users`(id, name, number, email, password) VAlUES(?,?,?,?,?) ");
            $insert_user->execute([$id, $name, $number, $email, $c_pass]);
        }

        if($insert_user) {
            $verify_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ? LIMIT 1");
            $verify_user->execute([$email, $c_pass]);

            $row = $verify_user->fetch(PDO::FETCH_ASSOC);

            if($verify_user-> rowCount() > 0 ) {
                setcookie('user_id', $row['id'], time() + 60*60*24*30, '/');
                header('Location:home.php');
            }else {
                $error_msg[] = 'something went wrong!';
            }
        }

    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <!-- Font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">


    <!-- Custom css link -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- header section starts -->

<?php include 'components/user_header.php' ?>
<!-- header section ends -->

<!-- register section starts here -->

<section class="form-container">
    <form action="" method="POST">
        <h3>Create an account</h3>
        <input type="text" name="name" required maxlength="50" placeholder="Your Name*" class="box">
        <input type="email" name="email" required maxlength="50" placeholder="Your email*" class="box">
        <input type="number" name="number" required maxlength="50" min="0" max="9999999999" maxlength="10" placeholder="Your number*" class="box">
        <input type="password" name="pass" required maxlength="50" placeholder="Your password*" class="box">
        <input type="password" name="c_pass" required maxlength="50" placeholder="Confirm your password*" class="box">
        <p>already have an account? <a href="login.php">Login here</a></p>
        <input type="submit" value="register new" name="submit" class="btn">
    </form>
</section>

<!-- register section ends here -->




<!-- footer section starts -->
<?php include 'components/footer.php' ?>
<!-- footer section ends -->


<!-- sweetallert cdn  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!-- custom js link -->

<script src="js/script.js"></script>

<?php include 'components/message.php' ?>
    
</body>
</html>