<html>
    <head>
       <title> Filmnéző adatbázis</title>
       <link rel = "stylesheet" type = "text/css" href="styles.css" />
    </head>
    <body>
        <?php
        include "openingdb.php";
        include "leftmenu.html";

        $link = opendb();
        $query = "SELECT DATE(datum) as datum, count(Datum) as mennyi FROM Filmnezes GROUP BY Datum ORDER BY count(Datum) DESC";
        $result = mysqli_query($link, $query);
        ?>

        <div id="maincontent">
            <h2>Mikor, hányan néztek filmet?</h2>
            <table id="tablazat">
                <tr>
                    <th>Dátum</th>
                    <th>Hányszor?</th>
                </tr>
                <?php while($row=mysqli_fetch_array($result)):?>
                    <tr>
                        <td><?=$row['datum']?></td>
                        <td><?=$row['mennyi']?></td>
                    </tr>
                <?php endwhile;?>
            </table>
            <br/> 
            <a href="filmnezes.php">Vissza</a>
        </div>
        
        <?php mysqli_close($link)?>
    </body>
</html>