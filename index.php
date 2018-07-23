<?php include("includes/header.php"); 

$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;


$item_per_page = 2 ;

$item_total_count = PhotoClass::count_all();

$paginate = new PaginateClass($page, $item_per_page, $item_total_count);

$sql = "SELECT * FROM photos ";
$sql .="LIMIT {$item_per_page} ";
$sql .= "OFFSET {$paginate->offset()}";

$photos = PhotoClass::find_query($sql);



//$photos = PhotoClass::find_all();

?>


        <div class="row">

             <!-- Blog Entries Column -->
            <div class="col-md-12">
  <div class="thumbnails row">
        <?php foreach ($photos as $photo) {
          ?>
              
                <div class="col-xs-6 col-md-3">
                <a href="photo.php?id=<?php echo $photo->id ?>" class="thumbnail">
                <img class="picture img-responsive" src="admin/<?php echo $photo->picture_path(); ?>" alt="" width="200px" height="150px">
                </a>
                
                </div>
                
                
         


          <?php
        }  ?>
                   </div>


                   <div class="row">
                           <ul class="pager">

                                <?php if($paginate->total_page() > 1){
                                        if($paginate->has_next()){
                                           echo "<li class='next'><a href='index.php?page={$paginate->next()}'>Next</a></li>";

                                        }

                                     

                                for($i=1; $i <= $paginate->total_page() ; $i++) { 
                                        if($i == $paginate->current_page){
                                                echo   "<li class='active'><a href='index.php?page={$i}'>{$i}</a></li>";
                                        }else{
                                             echo   "<li class='inactive'><a href='index.php?page={$i}'>{$i}</a></li>";
                                        
                                        }
                                }
                                        if($paginate->has_previous()){
                                           echo "<li class='previous'><a href='index.php?page={$paginate->previous()}'>Previous</a></li>";

                                        }



                                } ?>

                               
                           </ul>
                   </div>
          
         

            </div>




            <!-- Blog Sidebar Widgets Column -->
         <!--    <div class="col-md-4">

            
                 // include("includes/sidebar.php"); ?>



        </div> -->
        <!-- /.row -->

        <?php include("includes/footer.php"); ?>
