<?php
    session_start();

    error_reporting(E_ALL);
    ini_set('display_errors', 'On');
                    
    include 'databaseConnect.php';
                    
    $email = $_POST['email'];
    $passwd = $_POST['haslo'];
        
    $query = "begin
        :result := login('$email', '$passwd');
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
    echo $result;

    if($result=='zalogowano'){
          // zapis
        $ciastka = Array('email' => $email, 'haslo' => $passwd);
        setcookie('ciastka', serialize($ciastka), time()+3600);

        // odczyt zabezpieczony przed nieistniejącym ciasteczkiem
        if (isset($_COOKIE['ciastka'])) $tablica = unserialize($_COOKIE['ciastka']); 
        else $ciastka = Array();

        $_SESSION['Authenticated'] = 1;
        session_write_close();
        
        header('Location: userPanel.php');
    }

    else if(isset($_GET['logout'])){
        session_destroy();
        header('Location: index.html');
    }

    else {
        session_destroy();
        header('Location: index.html');
    }
?>