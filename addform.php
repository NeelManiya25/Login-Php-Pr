<?php
include('connection.php');
include('session.php');


$nameErr = "";
$emailErr = "";
$mobileErr = "";
$dobErr = "";
$genderErr = "";
$hobbyErr = "";

if(isset($_POST['submit'])){
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $hobby = $_POST['hobby'];

    $fileNames = [];
    $uploadDirectory = 'upload/';

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

    foreach ($_FILES['file']['name'] as $key => $value) {
        $fileTmpName = $_FILES['file']['tmp_name'][$key];
        $fileName = $_FILES['file']['name'][$key];
        $ext = pathinfo($fileName, PATHINFO_EXTENSION);
        $newFileName = time() . '_' . $key . '.' . $ext;
        
        try {
            move_uploaded_file($fileTmpName, $uploadDirectory . $newFileName);
            $fileNames[] = $newFileName; 
        } catch (Exception $exception) {
            echo 'Error: ' . $exception->getMessage();
        }
    }

    $filenewname = implode(',', $fileNames);
    // echo '<pre>';
    // print_r($filenewname);
    // die();

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
        $filenewname = json_encode($fileNames);
        

        $sql = "INSERT INTO users(`full_name`,`email`,`mobile`,`dob`,`gender`,`hobby`,`images`)
                VALUES ('$full_name','$email','$mobile','$dob','$gender','$hobby','$filenewname')";

        if(mysqli_query($conn,$sql)){
            header("Location:dashoboard.php");
        } else{
            echo "Error :" .$sql . "<br>".mysqli_error($conn);
        }
    }
}
?>
<form method="POST" enctype="multipart/form-data">
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="full_name" value="<?php echo isset($full_name) ? $full_name : ''; ?>"><br><br>
    <span class="error"><?php echo $nameErr; ?></span><br>
    <label for="email">Email:</label><br>
    <input type="text" id="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>"><br><br>
    <span class="error"><?php echo $emailErr; ?></span><br>
    <label for="mobile">Mobile Number:</label><br>
    <input type="tel" id="mobile" name="mobile" value="<?php echo isset($mobile) ? $mobile : ''; ?>"><br><br>
    <span class="error"><?php echo $mobileErr; ?></span><br>
    <label for="dob">Date of Birth:</label><br>
    <input type="date" id="dob" name="dob" value="<?php echo isset($dob) ? $dob : ''; ?>"><br><br>
    <span class="error"><?php echo $dobErr; ?></span><br>
    <label for="gender">Gender:</label><br>
    <input type="radio" id="Male" name="gender" value="Male" <?php echo isset($gender) && $gender == 'Male' ? 'checked' : ''; ?>> Male<br>
    <input type="radio" id="Female" name="gender" value="Female" <?php echo isset($gender) && $gender == 'Female' ? 'checked' : ''; ?>> Female<br><br>
    <span class="error"><?php echo $genderErr; ?></span><br>
    <label for="hobby">Hobby:</label><br>
    <input type="text" id="hobby" name="hobby" value="<?php echo isset($hobby) ? $hobby : ''; ?>"><br><br>
    <span class="error"><?php echo $hobbyErr; ?></span><br>
    <label for="file">Image:</label><br>
    <input type="file" id="file" name="file[]" multiple><br><br>
    <input type="submit" value="Submit" name="submit">
</form>