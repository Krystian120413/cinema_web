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
    <?php
        if(isset($_SESSION['Authenticated']) && ($_SESSION['Authenticated'] == 1)){
    ?>
            <form action="buyTicket.php" method="post">
                <div class="form-group row">
                    <label for="seat"  class="offset-md-4 col-md-2" style="margin-top:60px; font-size:1.2em;">Wybierz miejsce:</label>
                    <select name="seat"  class="col-md-1" style="margin-top:60px; font-size:1.2em;">
                        <?php  
                            error_reporting(E_ALL);
                            ini_set('display_errors', 'On');
                                
                            $username = "sys";                  // Use your username
                            $password = "admin";             // and your password
                            $database = "localhost/XE";   // and the connect string to connect to your database

                            $hall = $_POST['hall'];
                            $title = $_POST['title'];
                            $date = $_POST['date'];
                            $hour = $_POST['hour'];

                            $_SESSION['hall'] = $hall;
                            $_SESSION['title'] = $title;
                            $_SESSION['date'] = $date;
                            $_SESSION['hour'] = $hour;
                                
                            $query = "begin
                            :liczba_miejsc := pokaz_liczbe_miejsc($hall);
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
                            oci_bind_by_name($s, ':liczba_miejsc', $liczba_miejsc, 40);
                            oci_execute($s);

                            $qr = "begin
                            pokaz_miejsca('$title', '$date', '$hour', $hall);
                            end;";
                            $s = oci_parse($c, $qr);
                            if (!$s) {
                                $m = oci_error($c);
                                trigger_error('Could not parse statement: '. $m['message'], E_USER_ERROR);
                            }
                            $r = oci_execute($s, OCI_DEFAULT);
                            if (!$r) {
                                $m = oci_error($s);
                                trigger_error('Could not execute statement: '. $m['message'], E_USER_ERROR);
                            }
                            
                            $arr = array();
                            $i = 0;
                            $w = 0;
                            while($row = oci_fetch_array($s, OCI_BOTH)){
                                $arr[] = $row[0];
                                $i++;
                            }
                            if($i === 0){
                                for($j = 1; $j <= $liczba_miejsc; $j++) echo "<option value='".$j."'>".$j."</option>";
                            }
                            else if($i == $liczba_miejsc){
                                echo '<option>brak dostępnych biletów</option>';
                            }
                            else {
                                for($t = 1; $t <= $liczba_miejsc; $t++){
                                    for($e = 0; $e < count($arr); $e++){
                                        if($t == $arr[$e]){                                
                                            $w = 1;
                                        }    
                                    }
                                    if($w == 0) echo "<option value='".$t."'>".$t."</option>";
                                    $w = 0;
                                }
                            }
                                    
                            
                        ?>
                    </select>
                </div>
                <div class="form-group row">
                    <button type="submit" class="btn btn-secondary offset-md-5 col-md-2" style="margin-top:60px;">Zarezerwuj</button>
                </div>
            </form> 
</div>
    <?php
            echo "<h4 class='offset-md-3 col-md-5' style='margin-top:60px;'>Rezerwowanie biletu na ".$title.", sala: ".$hall.", data: ".$date." ".$hour."</h4>";
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</html>

