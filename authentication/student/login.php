<?php
    $status_url = null;
    if (isset($_GET['status'])) { $status_url = $_GET['status']; }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Sprintwik - De plek waar studenten leren</title>
        <meta name="description" content="Welkom bij Sprintwik">
        <link rel="icon" type="image/svg+xml" sizes="150x150" href="../assets/img/favicon.svg">
        <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    </head>

    <?php if ($status_url === 'email-false') { ?>
        <div style="width: 100%; height: 35px; background: linear-gradient(120deg, #9F98E8, #AFF6CF); position: absolute; top: 0">
            <p style="color: #FFFFFF; font-size: 14px; text-align: center; line-height: 35px;">Het lijkt erop dat u bent vergeten uw email adres in te vullen</p>
        </div>
    <?php } else if ($status_url === 'password-false') { ?>
        <div style="width: 100%; height: 35px; background: linear-gradient(120deg, #9F98E8, #AFF6CF); position: absolute; top: 0">
            <p style="color: #FFFFFF; font-size: 14px; text-align: center; line-height: 35px;">Het lijkt erop dat u bent vergeten uw wachtwoord in te vullen</p>
        </div>
    <?php } else if ($status_url === 'login-false') { ?>
        <div style="width: 100%; height: 35px; background: linear-gradient(120deg, #9F98E8, #AFF6CF); position: absolute; top: 0">
            <p style="color: #FFFFFF; font-size: 14px; text-align: center; line-height: 35px;">Login mislukt</p>
        </div>
    <?php } else if ($status_url === 'register-true') { ?>
        <div style="width: 100%; height: 35px; background: linear-gradient(120deg, #9F98E8, #AFF6CF); position: absolute; top: 0">
            <p style="color: #FFFFFF; font-size: 14px; text-align: center; line-height: 35px;">U bent geregistreerd. Log nu in</p>
        </div>
    <?php } ?>

    <body>
        <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-9 col-lg-12 col-xl-10">
                        <div class="card shadow-lg o-hidden border-0 my-5">
                            <div class="card-body p-0">
                                <div class="row">
                                    <div class="col-lg-6 d-none d-lg-flex">
                                        <div class="flex-grow-1 bg-login-image" style="background: url(../assets/img/login.jpg) center / cover no-repeat;"></div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="p-5">
                                            <div class="text-center">
                                                <h4 class="text-dark mb-4">Welkom student</h4>
                                            </div>
                                            <form class="user" action="../../source/student/login.php" method="POST">
                                                <div class="form-group"><input class="form-control form-control-user" type="email" id="email" aria-describedby="email" placeholder="Vul uw email adres in" name="email"></div>
                                                <div class="form-group"><input class="form-control form-control-user" type="password" id="password" placeholder="Vul uw wachtwoord in" name="password"></div>
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox small">
                                                        <div class="form-check"><input class="form-check-input custom-control-input" type="checkbox" id="formCheck-1"><label class="form-check-label custom-control-label" for="formCheck-1">Onthoud mij</label></div>
                                                    </div>
                                                </div><button class="btn btn-primary btn-block text-white btn-user" type="submit" style="background: linear-gradient(120deg, #9F98E8, #AFF6CF);border: none;">Login</button>
                                                <hr>
                                            </form>
                                            <div class="text-center"><a class="small" href="forgot.php">Wachtwoord vergeten</a></div>
                                            <div class="text-center"><a class="small" href="register.php">Maak een account</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="../assets/js/jquery.min.js"></script>
        <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
        <script src="../assets/js/theme.js"></script>
    </body>
</html>
