<?php
include('../includes/nav-top.php');
if(!isset($_SESSION['id'])){
    header('Location:index.php');
}
$userid=$_SESSION['id'];
$result1=mysqli_query($db,"SELECT * FROM `order_notification` o, `food` f WHERE o.food_id=f.id AND o.user_id=$userid");
?>
<div class="container" style="margin-top:20px;">
   <form action="" method="GET">
       <?php if($result1->num_rows>0){
    while($row=$result1->fetch_assoc()){
       ?>
        <div class="alert alert-success" role="alert">
              Your Order Of <?php echo $row['food_name']; ?>(<?php echo $row['food_quantity']?> quantity) Has Been Completed. <a href="notif.php?del=<?php echo $row['notif_id']; ?>" class="alert-link" style="float:right; text-decoration:none;">X</a>
        </div>
    <?php              
        }
    }
       else{
           echo '<p style="color:red">No Notifications.</p>';
       }
       ?>
    </form>
</div>
<?php

if(isset($_GET['del'])){
    $delid= $_GET['del'];
    $result2=mysqli_query($db,"DELETE FROM `order_notification` WHERE notif_id=$delid;");
    header('Refresh:0;url=notif.php');                             
}

include('../includes/footer-bottom.php')?>
