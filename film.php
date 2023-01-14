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
        $query = "SELECT f.id as id, f.cim as cim, f.ev as ev, f.hossz as hossz, count(fn.FelhId) as lattak FROM Film f  LEFT OUTER JOIN Filmnezes fn ON fn.FilmId = f.Id GROUP BY f.id";
        $result = mysqli_query($link,$query);
        ?>
        
        <div id="maincontent">
            <h2>Filmek kezelése</h2>
            <table id="tablazat">  
                <tr>
                    <th>Id</th>
                    <th>Cím</th>
                    <th>Megjelenési év</th>
                    <th>Hossz</th>
                    <th>Hányan látták?</th>
                </tr>
                <?php while($row = mysqli_fetch_array($result)):?>
                <tr>
                    <td><?=$row['id']?></td>
                    <td><?=$row['cim']?></td>
                    <td><?=$row['ev']?></td>
                    <td><?=$row['hossz']?></td>
                    <td><?=$row['lattak']?></td>
                    <td><a href="film_edit.php?id=<?=$row['id']?>">Szerkesztés</a></td>
                    <td><a href="film_delete.php?id=<?=$row['id']?>">Törlés</a></td>
                </tr>
                <?php endwhile; ?>
            </table>
            <br>
            <a href="film_add.php">Film hozzáadása</a>
            <br/>
            <a href="film_search.php">Film keresése</a>
        </div>
        
        <?php mysqli_close($link) ?>
    </body>
</html>
