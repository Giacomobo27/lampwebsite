<?php
    if($_SERVER["REQUEST_METHOD"] != "POST"){
        header("Location: /index.html");
    }
    include '../connection.php';
?>
<!DOCTYPE html>
<html>
    <head>
    
    <link rel="stylesheet" href="./log.css" />
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css" />
    </head>
    <body>
        <?php
                $email = $_POST['inputEmail'];
                $dbconn = pg_connect("host=localhost user=postgres password=biar
                                    port=5432 dbname=EsempioLogin");
                
                
                $query ="SELECT * from utente where email= $1";
                $result=pg_query_params($dbconn, $query, array($email));
                if ($line=pg_fetch_array($result)) {
                    $paswd = $_POST["inputPassword"];

                
                    $query = "SELECT * from utente where email=$1";
                    $result = pg_query_params($dbconn,$query, array(
                        $email));
                    if ($result) {
                        $line=pg_fetch_array($result);
                        $hash= $line["paswd"];
                        if(password_verify($paswd,$hash)) {
                        $nome = $line["nome"];
                    
                        echo "<div class='ris'> <div class='text-center'><div class='mx-auto p-5'> 
                        <img src=\"../logo2.png\" class='mb-2'>
                        <h1> Il login è andato a buon fine!<br>
                            <a href=\"../../market.html\">
                            Market</a> </h1> </div></div>
                            </div>"; }
                            else {
                                echo"<div class='ris'> <div class='text-center'><div class='mx-auto p-5'>
                                <img src=\"../logo2.png\" class='mb-2'>
                                <h1> Il login ha dato errore <br>
                                    <a href=\"index.html\">
                                    Login</a> </h1> </div></div>
                                    </div>";
                            }
                    }
                    else{
                        die("La registrazione non è andata a buon fine. Prova di nuovo!");
                    }
                    
                }
                else {
                    echo "<div class='ris'> <div class='text-center'><div class='mx-auto p-5'>
                    <img src=\"../logo2.png\" class='mb-2'>
                    <h1> Indirizzo email non valida<br>
                        <a href=\"index.html\">
                        Login</a> <br>
                        <a href=\"../registrazione/index.html\">
                        Register</a> </h1> </div></div>
                        </div>";
                }
            pg_close($dbconn);
        ?> 
    </body>
</html>