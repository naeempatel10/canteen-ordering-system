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
                        <h2>Add A Banner</h2>
                        <form action="ad-hero.php" method="POST" enctype="multipart/form-data">
                          <div class="form-group">
                            <label style="margin-top:5px;"><strong>Choose Category</strong></label>
                                <select class="form-control" name="cat_id">
                                <option value="" disabled selected>Select your option</option>
                                <?php 

                                if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {

                                ?>
                                  <option value="<?php echo $row['cat_id']; ?>"><?php echo $row['cat_title']; }}?></option>
                                </select><br>
                             <div class="form-group ">
                                <strong>Banner image</strong><input type="file" class="form-control-file" id="exampleFormControlFile1" name="p_img1" style="margin-top:10px;margin-bottom:10px;">
                              </div>
                          </div>
                          <input type="submit" name="submit" class="btn btn-outline-success" value="Add Banner">
                        </form>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <h2>Delete A Banner</h2>
                        <form action="ad-hero.php" method="POST" enctype="multipart/form-data">
                          <div class="form-group">
                            <label style="margin-top:5px;"><strong>Choose Category</strong></label>
                                <select class="form-control" name="del_cat_id">
                                <option value="" disabled selected>Select your option</option>
                                <?php 
                                $result1=mysqli_query($db,"SELECT * FROM `hero`, `category` WHERE hero.cat_id = category.cat_id;");
                                if ($result1->num_rows > 0) {
                                while($row = $result1->fetch_assoc()) {

                                ?>
                                  <option value="<?php echo $row['cat_id']; ?>"><?php echo $row['cat_title']; }}?></option>
                                </select><br>
                          </div>
                          <input type="submit" name="del_submit" class="btn btn-outline-danger" value="Delete Banner">
                        </form>
                    </div>

                </div>
            </div>
        </div>    
    <?php echo '</div>'; //end of wrapper of admin-navbar ?>
<?php
    if(isset($_POST['submit'])){
            $cat_id = $_POST['cat_id'];
            //images
            $p_img1 = $_FILES['p_img1']['name'];
            //images temp name
            $p_img1_tmpname = $_FILES['p_img1']['tmp_name'];
        if(empty($cat_id) || empty($p_img1)){
            echo "<script>alert('Error: Fill All The Details.')</script>";
        }
        else{
        move_uploaded_file($p_img1_tmpname,"../../images/hero/$p_img1");
        $result2=mysqli_query($db,"INSERT INTO `hero`(`image`,`cat_id`) VALUES ('$p_img1',$cat_id);");
        if($result2){
            echo "<script>alert('Banner Added Successfully')</script>";
            header('Refresh:0');
        }
    }
}
    if(isset($_POST['del_submit'])){
        $cat_id = $_POST['del_cat_id'];
        $result2=mysqli_query($db,"DELETE FROM `hero` WHERE `cat_id` = $cat_id;");
        if($result2){
            echo "<script>alert('Banner Deleted Successfully')</script>";
            header('Refresh:0');
        }
    }
include('../../includes/admin-footer.php');
?>