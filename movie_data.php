<?php

@include 'config.php';

if(isset($_POST['submit'])){

   $movie_name = mysqli_real_escape_string($conn, $_POST['movie_name']);
   $cast = mysqli_real_escape_string($conn, $_POST['cast']);
   $year_of_release = mysqli_real_escape_string($conn, $_POST['year_of_release']);
   $genre = mysqli_real_escape_string($conn, $_POST['genre']);
   $rating = mysqli_real_escape_string($conn, $_POST['rating']);
   $pic_link = mysqli_real_escape_string($conn, $_POST['pic_link']);

   $insert = "INSERT INTO movie_form(movie_name, cast, year_of_release, genre , rating ,pic_link) VALUES('$movie_name','$cast','$year_of_release','$genre' , '$rating' , '$pic_link')";
         mysqli_query($conn, $insert);
         header('location:admin_page.php');

 };


?>