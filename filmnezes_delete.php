<?php
include 'openingdb.php';

if(isset($_GET['id'])){
    $link = opendb();
    $id = mysqli_real_escape_string($link, $_GET['id']);

    $query = "DELETE FROM Filmnezes WHERE Id='$id'";
    mysqli_query($link,$query);
    mysqli_close($link);

}else{
    
    echo"Törlés sikertelen";
}

header("Location: filmnezes.php");
?>