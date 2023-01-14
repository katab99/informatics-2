<!DOCTYPE html>
<html>
    <head>
        <title> Filmnéző adatbázis</title>
        <link rel = "stylesheet" type = "text/css" href="styles.css" />
    </head>
    <body>
       
        <?php 
        include 'leftmenu.html';
        include 'openingdb.php';

        if(isset($_GET['id'])){
            $link = opendb();
            $id = mysqli_real_escape_string($link,$_GET['id']);

            $query = "SELECT nev, email, telefonszam, id FROM Felhasznalo WHERE id ='$id'";
            $result = mysqli_query($link, $query);
            $row = mysqli_fetch_array($result);
        }else{
            echo "Nincs ID";
        }
        ?>

        <div id="maincontent">
            <form method="post">
                <h2>Felhasználó szerkesztése</h2>
                <label for='nev'>Név</label> 
                <input type="text" name="nev" value="<?=$row['nev']?>"/>    
                <br>
                <label for='email'>Email</label> 
                <input type="text" name="email" value="<?=$row['email']?>"/>    
                <br>
                <label for="tszam">Telefonszám </label>
                <input type="text" name="tszam" value="<?=$row['telefonszam']?>"/> 
                <br>
                <input type="submit" value="Mentés" name="edit"/>
            </form>

            <?php 
            include 'felhasznalo_error.php';

            if(isset($_POST['edit'])){
               
                if(isset($_POST['nev']) and $_POST['nev'] and tsz_correct($_POST['tszam'])){
                    $id = mysqli_real_escape_string($link, $_GET['id']);
                    $nev = mysqli_real_escape_string($link, $_POST['nev']);
                    $email = mysqli_real_escape_string($link, $_POST['email']);
                    $tszam = mysqli_real_escape_string($link, $_POST['tszam']);
            
                    $query = "UPDATE Felhasznalo SET nev='$nev', email='$email', telefonszam='$tszam' WHERE id='$id'";
                    mysqli_query($link, $query);
                    header("Location: felhasznalo.php");

                } else{
                    echo "Helytelen megadott paraméterek.";
                }
            }
            
            mysqli_close($link);
            ?>

            <br/>
            <a href="felhasznalo.php">Vissza</a>
        </div>
        
    </body>
</html>