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
</head>

<body>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">

    <div class="container">
        <div class="card card-login mx-auto text-center bg-dark">
            <div class="card-header mx-auto bg-dark">
                <span> <img src="asset/image/black-logo.png" class="w-50" alt="eVote Shield"> </span><br />
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