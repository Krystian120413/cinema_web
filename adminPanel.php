<!DOCTYPE html>
<?php
    session_start();
?>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KONIK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <header>
        <nav class="navbar navbar-dark bg-dark navbar-expand-lg">
            <a class="navbar-brand">
                <div class="d-inline-block align-bottom baner">KINO <span class="title">KONIK</span></div>
            </a>
            <buttton class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#hambmenu" aria-controls="hambmenu" aria-expanded="false" aria-label="Navigation button">
                <span class="navbar-toggler-icon"></span>
            </buttton>
            <div class="collapse navbar-collapse justify-content-end" id="hambmenu">
                <div class="navbar-nav">
                    <hr/>
                    <a class="nav-link login" href="repertuar.php">Repertuar</a>
                    <hr/>
                    <?php
                        if(isset($_SESSION['Authenticated']) && ($_SESSION['Authenticated'] == 1)){
                    ?>
                        <a class="nav-link login" href="logowanie.php?logout">Wyloguj się</a>
                    <?php
                        }
                        else {
                    ?>
                        <a class="nav-link login" href="index.html">Powrót</a>
                    <?php
                        }
                    ?>    
                </div>
            </div>
        </nav>
    </header>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
           
        </div>
    </div>
    <?php
        if(isset($_SESSION['Authenticated']) && ($_SESSION['Authenticated'] == 1)){
    ?>
        <div class="row">
            <h1 class="col-md-12 hhh">WITAJ NASZ ADMINIE</h1>
        </div>
        <div class="row">
            <h3 class="col-md-12 panel" style="margin:80px 0 140px 0;">OTO PANEL ADMINA</h3>
        </div>
        <div class="row">
            <a href="addFilm.html" class="offset-md-1 col-md-2">
                <div class="cardd">Dodaj film</div>
            </a>
            <a href="addSeanceForm.php" class="offset-md-2 col-md-2">
                <div class="cardd">Dodaj seans</div>
            </a>
            <a href="seeUsers.php" class="offset-md-2 col-md-2">
                <div class="cardd">Zobacz użytkowników</div>
            </a>
        </div>
    <?php
        }
        else {
    ?>
    <div class="row">
        <h1 class="col-md-12 hhh">NIE JESTEŚ ZALOGOWANY</h1>
    </div>
    <?php
        }
    ?>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</html>