<?php include("includes/header.php");
        if(!$session->is_signed_in()) {redirect("login.php");}

        $photos = PhotoClass::find_all();


?>

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
       <?php include("includes/top_nav.php") ?>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <?php include("includes/side_nav.php") ?>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

           <div class="container-fluid">

                 <!--  Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                         PHOTOS
                            <small>Subheading</small>
                        </h1>

                    <div id="col-md-12">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Photo</th>
                                <th>ID</th>
                                <th>Filename</th>
                                <th>Title</th>
                                <th>Size</th>
                                <th>Comments</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php  foreach ($photos as $photo) : ?>
                                <tr>
                                    <td> <img class="admin-photo-thumbmail" src="<?php echo $photo->picture_path()  ?>" > 
        
                                    
                                    
                                     </td>
                                    <td><?php echo $photo->id; ?></td>
                                    <td><?php echo $photo->filename; ?></td>
                                    <td><?php echo $photo->title; ?></td>
                                    <td><?php echo $photo->size;  ?></td>
                                    <td><a href="comments.php?comment=comment&id=<?php echo $photo->id; ?>" class="btn btn-primary"><?php echo count(CommentClass::find_the_comments($photo->id));  ?> Comments</a></td>
                                    <td>  <div class="picture_link">
                                        <a href="../photo.php?id=<?php echo $photo->id; ?>" class="btn btn-primary">View</a>
                                        
                                        <a href="edit_photo.php?id=<?php echo $photo->id; ?>" class="btn btn-primary">Edit</a>
                                        <a href="delete_photo.php?id=<?php echo $photo->id; ?>" class="btn btn-danger">Delete</a>
                                    </div></td>
                                   
                                </tr>

                            <?php endforeach; ?>    
                            </tbody>
                        </table>
                    </div>        





                    </div>
                </div>
                <!-- /.row -->

            </div>
        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>