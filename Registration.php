<?php
    include('connection.php');  
    session_start();

    $nameErr = $emailErr = $mobileErr = $dobErr = $genderErr = $hobbyErr = $passwordErr = $cpasswordErr = "";

    if(isset($_POST['submit'])){
        $full_name = $_POST['full_name'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $hobby = $_POST['hobby'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];
        $emailCheckQuery = "SELECT * FROM users WHERE email = '$email'";
        $mobileCheckQuery = "SELECT * FROM users WHERE mobile = '$mobile'";

        $emailResult = mysqli_query($conn, $emailCheckQuery);
        if (!$emailResult) {
            die("Error Email: " . mysqli_error($conn));
        }
        if (mysqli_num_rows($emailResult) > 0) {
            $emailErr = "Email is already taken!";
        }
        $mobileResult = mysqli_query($conn, $mobileCheckQuery);
        if (!$mobileResult) {
            die("Error mobile: " . mysqli_error($conn));
        }
        if (mysqli_num_rows($mobileResult) > 0) {
            $mobileErr = "Mobile number is already taken!";
        }
        $fileNames = array(); 
        if(isset($_FILES['file']['name']) && !empty($_FILES['file']['name'][0])){
            foreach($_FILES['file']['name'] as $key => $name){
                    $newName = time() .'_'.$key;
                    $ext = pathinfo($name,PATHINFO_EXTENSION);
                    $fileNewName =$newName.'.'.$ext;
                    if(move_uploaded_file($_FILES['file']['tmp_name'][$key],'upload/'.$fileNewName)){
                        $fileNames[] = $fileNewName;
                    } else{
                        echo 'File upload failed:'.$_FILES['file']['error'][$key];
                }
            }
        }
        $fileNameJson = json_encode($fileNames);

        if(empty($full_name)){
            $nameErr = "Name is required";
        } elseif(!preg_match('/[a-zA-Z]*$/', $full_name)){
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

        if (empty($password)) {
            $passwordErr = "Password is required";
        } elseif(strlen($password) < 8) {
            $passwordErr = "Password must be at least 8 characters";
        } elseif(!preg_match("#[A-Z]+#", $password)) {
            $passwordErr = "Password must contain at least 1 uppercase letter";
        } elseif(!preg_match("#[a-z]+#", $password)) {
            $passwordErr = "Password must contain at least 1 lowercase letter";
        }

        if (empty($cpassword)) {
            $cpasswordErr = "Please confirm your password";
        } elseif($password !== $cpassword) {
            $cpasswordErr = "Passwords do not match";
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

        if (empty($nameErr) && empty($emailErr) && empty($mobileErr) && empty($dobErr) && empty($genderErr) && empty($hobbyErr) && empty($passwordErr) && empty($cpasswordErr)) {
            $hashedPassword = md5($password);
            $sql = "INSERT INTO users (`full_name`, `email`, `mobile`, `dob`, `gender`, `hobby`, `images`, `password`) 
                    VALUES ('".$full_name."', '".$email."', '".$mobile."', '".$dob."', '".$gender."', '".$hobby."', '".$fileNameJson."', '".$hashedPassword."')";

            if (mysqli_query($conn, $sql)) {
                $_SESSION['success_message'] = "User Successfully Registered";
                header("Location: login.php"); 
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    }
?>
<html>
<form method="POST" enctype="multipart/form-data">
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="full_name" value="<?php echo isset($full_name) ? $full_name : ''; ?>"><br>
    <span class="error"><?php echo $nameErr;?></span><br>

    <label for="email">Email:</label><br>
    <input type="text" id="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>"><br>
    <span class="error"><?php echo $emailErr;?></span><br>

    <label for="mobile">Mobile Number:</label><br>
    <input type="tel" id="mobile" name="mobile" value="<?php echo isset($mobile) ? $mobile : ''; ?>"><br>
    <span class="error"><?php echo $mobileErr;?></span><br>

    <label for="date">Date of Birth:</label><br>
    <input type="date" id="date" name="dob" value="<?php echo isset($dob) ? $dob : ''; ?>"><br>
    <span class="error"><?php echo $dobErr;?></span><br>

    <label for="gender">Gender:</label><br>
    <input type="radio" id="Male" name="gender" value="Male" <?php echo (isset($gender) && $gender == 'Male') ? 'checked' : ''; ?>>
    <label for="Male">Male</label><br>
    <input type="radio" id="Female" name="gender" value="Female" <?php echo (isset($gender) && $gender == 'Female') ? 'checked' : ''; ?>>
    <label for="Female">Female</label><br>
    <span class="error"><?php echo $genderErr;?></span><br>

    <label for="hobby">Hobby:</label><br>
    <input type="text" id="hobby" name="hobby" value="<?php echo isset($hobby) ? $hobby : ''; ?>"><br>
    <span class="error"><?php echo $hobbyErr;?></span><br>

    <label for="file">Images:</label><br>
    <input type="file" id="file" name="file[]" multiple><br><br>

    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password"><br>
    <span class="error"><?php echo $passwordErr;?></span><br>

    <label for="cpassword">Confirm Password:</label><br>
    <input type="password" id="cpassword" name="cpassword"><br><br>
    <span class="error"><?php echo $cpasswordErr;?></span><br>

    <input type="submit" value="Submit" name="submit">
</form>
</html>
