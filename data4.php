<?php

$konek = mysqli_connect("localhost", "root", "", "iot_tomat");

$sql_ID = mysqli_query($konek, "SELECT MAX(ID) FROM sensor");

$data_ID = mysqli_fetch_array($sql_ID);

$ID_akhir = $data_ID['MAX(ID)'];
$ID_awal =  $ID_akhir - 6 ;

$tanggal = mysqli_query($konek, "SELECT DATE_FORMAT(tanggal, '%H:%i:%s') AS waktu from sensor WHERE ID>='$ID_awal' and ID<='$ID_akhir' ORDER BY ID ASC");

$supply_pestisida = mysqli_query($konek, "SELECT phtanah2 from sensor WHERE ID>='$ID_awal' and ID<='$ID_akhir' ORDER BY ID ASC");

?>

<div class="card-body">
    <canvas id="mychart4"></canvas>
    <script type="text/javascript">
        var canvas1 = document.getElementById('mychart4');
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
                    label : "Ph Tanah", 
                    fill : true,
                    backgroundColor: "rgba(165, 42, 42, 0.2)", // Warna coklat muda untuk mq131
                    borderColor: "rgba(165, 42, 42, 1)",
                    lineTension : 0.5,
                    pointRadius : 5,
                    data : [
                        <?php
                            mysqli_data_seek($supply_pestisida, 0); // Mengembalikan pointer ke awal $supply_mq131
                            while($data_pestisida = mysqli_fetch_array($supply_pestisida)) {
                                echo $data_pestisida['phtanah2'].',' ;
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
