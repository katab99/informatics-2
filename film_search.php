<!DOCTYPE html>
<html>
    <head>
       <title> Filmnéző adatbázis</title>
       <link rel = "stylesheet" type = "text/css" href="styles.css" />
    </head>
    <body>
        <?php include 'leftmenu.html'?>

        <div id="maincontent">
            <div id="kereses">
                    <h2>Keresés (év alapján)</h2>
                    <form method="post">
                            <label for="ev">Év </label>
                            <input type= "text" name="ev"/>
                            <br/>
                            <label for="mikor">Mikor</label>
                            <select name="mikor">
                                <option value="1">Előtt</option>
                                <option value="2">Után</option>
                                <option value="3">Abban az évben</option>
                            </select>
                            <br/>
                            <input type="submit" value="Keres" name="search">
            </div>
          <br/>
          
          <?php
            include 'openingdb.php';
            include 'film_error.php';

            if(isset($_POST['search']) and ev_correct($_POST['ev'])){
                $link = opendb();
                $year = mysqli_real_escape_string($link, $_POST['ev']);

                if($_POST['mikor'] == 1){ // elott
                    $query = "SELECT cim FROM Film WHERE EV <'$year'";
                }elseif($_POST['mikor'] == 2){ //utan
                    $query = "SELECT cim FROM Film WHERE EV >'$year'";
                }elseif($_POST['mikor'] == 3){ // abban az evben 
                    $query = "SELECT cim FROM Film WHERE EV ='$year'";
                }

                $check = mysqli_query($link, $query); // hogy ne vesszen el az elso sor
                $result = mysqli_query($link, $query);
                mysqli_close($link);

                if(mysqli_fetch_array($check)){ // van-e valami a result-ban
                    $x = 1;
                }else{
                    $x = 0;
                }

                if($x == 1): ?>
                    <table>
                        <tr>
                            <th>Filmek</th>
                        </tr>
                    
                    
                    <?php while($row = mysqli_fetch_array($result)): ?>
                        <tr>
                            <td><?=$row['cim']?></td>
                        </tr>
                    <?php endwhile;?>
                    </table>
                <?php else :?>
                    <p>Nincs ilyen film az adatbázisban.</p>
                <?php endif;
                
            }elseif(isset($_POST['search'])){ //ha helytelen az ev
                echo "Érvénytelen megadott bemenet";
            } 
            ?>
            
            <br/>
            <a href="film.php">Vissza</a>
        </div>
        
    </body>
</html>