<?php

require("init.php");
$user = new UserClass();
$photo = new PhotoClass();
if(isset($_POST['image_name'])){

   $change = $user->ajax_save_user_image($_POST['image_name'], $_POST['user_id']);



}

if(isset($_POST['photo_id'])){

    PhotoClass::display_sidebar_data($_POST['photo_id']);

}