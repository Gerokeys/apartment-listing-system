<?php 

include 'components/connect.php';

if(isset($_COOKIE['user_id'])){
    $user_id = $_COOKIE['user_id'];
}else {
    $user_id = '';
}

if(isset($_POST['submit'])) {
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $pass = sha1($_POST['pass']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);
    
    $select_email = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
    $select_email->execute([$email]);

    $verify_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ? LIMIT 1");
    $verify_user->execute([$email, $pass]);

    $row = $verify_user->fetch(PDO::FETCH_ASSOC);

    if($verify_user-> rowCount() > 0 ) {
        setcookie('user_id', $row['id'], time() + 60*60*24*30, '/');
        header('Location:home.php');
    }else {
        $error_msg[] = 'incorrect email or password!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">


    <!-- Custom css link -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- header section starts -->

<?php include 'components/user_header.php' ?>
<!-- header section ends -->


<!-- loginsection starts here -->

<section class="form-container">
    <form action="" method="POST">
        <h3>Welcome Back</h3>
        <input type="email" name="email" required maxlength="50" placeholder="Your email*" class="box">
        <input type="password" name="pass" required maxlength="50" placeholder="Enter your password*" class="box">
        <p>don't have an account ?<a href="register.php">Register here</a></p>
        <input type="submit" value="login now" name="submit" class="btn">
    </form>
</section>

<!-- login section ends here -->




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