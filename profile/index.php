<?php
    namespace Sprintwik;
    use Sprintwik as Sprintwik;
    $configuration = parse_ini_file("{$_SERVER['DOCUMENT_ROOT']}/source/configuration/config.ini");
    include("{$_SERVER['DOCUMENT_ROOT']}/source/php/profile.php");

    if (!isset($_SESSION['email'])) {
        header('Location: ' . $configuration['root'] . 'authentication/student/login.php'); exit();
    } else { ?>
    
        <?php $response = \Sprintwik\profile::select_settings(); ?>

        <!DOCTYPE html>
        <html>
            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
                <title>Sprintwik - De plek waar studenten leren</title>
                <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
                <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
                <link rel="stylesheet" href="assets/css/styles.min.css">
                <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
            </head>

            <body id="page-top">
                <div id="wrapper">
                    <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0" style="background: linear-gradient(90deg , #9F98E8, #AFF6CF);">
                        <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                                <div class="sidebar-brand-icon"><i class="fas fa-landmark"></i></div>
                                <div class="sidebar-brand-text mx-3"><span>Sprintwik</span></div>
                            </a>
                            <hr class="sidebar-divider my-0">
                            <ul class="navbar-nav text-light" id="accordionSidebar"></ul>
                            <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
                        </div>
                    </nav>

                    <div class="d-flex flex-column" id="content-wrapper">
                        <div id="content">
                            <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                                <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle mr-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                                    <form class="form-inline d-none d-sm-inline-block mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                                        <div class="input-group"><input class="bg-light form-control border-0 small" type="text" placeholder="Zoeken">
                                            <div class="input-group-append"><button class="btn btn-primary py-0" type="button" style="background: linear-gradient(90deg  , #9F98E8, #AFF6CF);border: none;"><i class="fas fa-search"></i></button></div>
                                        </div>
                                    </form>
                                    <ul class="navbar-nav flex-nowrap ml-auto">
                                        <li class="nav-item dropdown d-sm-none no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-toggle="dropdown" href="#"><i class="fas fa-search"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right p-3 animated--grow-in" aria-labelledby="searchDropdown">
                                                <form class="form-inline mr-auto navbar-search w-100">
                                                    <div class="input-group"><input class="bg-light form-control border-0 small" type="text" placeholder="Search for ...">
                                                        <div class="input-group-append"><button class="btn btn-primary py-0" type="button"><i class="fas fa-search"></i></button></div>
                                                    </div>
                                                </form>
                                            </div>
                                        </li>
                                        <li class="nav-item dropdown no-arrow mx-1"></li>
                                        <li class="nav-item dropdown no-arrow">
                                            <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-toggle="dropdown" href="#"><span class="d-none d-lg-inline mr-2 text-gray-600 small"><?php echo $response[0]['first_name'] . ' ' . $response[0]['last_name']; ?></span><img class="border rounded-circle img-profile" src="data: image/png;base64, <?php echo $response[0]['profile_picture']; ?>" style="height: 32px;width: 32px; object-fit: cover;"></a>
                                                <div class="dropdown-menu shadow dropdown-menu-right animated--grow-in"><a class="dropdown-item" href="#"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Profiel</a><a class="dropdown-item" href="#"><i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Insellingen</a><a class="dropdown-item" href="#"><i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Activiteiten</a>
                                                    <div class="dropdown-divider"></div><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Uitloggen</a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </nav>
                            <div class="container-fluid">
                                <h3 class="text-dark mb-4" style="color: #808080 !important;">Sprintwik profiel</h3>
                                <div class="row mb-3">
                                    <div class="col-lg-4">
                                        <div class="card mb-3 shadow">
                                            <div class="card-header py-3">
                                                <p class="text-primary m-0 font-weight-bold" style="color: #808080 !important;">Profiel en header</p>
                                            </div>
                                            <form action="../source/php/profile.php?profile_picture=true" enctype="multipart/form-data" method="post">
                                                <div class="card-body text-center justify-content-center d-flex">
                                                    <div style="height: 160px; width: 160px" class="mb-5">
                                                        <img class="rounded-circle mt-4" src="data: image/png;base64, <?php echo $response[0]['profile_picture']; ?>" width="160" height="160" style="object-fit: cover;">
                                                        <label class="d-flex d-sm-flex d-md-flex d-lg-flex d-xl-flex justify-content-center align-items-center justify-content-sm-center align-items-sm-center justify-content-md-center align-items-md-center justify-content-lg-center align-items-lg-center justify-content-xl-center align-items-xl-center" style="transform: translate3d(75%, -100%, 0); width: 28px;height: 28px;border-radius: 50%;background: linear-gradient( 120deg , #9F98E8, #AFF6CF);"><i class="icon ion-android-image d-flex d-sm-flex d-md-flex d-lg-flex d-xl-flex justify-content-center align-items-center justify-content-sm-center align-items-sm-center justify-content-md-center align-items-md-center justify-content-lg-center align-items-lg-center justify-content-xl-center align-items-xl-center" style="height: 25px;width: 25px;color: rgb(255,255,255);cursor: pointer;"></i>
                                                            <input name="file" id="file" type="file" style="display: none;"/>
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="card-footer text-center">
                                                    <div><button class="btn btn-primary btn-sm" type="submit" style="background: linear-gradient( 120deg , #9F98E8, #AFF6CF);border: none;">Opslaan</button></div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="card mb-3 shadow" style="border-top: none">
                                            <form action="../source/php/profile.php?header_picture=true" enctype="multipart/form-data" method="post">
                                                <div class="card-body text-center justify-content-center d-flex">
                                                    <div style="height: 160px; width: 160px" class="mb-5">
                                                        <img class="rounded-circle mt-4" src="data: image/png;base64, <?php echo $response[0]['header_picture']; ?>" width="160" height="160" style="object-fit: cover;">
                                                        <label class="d-flex d-sm-flex d-md-flex d-lg-flex d-xl-flex justify-content-center align-items-center justify-content-sm-center align-items-sm-center justify-content-md-center align-items-md-center justify-content-lg-center align-items-lg-center justify-content-xl-center align-items-xl-center" style="transform: translate3d(75%, -100%, 0); width: 28px;height: 28px;border-radius: 50%;background: linear-gradient( 120deg , #9F98E8, #AFF6CF);"><i class="icon ion-android-image d-flex d-sm-flex d-md-flex d-lg-flex d-xl-flex justify-content-center align-items-center justify-content-sm-center align-items-sm-center justify-content-md-center align-items-md-center justify-content-lg-center align-items-lg-center justify-content-xl-center align-items-xl-center" style="height: 25px;width: 25px;color: rgb(255,255,255);cursor: pointer;"></i>
                                                            <input name="file" id="file" type="file" style="display: none;"/>
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="card-footer text-center">
                                                    <div><button class="btn btn-primary btn-sm" type="submit" style="background: linear-gradient( 120deg , #9F98E8, #AFF6CF);border: none;">Opslaan</button></div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="col-lg-8">
                                        <div class="row">
                                            <div class="col">
                                                <div class="card shadow mb-3">
                                                    <div class="card-header py-3">
                                                        <p class="text-primary m-0 font-weight-bold" style="color: #808080 !important;">Gebruiker instellingen</p>
                                                    </div>
                                                    <form action="../source/php/profile.php?user_settings=true" enctype="multipart/form-data" method="post">
                                                        <div class="card-body">
                                                            <div class="form-row">
                                                                <div class="col">
                                                                    <div class="form-group"><label for="email" style="color: #808080 !important;"><strong>Email adres</strong><br></label><input style="border-radius: 20px !important;" class="form-control placeholder" type="text" id="email" placeholder="<?php echo $response[0]['email']; ?>" name="email"></div>
                                                                </div>
                                                                <div class="col">
                                                                    <div class="form-group"><label for="password" style="color: #808080 !important;"><strong>Wachtwoord</strong><br></label><input style="border-radius: 20px !important;" class="form-control placeholder" type="password" id="password" placeholder="Vul uw wachtwoord in" name="password"></div>
                                                                </div>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="col">
                                                                    <div class="form-group"><label for="first_name" style="color: #808080 !important;"><strong>Voornaam</strong><br></label><input style="border-radius: 20px !important;"  class="form-control placeholder" type="text" id="first_name" placeholder="<?php echo $response[0]['first_name']; ?>" name="first_name"></div>
                                                                </div>
                                                                <div class="col">
                                                                    <div class="form-group"><label for="last_name" style="color: #808080 !important;"><strong>Achternaam</strong><br></label><input style="border-radius: 20px !important;" class="form-control placeholder" type="text" id="last_name" placeholder="<?php echo $response[0]['last_name']; ?>" name="last_name"></div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="card-footer">
                                                            <div><button class="btn btn-primary btn-sm" type="submit" style="background: linear-gradient( 120deg , #9F98E8, #AFF6CF);border: none;">Opslaan</button></div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="card shadow">
                                                    <div class="card-header py-3">
                                                        <p class="text-primary m-0 font-weight-bold" style="color: #808080 !important;">Contact gegevens</p>
                                                    </div>
                                                    <form action="../source/php/profile.php?contact_data=true" enctype="multipart/form-data" method="post">
                                                        <div class="card-body">
                                                            <div class="form-group"><label for="address" style="color: #808080 !important;"><strong>Woonplaats</strong><br></label><input style="border-radius: 20px !important;" class="form-control placeholder" type="text" id="address" placeholder="<?php echo $response[0]['address']; ?>" name="address"></div>
                                                            <div class="form-row">
                                                                <div class="col">
                                                                    <div class="form-group"><label for="city" style="color: #808080 !important;"><strong>Stad</strong><br></label><input style="border-radius: 20px !important;" class="form-control placeholder" type="text" id="city" placeholder="<?php echo $response[0]['city']; ?>" name="city"></div>
                                                                </div>
                                                                <div class="col">
                                                                    <div class="form-group"><label for="country" style="color: #808080 !important;"><strong>Land</strong><br></label><input style="border-radius: 20px !important;" class="form-control placeholder" type="text" id="country" placeholder="<?php echo $response[0]['country']; ?>" name="country"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-footer">
                                                            <div><button class="btn btn-primary btn-sm" type="submit" style="background: linear-gradient( 120deg , #9F98E8, #AFF6CF);border: none;">Opslaan</button></div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <footer class="bg-white sticky-footer">
                            <div class="container my-auto">
                                <div class="text-center my-auto copyright"><span style="color: #808080 !important;">Copyright © Sprintwik 2021</span></div>
                            </div>
                        </footer>
                </div>
                <script src="assets/js/jquery.min.js"></script>
                <script src="assets/bootstrap/js/bootstrap.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
                <script src="assets/js/theme.js"></script>
            </body>
        </html>
<?php } ?>
