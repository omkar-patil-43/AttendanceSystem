<?php
error_reporting(0);
include('includes/config.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Government Schemes List</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="css/modern-business.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="lab.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <style>
        .navbar-toggler {
            z-index: 1;
        }

        @media (max-width: 576px) {
            nav>.container {
                width: 100%;
            }
        }

        .carousel-item.active,
        .carousel-item-next,
        .carousel-item-prev {
            display: block;
        }
    </style>

</head>

<body>
    <?php include('includes/header.php'); ?>
    <?php include('includes/config.php'); ?>
    <!-- Navigation -->
    <br>

    <div class="container">
   
        <!-- Portfolio Section -->
        <center>
            <h3 style="color: white;"><b>&#9733; Schemes Details &#9733;</b>
        </center>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.php">Home</a>
            </li>
            <li class="breadcrumb-item active">Government Schemes</li>
        </ol>
        <br>
        <div class="row">
 <?php     
 $conn=mysqli_connect("localhost","root","root","bbdms");
$records = mysqli_query($conn,"select * from scheme"); // fetch data from database


          

while($data = mysqli_fetch_array($records)){
              ?>

                    <div class="col-lg-4 col-sm-5 portfolio-item">
                        <div class="card h-100" style="border: 2px solid black;border-radius:20px;">
                            <a href="#"><img class="card-img-top img-fluid" src="fimg/logo.jpg" style="border-radius:20px;" alt=""></a>
                            <div class="card-block">
                                <h4 class="card-title"><a href="#"><?php echo $data['schemename']; ?></a></h4>
                                <p class="card-text"><b> Scheme Name :</b> <?php echo $data['schemename']; ?></p> 
                            </div>

                            <a href="data:image/pdf;charset=utf8;base64 ,<?php echo base64_encode($data['schemepdf']) ?>" download="<?php echo $data['filename']; ?>">
                            <input type="submit"  class="btn btn-primary" value="Download Details" name="submit" style="margin:10px;margin-top:-5px;">
                             </a>
                             <a href="<?php echo $data['schemelink'] ?>">
                            <input type="submit"  class="btn btn-primary" value="Read more" name="submit" style="margin:10px;margin-top:-5px;">
                             </a>
</input>
                        </div>
                    </div>
            <?php }
             ?>
        </div>
    </div>
    <!-- Footer -->

    <br><br>
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/tether/tether.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <?php include('includes/footer.php'); ?>
</body>



</html>
