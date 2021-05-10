<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ONIK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
    <header>
        <nav class="navbar navbar-dark bg-dark navbar-expand-lg">
            <a class="navbar-brand" href="#">
                <div class="d-inline-block align-bottom baner">KINO <span class="title">KONIK</span></div>
            </a>
            <buttton class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#hambmenu" aria-controls="hambmenu" aria-expanded="false" aria-label="Navigation button">
                <span class="navbar-toggler-icon"></span>
            </buttton>
            <div class="collapse navbar-collapse justify-content-end" id="hambmenu">
                <div class="navbar-nav">
                    <hr/>
                    <a class="nav-link" href="repertuar.php">Repertuar</a>
                    <hr/>
                    <a class="nav-link login" id="login">Zaloguj się</a>                
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
        <h1 class="col-md-12 seans">SEANS TYGODNIA!</h1>
    </div>
    <div class="row">
        <div class="col-md-9 cont">
            <img src="img/mortal_kombat.jpeg" class="image" alt="mortal_kombat">
        </div>
        <div class="col-md-3 cont">
            <h2><a href="repertuar.php">Zarezerwuj bilet już dziś!</a></h2>
        </div>
    </div>
    <div class="row">
        <footer class="col-md-12 navbar fixed-bottom justify-content-end">
            <a href="#">
                Kontakt
            </a>
        </footer>
    </div>
</div>
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</html>

