<?php include("includes/header.php");
        if(!$session->is_signed_in()) {redirect("login.php");}

        $message = "";
        if(isset($_GET['delete'])){
            $comment = CommentClass::find_by_id($_GET['id']);
           if($comment->delete()) 
           $message = "Comment deleted";

        }
        if(isset($_GET['comment'])){
            $comments = CommentClass::find_the_comments($_GET['id']);
        }else{
            $comments = CommentClass::find_all();
        }
       




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
                       Comments
                            <small>Subheading</small>
                        </h1>
                     
                  <?php if(!empty($message)):  ?>
                    <div class="alert alert-danger"><?php echo $message ?></div>

    <?php endif; ?>  
                    <div id="col-md-12">

                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                           
                                <th>Author</th>
                                <th>Comment</th>
                           
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php  foreach ($comments as $comment) : ?>
                                <tr>
                                    <td><?php echo $comment->id; ?></td>
                                  
                                    
                                    
                                     </td>
                                    
                                    <td><?php echo $comment->author; ?></td>
                                    <td><?php echo $comment->body; ?></td>
                                   
                                    <td>  <div class="picture_link">
                                        <a href="" class="btn btn-primary">View</a>
                                        <a href="comments.php?delete=delete&id=<?php echo $comment->id ?>" class="btn btn-danger">Delete</a>
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