<?php
include('../includes/nav-top.php');
if(!isset($_SESSION['id'])){
    header('Location:index.php');
}
$userid=$_SESSION['id'];
$result1=mysqli_query($db,"SELECT * FROM `order_history`, `food` WHERE order_history.food_id=food.id AND order_history.user_id=$userid ORDER BY order_completed_at DESC");
?>
<div class="container" style="margin-top:20px;">
      <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">Order Id</th>
              <th scope="col">Food Name</th>
              <th scope="col">Food Quantity</th>
              <th scope="col">Food Subtotal</th>
              <th scope="col">Order Placed Time</th>
              <th scope="col">Order Completed Time</th>
            </tr>
          </thead>
          <tbody>
       <?php if($result1->num_rows>0){
    while($row=$result1->fetch_assoc()){
       ?>
            <tr>
              <th scope="row"><?php echo $row['ord_history_id'];?></th>
              <td><?php echo $row['food_name'];?></td>
              <td><?php echo $row['food_quantity'];?></td>
              <td><?php echo $row['food_subtotal'];?></td>
              <td><?php echo $row['order_placed_at'];?></td>
              <td><?php echo $row['order_completed_at'];?></td>
            </tr>
    <?php
        }
    }
       ?>
         </tbody>
    </table>
</div>
<?php

if(isset($_GET['del'])){
    $delid= $_GET['del'];
    $result2=mysqli_query($db,"DELETE FROM `order_notification` WHERE notif_id=$delid;");
}

include('../includes/footer-bottom.php')?>
