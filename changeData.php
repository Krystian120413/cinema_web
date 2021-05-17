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
                        <a class="nav-link login" href="userPanel.php">Powrót</a>
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
    <?php
        if(isset($_SESSION['Authenticated']) && ($_SESSION['Authenticated'] == 1)){
    ?>
        <div class="row">
            <h1 class="col-md-12 hhh" style="margin:20px 0 40px 0;">Zmień swoje dane</h1>
        </div>
        <div class="row">
            <h2 class="hhh">Zmiana hasła:</h2>
        </div>
        <form method="post" action="changePassword.php">
            <div class="form-group row">
                <label for="password" class="offset-md-2 col-md-2">Wpisz hasło:</label>
                <span class="col-md-3">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="material-icons">keyboard</i>
                            </span>
                        </div>
                        <input type="password" name="password" class="form-control registerInput" maxlength=70 required>
                    </div>
                </span>
            </div>

            <div class="form-group row">
            <label for="secondPassword" class="offset-md-2 col-md-2">Powtórz hasło:</label>
            <span class="col-md-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="material-icons">keyboard</i>
                        </span>
                    </div>
                    <input type="password" name="secondPassword" class="form-control registerInput" maxlength=70 required>
                </div>
            </span>
            </div>

            <div class="form-group row">
                <label for="oldPassword" class="offset-md-2 col-md-2">Wpisz stare hasło:</label>
                <span class="col-md-3">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="material-icons">person</i>
                            </span>
                        </div>
                        <input type="password" name="oldPassword" class="form-control registerInput" maxlength=70 required>
                    </div>
                </span>
            </div>

            <div class="form-group row">
                <button type="submit" class="btn btn-danger offset-md-4 col-md-2">Zmień hasło</button>
            </div>
        </form>

        <div class="row">
            <h2 class="hhh" style="margin-top:40px;">Zmiana danych:</h2>
        </div>
        <form method="post" action="changeUserData.php">
            <div class="form-group row">
                <label for="name" class="offset-md-2 col-md-2">Wpisz imię:</label>
                <span class="col-md-3">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="material-icons">person</i>
                            </span>
                        </div>
                        <input type="text" name="name" class="form-control registerInput" maxlength=70>
                    </div>
                </span>
            </div>

            <div class="form-group row">
            <label for="surname" class="offset-md-2 col-md-2">Wpisz nazwisko:</label>
            <span class="col-md-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="material-icons">person</i>
                        </span>
                    </div>
                    <input type="text" name="surname" class="form-control registerInput" maxlength=70>
                </div>
            </span>
            </div>
            <div class="form-group row">
                <button type="submit" class="btn btn-danger offset-md-4 col-md-2">Zaktualizuj swoje dane</button>
            </div>
        </form>
    <?php
            session_write_close();
        }
        else {
    ?>
    <div class="row">
        <h1 class="col-md-12 hhh">NIE JESTEŚ ZALOGOWANY</h1>
    </div>
    <?php
            session_destroy();
        }
    ?>
    <div class="row">
        <footer class="col-md-12 navbar fixed-bottom justify-content-end">
            <a href="contact.php">
                Kontakt
            </a>
        </footer>
    </div>
</div>
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</html>

