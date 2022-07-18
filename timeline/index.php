<?php
    namespace Sprintwik;
    use Sprintwik as Sprintwik;
    $configuration = parse_ini_file("{$_SERVER['DOCUMENT_ROOT']}/source/configuration/config.ini");
    include("{$_SERVER['DOCUMENT_ROOT']}/source/php/timeline.php");

    if (!isset($_SESSION['email'])) {
        header('Location: ' . $configuration['root'] . 'authentication/student/login.php'); exit();
    } else { ?>
    
        <?php $response = \Sprintwik\timeline::select_header(); ?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
            <title>Sprintwik - De plek waar studenten leren</title>
            <link rel="icon" type="image/svg+xml" sizes="150x150" href="assets/img/logo.svg">
            <link rel="icon" type="image/svg+xml" sizes="150x150" href="assets/img/logo.svg">
            <link rel="icon" type="image/svg+xml" sizes="150x150" href="assets/img/logo.svg">
            <link rel="icon" type="image/svg+xml" sizes="150x150" href="assets/img/logo.svg">
            <link rel="icon" type="image/svg+xml" sizes="150x150" href="assets/img/logo.svg">
            <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
            <link rel="stylesheet" href="assets/css/Eurostile.css">
            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
            <link rel="stylesheet" href="assets/css/styles.css">
            <link rel="stylesheet" href="assets/css/timeline.css">
            <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
            <script src="assets/js/jquery.min.js"></script>
        </head>

        <body>
            <div class="container">
                <nav class="navbar navbar-light navbar-expand-md" style="margin-top: 64px;padding-right: 50px;padding-left: 50px;">
                    <div class="container-fluid"><a class="navbar-brand" href="#" style="color: rgb(66,242,66);"><img src="assets/img/logo.svg" style="width: 46px;height: 46px;"></a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                        <div class="collapse navbar-collapse d-xl-flex d-lg-flex justify-content-xl-end justify-content-lg-end d-md-flex justify-content-md-end" id="navcol-1">
                            <ul class="navbar-nav">
                                <li class="nav-item"><a class="nav-link" href="#" style="font-weight: bold;color: #808080;font-size: 15px;margin-right: 15px;font-family: Roboto, sans-serif;height: 40px;">Mensen zoeken</a></li>
                                <li class="nav-item"><a class="nav-link" href="../profile/" style="background: linear-gradient( 120deg , #9F98E8, #AFF6CF);border-radius: 20px;color: #fff;padding-left: 30px;padding-right: 30px;font-family: Roboto, sans-serif;">Profiel</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="d-flex justify-content-center align-items-center" style="width: 100%;height: 66px;margin-top: 100px;"><span class="text-truncate pl-5 pr-5" style="color: #808080;font-size: 44px;font-family: Eurostile;font-weight: 650;"><?php echo $response[0]['first_name'] . ' ' . $response[0]['last_name'] ?>'s persoonlijke tijdlijn</span></div>
            <div class="d-flex justify-content-center align-items-center" style="height: 275px; margin-top: 100px; margin-bottom: 40px;">
                <div class="d-flex justify-content-center align-items-center" style="transform: rotate(-45deg);width: 275px;height: 275px;border-radius: 50%;box-shadow: inset 5px 0px #d3d3d3;"><img style="width: 256px;height: 256px;border-radius: 256px;transform: rotate(45deg); object-fit: cover;" src="data: image/png;base64, <?php echo $response[0]['profile_picture']; ?>"></div>
            </div>
            <?php if ($response[0]['city'] === 'Vul uw stad in' && $response[0]['country'] !== 'Vul uw land in') { ?>
                <div class="d-flex justify-content-center" style="margin-bottom: 150px; font-size: 14px;"><i class="fa fa-star"></i><p><?php echo $response[0]['role'] . ' - Stad onbekend, ' . $response[0]['country']; ?></p></div>
            <?php } else if ($response[0]['city'] !== 'Vul uw stad in' && $response[0]['country'] === 'Vul uw land in') { ?>
                <div class="d-flex justify-content-center" style="margin-bottom: 150px; font-size: 14px;"><p><?php echo $response[0]['role'] . ' - ' . $response[0]['city'] . ', Land onbekend' ?></p></div>
            <?php } else if ($response[0]['city'] === 'Vul uw stad in' && $response[0]['country'] === 'Vul uw land in') { ?>
                <div class="d-flex justify-content-center" style="margin-bottom: 150px; font-size: 14px;"><p><?php echo $response[0]['role'] . ' - Locatie onbekend'; ?></p></div>
            <?php } else if ($response[0]['city'] === 'Prive' || $response[0]['city'] === 'prive' || $response[0]['country'] === 'Prive' || $response[0]['country'] === 'prive') { ?>
                <div class="d-flex justify-content-center" style="margin-bottom: 150px; font-size: 14px; height: 21px;"><i style="font-size: 13px; margin-top: 4px; margin-right: 5px;" class="fa fa-star"></i><p><?php echo $response[0]['role'] . ' - Locatie prive'; ?></p></div>
            <?php } else { ?>
                <div class="d-flex justify-content-center" style="margin-bottom: 150px; font-size: 14px; height: 21px;"><i style="font-size: 13px; margin-top: 4px; margin-right: 5px;" class="fa fa-star"></i><p><?php echo $response[0]['role'] . ' - ' . $response[0]['city'] . ', ' . $response[0]['country'] ?></p></div>
            <?php }?>

            <script>
                remove_post = (upid) => {
                    $.post('<?php echo $configuration['root'] . '/source/php/timeline.php'; ?>', { upid: upid })
                    location.reload()
                }
            </script>

            <div class="container">
                <div class="timeline">
                    <div class="row no-gutters justify-content-end justify-content-md-around align-items-start timeline-nodes">
                        <div class="justify-content-xl-center align-items-xl-center col-10 col-md-5 order-3 order-md-1 timeline-content" style="border-radius: 10px;"><img style="width: 100%;height: 128px;object-fit: cover;border-top-left-radius: 10px;border-top-right-radius: 10px;" src="data: image/png;base64, <?php echo $response[0]['header_picture']; ?>">
                            <form action="../source/php/timeline.php?post=true" enctype="multipart/form-data" method="post">
                                <textarea class="form-control" nid="text" name="text" style="border-radius: 5px;width: 95%;margin-left: 2.5%;margin-right: 2.5%;margin-top: 2.5%;resize: none;height: 128px;border: none;box-shadow: 0px 3px 25px 0px inset rgba(10, 55, 90, 0.1);padding-left: 10px;padding-top: 10px;font-size: 12px;color: #b4b4b4;"></textarea>
                                <div class="text-right" style="width: 95%;height: 30px;margin-left: 2.5%;margin-right: 2.5%;margin-bottom: 2.5%; margin-top: 2.5%;">
                                    <button class="btn btn-primary" type="submit" style="height: 30px;padding-top: 0px;padding-bottom: 0px;background: linear-gradient( 120deg , #9F98E8, #AFF6CF);border: none;font-family: Roboto, sans-serif;">Plaats bericht</button>
                                    <label class="d-flex d-sm-flex d-md-flex d-lg-flex d-xl-flex justify-content-center align-items-center justify-content-sm-center align-items-sm-center justify-content-md-center align-items-md-center justify-content-lg-center align-items-lg-center justify-content-xl-center align-items-xl-center" style="transform: translate3d(75%, -100%, 0); width: 28px;height: 28px;border-radius: 50%;background: linear-gradient( 120deg , #9F98E8, #AFF6CF);"><i class="icon ion-android-image d-flex d-sm-flex d-md-flex d-lg-flex d-xl-flex justify-content-center align-items-center justify-content-sm-center align-items-sm-center justify-content-md-center align-items-md-center justify-content-lg-center align-items-lg-center justify-content-xl-center align-items-xl-center" style="height: 25px;width: 25px;color: rgb(255,255,255);cursor: pointer;"></i>
                                        <input name="file" id="file" type="file" style="display: none;"/>
                                    </label>
                                </div>
                            </form>
                        </div>
                        <div class="col-2 col-sm-1 px-md-3 order-2 timeline-image text-md-center" style="display: flex; justify-content: center; align-items: center;"><img src="data: image/png;base64, <?php echo $response[0]['profile_picture']; ?>" style="filter: grayscale(75%); border-radius: 50%;height: 50px;width: 50px; object-fit: cover;"></div>
                        <div class="col-10 col-md-5 order-1 order-md-3 py-3 timeline-date">
                            <p class="d-xl-flex justify-content-xl-start" style="font-size: 14px;">Welkom <?php echo $response[0]['first_name'] . ' ' . $response[0]['last_name']; ?></p>
                        </div>
                    </div>

                    <?php foreach (\Sprintwik\timeline::select_post() as $json) { ?>
                        <?php if ($json['picture'] === '') { ?>
                            <div class="row no-gutters justify-content-end justify-content-md-around align-items-start timeline-nodes">
                                <div class="h-auto d-xl-flex justify-content-xl-center align-items-xl-center col-10 col-md-5 order-3 order-md-1 timeline-content" style="border-radius: 10px;">
                                    <div class="d-flex justify-content-between w-100 align-items-center">
                                        <p class="d-xl-flex justify-content-xl-center w-100" style="margin-top: 16px; font-size: 12px;"><?php echo $json['text']; ?></p>
                                        <div class="d-flex justify-content-center align-items-center timeline-remove" style="border-radius: 50%; width: 24px; height: 24px; background-color: lightgray;"><i style="width: 22px !important; height: 22px !important; cursor: pointer; color: #808080; text-align: center;" id="<?php echo $json['upid']; ?>" onclick="remove_post(this.id)" class="ion-close"></i></div>
                                    </div>
                                </div>
                                <div class="col-2 col-sm-1 px-md-3 order-2 timeline-image text-md-center" style="display: flex; justify-content: center; align-items: center;"><img src="data: image/png;base64, <?php echo $response[0]['profile_picture']; ?>" style="filter: grayscale(75%); object-fit: cover; border-radius: 50%;height: 50px;width: 50px;"></div>
                                <div class="col-10 col-md-5 order-1 order-md-3 py-3 timeline-date">
                                    <p style="font-size: 14px; font-family: Roboto, sans-serif;"><?php echo $json['date']; ?></p>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="row no-gutters justify-content-end justify-content-md-around align-items-start timeline-nodes">
                                <div class="h-auto justify-content-xl-center align-items-xl-center col-10 col-md-5 order-3 order-md-1 timeline-content" style="border-radius: 10px;">
                                    <img style="width: 100%; height: 128px;object-fit: cover;border-top-left-radius: 10px;border-top-right-radius: 10px;" src="data: image/png;base64, <?php echo $json['picture']; ?>">
                                    <div class="d-flex justify-content-between w-100 align-items-center">
                                        <p class="d-xl-flex justify-content-xl-center w-100" style="margin-top: 16px; font-size: 12px;"><?php echo $json['text']; ?></p>
                                        <div class="d-flex justify-content-center align-items-center timeline-remove" style="border-radius: 50%; width: 24px; height: 24px; background-color: lightgray;"><i style="width: 22px !important; height: 22px !important; cursor: pointer; color: #808080; text-align: center;" id="<?php echo $json['upid']; ?>" onclick="remove_post(this.id)" class="ion-close"></i></div>
                                    </div>
                                </div>
                                
                                <div class="col-2 col-sm-1 px-md-3 order-2 timeline-image text-md-center" style="display: flex; justify-content: center; align-items: center;"><img src="data: image/png;base64, <?php echo $response[0]['profile_picture']; ?>" style="filter: grayscale(75%); object-fit: cover; border-radius: 50%;height: 50px;width: 50px;"></div>
                                <div class="col-10 col-md-5 order-1 order-md-3 py-3 timeline-date">
                                    <p style="font-size: 14px; font-family: Roboto, sans-serif;"><?php echo $json['date']; ?></p>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
            <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        </body>

        </html>
    <?php } ?>