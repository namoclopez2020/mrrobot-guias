<?php 
require('includes/load.php');

$user_id=$_SESSION['user_id'];

 $current_user=find_by_id('users',$user_id);
 echo $current_user['name'];
?>