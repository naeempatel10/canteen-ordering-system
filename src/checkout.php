<?php
include('../includes/nav-top.php');
if(!isset($_SESSION['id'])){
    header('Location:index.php');
}
$noitem=0;
?>
<div class="container">
<br>
    <div class="row">
            <aside class="col-sm-6 row h-100 mx-auto align-items-center text-center" style="margin-top:70px;">
                <article class="card">
                <div class="card-body p-5">
                <ul class="nav bg-light nav-pills rounded nav-fill mb-3" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill">
                        <i class="fas fa-outdent"></i>  Take-Away</a></li>
                </ul>
                <div class="tab-content">
                <div class="tab-pane fade show active" id="nav-tab-card">
                    <div class="form-group">
                        <label for="username">Full Name</label>
                        <input type="text" class="form-control text-center" name="username" disabled value="<?php echo $_SESSION['fname'].' '.$_SESSION['lname']; ?>">
                    </div> <!-- form-group.// -->

                    <div class="form-group">
                        <label for="cardNumber">Total</label>
                        <div class="input-group">
                            <input type="text" class="form-control text-center" name="cardNumber" disabled value="<?php if(!empty($_SESSION['total'])){echo 'Rs. '.$_SESSION['total'];}else{ $noitem= 1;echo 'Rs. 0'; } ?>">
                            <div class="input-group-append">
                            </div>
                        </div>
                    </div> <!-- form-group.// -->

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label><span class="text-center">Please Click On Confirm To Place Your Order.</span> </label>
                            </div>
                        </div>
                    </div> <!-- row.// -->
                    <form role="form" method="POST">
                        <input type="submit" class="subscribe btn btn-primary btn-block" type="button" value="Confirm" name="confirm">
                    </form>
                </div> <!-- tab-pane.// -->
                </div> <!-- tab-content .// -->

                </div> <!-- card-body.// -->
                </article> <!-- card.// -->
            </aside> <!-- col.// -->
    </div> <!-- row.// -->
</div>
<?php
    if(isset($_POST['confirm'])){
        if($noitem==1){?>
        <div class="alert alert-danger" role="alert" style="margin-top:10px;">
          No Food In The Cart Is Added. Add <a href="menu.php" class="alert-link">Some Food First</a>. 
        </div>
        
    <?php    }
        else{
            $user=$_SESSION['id'];
            $cart_detail= $_SESSION['cartDetail'];
            $food_id = array_column($cart_detail, 'fid');
            $food_quant = array_column($cart_detail, 'fq');
            $subtotal = array_column($cart_detail, 'subtotal');
            $transaction_completed=0; // to be used later to display a success card if the order is placed.
            //we can take sizeof any of the above variable as they would be anyway equal.
            for ($i = 0; $i <= sizeof($food_id)-1 ; $i++) {
                $fid = $food_id[$i];
                $fquant = $food_quant[$i];
                $fsubtotal = $subtotal[$i];
                //echo '<br> food id'.$fid.' food_quant'.$fquant;
                $result=mysqli_query($db,"INSERT INTO `pending_order`(`food_id`, `food_quantity`, `food_subtotal`, `user_id`) VALUES ($fid,$fquant,$fsubtotal,$user)");
                $transaction_completed=1;
            }
            $result2=mysqli_query($db,"DELETE FROM `cart` WHERE user_id=$user");
            if($transaction_completed==1){?>
         <div class="alert alert-success" role="alert" style="margin-top:10px;">
          Order Placed. You Can Check The Status Of Your Order From "Pending Orders" Tab. Redirecting in 10 Seconds Or Click<a href="view-pending.php" class="alert-link"> Here</a>. 
        </div>                 
    <?php
            header('Refresh: 10;url=view-pending.php');                             
        }
    }
}
?> 
<?php include('../includes/footer-bottom.php')?>