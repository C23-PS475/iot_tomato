<?php

$konek = mysqli_connect("localhost", "root", "", "iot_tomat");

$sql_ID = mysqli_query($konek, "SELECT MAX(ID) FROM sensor");

$data_ID = mysqli_fetch_array($sql_ID);

$ID_akhir = $data_ID['MAX(ID)'];
$ID_awal =  $ID_akhir - 6 ;

$tanggal = mysqli_query($konek, "SELECT DATE_FORMAT(tanggal, '%H:%i:%s') AS waktu from sensor WHERE ID>='$ID_awal' and ID<='$ID_akhir' ORDER BY ID ASC");

$supply_kelembapan = mysqli_query($konek, "SELECT Ph_tanah from sensor WHERE ID>='$ID_awal' and ID<='$ID_akhir' ORDER BY ID ASC");
$supply_kelembapanudara = mysqli_query($konek, "SELECT kelembapan_udara from sensor WHERE ID>='$ID_awal' and ID<='$ID_akhir' ORDER BY ID ASC");

?>

<div class="card-body">
    <canvas id="mychart1"></canvas>
    <script type="text/javascript">
        var canvas1 = document.getElementById('mychart1');
        var data1 = {
            labels : [
                <?php
                    while($data_tanggal = mysqli_fetch_array($tanggal)) {
                        echo '"'.$data_tanggal['waktu'].'",';
                    }
                ?>
            ],
            datasets : [
                {
                    label : "kelembapan tanah", 
                    fill : true,
                    backgroundColor : "rgba(239, 82, 93, 0.2)",
                borderColor : "rgba(239, 82, 93, 1)",
                    lineTension : 0.5,
                    pointRadius : 5,
                    data : [
                        <?php
                            mysqli_data_seek($supply_kelembapan, 0); // Mengembalikan pointer ke awal $supply_mq131
                            while($data_kelembapan = mysqli_fetch_array($supply_kelembapan)) {
                                echo $data_kelembapan['Ph_tanah'].',' ;
                            }
                        ?>
                    ]
                },
                {
                    label : "kelembapan udara", 
                    fill : true,
                    backgroundColor: "rgba(255, 165, 0, 0.2)", // Warna oranye muda untuk mq135
                    borderColor: "rgba(255, 165, 0, 1)",
                    lineTension : 0.5,
                    pointRadius : 5,
                    data : [
                        <?php
                            mysqli_data_seek($supply_kelembapanudara, 0); // Mengembalikan pointer ke awal $supply_mq135
                            while($data_udara = mysqli_fetch_array($supply_kelembapanudara)) {
                                echo $data_udara['kelembapan_udara'].',' ;
                            }
                        ?>
                    ]
                }
            ] 
        };

        var options1 = {
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Waktu' // Label untuk sumbu x
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Nilai' // Label untuk sumbu y
                    }
                }
            },
            showLines: true,
            animation: { duration: 5 }
        };

        var myLineChart1 = new Chart(canvas1, {
            type: 'line',
            data: data1,
            options: options1
        });
    </script>
</div>
