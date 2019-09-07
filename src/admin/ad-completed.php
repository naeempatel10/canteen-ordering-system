<?php
    if(isset($_GET['completed'])){
        include('../../includes/admin-navbar.php');
        $po_id=$_GET['completed'];
        $result1= mysqli_query($db,"SELECT * FROM pending_order p, user u, food f WHERE p.user_id=u.id AND p.po_id=$po_id AND p.food_id=f.id");
        if($result1->num_rows>0){
            if($row=$result1->fetch_assoc()){
                $food_id= $row['food_id'];
                $fquant= $row['food_quantity'];
                $fsubtot= $row['food_subtotal'];
                $userid= $row['user_id'];
                $order_placed_time= $row['order_placed_time'];
                //echo $food_id;
                $result=mysqli_query($db,"INSERT INTO `order_history`(`food_id`, `food_quantity`, `food_subtotal`, `user_id`, `order_placed_at`) VALUES ($food_id,$fquant,$fsubtot,$userid,'$order_placed_time')");
                $result2=mysqli_query($db,"INSERT INTO `order_notification`(`food_quantity`, `food_id`, `food_subtotal`, `user_id`) VALUES ($fquant,$food_id,$fsubtot,$userid)");
                $result3=mysqli_query($db,"DELETE FROM `pending_order` WHERE po_id=$po_id;");
                $result4=mysqli_query($db,"SELECT * FROM `order_notification`,`food` WHERE ((food_quantity=$fquant AND food_id=$food_id AND food_subtotal=$fsubtot AND user_id=$userid)  AND order_notification.food_id=food.id);");
                if($result4->num_rows>0){
                    if($row=$result4->fetch_assoc()){   
                        $_SESSION['food_name']= $row['food_name'];
                        $_SESSION['food_quantity']= $row['food_quantity'];
                        $_SESSION['food_subtotal']= $row['food_subtotal'];
                        $_SESSION['xuser_id']= $row['user_id'];
                        include('phpmail/mailS.php');
                    }
                }
                header('Location: ad-pending.php');
                
            }
        }
    }
?>