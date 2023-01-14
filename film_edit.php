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

            $query = "SELECT cim, ev, hossz, id FROM Film WHERE id = '$id'";
            $result = mysqli_query($link, $query);
            $row = mysqli_fetch_array($result);
        }else{
            echo "Nincs ID";
        }
        ?>

        <div id="maincontent">
            <form method="post">
                <h2>Film szerkesztése</h2>
                <label for='cim'>Cím</label> 
                <input type="text" name="cim" value="<?=$row['cim']?>"/>    
                <br>
                <label for='ev'>Év</label> 
                <input type="text" name="ev" value="<?=$row['ev']?>"/>    
                <br>
                <label for="hossz">Hossz </label>
                <input type="text" name="hossz" value="<?=$row['hossz']?>"/> 
                <br>
                <input type="submit" value="Mentés" name="edit"/>
            </form>

            <?php 
            include 'film_error.php';

            if(isset($_POST['edit'])){
            
                if($_POST['cim'] and ev_correct($_POST['ev']) and $_POST['hossz']){
            
                    $id = mysqli_real_escape_string($link, $_GET['id']);
                    $cim = mysqli_real_escape_string($link, $_POST['cim']);
                    $ev = mysqli_real_escape_string($link, $_POST['ev']);
                    $hossz = mysqli_real_escape_string($link, $_POST['hossz']);
            
                    $query = "UPDATE Film SET cim='$cim', ev='$ev', hossz='$hossz' WHERE id='$id'";
                    
                    mysqli_query($link, $query);
                    header("Location: film.php");
                } else {
                    echo "Hibás megadott paraméterek";
                }
            }
            
            mysqli_close($link);
            ?>

        <br/>
        <a href="film.php">Vissza</a>
        </div>
        
    </body>
</html>