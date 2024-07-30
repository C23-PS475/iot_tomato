<?php

    $konek = mysqli_connect("localhost", "root", "", "iot_tomat");

    $suhu = $_GET["Suhu_udara"];  
    $kelembapan_udara = $_GET["Kelembapan_udara"];  
    $ph = $_GET["Kelembapan_tanah"];
    $tinggi = $_GET["Tinggi"];
    $status = $_GET["status"];

    mysqli_query($konek,"ALTER TABLE sensor AUTO_INCREMENT=1");
    mysqli_query($konek, "INSERT INTO sensor(Suhu, kelembapan_udara, Ph_tanah, Tinggi, status)VALUES('$suhu', '$kelembapan_udara', '$ph', '$tinggi', '$status')");
?>