<?php
include('../includes/nav-top.php');
//session_start();
if(!isset($_SESSION['id'])){
    header('Location:index.php');
}
$result1=mysqli_query($db,"SELECT * FROM `hero`;");
$result2=mysqli_query($db,"SELECT * FROM `category`;");
?>
<style>
    .bg-food{
        background-image: url(../images/bg.jpg);
    }
</style>
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">

<?php
       if($result1->num_rows>0){
           $active=0;
   while($row=$result1->fetch_assoc()){
       if($active==0){
           echo "<div class='carousel-item active'>";
       }
       else {
           echo "<div class='carousel-item'>";
       }
       $active++;    
        ?>
            <a href="http://localhost:8012/canteen-mgmt/src/menu.php?type=<?php echo $row['cat_id'];?>"><img class="d-block w-100" src="../images/<?php echo $row['image']; ?>"></a>
  <?php
    echo '</div>';
   }
       }
?>
        </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
    </div>
    <div class="container text-center">
              <br><h5>Select A Category</h5><br>
       <div class="row">
            <?php 
                    if($result2->num_rows>0){
                        while($row=$result2->fetch_assoc()){
            ?>
                <div class="col-sm-12 col-md-4">
                    <div class="card text-white bg-food mb-3" style="max-width: 18rem;">
                      <!--<div class="card-header">Fast Fries</div>-->
                      <div class="card-body">
                        <h5 class="card-title"><?php echo $row['cat_title'];?></h5>
                        <a href="menu.php?type=<?php echo $row['cat_id']; ?>" class="btn btn-success"><span class="fa fa-plus-circle fa-fw"></span> Know More</a>
                      </div>
                    </div>
                </div>
                <?php                  
                        }
                    }
           ?>
       </div>
    </div>
<?php include('../includes/footer-bottom.php')?>
