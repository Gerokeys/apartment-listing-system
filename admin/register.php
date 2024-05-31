<?php 

include '../components/connect.php' ;

if(isset($_COOKIE['admin_id'])) {
    $admin_id = $_COOKIE['admin_id'];
}else {
    $admin_id = '';
}


if(isset($_POST['submit'])){

    $id = create_unique_id();
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING); 
    $pass = sha1($_POST['pass']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING); 
    $c_pass = sha1($_POST['c_pass']);
    $c_pass = filter_var($c_pass, FILTER_SANITIZE_STRING); 
 
    $verify_admins = $conn->prepare("SELECT * FROM `admin` WHERE name = ? LIMIT 1");
    $verify_admins->execute([$name]);
 
    if($verify_admins->rowCount() > 0){
        $warning_msg[] = 'name already taken';
    }else {
        if($pass != $c_pass){
            $warning_msg[] = "passwords don't match";
        }else {
            $insert_admin =$conn->prepare("INSERT INTO `admin`(id, name, password) VALUES(?,?,?)");
            $insert_admin->execute([$id, $name, $pass]);
            $success_msg[] = 'Registered successfully!';
        }
    }
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
    
    <!-- Font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="../css/admin_style.css?v=<?php echo time(); ?>">

<body>

<!-- header section starts here  -->

<?php include '../components/admin_header.php'; ?>

<!-- header section ends here  -->

<!-- dashboard section starts here  -->

<!-- register section starts here  -->

<section class="form-container" style="min-height: 100vh;">

   <form action="" method="POST">
      <h3>create new account!</h3>
      <input type="text" name="name" placeholder="enter username" maxlength="20" class="box" required oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" placeholder="enter password" maxlength="20" class="box" required oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="c_pass" placeholder="confirm password" maxlength="20" class="box" required oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="register now" name="submit" class="btn">
   </form>

</section>

<!-- register section ends here  -->








<!-- sweetallert cdn  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<script src="../js/admin_script.js"></script>

<?php include '../components/message.php' ?>
    
</body>
</html>