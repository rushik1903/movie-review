<?php

@include 'config.php';

session_start();

if (!isset($_SESSION['admin_name'])) {
   header('location:login_form.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <title>admin page</title>


   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>


   <!-- custom css file link  -->
   <link rel="stylesheet" href="style.css">
   <link rel="stylesheet" href="style_search.css">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


</head>

<body>

   <div class="bg-popcorn" style="height:100vh; color:white;">
      <div class="navi-bar-admin-page">
         <div class="d-flex flex-row justify-content-start">
            <div class="heading-welcome">
               <h1>Welcome <span style="color:white; font-size:36px; color:red"><?php echo $_SESSION['admin_name'] ?></span></h1>
            </div>
            <div class="ml-auto"><a href="logout.php" class="btn btn-info btn-lg" style="text-align:right; font-size: 20px; color:white;">logout</a></div>
         </div>
      </div>
      <!-- Trigger the modal with a button -->
      <div class="buttons-top">
         <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Add Movie</button>
         <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal1">Show details</button>
         <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal2">Update details</button>
         <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal3">Delete details</button>
      </div>
      <br>
      <br>
      <!-- Modal -->
      <div class="modal fade" id="myModal" role="dialog">
         <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
               <div class="modal-header">
                  <h4 class="modal-title" style="color:black;">Add Movie Details</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
               </div>
               <div class="modal-body">
                  <div class="form-container remove-min-ht">
                     <form action="movie_data.php" method="post">
                        <div class="data" style="color: black;">
                           <input type="text" name="movie_name" required placeholder="Movie name">
                           <input type="text" name="cast" required placeholder="enter cast">
                           <input type="text" name="year_of_release" required placeholder="year of release">
                           <input type="text" name="genre" required placeholder="genre">
                           <input type="text" name="rating" required placeholder="rating">
                           <input type="text" name="pic_link" required placeholder="link">
                           <input type="submit" name="submit" value="Add new" class="form-btn">
                        </div>
                     </form>
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               </div>
            </div>
         </div>
      </div>
      <!-- My modal 1 -->
      <div class="modal fade" id="myModal1" role="dialog">
         <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
               <div class="modal-header">
                  <h4 class="modal-title" style="color:black;">Enter Movie Details</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
               </div>
               <div class="modal-body">
                  <div class="form-container remove-min-ht">
                     <form action="" method="GET">
                        <div class="input-group mb-3">
                           <input type="text" name="search" required value="<?php if (isset($_GET['search'])) {
                                                                                 echo $_GET['search'];
                                                                              } ?>" class="form-control" placeholder="Search data">
                           <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                     </form>
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               </div>
            </div>
         </div>
      </div>



      <!-- To display search results as a styled table -->

      <table class="table table-bordered">
         <tbody>
            <?php
            if (isset($_GET['search'])) {
               $filtervalues = $_GET['search'];
               $query = "SELECT * FROM movie_form WHERE CONCAT(movie_name,cast,year_of_release,genre,rating , pic_link) LIKE '%$filtervalues%' ";
               $query_run = mysqli_query($conn, $query);

               if (mysqli_num_rows($query_run) > 0) {
                  foreach ($query_run as $items) {
            ?>

                     <div style="color:white;" class="search-results">
                        <img src="<?= $items['pic_link']; ?>" class="img-grid">

                        <div class="search-item">
                           <div class="search-inner-div">
                              movie name: <?= $items['movie_name']; ?></div>
                        </div>
                        <div class="search-item">
                           <div class="search-inner-div">
                              <h9>cast: </h9><?= $items['cast']; ?>
                           </div>
                        </div>
                        <div class="search-item">
                           <div class="search-inner-div">
                              <h9> Year of release: </h9><?= $items['year_of_release']; ?>
                           </div>
                        </div>
                        <div class="search-item">
                           <div class="search-inner-div">
                              <h9>Genre: </h9><?= $items['genre']; ?>
                           </div>
                        </div>
                        <div class="search-item">
                           <div class="search-inner-div">
                              <h9> rating: </h9><?= $items['rating']; ?>
                           </div>
                        </div>
                     </div> <br>

                  <?php
                     //use your database's attributes
                  }
               } else {
                  ?>
                  <tr>
                     <td colspan="4">No Record Found</td>
                  </tr>
            <?php
               }
            }
            ?>
         </tbody>
      </table>

      <!-- Update -->
      <div class="modal fade" id="myModal2" role="dialog">
         <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
               <div class="modal-header">
                  <h4 class="modal-title" style="color:black;">update Details</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
               </div>
               <div class="modal-body">
                  <div class="form-container remove-min-ht">
                     <form action="" method="GET">
                        <div class="input-group mb-3">
                           <input type="text" name="search2" required value="<?php if (isset($_GET['search2'])) {
                                                                                 echo $_GET['search2'];
                                                                              } ?>" class="form-control" placeholder="Search data">
                           <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                     </form>
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               </div>
            </div>
         </div>
      </div>



      <!-- update details -->

      <table class="table table-bordered">
         <tbody>
            <?php
            if (isset($_GET['search2'])) {
               $filtervalues = $_GET['search2'];
               $query = "SELECT * FROM movie_form WHERE CONCAT(movie_name,cast,year_of_release,genre,rating , pic_link) LIKE '%$filtervalues%' ";
               $query_run = mysqli_query($conn, $query);

               if (mysqli_num_rows($query_run) > 0) {
                  foreach ($query_run as $items) {
            ?>

                     <form action="update_row.php" method="post">
                        <div class="update-results" style="color:black">
                           <img src="<?= $items['pic_link']; ?>" class="img-grid">
                           <div class="search-item">
                              <div class="search-inner-div">
                                 <input type="text" name="id" required value="<?= $items['id']; ?>">
                              </div>
                           </div>

                           <div class="search-item">
                              <div class="search-inner-div">
                                 <input type="text" name="movie_name" required value="<?= $items['movie_name']; ?>">
                              </div>
                           </div>

                           <div class="search-item">
                              <div class="search-inner-div">
                                 <input type="text" name="cast" required value="<?= $items['cast']; ?>">
                              </div>
                           </div>

                           <div class="search-item">
                              <div class="search-inner-div">
                                 <input type="text" name="year_of_release" required value="<?= $items['year_of_release']; ?>">
                              </div>
                           </div>
                           
                           <div class="search-item">
                              <div class="search-inner-div">
                                 <input type="text" name="genre" required value="<?= $items['genre']; ?>">
                              </div>
                           </div>

                           <div class="search-inner-div">
                                 <div class="search-item">
                                 <input type="text" name="rating" required value="<?= $items['rating']; ?>">
                              </div>
                           </div>

                           <div class="search-inner-div">
                                 <div class="search-item">
                                 <input type="text" name="pic_link" required value="<?= $items['pic_link']; ?>">
                              </div>
                           </div>
                           
                           <div class="wrapper"><input type="submit" name="submit" value="update" class="form-btn update-btn"></div>


                        </div>
                     </form>

                     <br>

                  <?php
                     //use your database's attributes
                  }
               } else {
                  ?>
                  <tr>
                     <td colspan="4">No Record Found</td>
                  </tr>
            <?php
               }
            }
            ?>
         </tbody>
      </table>


      <!-- Delete details -->


      <div class="modal fade" id="myModal3" role="dialog">
         <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
               <div class="modal-header">
                  <h4 class="modal-title" style="color:black;">Delete Details</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
               </div>
               <div class="modal-body">
                  <div class="form-container remove-min-ht">
                     <form action="" method="GET">
                        <div class="input-group mb-3">
                           <input type="text" name="search3" required value="<?php if (isset($_GET['search3'])) {
                                                                                 echo $_GET['search3'];
                                                                              } ?>" class="form-control" placeholder="Search data">
                           <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                     </form>
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               </div>
            </div>
         </div>
      </div>



      <!-- To display search results as a styled table -->

      <table class="table table-bordered">
         <tbody>
            <?php
            if (isset($_GET['search3'])) {
               $filtervalues = $_GET['search3'];
               $query = "SELECT * FROM movie_form WHERE CONCAT(movie_name,cast,year_of_release,genre,rating , pic_link) LIKE '%$filtervalues%' ";
               $query_run = mysqli_query($conn, $query);

               if (mysqli_num_rows($query_run) > 0) {
                  foreach ($query_run as $items) {
            ?>

                     <form action="delete_row.php" method="post">
                        <div class="data update-results" style="color:black">
                           <img src="<?= $items['pic_link']; ?>" class="img-grid">
                           <div class="search-item">
                              <div class="search-inner-div">
                     
                                 <input type="text" name="id" required value="Movie ID :<?= $items['id']; ?>">
                              </div>
                           </div>
                           <div class="search-item">
                              <div class="search-inner-div">
                                 <input type="text" name="movie_name" required value="Movie name: <?= $items['movie_name']; ?>">
                              </div>
                           </div>
                           <div class="search-item">
                              <div class="search-inner-div">
                                 <input type="text" name="cast" required value="Starring: <?= $items['cast']; ?>">
                              </div>
                           </div>
                           <div class="search-item">
                              <div class="search-inner-div">
                                 <input type="text" name="year_of_release" required value="Release Year: <?= $items['year_of_release']; ?>">
                              </div>
                           </div>
                           <div class="search-item">
                              <div class="search-inner-div">
                                 <input type="text" name="genre" required value="Genre: <?= $items['genre']; ?>">
                              </div>
                           </div>
                           <div class="search-item">
                              <div class="search-inner-div">
                                 <input type="text" name="rating" required value="Rating: <?= $items['rating']; ?>">
                              </div>
                           </div>
                           <div class="wrapper"><input type="submit" name="submit" value="delete" class="form-btn update-btn"></div>


                        </div>
                     </form>

                     <br>

                  <?php
                     //use your database's attributes
                  }
               } else {
                  ?>
                  <tr>
                     <td colspan="4">No Record Found</td>
                  </tr>
            <?php
               }
            }
            ?>
         </tbody>
      </table>

   </div>
</body>

</html>

<!-- <form action="delete_row.php" method="post"> 
                           <div class="data" style="color:black">
                              <div class="search-item">
                              <div class="search-inner-div">
                                 movie name:<?= $items['movie_name']; ?></div>
                              </div>
                              <input type="text" name="id" required value="<?= $items['id']; ?>">
                              <input type="text" name="movie_name" required value="<?= $items['movie_name']; ?>">
                              <input type="text" name="cast" required value="<?= $items['cast']; ?>">
                              <input type="text" name="year_of_release" required value="<?= $items['year_of_release']; ?>">
                              <input type="text" name="genre" required value="<?= $items['genre']; ?>">
                              <input type="text" name="rating" required value="<?= $items['rating']; ?>">
                              <input type="text" name="pic_link" required value="<?= $items['pic_link']; ?>">
                             <input type="submit" name="submit" value="delete" class="form-btn">


                           </div>
                        </form> -->