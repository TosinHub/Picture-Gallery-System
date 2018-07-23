<?php 

include("includes/header.php");
        if(!$session->is_signed_in()) {redirect("login.php");}



$message = "";
if(isset($_POST['submit'])){
    $user = new UserClass();
    $photo = new ImageClass();
    $user->username = $_POST['username'];
    $user->last_name = $_POST['last_name'];
    $user->first_name = $_POST['first_name'];
    $user->password = $_POST['password'];
 

    if($photo->upload_image($_FILES['user_image'])){
           $user->user_image = $_FILES['user_image']['name'];
            $user->save();
    }else{
         $message = join("<br>", $photo->errors);
        echo $message;
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
                            <label for="caption">Username</label>
                            <input type="text" name="username" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label for="caption">First Name</label>
                            <input type="text" name="first_name" class="form-control"></div>
                        <div c lass="form-group">
                            <label for="">Last Name</label>
                            <input type="text" name="last_name" class="form-control">
                        </div>         
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>         

                                <div class="form-group">
                                <input type="file" name="user_image">
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