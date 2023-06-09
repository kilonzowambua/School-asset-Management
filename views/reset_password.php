<?php include('../helpers/auth.php'); ?>
<!DOCTYPE html>
<html lang="en">
<?php $page = 'Reset Password'; ?>
<?php include('../partials/head.php'); ?>

<body class="fix-menu">

    <div class="theme-loader">
        <div class="ball-scale">
            <div class='contain'>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
            </div>
        </div>
    </div>

    <section class="login-block">

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">

                    <form method="Post" class="md-float-material form-material">

                        <div class="auth-box card">
                            <div class="card-block">
                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                        <h3 class="text-left">Recover your password</h3>
                                    </div>
                                </div>
                                <div class="form-group form-primary">
                                    <input type="text" name="staff_no" class="form-control" required="" placeholder="Your Staff No">
                                    <span class="form-bar"></span>
                                </div>
                                <div class="form-group form-primary">
                                    <input type="email" name="staff_email" class="form-control" required="" placeholder="Your Email Address">
                                    <span class="form-bar"></span>
                                </div>
                                <div class="form-group form-primary">
                                    <input type="password" name="staff_password" class="form-control" required="" placeholder="New Password">
                                    <span class="form-bar"></span>
                                </div>
                                <div class="form-group form-primary">
                                    <input type="password" name="staff_confirmation_password" class="form-control" required="" placeholder="Confirm Password">
                                    <span class="form-bar"></span>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" name="reset_password" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Reset
                                            Password</button>
                                    </div>
                                </div>
                                <p class="f-w-600 text-right">Back to <a href="login">Login.</a></p>
            
                            </div>
                        </div>
                    </form>

                </div>

            </div>

        </div>

    </section>


    <?php include('../partials/script.php') ?>


</body>


</html>