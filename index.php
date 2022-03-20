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

    <title>JSCOE Attaindance System</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="css/modern-business.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/bot1.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>


</head>
<style>
    .content-wrapper {
        background-color: #042743;
        color: white;
    }

    @media screen and (min-width: 800px) {
        .main-contain {
            margin-left: 560px;
        }
        #preview{
            height: 250px;
            width: 250px;
            margin-left: -370px;
        }
        .btns{
            margin-left: 60px;
        }
    }
    @media screen and (max-width: 800px) {
        .btns {
            margin-left: 50px;
        }
    }

</style>

<body>

    <!-- Navigation -->
    <?php include('includes/header.php'); ?>

    <?php
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://ip-api.com/json");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $resultn = curl_exec($ch);
    $resultn = json_decode($resultn);

    if ($resultn->status == 'success') {

        $location = $resultn->city;
    }
    ?>


    <?php
    $classname = $_POST['classname'];
    $sheet1 = "sheet1";
    $rollno = $_POST['rollno'];
    $password = $_POST['password'];
    $subjectname = $_POST['subjectname'];
    $date =  date("m/d/Y");
    $code = $_POST['code'];

    if (isset($_POST["submit"])) {
        $newcon = mysqli_connect("localhost", "root", "root", "$classname") or die("error in connection");
        $sql = "SELECT * from $sheet1 where rollno='" . $rollno . "'AND password='" . $password . "' ";
        $result = mysqli_query($newcon, $sql) or die("error in query");

        if(mysqli_num_rows($result)==0){
            $loginflag = 0;
        }
        else{
            $loginflag = 1;
        }


        $con = mysqli_connect("localhost", "root", "root", "attendance") or die("error in connection");

        $check = mysqli_query($con, "SELECT * from qrdata where qrtext ='$code'");

        while($data = mysqli_fetch_array($check))
        {
            if($data['qrtext'] == $code){
                $flag = 1;
            }

        }

        if ($flag == 1) {
            if ($loginflag == 1) {
                $status = "present";
                $query = "INSERT into $subjectname(Code,Date,RollNo,AttendanceStatus,Location) VALUES ('$code','$date','$rollno','$status','$location')";
                $result1 = mysqli_query($newcon, $query);
                if ($result1) {
                    echo '<script>alert("Attaindance Marked")</script>';
                } else {
                    echo '<script>alert("Something went wrong")</script>';
                }
            } else {
                echo '<script>alert("Check your credentials")</script>';
            }
        } else {
            echo '<script>alert("Code not matching")</script>';
        }
    }
    ?>


    <!-- Page Content -->

    <div class="content-wrapper">
        <br>
        <center>
            <h3 class="page-title">Mark Attaendance</h3>
        </center>
        <div class="container main-contain">
            <div class="row">
                <div class="col-md-12 ">

                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <form method="post" class="form-horizontal">

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Roll Number</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="rollno" class="form-control" placeholder="enter roll number" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Password</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="password" class="form-control" placeholder="enter password" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Class Name</label>
                                            <div class="col-sm-4">
                                                <select name="classname" class="form-control" required>
                                                    <option>Select Class</option>
                                                    <option>TE_A</option>
                                                    <option>TE_B</option>
                                                </select>
                                            </div>

                                        </div>



                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Suject Name</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="subjectname" class="form-control" placeholder="enter subject name" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-1">
                                                <input type="text" id="code" name="code" class="form-control" hidden>
                                            </div>
                                        </div>

                                        <class="form-group">
                                            <div class="col">
                                                <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
                                                <div class="col-sm-12">
                                                    <video id="preview" class="p-1 border" style="width:100%;"></video>
                                                </div>
                                            </div>
                                </div>
                                <div class="form-group my-3 btns">
                                    <div class="col-sm-8 col-sm-offset-2">
                                        <button class="btn btn-danger" type="reset">Cancel</button>
                                        <button class="btn btn-primary" name="submit" type="submit">Submit</button>
                                    </div>
                                </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br> <br><br> <br><br>
    </div>

    <script type="text/javascript">
        var scanner = new Instascan.Scanner({
            video: document.getElementById('preview'),
            scanPeriod: 5,
            mirror: false
        });
        scanner.addListener('scan', function(content) {

            content;
            document.getElementById("code").value = content;
            alert(content);
            //window.location.href=content;
        });
        Instascan.Camera.getCameras().then(function(cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
                $('[name="options"]').on('change', function() {
                    if ($(this).val() == 1) {
                        if (cameras[0] != "") {
                            scanner.start(cameras[0]);
                        } else {
                            alert('No Front camera found!');
                        }
                    } else if ($(this).val() == 2) {
                        if (cameras[1] != "") {
                            scanner.start(cameras[1]);
                        } else {
                            alert('No Back camera found!');
                        }
                    }
                });
            } else {
                console.error('No cameras found.');
                alert('No cameras found.');
            }
        }).catch(function(e) {
            console.error(e);
            alert(e);
        });
    </script>


 


    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/tether/tether.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

</body>

<?php include('includes/footer.php'); ?>

</html>