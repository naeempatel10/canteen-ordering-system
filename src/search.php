<?php
include('../includes/nav-top.php');
if(!isset($_SESSION['id'])){
    header('Location:index.php');
}
    $search = $_SESSION['searchquery'];
    $result=mysqli_query($db,"SELECT * FROM `food` WHERE `food_name` LIKE '%$search%';");
    ?>
    <div class="container">
       <?php 
            if($result->num_rows>0){
                echo '<p style="margin-top:20px;">Showing Result Matching With Your Query"<b>'.$search.'</b>"</p>';
                $change_row = 0;
                while($row=$result->fetch_assoc()){
                if($change_row % 3 == 0 || $change_row == 0){  echo "<div class='row'>";}
        ?>
        <div class="col-sm-12 col-md-4" style="margin-top:10px;">
            <div class="card">
              <img class="card-img-top" src="../images/food/<?php echo $row['food_img']; ?>" alt="Card image cap">
              <div class="card-body">
                <?php
                  
                    if($row['veg_nonveg']=='veg'){?>
                        <h5 class="card-title" style="color: green;"><?php echo $row['food_name']; ?></h5>
                    <?php }
                    else{ ?>
                        <h5 class="card-title" style="color: red;"><?php echo $row['food_name']; ?></h5>
                <?php    }
                    
                  ?>
                <h5 class="card-text">Rs. <b><?php echo $row['price']; ?></b></h5>
                <a href="food-detail.php?id=<?php echo $row['id']; ?>" class="btn btn-outline-info">Know More</a>
              </div>
            </div>
        </div>
<?php
$change_row++;
if($change_row % 3 == 0 || $change_row == 0){  echo "</div>";}
                    
                }
            }
    else{
            echo '<p style="margin-top:20px; color:red;">No Food Item Found.</p>';
    }
    echo '</div>'; //end of container
?>
<?php include('../includes/footer-bottom.php')?>