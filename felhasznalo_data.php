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

        $query_nev = "SELECT nev FROM Felhasznalo WHERE id = '$id'";
        $query_fcim = "SELECT f.cim FROM Film f INNER JOIN Filmnezes fn ON fn.FilmId= f.ID WHERE fn.FelhId = '$id'";
        $query_mins = "SELECT sum(f.hossz) as mins FROM Film f INNER JOIN Filmnezes fn ON fn.FilmId= f.ID WHERE fn.FelhId = '$id'";

        $result_nev = mysqli_query($link, $query_nev);
        $result_fcim = mysqli_query($link, $query_fcim);
        $result_mins = mysqli_query($link, $query_mins);

        $row_nev = mysqli_fetch_array($result_nev);
        $row_mins = mysqli_fetch_array($result_mins);

        if ($row_mins['mins'] == null){
            $row_mins['mins'] = 0;
        }
        ?>
        
        <div id="maincontent">
            <h2> <?=$row_nev['nev']?> filmjei</h2>
            <p> Összesen <b><?=$row_mins['mins']?></b> percet töltött filmnézéssel.</p>
            <br/>
            <table>
                <tr>
                    <th>Filmek</th>
                </tr>

                <?php while($row_fcim = mysqli_fetch_array($result_fcim)): ?>
                <tr>
                    <td><?=$row_fcim['cim']?></td>
                </tr>
                <?php endwhile; ?>

            </table>
            
            <br/>
            <a href="felhasznalo.php">Vissza</a>
        </div>

        <?php mysqli_close($link) ?>
    </body>
</html>