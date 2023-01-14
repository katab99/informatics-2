<?php
include 'openingdb.php';

if(isset($_GET['id'])){
    $link = opendb();
    $id = mysqli_real_escape_string($link, $_GET['id']);

    $query1 = "DELETE FROM Filmnezes WHERE FelhId='$id'";
    $query2 = "DELETE FROM Felhasznalo WHERE Id='$id'" ;
    
    mysqli_query($link,$query1);
    mysqli_query($link,$query2);
    mysqli_close($link);

}else {
    
    echo"Törlés sikertelen";
}

header("Location: felhasznalo.php");
?>