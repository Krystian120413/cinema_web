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
                <div class="d-inline-block align-bottom baner">KINO <span class="title">ONIK</span></div>
            </a>
            <buttton class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#hambmenu" aria-controls="hambmenu" aria-expanded="false" aria-label="Navigation button">
                <span class="navbar-toggler-icon"></span>
            </buttton>
            <div class="collapse navbar-collapse justify-content-end" id="hambmenu">
                <div class="navbar-nav">
                    <hr/>
                    <a class="nav-link" href="repertuar.php">Repertuar</a>
                    <hr/>
                    <a class="nav-link" href="#">Nowości</a>
                    <hr/>
                </div>
            </div>
        </nav>
    </header>
<div class="container-fluid">
    <div class="row">
        <?php
            error_reporting(E_ALL);
            ini_set('display_errors', 'On');
            
            $username = "sys";                  // Use your username
            $password = "admin";             // and your password
            $database = "localhost/XE";   // and the connect string to connect to your database
            
            $query = "select * from administratorzy";
            
            $c = oci_connect($username, $password, $database, null, OCI_SYSDBA);
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
            
            echo "<table border='1'>\n";
            $ncols = oci_num_fields($s);
            echo "<tr>\n";
            for ($i = 1; $i <= $ncols; ++$i) {
                $colname = oci_field_name($s, $i);
                echo "  <th><b>".htmlspecialchars($colname,ENT_QUOTES|ENT_SUBSTITUTE)."</b></th>\n";
            }
            echo "</tr>\n";
            
            while (($row = oci_fetch_array($s, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
                echo "<tr>\n";
                foreach ($row as $item) {
                    echo "<td>";
                    echo $item!==null?htmlspecialchars($item, ENT_QUOTES|ENT_SUBSTITUTE):"&nbsp;";
                    echo "</td>\n";
                }
                echo "</tr>\n";
            }
            echo "</table>\n";
        ?>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</html>

