<?php
    session_start();
    
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');
            
    $username1 = "sys";                  // Use your username
    $password1 = "admin";             // and your password
    $database1 = "localhost/XE";   // and the connect string to connect to your database
    $email = $_POST['email'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];

    
            
    if($_POST['password'] != $_POST['passwordTwo']){
        echo "błędne dane";
        session_destroy();
    }
    else {
        $query = "begin
        :result := checkBeforeRegister('$email');
        end;";
                
        $c = oci_connect($username1, $password1, $database1, `AL32UTF8`, OCI_SYSDBA);
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

        if($result == 1){
            echo "błędne dane";
            session_destroy();
        }
        else {
            $query = "begin
            rejestracja('$email', '$password', '$name', '$surname');
            end;";

            $c = oci_connect($username1, $password1, $database1, `AL32UTF8`, OCI_SYSDBA);
            if (!$c) {
                $m = oci_error();
                trigger_error('Could not connect to database: '. $m['message'], E_USER_ERROR);
            }
                    
            $s = oci_parse($c, $query);
            if (!$s) {
                $m = oci_error($c);
                trigger_error('Could not parse statement: '. $m['message'], E_USER_ERROR);
            }

            oci_execute($s);

            $ciastka = Array('email' => $email, 'haslo' => $password);
            setcookie('ciastka', serialize($ciastka), time()+3600);

            if (isset($_COOKIE['ciastka'])) $tablica = unserialize($_COOKIE['ciastka']); 
            else $ciastka = Array();

            $_SESSION['Authenticated'] = 1;
            session_write_close();
        }
    }
?>
            

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
</head>
<body>
    <form name="myForm" id="myForm" action="logowanie.php" method="post" style="display:none;">
        <input type="email" name="email" value=`$email`>
        <input type="password" name="haslo" value=`$password`>
    </form>
    <script>
        window.onload = () => {
            document.forms["myForm"].submit();
        }
    </script>
</body>
</html>

