<?php
function ev_correct($ev){
    if ($ev < 1888){
        return 0;
    }
    else{
        return 1;
    }
}

function exist_cim($cim){
    $link = opendb();
    $query = "SELECT cim FROM Film";
    $result = mysqli_query($link, $query);

    while($row = mysqli_fetch_array($result)):
        if($cim == $row['cim']){
            return 0; //if miatt hogy nem lépjen be
        }
    endwhile;

    mysqli_close($link);

    return 1;
}
?>