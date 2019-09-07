<?php
include('../../includes/admin-navbar.php');
if(!isset($_SESSION['sadmin'])){
    header('Location: ../../src/index.php');
}
    $result1=mysqli_query($db,"SELECT * FROM `pending_order`, `user`,`food` WHERE pending_order.user_id=user.id AND pending_order.food_id=food.id ORDER BY pending_order.order_placed_time DESC");
?>
<div class="container">
       <br><h1>Pending Orders</h1>
        <table class="table table-striped text-center">
      <thead>
        <tr>
          <th scope="col" width="5%">#</th>
          <th scope="col" width="20%">Name</th>
          <th scope="col" width="10%">Quantity</th>
          <th scope="col" width="10%">Subtotal</th>
          <th scope="col" width="20%">Order Placed At</th>
          <th scope="col" width="20%">Order By</th>
          <th scope="col" width="15%">Order Completed</th>
        </tr>
      </thead>
      <tbody>
       <?php if($result2->num_rows>0){
                    $count=1;
                while($row=$result1->fetch_assoc()){
        ?>
        <tr>
         <form action="" method="GET">
              <th scope="row"><?php echo $count; ?></th>
              <td><?php echo $row['food_name']; ?></td>
              <td><?php echo $row['food_quantity']; ?></td>
              <td><?php echo $row['food_subtotal']; ?></td>
              <td><?php echo $row['order_placed_time']; ?></td>
              <td><?php echo $row['fname'].' '.$row['lname']; ?></td>
              <td><a href="ad-completed.php?completed=<?php echo $row['po_id']; ?>" class="btn btn-outline-success btn-block">Completed</a></td>
          </form>
        </tr>
        <?php       
                        $count++;
                    }
                }
        ?>
      </tbody>
    </table>
</div>
<?php
include('../../includes/admin-footer.php');
?>