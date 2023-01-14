<?php
//include 'openingdb.php'; --felhasznalo_add.ph + felhasznalo_edit.php van ez 

function exist($nev, $tomb){ //$_POST['x'], 'x'
    $link = opendb();
    $query = "SELECT nev, email FROM Felhasznalo";
    $result = mysqli_query($link, $query);

    while($row = mysqli_fetch_array($result)):
        if($nev == $row[$tomb]){
            return 0; //if miatt hogy nem lépjen be
        }
    endwhile;

    mysqli_close($link);

    return 1;
}

function tsz_correct($tsz){
    if(strlen($tsz) == 12){
        if($tsz[0] == '+'){
            return 1;
        }
    } elseif(strlen($tsz) == 0){
        return 1;
    }

    return 0;
}
?>