<?php
function exist_bejegy($fid, $fhid){

    $link = opendb();
    $query = "SELECT filmid, felhid FROM Filmnezes";
    $result = mysqli_query($link, $query);

    while($row = mysqli_fetch_array($result)):
        if($row['filmid'] == $fid and $row['felhid'] == $fhid){
               return 0;  
        }
    endwhile;

    mysqli_close($link);
    return 1;
}
?>