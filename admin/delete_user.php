<?php include("includes/init.php"); 
  if(!$session->is_signed_in()){
    redirect("login.php");
}

if(empty($_GET['id'])){

    redirect("../users.php");
}

$user = userClass::find_by_id($_GET['id']);
$user->delete();
  redirect("../users.php");


?>
