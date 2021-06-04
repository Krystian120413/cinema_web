<?php
    session_start();
    if(isset($_SESSION['Authenticated']) && ($_SESSION['Authenticated'] == 1)){
        $ciastka = $_COOKIE['ciastka'];
        $ciastka = stripslashes($ciastka);
        $ciastka = unserialize($ciastka);

        
        error_reporting(E_ALL);
        ini_set('display_errors', 'On');
                        
        include 'databaseConnect.php';

        $email = $ciastka['email'];
        $title = $_SESSION['title'];
        $hall = $_SESSION['hall'];
        $day = $_SESSION['date'];
        $hour = $_SESSION['hour'];
        $seat = $_POST['seat'];

        $query = "begin
        :result := kup_bilet('$email', '$title', '$day', '$hour', $hall, $seat);
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
        else {
            header("refresh:1; repertuar.php");
            echo "<script>alert('Wystąpił błąd. Spróbuj ponownie')</script>";
        }

        $_SESSION['hall'] = " ";
        $_SESSION['title'] = " ";
        $_SESSION['date'] = " ";
        $_SESSION['hour'] = " ";
        session_write_close();
    }
?>