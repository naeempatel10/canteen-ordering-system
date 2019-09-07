<?php
ob_start();
include('../includes/nav-top.php');
date_default_timezone_set('Asia/Kolkata');
$time = date("H");
if(!isset($_SESSION['id'])){
    header('Location:index.php');
}
if(isset($_GET['id'])){
    $noBreakfast=0;
    $canteenClosed=0;
    $id = $_GET['id'];
    $result=mysqli_query($db,"SELECT * FROM `food`, `category` WHERE food.category=category.cat_id AND food.id=$id"); //The query was changed from select * from food to this query in order to extract cat_title
    if($result->num_rows>0){
        if($row=$result->fetch_assoc()){
            if($row['category']==1){
                if ($time >= "12") {
                                $noBreakfast=1;
                            }
                    }
            if($time < "8" || $time > "18"){
                $canteenClosed=1;
            }            
?>
               <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-sm-6"  style="margin-top:70px;">
                        <img src="../images/food/<?php echo $row['food_img']; ?>">
                    </div>
                    <div class="col-lg-6 col-sm-6"  style="margin-top:70px;">
                        <label><h1><?php echo $row['food_name']; ?></h1></label><br>
                        <label><b>Category: </b><label><?php echo $row['cat_title']; ?> <a href="menu.php?type=<?php echo $row['cat_id']; ?>">(View More)</a></label></label><br>
                        <label><b>Veg/Non Veg: </b><?php
                            if(($row['veg_nonveg'])=='veg'){
                                echo '<label style="color:green">'.$row['veg_nonveg'].'</label>';
                            }
                             else{
                                echo '<label style="color:red">'.$row['veg_nonveg'].'</label>';
       
                                }
                            ?></label><br>
                        <label><b>Price: </b>Rs.<?php echo $row['price']; ?> Per <?php echo $row['cat_title']; ?></label><br>
                        <label><b>Quantity Left: </b><?php 
                                        if($row['quantity'] <= 5 ){ echo '<label style="color:red">'.$row['quantity']."</label>";
                                        }
                                        else{
                                            echo '<label style="color:green">'.$row['quantity']."</label>";
                                        }
                            ?></label><br>
                            <form action="" method="POST">
                                <label><b>Enter Quantity: </b></label><input type="number" class="form-inline" name="quantity" value="1" min="1" max="<?php echo $row['quantity'];?>" style="text-align:center;">
                                <?php if($noBreakfast==1){
                                echo '<p style="color:red; margin-top:10px;">'.$row['food_name'].' only available till 12 PM.</p>';
                                }
                                elseif($canteenClosed==1){
                                echo '<p style="color:red; margin-top:10px;">Canteen Closed. Canteen Is Open From 8 A.M. to 6 P.M.</p>';
                                }
                                    else{?>
                                <input type="submit" class="btn btn-outline-success btn-lg" style="margin-top:25px; margin-bottom: 30px;" value="Add To Cart" name="cart">
                                <?php } ?>
                            </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-sm-12 text-center">
                        <h1>Food Review</h1>
                        <p>How Would You Rate <b><?php echo $row['food_name']; ?></b> On A Scale Of 1-5? Your Review Is Final, So Be Careful.</p>
                        <form action="" method="POST">
                            <div class="form-group">
                              <select class="form-control" name="rating">
                                    <option value="" disabled selected>Select your option</option>
                                    <option value="1">1 - I Hate It</option>
                                    <option value="2">2 - It's Okay-ish</option>
                                    <option value="3">3 - It's Average</option>
                                    <option value="4">4 - I Like It</option>
                                    <option value="5">5 - I Love It</option>
                              </select>
                            </div>
                            <input type="submit" class="btn btn-outline-success btn-lg" style="margin-bottom: 15px;" value="Rate" name="rate">
                        </form>
                        <p>Based Upon Our Student's Rating, <b><?php echo $row['food_name']; ?></b> Has An Average Rating Of</p>
<?php
        //php to calculate the average of the rating
        $result6=mysqli_query($db,"SELECT AVG(`rating`) FROM `reviews` WHERE food_id=$id");
        if($result6->num_rows>0){
            if($row=$result6->fetch_assoc()){
                $avgRating= $row['AVG(`rating`)'];
            }
        }
?>
                        <h1><?php echo round($avgRating,2);//rouding off the decimal to 2 decimal places  ?></h1>
                    </div>
                </div>
            </div>
            
<?php        }
        }
    //code for when add to cart is pressed
$userid = $_SESSION['id'];
if(isset($_POST['cart'])){
    $qty = $_POST['quantity'];
    $result2=mysqli_query($db,"INSERT INTO `cart`(`food_id`, `food_quantity`, `user_id`) VALUES ($id,$qty,$userid)");
    $result3=mysqli_query($db,"UPDATE `food` SET `quantity`= `quantity` - $qty WHERE `id`=$id");
    header('Location: cart.php');
        }
if(isset($_POST['rate'])){
    if(isset($_POST['rating'])){ //this is done if the user clicks on rate button with "select your option" selected.
        $rating=$_POST['rating'];
        $result4=mysqli_query($db,"SELECT * FROM `reviews` WHERE food_id=$id AND user_id=$userid");
        if($result4->num_rows>0){
            if($row=$result4->fetch_assoc()){
                //do nothing as the user has already given his/her review.
                echo '<div class="alert alert-danger" role="alert">
                        You Have Already Given A Rating Of '.$row['rating'].' '.'To This Food Item.
                       </div>';
            }

        }
        else{
                $result5=mysqli_query($db,"INSERT INTO `reviews`(`food_id`, `rating`, `user_id`) VALUES ($id,$rating,$userid)");
                header("Refresh:0");
        }
    }
}
  } // end of outer if
else{//if no id is provided, simply redirect to menu page
    header('Location: menu.php');
}
include('../includes/footer-bottom.php')?>