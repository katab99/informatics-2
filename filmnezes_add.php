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

        $link = opendb();

        $query_name="SELECT nev, id FROM Felhasznalo ORDER BY nev";
        $query_movie="SELECT cim, id FROM Film ORDER BY cim";
       
        $name= mysqli_query($link,$query_name);
        $movie= mysqli_query($link,$query_movie);
    
        ?>
        
        <div id="maincontent">
            <form  method="post">
                <h2>Új bejegyzés</h2>

                <label for="nev">Név</label>
                <select name="felhid" size="1">
                <?php while($row_name = mysqli_fetch_array($name)): ?>
                <option value="<?=$row_name['id']?>"> <?php echo htmlentities($row_name['nev']) ?> </option>
                <?php endwhile; ?>
                </select>
                <br/>

                <label for="cim">Film cím</label>
                <select name="filmid" size="1">
                <?php while($row_movie = mysqli_fetch_array($movie)): ?>
                <option value="<?=$row_movie['id']?>"> <?php echo htmlentities($row_movie['cim']) ?> </option>
                <?php endwhile; ?>
                </select>
                <br/>

                <input type="submit" value="Hozzáad" name="add" />
                <br/>
            </form>

            <?php 
            include 'filmnezes_error.php';

            if(isset($_POST['add'])){
               
               if(exist_bejegy($_POST['filmid'],$_POST['felhid'])){
                    $felhid = mysqli_real_escape_string($link, $_POST['felhid']);
                    $filmid = mysqli_real_escape_string($link, $_POST['filmid']);
            
                    $query = "INSERT INTO filmnezes(FilmId, FelhId, Datum) VALUES ('$filmid', '$felhid', curdate())";
                    mysqli_query($link,$query);
               } else {
                    echo "Már létezik a bejegyzés"; // hogy ez is formazva legyen, belul van a blokk es nem  a vegen
                }
            } 

            mysqli_close($link);
            ?>
            
            <br/>
            <a href="filmnezes.php">Vissza</a>
        </div>
        
    </body>
</html>


