<?php
if(isset($_GET['po_id'])){
    include('../includes/config.php');
    $po_id= $_GET['po_id'];
    $user_id= $_GET['uid'];
    echo $user_id;
    echo $po_id;
    $result1=mysqli_query($db,"DELETE FROM `pending_order` WHERE po_id=$po_id AND user_id=$user_id;");
    header('Location: ../src/view-pending.php');
}
?>