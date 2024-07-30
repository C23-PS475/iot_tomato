<?php 
$konek = mysqli_connect("localhost", "root", "", "iot_tomat");
$sql = mysqli_query($konek, "SELECT * FROM sensor ORDER BY id DESC LIMIT 1");
$data = mysqli_fetch_array($sql);
$suhu = $data["Suhu"];   
$ph = $data["Ph_tanah"];
$kelembapan_udara = $data["kelembapan_udara"];
$tinggi = $data["Tinggi"];
$status = $data["status"];

// Tambahkan logika untuk mengubah status menjadi teks dengan warna yang sesuai
if ($status == 1) {
    $statusText = '<span class="status-badge status-on">ON</span>';
} else {
    $statusText = '<span class="status-badge status-off">OFF</span>';
}

echo '<span id="suhu">' . $suhu . '</span>';
echo '<span id="kelembapan">' . $kelembapan_udara . '</span>';
echo '<span id="phtanah">' . $ph . '</span>';
echo '<span id="tinggi">' . $tinggi . '</span>';
echo '<span id="status">' . $statusText . '</span>';
?>
