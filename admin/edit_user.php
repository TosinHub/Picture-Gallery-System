<?php 

include("includes/header.php");
        if(!$session->is_signed_in()) {redirect("login.php");}


$user = UserClass::find_by_id($_GET['id']);
$photo = new ImageClass();
$message = "";
if(isset($_POST['submit'])){
    
    $user->username = $_POST['username'];
    $user->last_name = $_POST['last_name'];
    $user->first_name = $_POST['first_name'];
    $user->password = $_POST['password']; 
    if(empty($_FILES['user_image']['name'])){
          if($user->save())
   redirect("users.php");
    }elseif($photo->upload_image($_FILES['user_image'])){
           $user->user_image = $_FILES['user_image']['name'];
             if($user->save())
             redirect("users.php");
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
                          EDIT USER
                            <small>Subheading</small>
                        </h1>     <?php echo $message ?>
                        <form action="" method="post" enctype="multipart/form-data">
                        <div class="col-md-5 user_image_box">

                       
                             <a href="#" data-toggle="modal" data-target="#photo-modal"><img class="img-responsive" src="<?php echo $user->picture_path()  ?>"></a> 
                              <br> 
                              
                        </div>


                            <div class="form-group">
                                   <label>Change Image</label>
                                <input type="file" name="user_image">
                                </div>
                        
                   <div class="col-md-5">
                       
                           

                             <div class="form-group">
                            <label for="caption">Username</label>
                            <input type="text" name="username" class="form-control" value="<?php echo $user->username ?>">
                        </div>
                        <div class="form-group">
                            <label for="caption">First Name</label>
                            <input type="text" name="first_name" class="form-control" value="<?php echo $user->first_name ?>"></div>
                        <div c lass="form-group">
                            <label for="">Last Name</label>
                            <input type="text" name="last_name" class="form-control"  value="<?php echo $user->last_name ?>">
                        </div>         
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" name="password" class="form-control"  value="<?php echo $user->password ?>">
                        </div>         
                           
                                 <a id="user-id" class="btn btn-danger" href="delete_user?id=<?php echo $user->id ?>">Delete</a>
                                <input type="submit" value="Submit" name="submit" class="btn btn-primary">
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
        </div>
        <!-- /#page-wrapper -->


  <?php include("includes/photo_library_modal.php"); ?>
  <?php include("includes/footer.php"); ?>