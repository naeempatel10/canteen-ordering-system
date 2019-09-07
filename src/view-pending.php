<?php
include('../includes/nav-top.php');
if(!isset($_SESSION['id'])){
    header('Location:index.php');
}
$userid=$_SESSION['id'];
$result1=mysqli_query($db,"SELECT * FROM `pending_order` p, `food` f WHERE p.food_id=f.id AND p.user_id=$userid");
?>
<div class="container" style="margin-top:20px;">
     <h1>View Pending Orders</h1>
      <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Food Name</th>
              <th scope="col">Food Quantity</th>
              <th scope="col">Food Subtotal</th>
              <th scope="col">Order Placed Time</th>
              <th scope="col">Cancel Order</th>
            </tr>
          </thead>
          <tbody>
       <?php if($result1->num_rows>0){
    $srno=1;
    while($row=$result1->fetch_assoc()){
       ?>
            <tr>
              <th scope="row"><?php echo $srno;?></th>
              <td><?php echo $row['food_name'];?></td>
              <td><?php echo $row['food_quantity'];?></td>
              <td><?php echo $row['food_subtotal'];?></td>
              <td><?php echo $row['order_placed_time'];?></td>
              <td><a href="../CRUD/delete-pending.php?po_id=<?php echo $row['po_id']; ?>&uid=<?php echo $_SESSION['id']; ?>" class="btn btn-outline-danger btn-block">Cancel Order</a></td>
            </tr>
    <?php
        $srno++;
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
