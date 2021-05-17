<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');
            
    $username1 = "sys";                  // Use your username
    $password1 = "admin";             // and your password
    $database1 = "localhost/XE";   // and the connect string to connect to your database
    
    $nr = $_POST['hall'];
    $title = $_POST['title'];
    $day = $_POST['day'];
    $time = $_POST['time'];
    $price_adult = $_POST['price_adult'];
    $price_child = $_POST['price_child'];
    $movie3d = $_POST['movie3d'];
    $price_school = $_POST['price_school'];

    $query = "begin
    :result := dodaj_seans($nr, '$title', '$day', '$time', $price_adult, $price_child, '$movie3d', $price_school);
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

    if($result == 'added'){
        header("refresh:1; addSeanceForm.php");
        echo "<script>alert('Pomyślnie dodano seans na film ".$title." ".$day." ".$time."')</script>";
    }
    else {
        header("refresh:1; addSeanceForm.php");
        echo "<script>alert('Wystąpił błąd. Spróbuj ponownie (".$result.")')</script>";
    }
    session_write_close();
?>
