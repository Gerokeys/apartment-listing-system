<?php 

include 'components/connect.php';

if(isset($_COOKIE['user_id'])){
    $user_id = $_COOKIE['user_id'];
}else {
    $user_id = '';
}

if(isset($_POST['send'])) {

    $message_id = create_unique_id();
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $email = $_POST['name'];
    $email = filter_var($name, FILTER_SANITIZE_STRING);
    $number = $_POST['name'];
    $number = filter_var($name, FILTER_SANITIZE_STRING);
    $message = $_POST['name'];
    $message = filter_var($name, FILTER_SANITIZE_STRING);

    $verify_message = $conn->prepare("SELECT * FROM `messages` WHERE name = ?  AND email = ? AND number = ? AND message = ?");
    $verify_message->execute([$name, $email, $number, $message]);

    if($verify_message->rowCount() > 0){
        $warning_msg[] = 'message sent already!';
    }else {
        $insert_message = $conn->prepare("INSERT INTO `messages`(id, name, email, number, message) VALUES(?,?,?,?,?)");
        $insert_message->execute([$message_id, $name, $email, $number, $message]);
        $success_msg[] = 'message sent successfully!';
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>contact</title>

    <!-- Font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">


    <!-- Custom css link -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- header section starts -->

<?php include 'components/user_header.php' ?>
<!-- header section ends -->

<!-- contact section begins  -->

<section class="contact">
    <div class="row">

    <div class="image">
        <img src="images/contact-img.svg" alt="">
    </div>

    <form action="" method="POST">
        <h3>Get in touch</h3>
        <input type="text" name="name" 
        placeholder="enter your name" required maxlength="50" class="box">
        <input type="text" name="email" 
        placeholder="enter your email" required maxlength="50" class="box">
        <input type="text" name="number" 
        placeholder="enter your number" required maxlength="10" min="0" max="9999999999" class="box">
        <textarea name="message" class="box" placeholder="enter your message" required maxlength="1000" cols="30" rows="10" id=""></textarea>
        <input type="submit" value="send message" name="send" class="btn">

    </form>
    </div>
</section>
<!-- contact section ends  -->

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