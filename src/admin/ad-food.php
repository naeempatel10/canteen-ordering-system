<?php
include('../../includes/admin-navbar.php');
if(!isset($_SESSION['sadmin'])){
    header('Location: ../../src/index.php');
}
ob_start();
?>
        <div id="page-content-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <h2>Add A Food Item</h2>
                        <form action="ad-food.php" method="POST" enctype="multipart/form-data">
                          <div class="form-group">
                            <label style="margin-top:5px;"><strong>Food Name</strong></label><br>
                            <input class="form-control" type="text" placeholder="Enter Food Name" name="fname">
                            <label style="margin-top:5px;"><strong>Food Price</strong></label><br>
                            <input class="form-control" type="text" placeholder="Enter Food Price" name="fprice">
                            <label style="margin-top:5px;"><strong>Food Quantity</strong></label><br>
                            <input class="form-control" type="text" placeholder="Enter Food Quantity" name="fquantity">
                            <label style="margin-top:5px;"><strong>Veg/Non Veg</strong></label>
                              <select class="form-control" name="veg_nonveg">
                                 <option value="" disabled selected>Select your option</option>
                                  <option value="veg">Veg</option>
                                  <option value="nonveg">Non-Veg</option>
                              </select>
                            <label style="margin-top:5px;"><strong>Food Category</strong></label>
                                <select class="form-control" name="cat_id">
                                   <option value="" disabled selected>Select your option</option>

                                <?php 

                                if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {

                                ?>
                                  <option value="<?php echo $row['cat_id']; ?>"><?php echo $row['cat_title']; }}?></option>
                                </select><br>
                             <div class="form-group ">
                                <strong>Food image</strong><input type="file" class="form-control-file" id="exampleFormControlFile1" name="p_img1" style="margin-top:10px;margin-bottom:10px;">
                              </div>
                          </div>
                          <input type="submit" name="submit" class="btn btn-outline-success" value="Add Item">
                        </form>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <h2>Delete A Food Item</h2>
                        <form action="ad-food.php" method="POST">
                          <div class="form-group">
                            <label style="margin-top:5px;"><strong>Choose Category</strong></label>
                                <select class="form-control" name="delid">
                                   <option value="" disabled selected>Select your option</option>
                                <?php 
                                $result1=mysqli_query($db,"SELECT * FROM `food`;");
                                if ($result1->num_rows > 0) {
                                while($row = $result1->fetch_assoc()) {

                                ?>
                                  <option value="<?php echo $row['id']; ?>"><?php echo $row['food_name']; }}?></option>
                                </select><br>
                          </div>
                          <input type="submit" name="del" class="btn btn-outline-danger" value="Delete Item">
                        </form>
                    </div>

                </div>
            </div>
        </div>    
<?php
    if(isset($_POST['submit'])){
        $cat_id = $_POST['cat_id'];
        $fname = $_POST['fname'];
        $fprice = $_POST['fprice'];
        $fquantity = $_POST['fquantity'];
        $veg_nonveg = $_POST['veg_nonveg'];
        //images
        $p_img1 = $_FILES['p_img1']['name'];
        //images temp name
        $p_img1_tmpname = $_FILES['p_img1']['tmp_name'];
        if(empty($cat_id) || empty($fname) || empty($fprice) || empty($fquantity)){
            echo "<script>alert('Error: Fill All The Details.')</script>";
        }
        else{
        move_uploaded_file($p_img1_tmpname,"../../images/$p_img1");
        $result2=mysqli_query($db,"INSERT INTO `food`(`category`,`food_name`, `food_img`, `price`, `quantity`,`veg_nonveg`) VALUES ($cat_id,'$fname','$p_img1',$fprice,$fquantity,'$veg_nonveg');");
        if($result2){
            echo "<script>alert('Item Added Successfully')</script>";
            header('Refresh:0');
        }
    }
}
    if(isset($_POST['del'])){
        $delitem=$_POST['delid'];
        $result3=mysqli_query($db,"DELETE FROM `food` WHERE id=$delitem;");
        if($result3){
            echo "<script>alert('Item Deleted Successfully')</script>";
            header('Refresh:0');
        }
    }
include('../../includes/admin-footer.php');
?>
