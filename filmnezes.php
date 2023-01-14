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
            $query = "SELECT fh.Nev, f.Cim, DATE(fn.Datum) AS datum, fn.Id AS id FROM Film f INNER JOIN filmnezes fn ON fn.FilmId=f.Id INNER JOIN felhasznalo fh ON fh.ID=fn.FelhId ORDER BY fh.Nev, f.Cim";
            $result = mysqli_query($link, $query);
        ?>
        
        <div id="maincontent">
            <h2>Bejegyzések</h2>
            <table>
            <tr>
                <th>Felhasználó</th>
                <th>Film cím</th>
                <th>Dátum</th>
            </tr>
            <?php while($row = mysqli_fetch_array($result)): ?>
                <tr>
                    <td><?=$row['Nev']?></td>
                    <td><?=$row['Cim']?></td>
                    <td><?=$row['datum']?></td> 
                    <td><a href="filmnezes_edit.php?id=<?=$row['id']?>">Szerkesztés</a></td>
                    <td><a href="filmnezes_delete.php?id=<?=$row['id']?>">Törlés</a></td>
                </tr>
            <?php endwhile; ?>
            </table>
            <br/>
            <a href="filmnezes_add.php">Új hozzáadása</a>
            <br/>
            <a href="filmnezes_topdates.php">Mikor nézték a legtöbb filmet?</a>
        </div>

        <?php mysqli_close($link) ?>
    </body>
</html>