<!DOCTYPE html>
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
        <h1 class="offset-md-4 col-md-3">Logowanie do panelu Administratora</h1>
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
         <button class="btn btn-primary offset-md-4 col-md-2" type="submit">Zaloguj się</button>
         <a href="index.html"><button class="btn col-md-1 btn-primary" type="button">Powrót</button></a>
    </form>
    <?php
        if(isset($_POST['email'])){
            session_start();

            error_reporting(E_ALL);
            ini_set('display_errors', 'On');
                            
            $username = "sys";                  // Use your username
            $password = "admin";             // and your password
            $database = "localhost/XE";   // and the connect string to connect to your database
                            
            $email = $_POST['email'];
            $passwd = $_POST['password'];
                
            $query = "begin
                :result := adminLogin('$email', '$passwd');
                end;";
                        
            $c = oci_connect($username, $password, $database, `AL32UTF8`, OCI_SYSDBA);
            if (!$c) {
                $m = oci_error();
                trigger_error('Could not connect to database: '. $m['message'], E_USER_ERROR);
            }
                        
            $s = oci_parse($c, $query);
            if (!$s) {
                $m = oci_error($c);
                trigger_error('Could not parse statement: '. $m['message'], E_USER_ERROR);
            }

            //$result = return z funkcji pl/sql
            oci_bind_by_name($s, ':result', $result, 40);
            oci_execute($s);
            echo $result;

            if($result=='zalogowano'){
                // zapis
                $ciastka = Array('email' => $email, 'haslo' => $passwd);
                setcookie('ciastka', serialize($ciastka), time()+3600);

                // odczyt zabezpieczony przed nieistniejącym ciasteczkiem
                if (isset($_COOKIE['ciastka'])) $tablica = unserialize($_COOKIE['ciastka']); 
                else $ciastka = Array();

                $_SESSION['Authenticated'] = 1;
                session_write_close();
                
                header('Location: adminPanel.php');
            }
            else {
                session_destroy();
                header('Location: adminLogin.php');
            }
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

