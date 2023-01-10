<!DOCTYPE html>
<html class="login" xml:lang="en">
<head>
    <title>Login Page</title>
    <link rel="shortcut icon" type="image/png" href="images\favicon.ico"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
          integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css\style.css">
</head>
<body class="loginbody">
<a href="homepage.php"><em class="fa fa-home"
                           style="font-size:40px;color: rgba(255, 195, 18, 0.7);margin: 20px 0 0 30px;"></em></a>
<div class="container">
    <div class="d-flex justify-content-center h-100">
        <div class="card">
            <div class="card-header">
                <h3>Admin Sign In</h3>
                <div class="d-flex justify-content-end social_icon">
                    <span onclick="javascript:location.href='https://www.facebook.com/shehab+med'"><em
                                class="fab fa-facebook-square"></em></span>
                    <span onclick="javascript:location.href='https://www.instagram.com/shi_hvb/'"><em
                                class="fab fa-instagram"></em></span>
                    <span onclick="javascript:location.href='https://twitter.com/_Shehvb_'"><em
                                class="fab fa-twitter-square"></em></span>
                </div>
            </div>
            <div class="card-body">
                <form method="post" action="">
                    <?php


                    $emailErr = "";
                    $email = "";
                    $passErr = "";

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $email = $_POST["adminemail"];
                        if (empty($_POST["adminemail"])) {
                            $emailErr = "Email is required";
                        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            $emailErr = "Invalid email format";
                        } else if (empty($_POST["adminpassword"])) {
                            $passErr = "Passsword is required";
                        } else {
                            try {
                                $pwd = $_POST['adminpassword'];

                                $host = "localhost";
                                $dbname = "placement";
                                $username = "root";
                                $password = "";

                                $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                $stmt = $conn->prepare("SELECT * FROM admin WHERE email=:email");
                                $stmt->bindParam(':email', $email);
                                $stmt->execute();
                                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                                $dbpwd = $row['password'];

                                if ($pwd == $dbpwd) {
                                    session_start();
                                    $_SESSION['name'] = $row['name'];
                                    $_SESSION['email'] = $row['email'];
                                    header("Location: admin/adminhomepage.php");
                                } else {
                                    $message = "Email or Password is incorrect";
                                    echo "<script type='text/javascript'> alert('$message'); </script>";
                                }
                            } catch (PDOException $e) {
                                echo "Error: " . $e->getMessage();
                            }
                        }
                    }
                    ?>
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><em class="fas fa-user"></em></span>
                        </div>
                        <input type="text" class="form-control" name="adminemail" placeholder="username" id="email">

                    </div>
                    <span style="color: red;"> <?php echo $emailErr; ?></span>
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><em class="fas fa-key"></em></span>
                        </div>
                        <input type="password" class="form-control" name="adminpassword" placeholder="password"
                               id="password"><em
                                style="color: rgb(0,0,0,0.5);border-radius: 0px 5px 5px 0px;padding: 10px 5px 0 5px;background-color: white;"
                                class="fa fa-eye" id="eye"></em>
                    </div>
                    <span style="color: red;"> <?php echo $passErr; ?></span>
                    <div style="color: white;font-size: 12px;">*Password should contain one number & special symbol
                    </div>
                    <br>
                    <div class="form-group">
                        <button type="submit" class="btn float-right login_btn">Admin Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    var password = document.getElementById('password');
    var eye = document.getElementById('eye');
    eye.addEventListener('click', togglePass);

    function togglePass() {
        eye.classList.toggle('active');
        (password.type == 'password') ? password.type = 'text' :
            password.type = 'password';
    }
</script>
</body>
</html>