<?php 

include 'components/connect.php';

if(isset($_COOKIE['user_id'])){
    $user_id = $_COOKIE['user_id'];
}else {
    $user_id = '';
    header('location:login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>

    <!-- Font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">


    <!-- Custom css link -->
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
</head>
<body>

<!-- header section starts -->

<?php include 'components/user_header.php' ?>
<!-- header section ends -->

<!-- dashboard section starts here  -->

<section class="dashboard">

    <h1 class="heading">dashboard</h1>

        <div class="box-container">

            <div class="box">
                <?php
                $select_user = $conn->prepare("SELECT * FROM `users` WHERE id = ? LIMIT 1");
                $select_user->execute([$user_id]);
                $fetch_user = $select_user->fetch(PDO::FETCH_ASSOC);
                ?>
                
                <h3> Welcome!</h3>
                <p><?=$fetch_user['name']?></p>
                <a href="update.php" class="btn">Update profile</a>
            </div>

            <div class="box">
                <h3>Filter search</h3>
                <p>Find your dream property</p>
                <a href="search.php" class="btn">Search now</a>
            </div>

            <div class="box">
            <?php
                $count_listings = $conn->prepare("SELECT * FROM `property` WHERE user_id = ?");
                $count_listings->execute([$user_id]);
                $total_listings = $count_listings->rowCount();
            ?>
            <h3><?= $total_listings; ?></h3>
            <p>properties listed</p>
            <a href="my_listings.php" class="btn">view all listings</a>
            </div>

            <div class="box">
            <?php
                $count_requests_received = $conn->prepare("SELECT * FROM `requests` WHERE receiver = ?");
                $count_requests_received->execute([$user_id]);
                $total_requests_received = $count_requests_received->rowCount();
            ?>
            <h3><?= $total_requests_received; ?></h3>
            <p>requests received</p>
            <a href="requests.php" class="btn">view all requests</a>
            </div>

            <div class="box">
            <?php
                $count_requests_sent = $conn->prepare("SELECT * FROM `requests` WHERE sender = ?");
                $count_requests_sent->execute([$user_id]);
                $total_requests_sent = $count_requests_sent->rowCount();
            ?>
            <h3><?= $total_requests_sent; ?></h3>
            <p>requests sent</p>
            <a href="saved.php" class="btn">view saved properties</a>
            </div>

            <div class="box">
            <?php
                $count_saved_properties = $conn->prepare("SELECT * FROM `saved` WHERE user_id = ?");
                $count_saved_properties->execute([$user_id]);
                $total_saved_properties = $count_saved_properties->rowCount();
            ?>
            <h3><?= $total_saved_properties; ?></h3>
            <p>properties saved</p>
            <a href="saved.php" class="btn">view saved properties</a>
            </div>


</div>
</h1>
</section>

<!-- dashboard section ends here  -->


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