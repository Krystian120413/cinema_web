<?php
    session_start();
    if(isset($_SESSION['Authenticated']) && ($_SESSION['Authenticated'] == 1)){
        $ciastka = $_COOKIE['ciastka'];
        $ciastka = stripslashes($ciastka);
        $ciastka = unserialize($ciastka);

        
        error_reporting(E_ALL);
        ini_set('display_errors', 'On');
                        
        $username = "sys";                  // Use your username
        $password = "admin";             // and your password
        $database = "localhost/XE";   // and the connect string to connect to your database
                        
            

        $email = $ciastka['email'];
        $title = $_POST['title'];
        $hall = $_POST['hall'];
        $day = $_POST['date'];
        $hour = $_POST['hour'];

                        
            $query = "begin
            :result := kup_bilet('$email', '$title','$hall', '$day', '$hour');
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

            if($result == 'bought'){
                header("refresh:1; repertuar.php");
                echo "<script>alert('Pomyślnie wykonano operację. Sprawdź teraz zakładkę swoje bilety')</script>";
            }
    }
?>