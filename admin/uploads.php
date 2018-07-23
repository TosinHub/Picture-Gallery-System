<?php 

include("includes/header.php"); 

    if(!$session->is_signed_in()){
        redirect("login.php");
}


$message = "";
if(isset($_POST['submit'])){
    $photo = new PhotoClass();
    $photo->title = $_POST['title'];
    $photo->caption = $_POST['caption'];
    $photo->alternative_text = $_POST['alternative_text'];
    $photo->description = $_POST['description'];
    $photo->set_file($_FILES['pic']);

    if($photo->save()){
        $message = "Photo uploaded successfully";
    }else{
        $message = join("<br>", $photo->errors);
    }
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
                          UPLOADS
                            <small>Subheading</small>
                        </h1>
                   <div class="col-md-5">
                            <?php echo $message ?>
                            <form action="" method="post" enctype="multipart/form-data">
                             <div class="form-group">
                            <label for="caption">Title</label>
                            <input type="text" name="title" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label for="caption">Caption</label>
                            <input type="text" name="caption" class="form-control"></div>
                        <div class="form-group">
                            <label for="">Alternative Text</label>
                            <input type="text" name="alternative_text" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea name="description" class="form-control" cols="30" rows="10"></textarea>
                        </div>           

                                <div class="form-group">
                                <input type="file" name="pic">
                                </div>
                                 
                                <input type="submit" value="Submit" name="submit" class="btn btn-primary">
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>