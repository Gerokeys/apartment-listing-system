<?php 

include 'components/connect.php';

if(isset($_COOKIE['user_id'])){
    $user_id = $_COOKIE['user_id'];
}else {
    $user_id = '';
    header('location:login.php');
}

$select_account = $conn->prepare("SELECT * FROM `users` WHERE id = ? LIMIT 1");
$select_account->execute(['$user_id']);
$fetch_account = $select_account->fetch(PDO::FETCH_ASSOC);




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>

    <!-- Font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">


    <!-- Custom css link -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- header section starts -->

<?php include 'components/user_header.php' ?>
<!-- header section ends -->

<!-- update section starts here -->

<section class="form-container">
    <form action="" method="POST">
        <h3>Update your account</h3>
        <input type="text" name="name" required maxlength="50" placeholder="<?= $fetch_account['name'] ?>" class="box">
        <input type="email" name="email" required maxlength="50" placeholder="<?= $fetch_account['email'] ?>" class="box">
        <input type="number" name="number" required maxlength="50" min="0" max="9999999999" maxlength="10" placeholder="<?= $fetch_account['number'] ?>" class="box">
        <input type="password" name="old pass" required maxlength="50" placeholder="Enter old password" class="box">
        <input type="password" name="new pass" required maxlength="50" placeholder="Enter new password" class="box">
        <input type="password" name="c_pass" required maxlength="50" placeholder="Confirm your new password" class="box">
        <input type="submit" value="update now" name="submit" class="btn">
    </form>
</section>

<!-- update section ends here -->



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