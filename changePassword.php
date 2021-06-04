<?php
session_start();
    if(isset($_SESSION['Authenticated']) && ($_SESSION['Authenticated'] == 1)){
        $ciastka = $_COOKIE['ciastka'];
        $ciastka = stripslashes($ciastka);
        $ciastka = unserialize($ciastka);

        if(($_POST['password'] == $_POST['secondPassword'] && ($ciastka['haslo'] == $_POST['oldPassword']))){
            error_reporting(E_ALL);
            ini_set('display_errors', 'On');
                        
            include 'databaseConnect.php';

            $email = $ciastka['email'];
            $passwd = $_POST['password'];

                        
            $query = "begin
            :result := zmien_haslo('$email', '$passwd');
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
                echo "<script>alert('Pomyślnie zmieniono Twoje hasło.')</script>";
                session_write_close();
            }
            else {
                header("refresh:1; changeData.php");
                echo "<script>alert('Błąd bazy danych. Wprowadź hasło poprawnie.')</script>";
            }
        }
        else {
            header("refresh:1; changeData.php");
            echo "<script>alert('Hasła nie są identyczne, lub podano błędne stare hasło')</script>";      
        }
    }
?>   