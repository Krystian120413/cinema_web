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
                    <a href="adminPanel.php" class="nav-link">Powrót</a>                
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
        <h1 class="offset-md-4 col-md-3 hhh">Dodaj seans</h1>
    </div>
    <form method="post" action="addSeance.php">
        <div class="form-group row">
            <label for="title" class="offset-md-2 col-md-2">Tytuł filmu:</label>
            <span class="col-md-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="material-icons">movie</i>
                        </span>
                    </div>
                    <select name="title" class="form-control registerInput" required>
                        <?php
                            error_reporting(E_ALL);
                            ini_set('display_errors', 'On');
                                
                            $username = "sys";                  // Use your username
                            $password = "admin";             // and your password
                            $database = "localhost/XE";   // and the connect string to connect to your database
                                
                            $query = "select tytul from filmy";
                                
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
                            $r = oci_execute($s);
                            if (!$r) {
                                $m = oci_error($s);
                                trigger_error('Could not execute statement: '. $m['message'], E_USER_ERROR);
                            }

                            while ($row = oci_fetch_array($s, OCI_ASSOC+OCI_RETURN_NULLS)) {
                                foreach ($row as $item) {
                        ?>
                                    <option>
                                        <?php
                                            echo $item!==null? $item :"&nbsp;";
                                        ?>
                                    </option>
                        <?php
                                }
                            }
                        ?>
                    </select>
                </div>
            </span>    
         </div>

         <div class="form-group row">
            <label for="hall" class="offset-md-2 col-md-2">Nr sali:</label>
            <span class="col-md-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="material-icons">room</i>
                        </span>
                    </div>
                    <input type="number" name="hall" class="form-control registerInput" placeholder="1-8" maxlength=2 required min="1" max="8">
                </div>
            </span>
         </div>

         <div class="form-group row">
            <label for="day" class="offset-md-2 col-md-2">Dzień:</label>
            <span class="col-md-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="material-icons">calendar_today</i>
                        </span>
                    </div>
                    <input type="text" name="day" class="form-control registerInput" placeholder="fomat daty 23/04/2021" maxlength=10 required>
                </div>
            </span>
         </div>

         <div class="form-group row">
            <label for="time" class="offset-md-2 col-md-2">Godzina:</label>
            <span class="col-md-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="material-icons">schedule</i>
                        </span>
                    </div>
                    <input type="text" name="time" class="form-control registerInput" placeholder="np. 13:30" maxlength=10 required>
                </div>
            </span>
         </div>

         <div class="form-group row">
            <label for="price_adult" class="offset-md-2 col-md-2">Cena dorosły:</label>
            <span class="col-md-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="material-icons">sell</i>
                        </span>
                    </div>
                    <input type="number" name="price_adult" class="form-control registerInput" maxlength="3" required>
                </div>
            </span>
         </div>

         <div class="form-group row">
            <label for="price_child" class="offset-md-2 col-md-2">Cena ulgowy:</label>
            <span class="col-md-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="material-icons">sell</i>
                        </span>
                    </div>
                    <input type="number" name="price_child" class="form-control registerInput" maxlength=4 required>
                </div>
            </span>
         </div>

         <div class="form-group row">
            <label for="price_school" class="offset-md-2 col-md-2">Cena dla szkół:</label>
            <span class="col-md-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="material-icons">sell</i>
                        </span>
                    </div>
                    <input type="number" name="price_school" class="form-control registerInput" maxlength=4 required>
                </div>
            </span>
         </div>

         <div class="form-group row">
            <label for="movie3d" class="offset-md-2 col-md-2">Czy film jest w 3D:</label>
            <span class="col-md-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="material-icons">3d_rotation</i>
                        </span>
                    </div>
                    <input type="text" name="movie3d" class="form-control registerInput" placeholder="Wpisz 'TAK' lub 'NIE'" maxlength=200 required>
                </div>
            </span>    
         </div>

         <button class="btn btn-primary offset-md-4 col-md-2" type="submit">Dodaj seans</button>
    </form>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</html>

