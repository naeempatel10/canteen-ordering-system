<?php
include('../../includes/admin-navbar.php');
if(!isset($_SESSION['sadmin'])){
    header('Location: ../../src/index.php');
}
    $result1=mysqli_query($db,"SELECT * FROM `order_history` o, `food` f, `user` u WHERE o.food_id=f.id AND o.user_id= u.id ORDER BY order_placed_at DESC;");
?>
<div class="container">
       <br><h1>Order History</h1>
        <table class="table table-striped text-center">
      <thead>
        <tr>
          <th scope="col" width="10%">Order id</th>
          <th scope="col" width="20%">Name</th>
          <th scope="col" width="5%">Quantity</th>
          <th scope="col" width="10%">Subtotal</th>
          <th scope="col" width="20%">Order Placed At</th>
          <th scope="col" width="20%">Order Completed At</th>
          <th scope="col" width="20%">Order By</th>
        </tr>
      </thead>
      <tbody>
       <?php if($result2->num_rows>0){
                while($row=$result1->fetch_assoc()){
        ?>
        <tr>
         <form action="" method="GET">
              <th scope="row"><?php echo $row['ord_history_id']; ?></th>
              <td><?php echo $row['food_name']; ?></td>
              <td><?php echo $row['food_quantity']; ?></td>
              <td><?php echo $row['food_subtotal']; ?></td>
              <td><?php echo $row['order_placed_at']; ?></td>
              <td><?php echo $row['order_completed_at']; ?></td>
              <td><?php echo $row['fname'].' '.$row['lname']; ?></td>
          </form>
        </tr>
        <?php       
                    }
                }
        ?>
      </tbody>
    </table>
</div>
<?php
include('../../includes/admin-footer.php');
?>