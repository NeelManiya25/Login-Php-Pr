<?php
    include('connection.php');
    include('session.php');
 

    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    // echo '<pre>';
    // print_r($row);
    // die();
    $full_name = $row['full_name'];
    $email = $row['email'];
    $mobile = $row['mobile'];
    $dob = $row['dob'];
    $gender = $row['gender'];
    $hobby = $row['hobby'];
    $images = $row['images']; 

    $nameErr = "";
    $emailErr = "";
    $mobileErr = "";
    $dobErr = "";
    $genderErr = "";
    $hobbyErr = "";

    if (isset($_POST['submit'])) {
        $full_name = $_POST['full_name'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $gender = $_POST['gender'];
        $dob = $_POST['dob'];
        $hobby = $_POST['hobby'];
        
        $newfileName = '';
        if ($_FILES['file']['name'] != '') {
            $path = $_FILES['file']['name'];
            $newname = time();
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            $newfileName = $newname . '.' . $ext;
            if (move_uploaded_file($_FILES['file']['tmp_name'], 'upload/'.$images)) {
                if ($images != '' && file_exists('upload/'.$images)) {
                    unlink('upload/'.$images); 
                }
            } else {
                echo "Error in file upload.";
            }
        } else {
            $newfileName = $images;
        }
        if (empty($full_name)) {
            $nameErr = "Name is required";
        } elseif (!preg_match('/^[a-zA-Z ]*$/', $full_name)) {
            $nameErr = "Invalid Name";
        }
        if (empty($email)) {
            $emailErr = "Email is required";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid Email format";
        }
        if (empty($mobile)) {
            $mobileErr = "Mobile number is required";
        } elseif (!preg_match("/^[0-9]{10}$/", $mobile)) { 
            $mobileErr = "Invalid mobile number";
        }
        if (empty($dob)) {
            $dobErr = "Date of birth is required";
        }
        if (empty($gender)) {
            $genderErr = "Gender is required";
        } elseif (!preg_match("/^[a-zA-Z]*$/", $gender)) {
            $genderErr = "Invalid gender";
        }
        if (empty($hobby)) {
            $hobbyErr = "Hobby is required";
        } elseif (!preg_match("/^[a-zA-Z ]*$/", $hobby)) {
            $hobbyErr = "Invalid hobby";
        }
        if (empty($nameErr) && empty($emailErr) && empty($mobileErr) && empty($dobErr) && empty($genderErr) && empty($hobbyErr)) {
            $filenames = json_encode(array_values($imageList)); 
            $sql = "UPDATE users SET 
                        `full_name` = '$full_name',
                        `dob` = '$dob',
                        `gender` = '$gender',
                        `hobby` = '$hobby',
                        `images` = '$images'
                        WHERE id = '$id'";
                echo '<pre>';
                print_r($sql);
                die();
            if (mysqli_query($conn, $sql)) {
                header("location: dashoboard.php"); 
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
}
?>      
<html>
<body>
    <form method="POST" enctype="multipart/form-data">
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="full_name" value="<?php echo $full_name; ?>"><br>    
    <span class="error"><?php echo  $nameErr;?></span><br>
    <label for="email">Email:</label><br>   
    <input type="text" id="email" name="email" value="<?php echo $email; ?>"><br>
    <span><?php echo $emailErr;?></span><br>
    <label for="mobile">Mobile Number:</label><br>
    <input type="tel" id="mobile" name="mobile" value="<?php echo $mobile; ?>"><br>
    <span><?php echo $mobileErr;?></span><br>
    <label for="date">Date of Birth:</label><br>
    <input type="date" id="date" name="dob" value="<?php echo $dob;?>"><br>
    <span><?php echo $dobErr;?></span><br>
    <label for="gender">Gender:</label><br>
    <input type="radio" id="Male" name="gender" value="Male" <?php echo ($gender == 'Male') ? 'checked' : ''; ?>>
    <label for="male">Male</labe><br>
    <input type="radio" id="Female" name="gender" value="Female" <?php echo ($gender == 'Female') ? 'checked' : ''; ?>>
    <label for="female">Female</label><br><br>
    <span><?php echo $genderErr;?></span>
    <label for="hobby">Hobby:</label><br>
    <input type="text" id="hobby" name="hobby" value="<?php echo $hobby?>">
    <span><?php echo $hobbyErr;?></span><br>
    <label for="file">Image:</label>
    <input type="file" id="file" name="file">
    <?php if (isset($row['images']) && $row['images'] != '') { ?>
        <img src="upload/<?php echo $row['images']; ?>" style="height:40px;width:40px;">
    <?php } else {
        echo "No image found.";
    } ?>
    <br><br>
    <input type="submit" value="submit" name="submit">
</form> 
</body>
</html>     