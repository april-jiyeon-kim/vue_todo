<?php
    $conn = mysqli_connect("localhost","root","pyung0711","todo",3309);   
    $sql = "SELECT * FROM todo";
    $result = mysqli_query($conn,$sql);
    $fetch = array();
    while($row = mysqli_fetch_array($result)){
       $fetch[] =$row;
    }
    echo json_encode($fetch);
    exit;
?>