<?php
$conn = mysqli_connect("localhost","root","","user_login");

if(!$conn){
  die("Connection failed: ". mysqli_connect_error());
}
?>

<!-- Invalid JSON text: "Missing a comma or ']' after an array element." at position 23 in value for column 'users.images'. -->