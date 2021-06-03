<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/style.css">
    <title><?php echo SITENAME; ?></title>
</head>
    <body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                <div class="card-body">
                                    <?php flash('register_success'); ?>
                                    <form action="<?php echo URLROOT.'/users/index'?>" method="post">
                                        <div class="form-floating mb-3">
                                            <input class="form-control form-control-lg <?php echo (!empty($data['email_error'])) ? 'is-invalid': ''?>"
                                                   value="<?php echo $data['email']?>" id="inputEmail" type="email" placeholder="name@example.com" name="email"/>
                                            <label for="inputEmail">Email address</label>
                                            <span class="invalid-feedback"><?php echo $data['email_error']?></span>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control form-control-lg <?php echo (!empty($data['password_error'])) ? 'is-invalid': ''?>"
                                                   value="<?php echo $data['password']?>" id="inputPassword" type="password" placeholder="Password" name="password">
                                            <label for="inputPassword">Password</label>

                                            <span class="invalid-feedback"><?php echo $data['password_error']?></span>
                                        </div>
<!--                                        <div class="form-check mb-3">-->
<!--                                            <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />-->
<!--                                            <label class="form-check-label" for="inputRememberPassword">Remember Password</label>-->
<!--                                        </div>-->
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
<!--                                            <a class="small" href="password.html">Forgot Password?</a>-->
                                            <input type="submit" value="Login " class="btn btn-success btn-block">
<!--                                            <a class="btn btn-primary" href="index.html">Login</a>-->
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="register.html">Need an account? Sign up!</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="<?php echo URLROOT; ?>/js/main.js"></script>
    <script src="<?php echo URLROOT; ?>/js/scripts.js"></script>
    </body>
</html>