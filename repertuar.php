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
                    <?php
                        if(isset($_SESSION['Authenticated']) && ($_SESSION['Authenticated'] == 1)){
                            $ciastka = $_COOKIE['ciastka'];
                            $ciastka = stripslashes($ciastka);
                            $ciastka = unserialize($ciastka);
                            if($ciastka['email'] != 'admin@admin.pl'){
                    ?>
                                <a class="nav-link login" href="userPanel.php">Powrót</a>                            
                    <?php
                            }
                            else {
                    ?>      
                                <a class="nav-link login" href="adminPanel.php">Powrót</a>
                    <?php
                            }
                    ?>
                            <hr/>
                            <a class="nav-link login" href="logowanie.php?logout">Wyloguj się</a>
                    <?php            
                        }
                        else {
                    ?>
                            <a class="nav-link login" href="index.html">Powrót</a>
                            <hr/>
                            <a class="nav-link login" id="login">Zaloguj się</a>
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
        <?php            
            error_reporting(E_ALL);
            ini_set('display_errors', 'On');
                
            $username = "sys";                  // Use your username
            $password = "admin";             // and your password
            $database = "localhost/XE";   // and the connect string to connect to your database
                
            $query = "begin
            pokaz_seanse;
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

            if(isset($_SESSION['Authenticated']) && ($_SESSION['Authenticated'] == 1)){
        ?>
            <table style='border:1px solid white' id="tickteTable">
                <tr>
                    <th>NUMER<br>SALI</th>
                    <th>TYTUŁ</th>
                    <th>REŻYSER</th>
                    <th>DATA</th>
                    <th>GODZINA<br>ROPOCZĘCIA</th>
                    <th>SEANS 3D</th>
                    <th>CENA BILETU<br> DLA DOROSŁYCH</th>
                    <th>CENA BILETU<br> ULGOWA</th>
                    <th>CENA BILETU<br> DLA SZKÓŁ</th>
                    <th>KUP</th>
                </tr>
                
                <?php
                    while ($row = oci_fetch_array($s, OCI_ASSOC+OCI_RETURN_NULLS)) {
                ?>
                        <tr style="border: 1px solid white">
                            <?php
                                foreach ($row as $item) {
                            ?>
                                <td> 
                                    
                                    <?php
                                        echo $item!==null? $item :"&nbsp;";
                                    ?>
                                </td>
                            <?php
                                }
                            ?>
                            <td>
                                <button class="btn btn-secondary">KUP</button>
                            </td>
                        </tr>
                <?php
                    }
                ?>
            </table>
            <div>
                <?php
                    $qr = "begin
                    pokaz_miejsca('Kiler', '21/07/30', '14:30', 1);
                    end;";
                    $s = oci_parse($c, $qr);
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
                    <table style='border:1px solid white' id="tickteTable">
                        <?php
                            while ($row = oci_fetch_array($s, OCI_ASSOC+OCI_RETURN_NULLS)) {
                        ?>
                                <tr style="border: 1px solid white">
                                    <?php
                                        foreach ($row as $item) {
                                    ?>
                                        <td> 
                                            
                                            <?php
                                                echo $item!==null? $item :"&nbsp;";
                                            ?>
                                        </td>
                                    <?php
                                        }
                                    ?>
                                </tr>
                        <?php
                            }
                        ?>
            </div>
        <?php
            }
            else{
        ?>
                
            <table style='border:1px solid white'>
                <tr>
                    <th>NUMER<br>SALI</th>
                    <th>TYTUŁ</th>
                    <th>REŻYSER</th>
                    <th>DATA</th>
                    <th>GODZINA<br>ROPOCZĘCIA</th>
                    <th>SEANS 3D</th>
                    <th>CENA BILETU<br> DLA DOROSŁYCH</th>
                    <th>CENA BILETU<br> ULGOWA</th>
                    <th>CENA BILETU<br> DLA SZKÓŁ</th>
                </tr>
                <?php
                    while ($row = oci_fetch_array($s, OCI_ASSOC+OCI_RETURN_NULLS)) {
                ?>
                        <tr style="border: 1px solid white">
                            <?php
                                foreach ($row as $item) {
                            ?>
                                <td> 
                                    <?php
                                        echo $item!==null? $item :"&nbsp;";
                                    ?>
                                </td>
                            <?php
                                }
                            ?>
                        </tr>
                <?php
                    }
                ?>
            </table>
        <?php
            }
        ?>
    </div>
</div>
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</html>

