<?php
session_start();
    if(isset($_SESSION['Authenticated']) && ($_SESSION['Authenticated'] == 1)){
        $ciastka = $_COOKIE['ciastka'];
        $ciastka = stripslashes($ciastka);
        $ciastka = unserialize($ciastka);

        if(!(is_null($_POST['name']))){
            error_reporting(E_ALL);
            ini_set('display_errors', 'On');
                        
            include 'databaseConnect.php';
                        
            $email = $ciastka['email'];
            $name = $_POST['name'];

                        
            $query = "begin
            :result := zmien_imie('$email', '$name');
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
            
            oci_bind_by_name($s, ':result', $result, 40);
            oci_execute($s);

            if($result == 'changed'){
                header("refresh:1; userPanel.php");
                echo "<script>alert('Pomyślnie zmieniono Twoje dane.')</script>";
                session_write_close();
            }
            else {
                header("refresh:1; changeData.php");
                echo "<script>alert('Błąd bazy danych.')</script>";
            }
        }
        else {
            header("refresh:0.1; changeData.php");
            echo "<script>alert('Nic nie wpisano.')</script>";      
        }
        if(!(is_null($_POST['surname']))){
            error_reporting(E_ALL);
            ini_set('display_errors', 'On');
                        
            $username = "sys";                  // Use your username
            $password = "admin";             // and your password
            $database = "localhost/XE";   // and the connect string to connect to your database
                        

            $email = $ciastka['email'];
            $surname = $_POST['surname'];

                        
            $qr = "begin
            :result := zmien_nazwisko('$email', '$surname');
            end;";
                        
            $c = oci_connect($username, $password, $database, `AL32UTF8`, OCI_SYSDBA);
            if (!$c) {
                $m = oci_error();
                trigger_error('Could not connect to database: '. $m['message'], E_USER_ERROR);
                }
                        
            $s = oci_parse($c, $qr);
            if (!$s) {
                $m = oci_error($c);
                trigger_error('Could not parse statement: '. $m['message'], E_USER_ERROR);
            }
            
            oci_bind_by_name($s, ':result', $result, 40);
            oci_execute($s);

            if($result == 'changed'){
                header("refresh:0.1; userPanel.php");
                echo "<script>alert('Pomyślnie zmieniono Twoje dane.')</script>";
                session_write_close();
            }
            else {
                header("refresh:0.1; changeData.php");
                echo "<script>alert('Błąd bazy danych.')</script>";
            }
        }
        else {
            header("refresh:0.1; changeData.php");
            echo "<script>alert('Nic nie wpisano.')</script>";      
        }
        session_write_close();
    }
?>   