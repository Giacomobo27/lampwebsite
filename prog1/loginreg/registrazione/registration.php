
<!DOCTYPE html>
<html>
    <head>

    <link rel="stylesheet" href="../login/log.css" />
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css" />
    </head>
    <body>
        <?php
                $email = $_POST['inputEmail'];
                $dbconn = pg_connect("host=localhost user=postgres password=biar
                                    port=5432 dbname=EsempioLogin");
                    
                
                $query ="SELECT * from utente where email= $1";

                $result=pg_query_params($dbconn, $query, array($email));
                if ($line=pg_fetch_array($result, null, PGSQL_ASSOC)) {
                    echo "<div class='ris'> <div class='text-center'><div class='mx-auto p-5'>
                    <img src=\"../logo2.png\" class='mb-2'>
                    <h1> Indirizzo email già in uso<br>
                        <a href=\"index.html\">
                        Register</a> <br>
                        <a href=\"../login/index.html\">
                        Login</a> </h1> </div></div>
                        </div>";
                }
                else {
                    $nome = $_POST["inputName"];
                    $cognome= $_POST['inputSurname'];
                    $paswd = $_POST['inputPassword'];


                    $paswd = password_hash($_POST["inputPassword"],PASSWORD_DEFAULT);
                   


                    $cap = $_POST['inputCap'];
                    $query2 = "INSERT INTO  utente VALUES ($1,$2,$3,$4,$5)";
                    $result = pg_query_params($dbconn,$query2,array($email,$nome,$cognome,$paswd,$cap));

                    if($result){
                        echo "<div class='ris'> <div class='text-center'><div class='mx-auto p-5'>
                        <img src=\"../logo2.png\" class='mb-2'>
                        <h1> la registrazione è andata a buon fine!<br>
                            <a href=\"../../market.html\">
                            Market</a> </h1> </div></div>
                            </div>";
                    }
                    else {
                        die ("La registrazione non è andata a buon fine prova di nuovo.Prova di nuovo!");
                        pg_close($dbconn);
                    }
                }
        ?> 
    </body>
</html>