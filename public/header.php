<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="Surf Stats for surf0 CSGO Surf Servers">
        <meta name="keywords" content="SurfStats,CSGO,surftimer,Surf,Surf Servers">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <?php if($page_name === 'Player Profile - Dashboard'): ?>
            <title>surf0 - <?php echo $player_id; ?> - Player Profile - Dashboard - Surf Stats</title>
        <?php else: ?>
            <title>surf0 - <?php echo $page_name; ?> - Surf Stats</title>
        <?php endif; ?>
        
        <link rel="apple-touch-icon" sizes="180x180" href="./images/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="./images/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon-16x16.png">
        <link rel="manifest" href="./images/site.webmanifest">

        <!-- Bootstrap core CSS -->
        <link href="<?php __DIR__."/../vendor/bootstrap/css/cyborg/bootstrap.min.css" ?>" rel="stylesheet">

        <!-- Custom core CSS -->
        <link href="<?php __DIR__."/../vendor/fontawesome-free-6.1.2-web/css/all.min.css"?>" rel="stylesheet">
        <link href="<?php __DIR__."/../vendor/css/datatables.min.css"?>" rel="stylesheet">
        <link href="<?php __DIR__."/../vendor/css/custom.css"?>" rel="stylesheet">

        <!-- JavaScript Core -->
        <script src="<?php __DIR__."/../vendor/js/popperjs-2.11.6.min.js"?>"></script>
        <script src="<?php __DIR__."/../vendor/js/jquery-3.6.0.min.js"?>"></script>
        <script src="<?php __DIR__."/../vendor/bootstrap/js/bootstrap.min.js"?>"></script>
        
        <!-- Datatables Core -->
        <script type="text/javascript" src="<?php __DIR__."/../vendor/js/datatables.min.js"?>"></script>
        <script defer data-domain="surf0.net" src="https://stats.960.eu/js/plausible.js"></script>

        <?php require_once(__DIR__.'/../inc/scripts.php'); ?>

    </head>
    <body class="d-flex flex-column bg-black-kp">
