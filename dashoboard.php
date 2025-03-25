<?php
include("connection.php");
include("session.php"); 

$records_per_page = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start_from = ($page - 1) * $records_per_page;

$search_query = '';
$filtervalues = ''; 

if (isset($_GET['search'])) {
    $filtervalues = mysqli_real_escape_string($conn, $_GET['search']); 
    $search_query = "AND (full_name LIKE '%$filtervalues%' OR email LIKE '%$filtervalues%' OR mobile LIKE '%$filtervalues%' OR dob LIKE '%$filtervalues%' OR hobby LIKE '%$filtervalues%' OR gender LIKE '%$filtervalues%' OR images LIKE '%$filtervalues%')";
}

?>

<html>
    <style>
        table,th,td{
            border:2px solid;
        }
    </style>
    <h2>Dashoboard</h2>
    <button onclick="location.href='addform.php'">Add+</button>
    <a href="logout.php" style="margin-left:1400px;">
        <button>Logout</button>
    </a>
    <form action="" method="GET">
        <div  style="margin-top:20px;">
            <input type="text" name="search" value="<?php echo htmlspecialchars($filtervalues); ?>" placeholder="Search data">
            <button type="submit">Search</button>
            <button type="button" onclick="window.location.href='dashoboard.php'">Cancel</button>
        </div>
    </form>

    <a href="profile.php?id=<?php echo $_SESSION['id'];?>" style="margin-left:1200px;margin-top:60px;">
        <button>Edit Profile</button>  
        <?php
            $sql = "SELECT * FROM users WHERE id = '".$_SESSION['id']."'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $imageList = $row['images'];
            $imagejson = json_decode($imageList);
            foreach($imagejson as $image){
                echo '<img src ="upload/'.$image.'" style="height:40px;width:40px;margin-right:20px;">';
            }
        ?>
    </a> 
    <label style="margin-left:750px;">Welcome,
        <?php
        if (isset($_SESSION['full_name'])) {
            echo $_SESSION['full_name'];
        }
        ?>
    </label>
    <br>

    <?php
    if ($_SESSION['login_success'] == 'admin') {
        $sql = "SELECT * FROM users WHERE id != '".$_SESSION['id']."' $search_query LIMIT $start_from, $records_per_page"; 
        $result = mysqli_query($conn, $sql);
        ?>
        <table>
            <tr>
                <th>Sr.No.</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Dob</th>
                <th>Gender</th>
                <th>Hobby</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
            <?php
                if (mysqli_num_rows($result)) {
                    $s = $start_from + 1;  
                    while($row = mysqli_fetch_assoc($result)) {
            ?>
                <tr>
                    <td><?php echo $s++;?></td>
                    <td><?php echo $row['full_name'];?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['mobile']; ?></td>
                    <td><?php echo $row['dob']; ?></td>
                    <td><?php echo $row['gender']; ?></td>
                    <td><?php echo $row['hobby']; ?></td>
                    <td>
                        <?php
                            $imageList = $row['images'];
                            $imagejson = json_decode($imageList);
                            foreach($imagejson as $image) {
                                echo '<a href="upload/'.$image.'" target="__blank">
                                    <img src="upload/'.$image.'" style="height:40px;width:40px;margin-right:20px;">
                                    </a>';
                            }
                        ?>
                    </td>
                    <td>
                        <a href="delete.php?id=<?php echo $row['id'];?>">Delete</a>&nbsp;
                        <a href="update.php?id=<?php echo $row['id']; ?>">Edit</a>
                    </td>
                </tr>
            <?php
                    }
                ?>
        </table>
        <?php
        $sql_total = "SELECT COUNT(*) FROM users WHERE id != '".$_SESSION['id']."' $search_query";
        $result_total = mysqli_query($conn, $sql_total);
        $row_total = mysqli_fetch_row($result_total);
        $total_records = $row_total[0];
        $total_pages = ceil($total_records / $records_per_page);

        echo "<div style='text-align:center;'>";
        if ($page > 1) {
            echo "<a href='dashoboard.php?page=" . ($page - 1) . "'>Prev</a> ";
        }
        for ($i = 1; $i <= $total_pages; $i++) {
            if($i == $page){
                echo "<strong>$i</strong>";
            }else{
                echo "<a href='dashoboard.php?page=$i'>$i</a>";
            }
        }
        if($page < $total_pages){
            echo "<a href='dashoboard.php?page=".($page +1)."'>Next</a>";
        }
        echo "</div>";
    } 
    else{
        echo "<p style='margin-left:300px;'>No records found.</p>";
    }
    if(!empty($total_records)){
        echo "<div style='margin-left:1450px;font-size:30px;'>$total_records</div>";
    }
   
}
?>
</html>
