<?php
include("connection.php");
include("session.php");
?>
<html>
    <style>
        table, th, td {
            border: 2px solid;
        }
    </style>
    <h2>Dashboard</h2>
    <button onclick="location.href='addform.php'">Add+</button>
    <a href="logout.php" style="margin-left:1400px;">
        <button>Logout</button>
    </a>
    <a href="profile.php?id=<?php echo $_SESSION['id'];?>" style="margin-left:1200px">
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
        if(isset($_SESSION['full_name'])){
            echo $_SESSION['full_name'];
        }
        ?>
    </label>
    <br>
    <?php
    if ($_SESSION['login_success'] == 'admin') {
        $sql = "SELECT * FROM users WHERE id != '".$_SESSION['id']."'"; 
        $result = mysqli_query($conn, $sql);
        ?>
      <?php   ?>
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
                $s = 1;
                while($row = mysqli_fetch_assoc($result)){
            ?>
                <tr>
                    <td><?php echo $s++; ?></td>
                    <td><?php echo $row['full_name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['mobile']; ?></td>
                    <td><?php echo $row['dob']; ?></td>
                    <td><?php echo $row['gender']; ?></td>
                    <td><?php echo $row['hobby']; ?></td>
                    <td>
                        <?php
                            $imageList = $row['images'];
                            $imagejson = json_decode($imageList);
                            foreach($imagejson as $image){
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
    <?php    } else {
        echo "No records found."; 
    }
}
?>
</html>