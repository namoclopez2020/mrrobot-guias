<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(3);

  if(isset($_GET['id'])){
    $correlativo=$_GET['id'];
    $sql="select * from registro where correlativo='$correlativo'";
    $query=$db->query($sql);
    $count=$db->num_rows($query);
    if($count>0){
        
    }else{
      redirect("status_equipo.php",false);
    }
  }else{

  }
?>
