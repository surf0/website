<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="Surf Stats">
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
        <link href="./vendor/bootstrap/css/<?php if($settings_theme!=='') echo $settings_theme; else echo 'default'; ?>/bootstrap.min.css" rel="stylesheet">

        <!-- Custom core CSS -->
        <link href="./vendor/fontawesome-free-6.1.2-web/css/all.min.css" rel="stylesheet">
        <link href="./vendor/css/datatables.min.css" rel="stylesheet">
        <link href="./vendor/css/custom.css" rel="stylesheet">

        <!-- JavaScript Core -->
        <script src="./vendor/js/popperjs-2.11.6.min.js"></script>
        <script src="./vendor/js/jquery-3.6.0.min.js"></script>
        <script src="./vendor/bootstrap/js/bootstrap.min.js"></script>
        
        <!-- Datatables Core -->
        <script type="text/javascript" src="./vendor/js/datatables.min.js"></script>
        <?php require_once('./inc/scripts.php'); ?>

    </head>
    <body class="d-flex flex-column bg-black-kp">
