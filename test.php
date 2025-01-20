<?php
// include("connection.php");


// mysqli_autocommit($conn, False);

// mysqli_query($conn, "insert into users values('yug', 'Male', 'yugmaniya@gmail.com')");
// mysqli_query($conn, "insert into players values('het', 'Male', 'hetmaniya@gmail.com')");

// mysqli_autocommit($conn, TRUE);
// mysqli_close($conn);
// $debug = mysqli_debug("T:n:t:m:x:F:L:o,/sample.txt");
// print($debug);


// $conn = mysqli_connect("localhost","root","","user_login");
// mysqli_dump_debug_info($conn);
// echo '<pre>';
// print_r($conn);
// die();


// $mysqli = new mysqli("localhost","root","","user_login");

// if ($mysqli -> connect_errno) {
//   echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
//   exit();
// }
// if (!$mysqli -> query("INSERT INTO users (`full_name`) VALUES ('neel')")) {
//   echo("Error description: " . $mysqli -> error);
// }

// $mysqli -> close();

// $con=mysqli_connect("localhost","root","","user_login");

// if (mysqli_connect_errno()) {
//   echo "Failed to connect to MySQL: " . mysqli_connect_error();
//   exit();
// }

// if (!mysqli_query($con,"INSERT INTO users (`full_name`) VALUES ('Glenn')")) {
//   print_r(mysqli_error_list($con));
// }

// mysqli_close($con);

// Numeric/Indexed Array

// $fruit = array("Mango", "Papaya", "Orange");
// echo "I would like to eat " . $fruit[0] . ", " . $fruit[1] . " and " . $fruit[2] . ".";


// $con=mysqli_connect("localhost","root","","user_login");

// mysqli_dump_debug_info($con);
// echo '<pre>';
// print_r($con);
// die();

// $mysqli = new mysqli("localhost","root","","user_login");

// if ($mysqli -> connect_errno) {
//   echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
//   exit();
// }

// $sql = "SELECT full_name, mobile,email,dob,hobby,gender,images FROM users ORDER BY full_name";
// $result = $mysqli -> query($sql);
// $row = $result -> fetch_array(MYSQLI_NUM);
// echo '<pre>';
// print_r($row);
// die();


// $row = $result -> fetch_array(MYSQLI_ASSOC);
// echo '<pre>';
// print_r($row);
// die();
// printf ("%s (%s)\n", $row["full_name"],$row["mobile"],$row["email"],$row["dob"],$row["hobby"],$row["gender"],$row["images"]);
// $result -> free_result();
// $mysqli -> close();



// $con = mysqli_connect("localhost","root","","user_login");


// mysqli_query($con, "INSERT INTO users values('Sikhar', 'sikhar@gmail.com', '9979042987', '25-08-2004','car driving','Male')");
// mysqli_query($con, "INSERT INTO users values('Jonathan', 'Jonathan@gmail.com', '9428141441', '29-12-2005','bike rider','Male')");
// mysqli_query($con, "INSERT INTO users values('Kumara', 'kumara@gmail.com', '7567742987', '01-02-2004','Golf','Male')");
// print("Record Inserted.....\n");

// $res = mysqli_query($con, "SELECT * FROM users");

// while($info = mysqli_fetch_field($res)){
//    $currentfield = mysqli_field_tell($res);
//    print_r("Current Field: ".$currentfield."\n");
//    print_r("Name: ".$info->name."\n");

// }

// mysqli_free_result($res);

// mysqli_close($con);


// $mysqli = new mysqli("localhost","root","","user_login");

// if ($mysqli -> connect_errno) {
//   echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
//   exit();
// }

// $sql = "SELECT full_name,email,mobile,dob,hobby,gender,images FROM users ORDER BY full_name";


// if ($result = $mysqli -> query($sql)) {
//   while ($filedinfo = $result -> fetch_assoc()) {
//     echo '<pre>';
//     print_r($filedinfo);
//     die();
//     print_r("Name: %s\n", $filedinfo -> full_name);
//     print_r("Table: %s\n", $filedinfo -> table);
//     print_r("Max. Len: %d\n", $filedinfo -> max_length);
//   }
//   $result -> free_result();
// }

// $mysqli -> close();


// $mysqli = new mysqli("localhost","root","","user_login");

// if ($mysqli -> connect_errno) {
//   echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
//   exit();
// }

// $sql = "SELECT * FROM users ORDER BY full_name";

// if ($result = $mysqli -> query($sql)) {
//   $row = $result -> fetch_row();
//   foreach ($result -> lengths as $i => $val) {
//     echo '<pre>';
//     printf("Field %2d has length: %2d\n", $i + 1, $val);
//   }
//   $result -> free_result();
// }

// $mysqli -> close();

// $mysqli = new mysqli("localhost","root","","user_login");

// if ($mysqli -> connect_errno) {
//   echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
//   exit();
// }

// $sql = "SELECT full_name,mobile FROM users ORDER BY full_name";

// if ($result = $mysqli -> query($sql)) {
//   while ($obj = $result -> fetch_object()) {
//     echo '<pre>';
//     printf("%s (%s)\n", $obj->full_name, $obj->mobile);
//   }
//   $result -> free_result();
// }

// $mysqli -> close();


// $mysqli = new mysqli("localhost","root","","user_login");
// if ($mysqli -> connect_errno) {
//   echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
//   exit();
// }
// $sql = "SELECT full_name , dob FROM users ORDER BY full_name";
// if ($result = $mysqli -> query($sql)) {
//   while ($row = $result -> fetch_row()) {
//     echo '<pre>';
//     printf ("%s (%s)\n", $row[0], $row[1]);
//   }
//   $result -> free_result();
// }
// $mysqli -> close();

// $con = mysqli_connect("localhost","root","","user_login");

// if (mysqli_connect_errno()) {
//   echo "Failed to connect to MySQL: " . mysqli_connect_error();
//   exit();
// }

// $sql = "SELECT full_name , dob FROM users ORDER BY full_name";

// if ($result = mysqli_query($con, $sql)) {

//   while ($row = mysqli_fetch_row($result)) {
//     echo '<pre>';
//     printf ("%s (%s)\n", $row[0], $row[1]);
//   }
//   mysqli_free_result($result);
// }   
// mysqli_close($con);


// $con = mysqli_connect("localhost","root","","user_login");
// $mysqli = "";
// if($mysqli -> connect_errorno){
//     echo "Failed to connect to MySQL :".$mysqli ->connect_error;
//     exit();
// }
// $mysqli ->query("SELECT * FROM users");
// $mysqli ->field_count();
// $mysqli -> close();

// $mysqli = new mysqli("localhost","root","","user_login");
// if ($mysqli -> connect_errno) {
//   echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
//   exit();
// }
// var_dump($mysqli -> get_charset());
// $mysqli -> close();

// $mysqli = new mysqli("localhost","root","","user_login");
// if($mysqli ->connect_errno){
//     echo "Failed to connect to MySQL:".$mysqli->connect_error;
//     exit();
// }
// var_dump($mysqli->get_charset());
// $mysqli->close();


// echo mysqli_get_client_info();
// $con = mysqli_connect("localhost","root","","user_login");
// echo '<pre>';
// print_r(mysqli_get_client_stats());


// echo mysqli_get_client_version();

// $con = mysqli_connect("localhost","root","","user_login");

// if (mysqli_connect_errno()) {
//     echo "Failed to connect to MySQL: " . mysqli_connect_error();
//     exit();
//   }
  
//   echo mysqli_get_host_info($con);
  
//   mysqli_close($con);


//   $mysqli = new mysqli("localhost","root","","user_login");

// if ($mysqli -> connect_errno) {
//   echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
//   exit();
// }

// echo $mysqli -> server_version;

// $mysqli -> close();


// echo $mysqli -> server_version;

// $con = mysqli_init();
// if (!$con) {
//   die("mysqli_init failed");
// }

// if (!mysqli_real_connect($con,"localhost","root","","user_login")) {
//   die("Connect Error: " . mysqli_connect_error());
// }

// mysqli_close($con);
?>