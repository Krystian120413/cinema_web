<?php
session_start();
    if(isset($_SESSION['Authenticated']) && ($_SESSION['Authenticated'] == 1)){
        $ciastka = $_COOKIE['ciastka'];
        $ciastka = stripslashes($ciastka);
        $ciastka = unserialize($ciastka);

        if(($_POST['password'] == $_POST['secondPassword']) && ($_POST['password'] == $ciastka['haslo'])){
            error_reporting(E_ALL);
            ini_set('display_errors', 'On');
                        
            $username = "sys";                  // Use your username
            $password = "admin";             // and your password
            $database = "localhost/XE";   // and the connect string to connect to your database
                        
            

            $email = $ciastka['email'];
            $passwd = $_POST['password'];

                        
            $query = "begin
            :result := usun_konto('$email');
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

            if($result == 'deleted'){
                header("refresh:1; index.html");
                echo "<script>alert('Pomyślnie usunięto Twoje konto')</script>";
            }
            else {
                header("refresh:1; deleteAccount.php");
                echo "<script>alert('Hasła nie są identyczne')</script>";
            }
        }
        else {
                header("refresh:1; deleteAccount.php");
                echo "<script>alert('Błąd bazy danych. Wprowadź hasło poprawnie.')</script>";
        }
    }
?>   