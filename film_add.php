<!DOCTYPE html>
<html>
    <head>
        <title> Filmnéző adatbázis</title>
        <link rel = "stylesheet" type = "text/css" href="styles.css" />
    </head>
    <body>
        <?php include 'leftmenu.html'?>
        
        <div id="maincontent">
            <form  method="post">
                <h1>Új film</h1>
                <label for="cim">Film cím</label>
                <input type="text" name="cim"/>    
                <br/>

                <label for="ev">Megjelenési év</label>
                <input type="text" name="ev"/>    
                <br/>

                <label for="hossz">Hossz </label>
                <input type="text" name="hossz"/> 
                <br/>

                <input type="submit" value="Hozzáad" name="add" />
                <br/>
            </form>

            <?php
                include 'openingdb.php';
                include 'film_error.php';

                if(isset($_POST['add'])){
                    
                    if($_POST['cim'] and ev_correct($_POST['ev']) and $_POST['hossz'] and exist_cim($_POST['cim'])){
                        $link = opendb();
                        $cim = mysqli_real_escape_string($link, $_POST['cim']);
                        $ev = mysqli_real_escape_string($link, $_POST['ev']);
                        $hossz = mysqli_real_escape_string($link, $_POST['hossz']);

                        $query = "INSERT INTO film(cim, ev, hossz) VALUES ('$cim', '$ev', '$hossz')";

                        mysqli_query($link,$query);
                        mysqli_close($link);
                        header("Location: film.php");
                    } else{
                        echo "Hibás megadott paraméterek";
                    }
                }
            ?>
            
            <br/>
            <a href="film.php">Vissza</a>
        </div>
    </body>
</html>



