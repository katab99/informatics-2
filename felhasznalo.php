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
        $query = "SELECT id, nev, email, telefonszam FROM Felhasznalo";
        $result = mysqli_query($link, $query);
        ?>
        
        <div id="maincontent">
            <h2>Felhasználók kezelése</h2>
            <table>
                <tr>
                    <th>Id</th>
                    <th>Név</th>
                    <th>Email</th>
                    <th>Telefonszám</th>
                </tr>
                <?php while($row = mysqli_fetch_array($result)): ?>
                <tr>
                    <td><?=$row['id']?></td>
                    <td><a href="felhasznalo_data.php?id=<?=$row['id']?>"><?=$row['nev']?></td>
                    <td><?=$row['email']?></td>
                    <td><?=$row['telefonszam']?></td>
                    <td><a href="felhasznalo_edit.php?id=<?=$row['id']?>">Szerkesztés</a></td>
                    <td><a href="felhasznalo_delete.php?id=<?=$row['id']?>">Törlés</a></td>
                </tr>
            <?php endwhile; ?>
            </table>
           
            <br/>
            <a href="felhasznalo_add.php">Felhasználó hozzáadása</a>
        </div>

        <?php mysqli_close($link) ?>
    </body>
</html>