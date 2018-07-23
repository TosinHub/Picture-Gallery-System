<?php include("includes/init.php"); 
  if(!$session->is_signed_in()){
    redirect("login.php");
}

if(empty($_GET['id'])){

    redirect("../photos.php");
}

$photo = PhotoClass::find_by_id($_GET['id']);
$photo->delete_photo();
  redirect("../photos.php");


?>
