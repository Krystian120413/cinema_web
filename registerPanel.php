<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KONIK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <header>
        <nav class="navbar navbar-dark bg-dark navbar-expand-lg">
            <a class="navbar-brand" href="index.php">
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
        <h1 class="offset-md-3 col-md-3">Rejestracja</h1>
    </div>
    <form method="post">
        <div class="form-group row">
            <label for="email" class="offset-md-2 col-md-2">Email:</label>
            <span class="col-md-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="material-icons">mail</i>
                        </span>
                    </div>
                    <input type="email" name="email" class="form-control registerInput" placeholder="name@gmail.com" maxlength=70 required>
                </div>
            </span>    
         </div>

         <div class="form-group row">
            <label for="password" class="offset-md-2 col-md-2">Hasło:</label>
            <span class="col-md-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="material-icons">person</i>
                        </span>
                    </div>
                    <input type="password" name="password" class="form-control registerInput" placeholder="hasło" maxlength=32 required>
                </div>
            </span>
         </div>

         <div class="form-group row">
            <label for="passwordTwo" class="offset-md-2 col-md-2">Powtórz hasło:</label>
            <span class="col-md-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="material-icons">person</i>
                        </span>
                    </div>
                    <input type="password" name="passwordTwo" class="form-control registerInput" placeholder="powtórz hasło" maxlength=32 required>
                </div>
            </span>
         </div>

         <div class="form-group row">
            <label for="name" class="offset-md-2 col-md-2">Imię:</label>
            <span class="col-md-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="material-icons">person</i>
                        </span>
                    </div>
                    <input type="text" name="name" class="form-control registerInput" placeholder="Imię" maxlength=70 required>
                </div>
            </span>
         </div>

         <div class="form-group row">
            <label for="surname" class="offset-md-2 col-md-2">Nazwisko:</label>
            <span class="col-md-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="material-icons">person</i>
                        </span>
                    </div>
                    <input type="text" name="surname" class="form-control registerInput" placeholder="Nazwisko" maxlength=70 required>
                </div>
            </span>
         </div>

         <button class="btn btn-primary offset-md-5 col-md-1" type="submit">Zarejestruj się</button>
    </form>
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

