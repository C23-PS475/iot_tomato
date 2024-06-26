<?php

    $konek = mysqli_connect("localhost", "root", "", "iot_tomat");

    $suhu = $_GET["Suhu"];   
    $ph = $_GET["Ph_tanah"];
    $tinggi = $_GET["Tinggi"];
    $status = $_GET["status"];



    mysqli_query($konek,"ALTER TABLE sensor AUTO_INCREMENT=1");
    mysqli_query($konek, "INSERT INTO sensor(Suhu, Ph_tanah, Tinggi, status)VALUES('$suhu', '$ph', '$tinggi', '$status')");
    

?>