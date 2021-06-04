<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');
            
    include 'databaseConnect.php';
    
    $title = $_POST['title'];
    $director = $_POST['director'];
    $genre = $_POST['genre'];
    $time = $_POST['time'];

    $query = "begin
    :result := dodaj_film('$title', '$director', '$genre', '$time');
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

    if($result){
        header("refresh:1; addFilm.html");
        echo "<script>alert('Pomyślnie dodano film ".$title." do bazy')</script>";
    }
    else {
        header("refresh:0.1, addFilm.html");
        echo "<script>alert('Wystąpił błąd. Spróbuj ponownie')</script>";
    }
    session_write_close();
?>
