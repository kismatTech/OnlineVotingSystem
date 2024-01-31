<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

<!-- Check Login -->
<?php
require_once("inc/config.php");
require("inc/function.php");

if (isset($_POST['su_btn'])) {

    $response = registerUser($_POST['su_email'], $_POST['su_name'], $_POST['su_contact'], $_POST['su_password'], $_POST['con_password']);
}

if (isset($_POST['login'])) {

    $response = loginUser($_POST['email'], $_POST['password']);
}

?>

<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="asset/css/login.css">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Voting System</title>
    <link href="../assets/img/favicon.png" rel="icon">
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet">
</head>

<body>
    <!-- ======= Top Bar ======= -->
    <section id="topbar" class="d-flex align-items-center">
        <div class="container d-flex justify-content-center justify-content-md-between">
            <div class="contact-info d-flex align-items-center">
                <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:contact@eVoteshield.com">contact@eVoteshield.com</a></i>
                <i class="bi bi-phone d-flex align-items-center ms-4"><span>974-4304140</span></i>
            </div>

            <div class="cta d-none d-md-flex align-items-center">
                <a href="login.php" class="scrollto">Login</a>
            </div>
        </div>
    </section>

    <!-- ======= Header ======= -->
    <header id="header" class="d-flex align-items-center">
        <div class="container d-flex align-items-center justify-content-between">

            <div class="mh-100 logo">
                <!-- <h1><a href="index.html">eVote Shield</a></h1> -->
                <!-- Uncomment below if you prefer to use an image logo -->
                <a href="../index.html"><img src="../assets/img/evote.png" alt="eVote Shield" class="img-fluid"></a>
            </div>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto active" href="../index.html#hero">Home</a></li>
                    <li><a class="nav-link scrollto" href="../index.html#about">About</a></li>
                    <li><a class="nav-link scrollto" href="../index.html#services">Services</a></li>
                    <!-- <li><a class="nav-link scrollto " href="#portfolio">Portfolio</a></li> -->
                    <li><a class="nav-link scrollto" href="../index.html#team">Team</a></li>
                    <!-- <li><a class="nav-link scrollto" href="#pricing">Pricing</a></li> -->
                    <!-- <li><a href="blog.html">Blog</a></li> -->
                    <li><a class="nav-link scrollto" href="../index.html#contact">Contact</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">

    <div class="container">
        <div class="card card-login mx-auto text-center bg-light">
            <div class="card-header mx-auto bg-light">
                <span> <img src="asset/image/white-logo.png" class="w-50" alt="eVote Shield"> </span><br />
                <!-- <span class="logo_title mt-50"> Login Dashboard </span> -->
            </div>
            <?php
            if (isset($_GET['sign-up'])) {
            ?>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" name="su_name" class="form-control" value="<?php echo @$_POST['su_name']; ?>" placeholder="Full Name">
                        </div>

                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input type="email" name="su_email" class="form-control" value="<?php echo @$_POST['su_email']; ?>" placeholder="Your Email">
                        </div>

                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            </div>
                            <input type="tel" name="su_contact" class="form-control" value="<?php echo @$_POST['su_contact']; ?>" placeholder="Contact No">
                        </div>

                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" name="su_password" value="<?php echo @$_POST['su_password']; ?>" class="form-control" placeholder="Password">
                        </div>

                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" name="con_password" value="<?php echo @$_POST['con_password']; ?>" class="form-control" placeholder="Confirm Password">
                        </div>

                        <?php
                        if (@$response == "success") {
                        ?>
                            <p style="color: rgb(69, 255, 69);" class="success">Your registration was successful</p>
                        <?php
                        } else {
                        ?>
                            <p style="color: #ff4646;" class="error"><?php echo @$response; ?></p>
                        <?php
                        }
                        ?>

                        <div class="form-group">
                            <input type="submit" name="su_btn" value="Sign Up" class="btn btn-outline-danger float-right login_btn">
                        </div>
                        <span class="login">
                            <a href="login.php" class="btn btn-link pull-right white-text">Already Login?</a>
                        </span>


                    </form>
                </div>

            <?php
            } else {
            ?>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" name="email" class="form-control" placeholder="Email" value="<?php echo @$_POST['email']; ?>">
                        </div>

                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" name="password" class="form-control" value="<?php echo @$_POST['password']; ?>" placeholder="Password">
                        </div>
                        <!-- Displaying Error Messsage -->
                        <p style="color: #ff4646;" class="error"><?php echo @$response; ?></p>

                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <input type="submit" name="login" class="btn btn-lg btn-success btn-block" value="Sign In">
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <a href="?sign-up=1" class="btn btn-lg btn-primary btn-block">Register</a>
                            </div>
                        </div>
                        <span class="forgetpass">
                            <a href="" class="btn btn-link pull-right">Forgot Password?</a>
                        </span>
                    </form>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</body>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</html>