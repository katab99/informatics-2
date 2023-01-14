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
        $id = mysqli_real_escape_string($link, $_GET['id']);

        $query_name= "SELECT nev, id as felhid FROM Felhasznalo WHERE id=(SELECT FelhId FROM Filmnezes WHERE id = '$id')";
        $query_movie= "SELECT cim, id FROM Film ORDER BY cim";
       

        $name= mysqli_query($link,$query_name);
        $movie= mysqli_query($link,$query_movie);

        $row_name = mysqli_fetch_array($name);
        ?>
        
        <div id="maincontent">
            <form  method="post">
                <h2>Bejegyzés szerkesztése</h2>

                <p><b>Felhasználó:</b> <?=$row_name['nev']?></p>

                <label for="cim">Film cím</label>
                <select name="filmid" size="1">
                <?php while($row_movie = mysqli_fetch_array($movie)): ?>
                <option value="<?=$row_movie['id']?>"> <?php echo htmlentities($row_movie['cim']) ?> </option>
                <?php endwhile; ?>
                </select>
                <br/>

                <input type="submit" value="Szerkeszt" name="edit" />
                <br/>
            </form>

            <?php 
            include 'filmnezes_error.php';

            if(isset($_POST['edit'])){
               
               if(exist_bejegy($_POST['filmid'],$row_name['felhid'])){
                    $filmid = mysqli_real_escape_string($link, $_POST['filmid']);
            
                    $query = "UPDATE Filmnezes SET FilmId='$filmid' WHERE id='$id'";
                    mysqli_query($link,$query);
               } else {
                    echo "Már létezik a bejegyzés"; 
                }
            } 

            mysqli_close($link);
            ?>
            
            <br/>
            <a href="filmnezes.php">Vissza</a>
        </div>
        
    </body>
</html>