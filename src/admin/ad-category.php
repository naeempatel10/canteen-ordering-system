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
                        <h2>Add A Category</h2>
                        <form action="ad-category.php" method="POST">
                          <div class="form-group">
                            <label style="margin-top:5px;"><strong>Category Name</strong></label><br>
                            <input class="form-control" type="text" placeholder="Enter Category" name="catname">
                          </div>
                          <input type="submit" name="add" class="btn btn-outline-success" value="Add Category">
                        </form>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <h2>Delete A Category</h2>
                        <form action="ad-category.php" method="POST">
                          <div class="form-group">
                            <label style="margin-top:5px;"><strong>Choose Category</strong></label>
                                <select class="form-control" name="del_cat">
                                <option value="" disabled selected>Select your option</option>
                                <?php 
                                $result1=mysqli_query($db,"SELECT * FROM `category`;");
                                if ($result1->num_rows > 0) {
                                while($row = $result1->fetch_assoc()) {

                                ?>
                                  <option value="<?php echo $row['cat_id']; ?>"><?php echo $row['cat_title']; }}?></option>
                                </select><br>
                          </div>
                          <input type="submit" name="del_submit" class="btn btn-outline-danger" value="Delete Category">
                        </form>
                    </div>

                </div>
            </div>
        </div>    
    <?php echo '</div>'; //end of wrapper of admin-navbar ?>
<?php
    if(isset($_POST['add'])){
            $catname = $_POST['catname'];
        if(empty($catname)){
            echo "<script>alert('Error: Fill All The Details.')</script>";
        }
        else{
        $result2=mysqli_query($db,"INSERT INTO `category`(`cat_title`) VALUES ('$catname');");
        if($result2){
            echo "<script>alert('Category Added Successfully')</script>";
            header('Refresh:0');
        }
    }
}
    if(isset($_POST['del_submit'])){
        $cat_id = $_POST['del_cat'];
        $result2=mysqli_query($db,"DELETE FROM `category` WHERE `cat_id` = $cat_id;");
        if($result2){
            echo "<script>alert('Category Deleted Successfully')</script>";
            header('Refresh:0');
        }
    }
include('../../includes/admin-footer.php');
?>