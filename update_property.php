<?php 

include 'components/connect.php';

if(isset($_COOKIE['user_id'])){
    $user_id = $_COOKIE['user_id'];
}else {
    $user_id = '';
}

if(isset($_GET['get_id'])) {
    $get_id =  $_GET['get_id'];
}else {
    $get_id = '';
    header('Location:home.php');
}

if(isset($_POST['update'])){
    $update_id = $_POST['property_id'];
    $update_id = filter_var($update_id, FILTER_SANITIZE_STRING);

    $property_name = $_POST['property_name'];
    $property_name = filter_var($property_name, FILTER_SANITIZE_STRING);
    $price = $_POST['price'];
    $price = filter_var($price, FILTER_SANITIZE_STRING);
    $deposit = $_POST['deposit'];
    $deposit = filter_var($deposit, FILTER_SANITIZE_STRING);
    $offer = $_POST['offer'];
    $offer = filter_var($offer, FILTER_SANITIZE_STRING);
    $type = $_POST['type'];
    $type = filter_var($type, FILTER_SANITIZE_STRING);
    $address = $_POST['address'];
    $address = filter_var($address, FILTER_SANITIZE_STRING);
    $status = $_POST['status'];
    $status = filter_var($status, FILTER_SANITIZE_STRING);
    $furnished = $_POST['furnished'];
    $furnished = filter_var($furnished, FILTER_SANITIZE_STRING);
    $bhk = $_POST['bhk'];
    $bhk = filter_var($bhk, FILTER_SANITIZE_STRING);
    $bathroom = $_POST['bathroom'];
    $bathroom = filter_var($bathroom, FILTER_SANITIZE_STRING);
    $bedroom = $_POST['bedroom'];
    $bedroom = filter_var($bedroom, FILTER_SANITIZE_STRING);
    $balcony = $_POST['balcony'];
    $balcony = filter_var($balcony, FILTER_SANITIZE_STRING);
    $carpet = $_POST['carpet'];
    $carpet = filter_var($carpet, FILTER_SANITIZE_STRING);
    $age = $_POST['age'];
    $age = filter_var($age, FILTER_SANITIZE_STRING);
    $loan = $_POST['loan'];
    $loan = filter_var($loan, FILTER_SANITIZE_STRING);
    $total_floors = $_POST['total_floors'];
    $total_floors = filter_var($total_floors, FILTER_SANITIZE_STRING);
    $room_floor = $_POST['room_floor'];
    $room_floor = filter_var($room_floor, FILTER_SANITIZE_STRING);
    $description = $_POST['description'];
    $description= filter_var($description, FILTER_SANITIZE_STRING);

    if(isset($_POST['lift'])){
        $lift = $_POST['lift'];
        $lift = filter_var($lift, FILTER_SANITIZE_STRING);
     }else{
        $lift = 'no';
     }

    if(isset($_POST['security_guard'])){
        $security_guard = $_POST['security_guards'];
        $security_guard = filter_var($security_guards, FILTER_SANITIZE_STRING);
    } else {
        $security_guard = 'no';
    }
    if(isset($_POST['play_area'])){
        $play_area = $_POST['play_area'];
        $play_area = filter_var($play_area, FILTER_SANITIZE_STRING);
    } else {
        $play_area = 'no';
    }
    if(isset($_POST['garden'])){
        $garden = $_POST['garden'];
        $garden = filter_var($garden, FILTER_SANITIZE_STRING);
    } else {
        $garden = 'no';
    }
    if(isset($_POST['water_supply'])){
        $water_supply = $_POST['water_supply'];
        $water_supply = filter_var($water_supply, FILTER_SANITIZE_STRING);
    } else {
        $water_supply = 'no';
    }
    if(isset($_POST['power_backup'])){
        $power_backup = $_POST['power_backup'];
        $power_backup = filter_var($power_backup, FILTER_SANITIZE_STRING);
    } else {
        $power_backup = 'no';
    }
    if(isset($_POST['parking_area'])){
        $parking_area = $_POST['parking_area'];
        $parking_area = filter_var($parking_area, FILTER_SANITIZE_STRING);
    } else {
        $parking_area = 'no';
    }
    if(isset($_POST['gym'])){
        $gym = $_POST['gym'];
        $gym = filter_var($gym, FILTER_SANITIZE_STRING);
    } else {
        $gym = 'no';
    }
    if(isset($_POST['shopping_mall'])){
        $shopping_mall = $_POST['shopping_mall'];
        $shopping_mall = filter_var($shopping_mall, FILTER_SANITIZE_STRING);
    } else {
        $shopping_mall = 'no';
    }
    if(isset($_POST['hospital'])){
        $hospital = $_POST['hospital'];
        $hospital = filter_var($hospital, FILTER_SANITIZE_STRING);
    } else {
        $hospital = 'no';
    }
    if(isset($_POST['school'])){
        $school = $_POST['school'];
        $school = filter_var($school, FILTER_SANITIZE_STRING);
    } else {
        $school = 'no';
    }
    if(isset($_POST['market_area'])){
        $market_area = $_POST['market_area'];
        $market_area = filter_var($market_area, FILTER_SANITIZE_STRING);
    } else {
        $market_area = 'no';
    }


    $old_image_01 = $_POST['old_image_01'];
    $old_image_01 = filter_var($old_image_01, FILTER_SANITIZE_STRING);
    $image_01 = $_FILES['image_01']['name'];
    $image_01 = filter_var($image_01, FILTER_SANITIZE_STRING);
    $image_01_ext = pathinfo($image_01, PATHINFO_EXTENSION);
    $rename_image_01 = create_unique_id().'.'.$image_01_ext;
    $image_01_tmp_name = $_FILES['image_01']['tmp_name'];
    $image_01_size = $_FILES['image_01']['size'];
    $image_01_folder = 'uploaded_files/'.$rename_image_01;

    if(!empty($image_01)){
        if($image_01_size > 2000000){
            $warning_msg[]  = 'image 01 is too large';
        }else {
            $update_image_01 = $conn->prepare("UPDATE `property` SET image_01= ? WHERE id = ?");
            $update_image_01->execute([$rename_image_01, $update_id]);
            move_uploaded_file($image_01_tmp_name, $image_01_folder);
            if($old_image_01 != ''){
                unlink('uploaded_files/'.$old_image_01);
            }
        }
    }

    $old_image_02 = $_POST['old_image_02'];
    $old_image_02 = filter_var($old_image_02, FILTER_SANITIZE_STRING);
    $image_02 = $_FILES['image_02']['name'];
    $image_02 = filter_var($image_02, FILTER_SANITIZE_STRING);
    $image_02_ext = pathinfo($image_02, PATHINFO_EXTENSION);
    $rename_image_02 = create_unique_id().'.'.$image_02_ext;
    $image_02_tmp_name = $_FILES['image_02']['tmp_name'];
    $image_02_size = $_FILES['image_02']['size'];
    $image_02_folder = 'uploaded_files/'.$rename_image_02;

    if(!empty($image_02)){
        if($image_02_size > 2000000){
            $warning_msg[]  = 'image 02 is too large';
        }else {
            $update_image_02 = $conn->prepare("UPDATE `property` SET image_02= ? WHERE id = ?");
            $update_image_02->execute([$rename_image_02, $update_id]);
            move_uploaded_file($image_02_tmp_name, $image_02_folder);
            if($old_image_02 != ''){
                unlink('uploaded_files/'.$old_image_02);
            }
        }
    }

    $old_image_03 = $_POST['old_image_03'];
    $old_image_03 = filter_var($old_image_03, FILTER_SANITIZE_STRING);
    $image_03 = $_FILES['image_03']['name'];
    $image_03 = filter_var($image_03, FILTER_SANITIZE_STRING);
    $image_03_ext = pathinfo($image_03, PATHINFO_EXTENSION);
    $rename_image_03 = create_unique_id().'.'.$image_03_ext;
    $image_03_tmp_name = $_FILES['image_03']['tmp_name'];
    $image_03_size = $_FILES['image_03']['size'];
    $image_03_folder = 'uploaded_files/'.$rename_image_03;

    if(!empty($image_03)){
        if($image_03_size > 2000000){
            $warning_msg[]  = 'image 03 is too large';
        }else {
            $update_image_03 = $conn->prepare("UPDATE `property` SET image_03= ? WHERE id = ?");
            $update_image_03->execute([$rename_image_03, $update_id]);
            move_uploaded_file($image_03_tmp_name, $image_03_folder);
            if($old_image_03 != ''){
                unlink('uploaded_files/'.$old_image_03);
            }
        }
    }

    $old_image_04 = $_POST['old_image_04'];
    $old_image_04 = filter_var($old_image_04, FILTER_SANITIZE_STRING);
    $image_04 = $_FILES['image_04']['name'];
    $image_04 = filter_var($image_04, FILTER_SANITIZE_STRING);
    $image_04_ext = pathinfo($image_04, PATHINFO_EXTENSION);
    $rename_image_04 = create_unique_id().'.'.$image_04_ext;
    $image_04_tmp_name = $_FILES['image_04']['tmp_name'];
    $image_04_size = $_FILES['image_04']['size'];
    $image_04_folder = 'uploaded_files/'.$rename_image_04;

    if(!empty($image_04)){
        if($image_04_size > 2000000){
            $warning_msg[]  = 'image 04 is too large';
        }else {
            $update_image_04 = $conn->prepare("UPDATE `property` SET image_04= ? WHERE id = ?");
            $update_image_04->execute([$rename_image_04, $update_id]);
            move_uploaded_file($image_04_tmp_name, $image_04_folder);
            if($old_image_04 != ''){
                unlink('uploaded_files/'.$old_image_04);
            }
        }
    }

    $old_image_05 = $_POST['old_image_05'];
    $old_image_05 = filter_var($old_image_05, FILTER_SANITIZE_STRING);
    $image_05 = $_FILES['image_05']['name'];
    $image_05 = filter_var($image_05, FILTER_SANITIZE_STRING);
    $image_05_ext = pathinfo($image_05, PATHINFO_EXTENSION);
    $rename_image_05 = create_unique_id().'.'.$image_05_ext;
    $image_05_tmp_name = $_FILES['image_05']['tmp_name'];
    $image_05_size = $_FILES['image_05']['size'];
    $image_05_folder = 'uploaded_files/'.$rename_image_05;

    if(!empty($image_05)){
        if($image_05_size > 2000000){
            $warning_msg[]  = 'image 05 is too large';
        }else {
            $update_image_05 = $conn->prepare("UPDATE `property` SET image_05= ? WHERE id = ?");
            $update_image_05->execute([$rename_image_05, $update_id]);
            move_uploaded_file($image_05_tmp_name, $image_05_folder);
            if($old_image_05 != ''){
                unlink('uploaded_files/'.$old_image_05);
            }
        }
    }

    $update_listing = $conn->prepare("UPDATE `property` SET property_name = ?, address = ?, price = ?, type = ?, offer = ?, status = ?, furnished = ?, bhk = ?, deposit = ?, bedroom = ?, bathroom = ?, carpet = ?, age = ?, total_floors = ?, room_floor = ?, loan = ?, lift = ?, security_guard = ?, play_area = ?, garden = ?, water_supply = ?, power_backup = ?, parking_area = ?, gym = ?, shopping_mall = ?, hospital = ?, school = ?, market_area = ?, description = ? WHERE id = ?");   
    $update_listing->execute([$property_name, $address, $price, $type, $offer, $status, $furnished, $bhk, $deposit, $bedroom, $bathroom, $carpet, $age, $total_floors, $room_floor, $loan, $lift, $security_guard, $play_area, $garden, $water_supply, $power_backup, $parking_area, $gym, $shopping_mall, $hospital, $school, $market_area, $description, $update_id]);

    $success_msg[] = 'Successfully updated';
}

if(isset($_POST['delete_image_02'])){
    $old_image_02 = $_POST['old_image_02'];
    $old_image_02 = filter_var($old_image_02, FILTER_SANITIZE_STRING);
    $update_image_02 = $conn->prepare("UPDATE `property` SET image_02= ? WHERE id = ?");
    $update_image_02->execute([$rename_image_02, $update_id]);
    if($old_image_02 != ''){
        unlink('uploaded_images/'.$old_image_02);
        $success_msg[] = 'image 02 deleted';
    }
}

if(isset($_POST['delete_image_02'])){
    $old_image_03 = $_POST['old_image_03'];
    $old_image_03 = filter_var($old_image_03, FILTER_SANITIZE_STRING);
    $update_image_03 = $conn->prepare("UPDATE `property` SET image_03= ? WHERE id = ?");
    $update_image_03->execute([$rename_image_03, $update_id]);
    if($old_image_03 != ''){
        unlink('uploaded_images/'.$old_image_03);
        $success_msg[] = 'image 03 deleted';
    }
}

if(isset($_POST['delete_image_04'])){
    $old_image_04 = $_POST['old_image_04'];
    $old_image_04 = filter_var($old_image_04, FILTER_SANITIZE_STRING);
    $update_image_04 = $conn->prepare("UPDATE `property` SET image_04= ? WHERE id = ?");
    $update_image_04->execute([$rename_image_04, $update_id]);
    if($old_image_04 != ''){
        unlink('uploaded_images/'.$old_image_04);
        $success_msg[] = 'image 04 deleted';
    }
}

if(isset($_POST['delete_image_05'])){
    $old_image_05 = $_POST['old_image_05'];
    $old_image_05 = filter_var($old_image_05, FILTER_SANITIZE_STRING);
    $update_image_05 = $conn->prepare("UPDATE `property` SET image_05= ? WHERE id = ?");
    $update_image_05->execute([$rename_image_05, $update_id]);
    if($old_image_05 != ''){
        unlink('uploaded_images/'.$old_image_05);
        $success_msg[] = 'image 05 deleted';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update property</title>

    <!-- Font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">


    <!-- Custom css link -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- header section starts -->

<?php include 'components/user_header.php' ?>
<!-- header section ends -->

<!-- update_property begins here  -->
<section class="property-form">

    <?php
    $select_property = $conn->prepare("SELECT * FROM `property` WHERE id = ? LIMIT 1");
    $select_property->execute([$get_id]);
    if ($select_property->rowCount() > 0){
        while($fetch_property = $select_property->fetch(PDO::FETCH_ASSOC)) {

        $property_id = $fetch_property['id'];
        
    ?> 
    <form action="" method="post" enctype="multipart/form-data" class="box">
        <h3>Property details</h3>
        <input type="hidden" name="property_id" value="<?= $property_id; ?>">
        <input type="hidden" name="old_image_01" value="<?= $fetch_property['image_01']; ?>">
        <input type="hidden" name="old_image_02" value="<?= $fetch_property['image_02']; ?>">
        <input type="hidden" name="old_image_03" value="<?= $fetch_property['image_03']; ?>">
        <input type="hidden" name="old_image_04" value="<?= $fetch_property['image_04']; ?>">
        <input type="hidden" name="old_image_05" value="<?= $fetch_property['image_05']; ?>">
        <div class="box">
            <p>property name <span>*</span></p>
            <input type="text" name="property_name" value="<?= $fetch_property['property_name'];?>" maxlength="50" required placeholder="enter property name" class="input" >
        </div>
        <div class="flex">
            <div class="box">
                <p>property price<span>*</span></p>
                <input type="number" name="price" value="<?= $fetch_property['price'] ?>" maxlength="50" min="0" max="9999999999" required placeholder="enter property price" class="input" >
            </div>
            <div class="box">
                <p>deposit amount<span>*</span></p>
                <input type="number" name="deposit"
                value="<?= $fetch_property[ 'deposit']?>"
                 maxlength="50" min="0" max="9999999999" 
                 required placeholder="enter deposit amount" 
                 class="input" >
            </div>
            <div class="box">
                <p>property address <span>*</span></p>
                <input type="text" name="address" value="<?= $fetch_property['address'] ?>" maxlength="150" required placeholder="enter property adrress" class="input">
            </div>
            <div class="box">
                <p>offer type <span>*</span></p>
                <select name="offer" class="input" required>
                    <option value="<?= $fetch_property['offer'] ?>"
                    selected><?= $fetch_property['offer'] ?></option>
                    <option value="sale">sale</option>
                    <option value="resale">resale</option>
                    <option value="rent">rent</option>
                </select>
            </div>
            <div class="box">
                <p>property type <span>*</span></p>
                <select name="type" class="input" required>
                    <option value="<?= $fetch_property['offer'] ?>"
                    selected><?= $fetch_property['offer'] ?></option>
                    <option value="flat">flat</option>
                    <option value="house">house</option>
                    <option value="shop">shop</option>
                </select>
            </div>
            <div class="box">
                <p>property status<span>*</span></p>
                <select name="status" class="input" required>
                    <option value="<?= $fetch_property['status'] ?>"
                    selected><?= $fetch_property['status'] ?></option>
                    <option value="ready to move">ready to move</option>
                    <option value="under construction">under construction</option>
                </select>
            </div>
            <div class="box">
                <p>furnished status<span>*</span></p>
                <select name="furnished" class="input" required>
                    <option value="<?= $fetch_property['furnished'] ?>"
                    selected><?= $fetch_property['furnished'] ?></option>
                    <option value="unfurnished">unfurnished</option>
                    <option value="semi-furnished">semi-furnished</option> 
                    <option value="furnished">furnished</option>
                </select>
            </div>
            <div class="box">
                <p>How many BHK<span>*</span></p>
                <select name="bhk" class="input" required>
                    <option value="<?= $fetch_property['bhk'] ?>"
                    selected><?= $fetch_property['bhk'] ?></option>
                    <option value="1">1 BHK</option>
                    <option value="2">2 BHK</option>
                    <option value="3">3 BHK</option>
                    <option value="4">4 BHK</option>
                    <option value="5">5 BHK</option>
                    <option value="6">6 BHK</option>
                    <option value="7">7 BHK</option>
                    <option value="8">8 BHK</option>
                    <option value="9">9 BHK</option>
                    <option value="10">10 BHK</option>
                </select>
            </div>
            <div class="box">
                <p>how many bedrooms<span>*</span></p>
                <select name="bedroom" class="input" required>
                    <option value="<?= $fetch_property['bedroom'] ?>"
                    selected><?= $fetch_property['bedroom'] ?></option>
                    <option value="1">1 bedroom</option>
                    <option value="2">2 bedrooms</option>
                    <option value="3">3 bedrooms</option>
                    <option value="4">4 bedrooms</option>
                    <option value="5">5 bedrooms</option>
                    <option value="6">6 bedrooms</option>
                    <option value="7">7 bedrooms</option>
                    <option value="8">8 bedrooms</option>
                    <option value="9">9 bedrooms</option>
                    <option value="10">10 bedrooms</option>
                </select>
            </div>
            <div class="box">
                <p>How bathrooms<span>*</span></p>
                <select name="bathroom" class="input" required>
                    <option value="<?= $fetch_property['bathroom'] ?>"
                    selected><?= $fetch_property['bathroom'] ?></option>
                    <option value="0">0 bathroom</option>
                    <option value="1">1 bathroom</option>
                    <option value="2">2 bathrooms</option>
                    <option value="3">3 bathrooms</option>
                    <option value="4">4 bathrooms</option>
                    <option value="5">5 bathrooms</option>
                    <option value="6">6 bathrooms</option>
                    <option value="7">7 bathrooms</option>
                    <option value="8">8 bathrooms</option>
                    <option value="9">9 bathrooms</option>
                    <option value="10">10 bathrooms</option>
                </select>
            </div>
            <div class="box">
                <p>How many balconies<span>*</span></p>
                <select name="balcony" class="input" required>
                    <option value="<?= $fetch_property['balcony'] ?>"
                    selected><?= $fetch_property['balcony'] ?> balcony</option>
                    <option value="0">0 balconies</option>
                    <option value="1">1 balconies</option>
                    <option value="2">2 balconies</option>
                    <option value="3">3 balconies</option>
                    <option value="4">4 balconies</option>
                    <option value="5">5 balconies</option>
                    <option value="6">6 balconies</option>
                    <option value="7">7 balconies</option>
                    <option value="8">8 balconies</option>
                    <option value="9">9 balconies</option>
                    <option value="10">10 balconies</option>
                </select>
            </div>
            <div class="box">
                <p>carpet area (sqft)<span>*</span></p>
                <input type="number" name="carpet"
                 maxlength="10" min="0" max="9999999999"  value="<?= $fetch_property['carpet'] ?>"
                 required placeholder="how many square feet" 
                 class="input" >
            </div>
            <div class="box">
                <p>property age<span>*</span></p>
                <input type="number" name="age"  value="<?= $fetch_property['age'] ?>"
                 maxlength="2" min="0" max="99" 
                 required placeholder="how old is the property" 
                 class="input" >
            </div>
            <div class="box">
                <p>total floors<span>*</span></p>
                <input type="number" name="total_floors"
                 maxlength="2" min="0" max="99"  value="<?= $fetch_property['total_floors'] ?>"
                 required placeholder="how many floors available?" 
                 class="input" >
            </div>
            <div class="box">
                <p>room floor<span>*</span></p>
                <input type="number" name="room_floor"
                 maxlength="2" min="0" max="99"  value="<?= $fetch_property['room_floor'] ?>"
                 required placeholder="property floor number" 
                 class="input" >
            </div>

            <div class="box">
                <p>loan<span>*</span></p>
                <select name="loan" class="input" required>
                <option value="<?= $fetch_property['loan'] ?>"
                    selected><?= $fetch_property['loan'] ?></option>
                    <option value="available">available</option>
                    <option value="not available">not available</option>
                </select>
            </div>
        </div>
        <div class="box">
            <p>Property description<span>*</span></p>
            <textarea name="description"  value="<?= $fetch_property['description'] ?>" cols="30" rows="10" maxlength="1000" required placeholder="enter property description" class="input"></textarea>
        </div>
        <div class="checkbox">
            <div class="box">
                <p><input type="checkbox" name="lift" value="yes" <?php if($fetch_property['lift'] == 'yes') echo 'checked'; ?>>lifts</p>
                <p><input type="checkbox" name="security_guard" value="yes" <?php if($fetch_property['security_guard'] == 'yes') echo 'checked'; ?>>security guard</p>
                <p><input type="checkbox" name="play_area" value="yes" <?php if($fetch_property['play_area'] == 'yes') echo 'checked'; ?>>play area</p>
                <p><input type="checkbox" name="garden" value="yes" <?php if($fetch_property['garden'] == 'yes') echo 'checked'; ?>>garden</p>
                <p><input type="checkbox" name="water_supply" value="yes" <?php if($fetch_property['water_supply'] == 'yes') echo 'checked'; ?>>water supply</p>
                <p><input type="checkbox" name="power_backup" value="yes" <?php if($fetch_property['power_backup'] == 'yes') echo 'checked'; ?>>power backup</p>
            </div>
            <div class="box">
                <p><input type="checkbox" name="parking_area" value="yes" <?php if($fetch_property['parking_area'] == 'yes') echo 'checked'; ?>>parking area</p>
                <p><input type="checkbox" name="gym" value="yes" <?php if($fetch_property['gym'] == 'yes') echo 'checked'; ?>>gym</p>
                <p><input type="checkbox" name="shopping_mall" value="yes" <?php if($fetch_property['shopping_mall'] == 'yes') echo 'checked'; ?>>shopping mall</p>
                <p><input type="checkbox" name="hospital" value="yes" <?php if($fetch_property['hospital'] == 'yes') echo 'checked'; ?>>hospital</p>
                <p><input type="checkbox" name="school" value="yes" <?php if($fetch_property['school'] == 'yes') echo 'checked'; ?>>school</p>
                <p><input type="checkbox" name="market_area" value="yes"  <?php if($fetch_property['market_area'] == 'yes') echo 'checked'; ?>>market_area</p>
            </div>
        </div>

        <div class="box">
            <img src="uploaded_files/<?= $fetch_property['image_01']; ?>" alt="">
            <input type="submit" value="delete image 01" class="inline-btn">
            <p>update image 01</p>
            <input type="file" class="input" name="image_01" accept="image/*" required>
        </div>
        <div class="flex">
        <div class="box"> 
            <?php 
            if(!empty($fetch_property['image_02'])){
            ?>
            <img src="uploaded_files/<?= $fetch_property['image_02']; ?>" alt="">
            <input type="submit" value="delete image 02" onclick="return confirm('delete image?')" name="delete_image_02" class="btn">
            <?php }; ?>
            
            <p>update image 02</p>
            ?>
            <input type="file" class="input" name="image_02" accept="image/*">
        </div>
        <div class="box">
            <?php
            if(!empty($fetch_property['image_03'])){
            ?>
            <img src="uploaded_files/<?= $fetch_property['image_03']; ?>" alt="">
            <input type="submit" value="delete image 03" onclick="return confirm('delete image?')" name="delete_image_03" class="btn">
            <?php }; ?>
            
            <p>update image 03</p>
            ?>
            <input type="file" class="input" name="image_03" accept="image/*">
        </div>
        <div class="box">
            <?php 
            if(!empty($fetch_property['image_04'])){
            ?>
            <img src="uploaded_files/<?= $fetch_property['image_04']; ?>" alt="">
            <input type="submit" value="delete image 04" onclick="return confirm('delete image?')" name="delete_image_04" class="btn">
            <?php }; ?>
            
            <p>update image 04</p>
            ?>
            <input type="file" class="input" name="image_04" accept="image/*">
        </div>
        <div class="box">
            <?php 
            if(!empty($fetch_property['image_05'])){
            ?>
            <img src="uploaded_files/<?= $fetch_property['image_05']; ?>" alt="">
            <input type="submit" value="delete image 05" onclick="return confirm('delete image?')" name="delete_image_05" class="btn">
            <?php }; ?>
            
            <p>update image 05</p>
            ?>
            <input type="file" class="input" name="image_05" accept="image/*">
        </div>
    </div>
    <input type="submit" name="update" value="update property" class="btn">
</form>
<?php
    }
}else {
    echo '<p class="empty">Property was not listed</p>';
}
?>
</section>


<!-- update_property ends here  -->


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