<!DOCTYPE html>
<html>
    <head>
        <title> Filmnéző adatbázis</title>
        <link rel = "stylesheet" type = "text/css" href="styles.css" />
    </head>
    <body>
        <?php include 'leftmenu.html'?>
        
        <div id="maincontent">
            <h2>Új felhasználó</h2>
            
            <form  method="post">
                <label for="nev">Név</label>
                <input type="text" name="nev" />    
                <br/>
                <label for="email">Email</label>
                <input type="text" name="email" />    
                <br/>
                <label for="tszam">Telefonszám</label>
                <input type="text" name="tszam"/> 
                <br/>
                <input type="submit" value="Hozzáad" name="add" />
                <br/>
            </form>
            
            <?php
            include 'openingdb.php'; 
            include 'felhasznalo_error.php';
            
            if(isset($_POST['add'])){
                
                if(isset($_POST['nev']) and $_POST['nev'] and exist($_POST['nev'], 'nev') and exist($_POST['email'], 'email') and tsz_correct($_POST['tszam'])){
                    $link = opendb(); // csak akkor nyitja meg ha belep
                    $nev = mysqli_real_escape_string($link, $_POST['nev']);
                    $email = mysqli_real_escape_string($link, $_POST['email']);
                    $tszam = mysqli_real_escape_string($link, $_POST['tszam']);
            
                    $query = sprintf("INSERT INTO felhasznalo(nev, email, telefonszam) VALUES ('%s', '%s', '%s')",$nev, $email,$tszam);
            
                    mysqli_query($link,$query);
                    mysqli_close($link);
                    header("Location: felhasznalo.php"); // beiras utan visszamegy
                }else{ // csak akkor irja ki amikor lenyomtak a gombot
                    echo "Helytelen megadott paraméterek.";
                } 
            }
            ?>
            
            <br/>
            <a href="felhasznalo.php">Vissza</a>
        </div>

    </body>
</html>
