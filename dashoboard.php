<?php
include("connection.php");
include("session.php");
?>
<html>
    <style>
        table, th, td {
            border: 2px, solid;
        }
    </style>
    <h2>Dashboard</h2>
    <button onclick="location.href='addform.php'">Add+</button>
    <a href="logout.php" style="margin-left:1400px;">
        <button>Logout</button>
    </a>
    <?php
          $sql = "SELECT * FROM users";
          $result = mysqli_query($conn,$sql);
          $row = mysqli_fetch_assoc($result);
    ?>
    <a href="profile.php?id=<?php echo $_SESSION['id'];?>" style="margin-left:1200px">
        <button>Edit Profile</button>  
        <?php
            $imageList = $row['images'];
            $imagejson = json_decode($imageList);
            foreach ($imagejson as $image) {    
                echo '<img src="upload/'.$image.'"style="height:40px;width:40px;margin-right:20px;">';
            }
        ?>
        </a> 
    </a>
        <label style="margin-left:750px;">Welcome,
        <?php
            $sql = "SELECT * FROM users";
            $result = mysqli_query($conn,$sql);
            if(isset($_SESSION['full_name'])){
                echo $_SESSION['full_name'];
            }
        ?>
    </label>
    <br>
    <?php
        $sql = "SELECT * FROM users";
        $result = mysqli_query($conn, $sql);
    ?>
    <table>
        <tr>
            <th>ID</th>
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
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
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
                    foreach ($imagejson as $image) {    
                        echo '<a href="upload/'.$image.'" target="__blank">
                        <img src="upload/'.$image.'"style="height:40px;width:40px;margin-right:20px;">
                        
                        </a>
                        ';
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
</html>