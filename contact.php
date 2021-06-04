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
            <a class="navbar-brand" href="index.html">
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
        <div id="loginPanel" class="col-md-12">
            <!--Form added in javascript-->
        </div>
    </div>
    <div class="row">
        <h1 class="offset-md-4 col-md-3">KONTAKT</h1>
    </div>
    <div class="row">
        <div class="offset-md-3 col-md-3">
            <h2><u>Kino KONIK</u></h2>
            <p>
                ul. Jana Pawła II 8
                <br/>
                00-576 Warszawa
                <br/>
                kino@konik.pl
            </p>
        </div>
    </div>
    <div class="row">
        <div class="offset-md-3 col-md-3">
            <h2><u>Kasa / Rezerwacje</u></h2>
            <p>
                tel.: 22 765 45 28
                <br/>
                kasakino@konik.pl
                <br/>
                <span>Kasa otwiera się 30 minut przed pierwszym seansem.</span>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="offset-md-3 col-md-3">
            <h2><u>Biuro</u></h2>
            <p>
                tel. / fax: 22 765 45 98
                <br/>
                (czynne od poniedziałku do piątku w godz. 9:30-17:00)
            </p>
        </div>
    </div>
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</html>

