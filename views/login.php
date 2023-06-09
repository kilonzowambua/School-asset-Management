<?php include('../helpers/auth.php'); ?>
<!DOCTYPE html>
<html lang="en">
<?php $page = 'Login'; ?>
<?php include('../partials/head.php') ?>

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

        <div class="container">
            <div class="row">
                <div class="col-sm-12">

                    <form class="md-float-material form-material" method="post">
                        <div class="text-center">

                        </div>
                        <div class="auth-box card">
                            <div class="card-block">
                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                        <h3 class="text-center">Sign In</h3>
                                    </div>
                                </div>

                                <div class="form-group form-primary">
                                    <input type="text" name="staff_email" class="form-control" required="" placeholder="Your Email Address">
                                    <span class="form-bar"></span>
                                </div>
                                <div class="form-group form-primary">
                                    <input type="password" name="staff_password" class="form-control" required="" placeholder="Password">
                                    <span class="form-bar"></span>
                                </div>
                                <div class="row m-t-25 text-left">
                                    <div class="col-12">
                                        
                                        <div class="forgot-phone text-right f-right">
                                            <a href="reset_password" class="text-right f-w-600"> Forgot
                                                Password?</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-t-30">
                                    <div class="col-md-12">
                                        <button type="submit" name="login" class="btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20">
                                            Sign in </button>
                                    </div>
                                </div>


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