<?php

@include 'config.php';


if(isset($_POST['submit'])){

   $rate = mysqli_real_escape_string($conn, $_POST['id']);

   $delete = "DELETE FROM movie_form WHERE id = '$rate' ";
         mysqli_query($conn, $delete);
         header('location:admin_page.php');

 };


?>