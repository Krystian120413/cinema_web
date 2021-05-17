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
    <div class="row">
        <div class="col-md-12">
           
        </div>
    </div>
    <?php
        if(isset($_SESSION['Authenticated']) && ($_SESSION['Authenticated'] == 1)){
    ?>
        <div class="row">
            <h1 class="col-md-12 hhh" style="margin:80px 0 140px 0;">TWOJE BILETY</h1>
        </div>
        <div class="row">
            <?php
                error_reporting(E_ALL);
                ini_set('display_errors', 'On');
                
                $username = "sys";                  // Use your username
                $password = "admin";             // and your password
                $database = "localhost/XE";   // and the connect string to connect to your database
                
                $ciastka = $_COOKIE['ciastka'];
                $ciastka = stripslashes($ciastka);
                $ciastka = unserialize($ciastka);

                $email = $ciastka['email'];

                
                $query = "begin
                pokaz_bilety('$email');
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
                $r = oci_execute($s);
                if (!$r) {
                    $m = oci_error($s);
                    trigger_error('Could not execute statement: '. $m['message'], E_USER_ERROR);
                }

            ?>
            <table class="ticketTable">
                <th>NR<br>BILETU</th>
                <th>MIEJSCE</th>
                <th>SALA</th>
                <th>DZIEŃ</th>
                <th>GODZINA</th>
                <th>3D</th>
                <th>TYTUŁ</th>
                <th>REŻYSER</th>
                <th>czas trwania</th>
                <tr>
                <?php
                    while($row = oci_fetch_array($s, OCI_ASSOC+OCI_RETURN_NULLS)){
                        echo "<tr>";
                            foreach ($row as $item) {
                ?>
                                <td>
                                    <?php
                                        echo $item  !== null ? $item." " :"&nbsp;";
                                    ?>
                                </td>
                <?php
                            }
                        echo "</tr>";
                    }
                ?>
                </tr>   
            </table>     
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
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</html>

