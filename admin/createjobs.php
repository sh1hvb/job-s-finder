<!DOCTYPE html>
<html xml:lang="en">
<head>
    <title>Create Job</title>
    <link rel="shortcut icon" type="image/png" href="..\images\favicon.ico"/>
    <link rel="stylesheet" type="text/css" href="css\adminstyle.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="icon" href="..\images\favicon.ico" type="image/gif" sizes="16x16">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>

</head>
<body>

<?php
session_start();
$_SESSION['message'] = '';


$host = "localhost";
$user = "root";
$password = "";
$dbname = "placement";


$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_FILES["clogo"]) && !empty($_FILES["clogo"]["name"])) {
    $file = $_FILES["clogo"];


    $allowed_types = array("image/jpeg", "image/png", "image/gif");
    if (in_array($file["type"], $allowed_types)) {
        $target_dir = "../upload/";
        $target_file = $target_dir . basename($file["name"]);
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            $cname = $_POST['cname'];
            $csalary = $_POST['csalary'];
            $cdesc = $_POST['cdesc'];
            $cexperience = $_POST['cexperience'];
            $ccity = $_POST['ccity'];
            $clogo = $target_file;

            $query = "INSERT INTO company (cname, csalary, ccity, cdesc, cexperience, clogo) VALUES (?, ?, ?, ?, ?, ?)";


            $stmt = mysqli_prepare($conn, $query);

            mysqli_stmt_bind_param($stmt, "sissss", $cname, $csalary, $ccity, $cdesc, $cexperience, $clogo);

            // Exécution de la requête
            mysqli_stmt_execute($stmt);

            // Fermeture du statement
            mysqli_stmt_close($stmt);

            // Confirmation de l'ajout
            echo "Données ajoutées avec succès!";
        }
    } else {
        echo "Type de fichier non autorisé.";
    }
} elseif (empty($clogo)) {
    echo "Aucun fichier n'a été envoyé.";
}

// Fermeture de la connexion
mysqli_close($conn);


if (!isset($_SESSION['name'])) {
    header("Location: ../homepage.php");
}

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: ../homepage.php");
}

?>

<section class="preloader">
    <div class="spinner">
        <span class="spinner-rotate"></span>
    </div>
</section>
<header>
    <img src="../images/logo1.png" alt="#HOME" style="width: 100Px;
	height: 70px;
	float: left;
    margin: 0px 0px 0px 25px;
    opacity: 1;">
    <div class="title">Welcome to Admin Dashboard</div>
    <nav>
        <ul class="main-nav">
            <li><span style="color: #949695;"><?php echo "Welcome " . $_SESSION['name'] . "&emsp;&emsp;"; ?></span></li>
        </ul>
    </nav>
</header>
<section>

    <div style="width: 100%; height: auto;">

        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li>
                    <a href="adminhomepage.php"><em style="font-size:24px"
                                                    class="fa fa-home"></em>&emsp;Dashboard</a></i>
                </li>
                <li>
                    <a href="searchcompany.php"><em style="font-size:24px" class="fa fa-search"></em>&emsp;Search
                        Job</a>
                </li>
                <li class="active">
                    <a href="createjobs.php"><em style="font-size:24px" class="fa fa-check-circle-o"></em>&emsp;Create
                        Jobs</a>
                </li>
                <li>
                    <a href="applied-jobs.php"><em style="font-size:24px" class="fa fa-envelope-o"></em>&emsp;Job
                        Application</a>
                </li>
                <form method="post">
                    <button type="submit" name="logout" class="btn btn-info" style="margin: 10px 0 0 64px;">Logout
                    </button>
                </form>
            </ul>
        </div>


        <div class="mainpage">
            <div class="hd_title">New Job Post</div>

            <div class="main">
                <div class="createjobset">
                    <form action="createjobs.php" method="post" enctype="multipart/form-data">
                        <div class="row">

                            <div class="col-md-6 latest-job ">

                                <div class="form-group">
                                    <label for="fname">Company Name</label>
                                    <input type="text" class="form-control input-sm" name="cname"
                                           placeholder="Company Name" value="" required="">
                                </div>

                                <div class="form-group">
                                    <label for="lname">City</label>
                                    <input type="text" class="form-control input-sm" name="ccity" placeholder="City"
                                           value="" required="">
                                </div>

                                <div class="form-group">
                                    <label for="lname">Description</label>
                                    <textarea type="text" class="form-control input-sm" rows="4" name="cdesc"
                                              placeholder="Description" value="" required=""></textarea>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-flat btn-success">Create Job</button>
                                </div>
                            </div>

                            <div class="col-md-6 latest-job ">


                                <div class="form-group">
                                    <label for="contactno">Salary</label>
                                    <input type="text" class="form-control input-sm" name="csalary" placeholder="Salary"
                                           value="">
                                </div>

                                <div class="form-group">
                                    <label for="qualification">Experience</label>
                                    <input type="text" class="form-control input-sm" name="cexperience"
                                           placeholder="Experience" value="">
                                </div>

                                <div class="form-group">
                                    <label>Upload Logo</label>
                                    <input type="file" name="clogo" class="btn btn-default">
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>
<script src="../js/jquery.js"></script>
<script src="../js/custom.js"></script>
</body>

</html>