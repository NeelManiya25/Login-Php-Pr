<html>
<body>
<?php
    include('connection.php');
    include('session.php');

    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE `id` = $id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $newPassword = "";
    $full_name = $row['full_name'];
    $email = $row['email'];
    $mobile = $row['mobile'];
    $dob = $row['dob'];
    $gender = $row['gender'];
    $hobby = $row['hobby'];
    $password = $row['password'];
    $filenames = $row['images']; 
    $nameErr = $emailErr = $mobileErr = $dobErr = $genderErr = $hobbyErr = $passwordErr = "";
    
    $imageList = json_decode($filenames, true);
    if (isset($_POST['submit'])) {
        $full_name = $_POST['full_name'];
        $gender = $_POST['gender']; 
        $dob = $_POST['dob'];
        $hobby = $_POST['hobby'];
        $NewPassword = $_POST['password'];
        $cpassword = $_POST['cpassword'];

        if (!empty($_FILES['file']['name'][0])) {
            foreach ($_FILES['file']['name'] as $key => $filename) {
                $path = $_FILES['file']['name'][$key];
                $newname = time() . "_" . $key;
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                $newfileName = $newname . '.' . $ext;
                if (move_uploaded_file($_FILES['file']['tmp_name'][$key], 'upload/' . $newfileName)) {
                    $imageList[] = $newfileName; 
                } else {
                    echo "Error in file upload.";
                }
            }
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
        if (empty($password) || empty($cpassword)) {
            $passwordErr = "Password is required";
        } elseif ($password !== $cpassword) {
            $passwordErr = "Passwords do not match";
        } elseif (strlen($password) < 8) {
            $passwordErr = "Password must be at least 8 characters";
        } elseif (!preg_match("#[A-Z]+#", $password)) {
            $passwordErr = "Password must contain at least 1 uppercase letter";
        } elseif (!preg_match("#[a-z]+#", $password)) {
             $passwordErr = "Password must contain at least 1 lowercase letter";
        }

        if (empty($nameErr) && empty($dobErr) && empty($genderErr) && empty($hobbyErr)) {
            $filenames = json_encode(array_values($imageList)); 
            $hashedPassword = md5($NewPassword);
            if (!empty($NewPassword)) {
                if(!empty($passwordErr)){
                $sql = "UPDATE users SET 
                        `full_name` = '$full_name',
                        `dob` = '$dob',
                        `gender` = '$gender',
                        `hobby` = '$hobby',
                        `images` = '$filenames',
                        `password` = '$hashedPassword'
                        WHERE id = '$id'";
                }
            } else {
                $sql = "UPDATE users SET
                        `full_name` = '$full_name',
                        `dob` = '$dob',
                        `gender`= '$gender',
                        `hobby` = '$hobby',
                        `images` = '$filenames'
                        WHERE id = '$id'";
            }
            
            if (mysqli_query($conn, $sql)) {
                header("Location: dashoboard.php");
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    }
?>
<form method="POST" enctype="multipart/form-data">  
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="full_name" value="<?php echo $full_name; ?>"><br><br>
    <span class="error"><?php echo  $nameErr;?></span><br>
    <label for="email">Email:</label><br>
    <input type="text" id="email" name="email" value="<?php echo $email; ?>"><br><br>
    <span><?php echo $emailErr;?></span><br>
    <label for="mobile">Mobile Number:</label><br>
    <input type="tel" id="mobile" name="mobile" value="<?php echo $mobile;?>">
    <span><?php echo $mobileErr;?></span><br>
    <label for="date">Date of Birth:</label><br>
    <input type="date" id="date" name="dob" value="<?php echo $dob; ?>"><br><br>
    <span><?php echo $dobErr;?></span><br>
    <label for="gender">Gender:</label><br>
    <input type="radio" id="Male" name="gender" value="Male" <?php echo ($gender == 'Male') ? 'checked' : ''; ?>>
    <label for="male">Male</label><br>
    <input type="radio" id="Female" name="gender" value="Female" <?php echo ($gender == 'Female') ? 'checked' : ''; ?>>
    <label for="female">Female</label><br><br>
    <span><?php echo $genderErr;?></span>
    <label for="hobby">Hobby:</label><br>
    <input type="text" id="hobby" name="hobby" value="<?php echo $hobby?>"><br><br>
    <span><?php echo $hobbyErr;?></span><br>
    <label for="file">Image:</label><br>
    <input type="file" id="file" name="file[]" multiple><br><br>
    <?php  
    if($imageList){
        foreach($imageList as $image){
            echo '<img src="upload/'.$image.'"style="height:40px;width:40px;margin-right:20px;">';
        }
    } else{
        echo "No images found.";
    }
    ?>
    <br><br>
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password"><br><br>
    <span><?php echo $passwordErr;?></span><br>
    <label for="cpassword">Confirm Password:</label><br>
    <input type="password" id="cpassword" name="cpassword"><br><br>
    <span><?php echo $passwordErr; ?></span><br>
    <input type="submit" value="Submit" name="submit">
</form> 
</body>
</html>
