<?php
    session_start();

    error_reporting(E_ALL);
    ini_set('display_errors', 'On');
                    
    $username = "sys";                  // Use your username
    $password = "admin";             // and your password
    $database = "localhost/XE";   // and the connect string to connect to your database
         
    $ciastka = $_COOKIE['ciastka'];
    $ciastka = stripslashes($ciastka);
    $ciastka = unserialize($ciastka);

    $row = $_POST['row'];
    
    $query = "begin
        :result := usun_klienta('$row');
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

    if($result == 'deleted'){      
        header("refresh:1; seeUsers.php");
        echo "<script>alert('Pomyślnie usunięto użytkownika.')</script>"; 
    }

    else {
        header("refresh:1; seeUsers.php");
        echo "<script>alert('Błąd bazy danych.')</script>";
    }
?>