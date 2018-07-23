<?php include("includes/header.php");
        if(!$session->is_signed_in()) {redirect("login.php");}

        $users = UserClass::find_all();


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
                         USERS
                            <small>Subheading</small>
                        </h1>
                    <a href="add_user.php" class="btn btn-primary">Add Users</a>
                    <div id="col-md-12">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Photo</th>
                                <th>Username</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php  foreach ($users as $user) : ?>
                                <tr>
                                    <td><?php echo $user->id; ?></td>
                                    <td><img class="user_image" src="<?php echo $user->picture_path()  ?>" > 
        
                                    
                                    
                                     </td>
                                    
                                    <td><?php echo $user->username; ?></td>
                                    <td><?php echo $user->first_name; ?></td>
                                    <td><?php echo $user->last_name;  ?></td>
                                    <td>  <div class="picture_link">
                                        <a href="" class="btn btn-primary">View</a>
                                        <a href="edit_user.php?id=<?php echo $user->id ?>" class="btn btn-primary">Edit</a>
                                        <a href="delete_user.php/?id=<?php echo $user->id ?>" class="btn btn-danger">Delete</a>
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