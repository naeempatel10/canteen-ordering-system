<?php
//issues to be fix : if i add a burger and then add the same burger and remove 1 of the burger than both are getting deleted.
include('../includes/nav-top.php');
if(!isset($_SESSION['id'])){
    header('Location:index.php');
}
?>
<style>

    .table>tbody>tr>td, .table>tfoot>tr>td{
    vertical-align: middle;
}
@media screen and (max-width: 600px) {
    table#cart tbody td .form-control{
		width:20%;
		display: inline !important;
	}
	.actions .btn{
		width:36%;
		margin:1.5em 0;
	}
	
	.actions .btn-info{
		float:left;
	}
	.actions .btn-danger{
		float:right;
	}
	
	table#cart thead { display: none; }
	table#cart tbody td { display: block; padding: .6rem; min-width:320px;}
	table#cart tbody tr td:first-child { background: #333; color: #fff; }
	table#cart tbody td:before {
		content: attr(data-th); font-weight: bold;
		display: inline-block; width: 8rem;
	}
	
	
	
	table#cart tfoot td{display:block; }
	table#cart tfoot td .btn{display:block;}
	
}

</style>
<div class="container">
    <h1>My cart</h1>
        <table id="cart" class="table table-hover table-condensed">
                        <thead>
                            <tr>
                                <th style="width:50%">Food</th>
                                <th style="width:10%">Price</th>
                                <th style="width:10%">Quantity</th>
                                <th style="width:10%" class="text-center">Subtotal</th>
                                <th style="width:10%">Actions</th>
                            </tr>
                        </thead>
                <?php
                $userid= $_SESSION['id'];
                $result=mysqli_query($db,"SELECT * FROM `cart`, `food` WHERE cart.food_id= food.id AND cart.user_id=$userid;");
                $total=0; // used for displaying the total price at the bottom
                if($result->num_rows>0){
                    $_SESSION['cartDetail']=array(); //to store entire cart detail so that we can use it later in pending_order table for admin-panel.
                    while($row=$result->fetch_assoc()){
            ?>
                        <tbody>
                            <tr>
                                <td data-th="Product">
                                    <div class="row">
                                        <div class="col-sm-2 hidden-xs"><br><img src="../images/food/<?php echo $row['food_img']; ?>" alt="" class="img-responsive" width="100%"/></div>
                                        <div class="col-sm-10">
                                            <h4 style="margin-left:20px;"><br><a href="food-detail.php?id=<?php echo $row['food_id']; ?>" style="text-decoration: none;"><?php echo $row['food_name']; ?></a></h4>
                                        </div>
                                    </div>
                                </td>
                                <td data-th="Price"><br>Rs. <?php $price=$row['price']; echo $price; ?></td>
                                        <td data-th="Quantity"><br>
                                            <input type="number" name="quantity" class="form-control text-center" value="<?php $fquantity=$row['food_quantity']; echo $fquantity; ?>" min="1" max="<?php echo $row['quantity'];?>" disabled>
                                        </td>
                                        <td data-th="Subtotal" class="text-center"><?php
                                            $sub_total= ($price * $fquantity);
                                            echo '<br>Rs. '.$sub_total;
                                            $total = $total+ $sub_total;
                                            ?>
                                        </td>
                                        <td class="actions">
                                            <a class="btn btn-danger btn-sm" href="../CRUD/delete.php?id=<?php echo $row['food_id']?>&q=<?php echo $fquantity;?>&c=<?php echo $row['cart_id']; ?>">Remove Item</a>
                                        </td>
                            </tr>
                        </tbody>
        <?php 
                        $_SESSION['cartDetail'][] = array("fid" => $row['food_id'],"fq" => $fquantity,"subtotal" => $sub_total);
                    }
                    $_SESSION['total']= $total;
                    //This was just an example. Now push everything into a single array. ie foodname,price,quanitity etc and store it. then refer here to insert into pending_order table for admin panel. /* https://stackoverflow.com/questions/7746720/inserting-a-multi-dimensional-php-array-into-a-mysql-database */
                }
            else{
                echo '</table><br><h1 class="text-center">No Item In The Cart</h1>';
                echo '<a href="menu.php" class="btn btn-warning"><i class="fa fa-angle-left"></i> Check Menu</a>';
            }
            if($total==0){ //if the total is 0, unset the $_SESSION['total']. This is done because in th checkout page, I am calling this variable to display the total price. If say in the cart page, the user adds an item that means the $_SESSION['total'] is now set, and after adding the item, the user deletes the item. so, now his cart is empty but the the $_SESSION['total'] is still set, and then if user manually enters the checkout.php link in the browser, in the total column, it will still display the value of $_SESSION['total'] which is def wrong. so what i'll do is unset the variable here if $total is 0.
                unset($_SESSION['total']);
                
            }
            
            if($result->num_rows>0){
            ?>
                        <tfoot>
                            <tr>
                                <td><a href="menu.php" class="btn btn-warning"><i class="fa fa-angle-left"></i> Check Menu</a></td>
                                <td colspan="2" class="hidden-xs"></td>
                                <td class="hidden-xs text-center"><strong>Total Rs. <?php echo $total; ?></strong></td>
                                <td><a href="checkout.php" class="btn btn-success btn-block">Checkout <i class="fa fa-angle-right"></i></a></td>
                            </tr>
                        </tfoot>
                        <?php } ?>
                    </table>
</div>
<?php
include('../includes/footer-bottom.php')?>
