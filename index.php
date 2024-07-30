<?php
// Mulai session
session_start();

// Periksa apakah session 'username' sudah diset
if (!isset($_SESSION['username'])) {
    // Jika tidak, redirect pengguna ke halaman login
    header("Location: login.php");
    exit(); // Pastikan keluar dari skrip
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Penyiraman Tomat</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <link rel="stylesheet" href="text/css" href="assets/css/bootstrap.min.css">
    <script type="text/javascript" src="assets/js/jquery-3.4.0.min.js"></script>
    <script type="text/javascript" src="assets/js/mdb.min.js"></script>
    <script type="text/javascript" src="jquery-latest.js"></script>
    <script type="text/javascript" src="js/jquery.min.js"></script> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<style type="text/css">

.status-badge {
    font-size: 1.8em;
    padding: 10px 10px;
    border-radius: 5px;
    color: #fff;
    text-align: center;
    display: inline-block;
    width: 100px; /* Sesuaikan lebar badge sesuai kebutuhan */
    margin-bottom: 10px; /* Atur margin jika diperlukan */
}

.status-on {
    background-color: #28a745; /* Warna hijau untuk status ON */
}

.status-off {
    background-color: #dc3545; /* Warna merah untuk status OFF */
}

.card-img-top {
            width: 50%; /* Mengatur lebar gambar agar mengisi container card */
            height: 50%; /* Mengatur tinggi gambar agar mengikuti proporsi aslinya */
        }


	div.testArea{
		display:inline-block;
		width:16em;
		height:14em;
		position:relative;
		box-sizing:border-box;
	}
	div.testName{
		position:absolute;
		top: -0.3em; left: 18%;
		width:auto;
		font-size:1.4em;
		z-index:9;
        white-space: nowrap;
	}
    div.testName2{
		position:absolute;
		top: -0.3em; left:40%;
		width:auto;
		font-size:1.4em;
		z-index:9;
        white-space: nowrap;
	}
    div.testName3{
		position:absolute;
		top: -0.3em; left:30%;
		width:auto;
		font-size:1.4em;
		z-index:9;
        white-space: nowrap;
	}
	div.meterText{
		position:absolute;
		bottom:1.3em;
		width:auto;
		font-size:3em;    
		z-index:9;
        color: black;
        left: 33%;
        white-space: nowrap;
	}
	div.meterText:empty:before{
		content:"";
	}
	div.unit{
		position:absolute;
		bottom:1em; left:47%;
		width:auto;
		z-index:9;
        white-space: nowrap;
	}
    div.unit2{
		position:absolute;
		bottom:1em; left:45%;
		width:auto;
		z-index:9;
        white-space: nowrap;
	}
    div.nilai{
        position:absolute;
		bottom:0.3em; left:12%;
		width:auto;
		z-index:9;
        white-space: nowrap;
    }
    div.nilai2{
        position:absolute;
		bottom:0.3em; left:76%;
		width:auto;
		z-index:9;
        white-space: nowrap;
    }
	div.testArea canvas{
		position:absolute;
		top:0; left:0; width:100%; height:100%;
		z-index:1;
	}
	div.testGroup{
		display:inline-block;
	}

    .card-body div#beban,
    .card-body div#beban2 {
        clear: both; /* Bersihkan float */
        font-weight: bold; /* Membuat tulisan tebal */
        color: white; /* Membuat tulisan berwarna putih */
        border-radius: 0.25rem; /* Atur border-radius sesuai kebutuhan */
    }

    /* Style untuk ketika relay ON */
    .card-body div#beban span,
    .card-body div#beban2 span {
        background-color: green; /* Warna latar belakang untuk relay ON */
        padding: 0.25rem 0.5rem; /* Atur padding sesuai kebutuhan */
        border-radius: 0.25rem; /* Atur border-radius sesuai kebutuhan */
    }

    /* Style untuk ketika relay OFF */
    .card-body div#beban span.off,
    .card-body div#beban2 span.off {
        background-color: red; /* Warna latar belakang untuk relay OFF */
        padding: 0.25rem 0.5rem; /* Atur padding sesuai kebutuhan */
        border-radius: 0.25rem; /* Atur border-radius sesuai kebutuhan */
}

	@media all and (max-width:65em){
		body{
			font-size:1.5vw;
		}
        div.testName{
        top: -0.3em;
        left: 35%; 
        } div.testName2{
            top: -0.3em;
            left: 30%; 
        } div.testName3{
            top: -0.3em;
            left: 25%; 
        }
	}
	@media all and (max-width:40em){
		body{
			font-size:0.8em;
		}
		div.testGroup{
			display:block;
			margin: 0 auto;
		}
	}
    
</style>
<script type="text/javascript"> 
$(document).ready(function() {
    setInterval(function() {
        $("#dlText").load('ceksensor.php #suhu');
        $("#wlText").load('ceksensor.php #kelembapan');
        $("#ulText").load('ceksensor.php #phtanah');
        $("#plText").load('ceksensor.php #phtanahbaru');       
        $("#pingText").load('ceksensor.php #tinggi');
        $("#grafik").load('data.php');
        $("#grafik2").load('data2.php');
        $("#grafik3").load('data3.php');
        $("#grafik4").load('data4.php');
        $("#status").load('ceksensor.php #status', function(responseText) {
            var statusBadge = $(responseText).find('.status-badge').text().trim(); // Ekstrak teks dari elemen dengan kelas status-badge

            // Periksa status yang diterima
            if (statusBadge === 'ON') {
                $('#status').removeClass('status-off').addClass('status-on').text('ON');
            } else if (statusBadge === 'OFF') {
                $('#status').removeClass('status-on').addClass('status-off').text('OFF');
            } else {
                // Jika status tidak dikenali
                console.log('Status tidak dikenali: ' + statusBadge);
            }
        });
    }, 1000); // Interval update setiap 1 detik (1000 milidetik)
});

    
    
    function I(id){return document.getElementById(id);}
    var meterBk="#E0E0E0";
    var dlColor="#008080",
        wlColor="#FF8C00",
        plColor="#ADFF2F",
        ulColor="#800080",
        pingColor = "#AA6060"
    var progColor="#EEEEEE";
    var parameters={ //custom test parameters. See doc.md for a complete list
        time_dl: 10, //download test lasts 10 seconds
        time_wl: 10,
        time_pl: 10,
        time_ul: 10, //upload test lasts 10 seconds
        count_ping: 50, //ping+jitter test does 20 pings
        getIp_ispInfo: false //will only get IP address without ISP info
    };

    //CODE FOR GAUGES
    function drawMeter(c, amount, maxAmount, bk, fg, prog) {
    var ctx = c.getContext("2d");
    var dp = window.devicePixelRatio || 1;
    var cw = c.clientWidth * dp,
        ch = c.clientHeight * dp;
    var sizScale = ch * 0.0055;
    if (c.width == cw && c.height == ch) {
        ctx.clearRect(0, 0, cw, ch);
    } else {
        c.width = cw;
        c.height = ch;
    }

    // Hitung persentase dari amount terhadap maksimum
    var percentage = amount / maxAmount;

    // Gambar busur berdasarkan persentase
    ctx.beginPath();
    ctx.strokeStyle = bk;
    ctx.lineWidth = 16 * sizScale;
    ctx.arc(c.width / 2, c.height - 58 * sizScale, c.height / 1.8 - ctx.lineWidth, -Math.PI * 1.1, Math.PI * 0.1);
    ctx.stroke();
    ctx.beginPath();
    ctx.strokeStyle = fg;
    ctx.lineWidth = 16 * sizScale;
    ctx.arc(c.width / 2, c.height - 58 * sizScale, c.height / 1.8 - ctx.lineWidth, -Math.PI * 1.1, percentage * Math.PI * 1.2 - Math.PI * 1.1);
    ctx.stroke();
    if (typeof prog !== "undefined") {
        ctx.fillStyle = prog;
        ctx.fillRect(c.width * 0.3, c.height - 16 * sizScale, c.width * 0.4 * percentage, 4 * sizScale);
    }
}

function updateUI(forced) {
    // Ambil nilai dlText dari elemen #dlText
    var dlTextValue = parseFloat($('#dlText').text());
    var wlTextValue = parseFloat($('#wlText').text());
    var plTextValue = parseFloat($('#plText').text());
    var ulTextValue = parseFloat($('#ulText').text());
    var pingTextValue = parseFloat($('#pingText').text());

    // Tentukan warna meter berdasarkan nilai dlText
    var dlMeterColor;
    if (dlTextValue >= 0 && dlTextValue <= 100) {
        dlMeterColor = dlColor;
    } else {
        dlMeterColor = progColor;
    }

    var wlMeterColor;
    if (wlTextValue >= 0 && wlTextValue <= 100) {
        wlMeterColor = wlColor;
    }else {
        wlMeterColor = progColor;
    }

    var plMeterColor;
    if (plTextValue >= 0 && plTextValue <= 100) {
        plMeterColor = plColor;
    }else {
        plMeterColor = progColor;
    }

    var ulMeterColor;
    if (ulTextValue >= 0 && ulTextValue <= 100) {
        ulMeterColor = ulColor;
    }else {
        ulMeterColor = progColor;
    }

    var pingMeterColor;
        if (pingTextValue >= 0 && pingTextValue <= 100) {
            pingMeterColor = pingColor;
        } else {
            pingMeterColor = pingColor;
        }
    

    // Update teks dlText
    $('#dlText').text(dlTextValue);
    $('#wlText').text(wlTextValue);
    $('#plText').text(plTextValue);
    $('#ulText').text(ulTextValue); 
    $('#pingText').text(pingTextValue);


    // Menggambar meter dengan warna yang sesuai
    drawMeter(I("dlMeter"), dlTextValue, 100, meterBk, dlMeterColor);
    drawMeter(I("wlMeter"), wlTextValue, 100, meterBk, wlMeterColor);
    drawMeter(I("plMeter"), plTextValue, 100, meterBk, plMeterColor);
    drawMeter(I("ulMeter"), ulTextValue, 100, meterBk, ulMeterColor);
    drawMeter(I("pingMeter"), pingTextValue, 100, meterBk, pingMeterColor);
}

    //update the UI every frame
    window.requestAnimationFrame=window.requestAnimationFrame||window.webkitRequestAnimationFrame||window.mozRequestAnimationFrame||window.msRequestAnimationFrame||(function(callback,element){setTimeout(callback,1000/60);});
    function frame(){
        requestAnimationFrame(frame);
        updateUI();
    }
    frame(); //start frame loop



</script>


<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion" style="background-color: 	#D2691E;" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                <img src="img/tomato.png" alt="Tomat" width="50" height="50">
                </div>
                <div class="sidebar-brand-text mx-3">Penyiraman Tomat<sup>JTD</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

             <li class="nav-item">
                <a class="nav-link" href="tables.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Report</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                <?php echo $_SESSION['username']; ?>
                                </span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="login.php" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Keluar
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Content Row -->
                    <div class="row">

                    <div class="col-xl-9 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h5 class="m-0 font-weight-bold" style="color: #D2691E;">Monitoring</h5>
                                    <div class="dropdown no-arrow">
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body text-center">
                                    <div class="testGroup">
                                        <div class="testArea">
                                            <div class="testName3">Suhu Udara</div>
                                            <canvas id="dlMeter" class="meter"></canvas>
                                            <div id="dlText" class="meterText"></div>
                                            <h4><div class="unit2">°C</div></h4>
                                            <h5><div class="nilai">0</div></h5>
                                            <h5><div class= "nilai2">100</div><h5>
                                        </div>
                                        <div class="testArea">
                                            <div class="testName">Kelembapan Udara</div>
                                            <canvas id="wlMeter" class="meter"></canvas>
                                            <div id="wlText" class="meterText"></div>
                                            <h4><div class="unit2">%</div></h4>
                                            <h5><div class="nilai">0</div></h5>
                                            <h5><div class= "nilai2">100</div><h5>
                                        </div>
                                        <div class="testArea">
                                            <div class="testName3">Ph tanah</div>
                                            <canvas id="plMeter" class="meter"></canvas>
                                            <div id="plText" class="meterText"></div>
                                            <h4><div class="unit2">ph</div></h4>
                                            <h5><div class="nilai">0</div></h5>
                                            <h5><div class= "nilai2">100</div><h5>
                                        </div>
                                        <div class="testArea">
                                            <div class="testName">Kelembapan Tanah</div>
                                            <canvas id="ulMeter" class="meter"></canvas>
                                            <div id="ulText" class="meterText"></div>
                                            <h4><div class="unit">%</div></h4>
                                            <h5><div class="nilai">0</div></h5>
                                            <h5><div class= "nilai2">100</div><h5>
                                        </div>
                                        <div class="testArea">
                                            <div class="testName3">Pestisida</div>
                                            <canvas id="pingMeter" class="meter"></canvas>
                                            <div id="pingText" class="meterText"></div>
                                            <h4><div class="unit2">liter</div></h4>
                                            <h5><div class="nilai">0</div></h5>
                                            <h5><div class="nilai2">100</div></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h5 class="m-0 font-weight-bold" style="color: #D2691E;">Status Penyiraman</h5>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body text-center">
                                <div id="status" class="status-badge"></div>
                                </div>
                            </div>
                        </div>


                    </div>
                        

                    <!-- Content Row -->

                    <div class="row">

                    <div class="col-xl-6 col-lg-2">
                            <div class="card shadow mb-3">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h5 class="m-0 font-weight-bold" style="color: #D2691E;">Grafik Kelembapan</h5>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div id="grafik">
                                    </div>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-2">
                            <div class="card shadow mb-3">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h5 class="m-0 font-weight-bold" style="color: #D2691E;">Grafik Suhu</h5>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div id="grafik2">
                                    </div>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-2">
                            <div class="card shadow mb-3">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h5 class="m-0 font-weight-bold" style="color: #D2691E;">Grafik Pestisida</h5>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div id="grafik3">
                                    </div>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-2">
                            <div class="card shadow mb-3">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h5 class="m-0 font-weight-bold" style="color: #D2691E;">Grafik Pestisida</h5>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div id="grafik4">
                                    </div>
                                    
                                </div>
                            </div>
                        </div>

                        <!-- Area Chart -->
                        <div class="col-xl-6 col-lg-2">
                            <div class="card shadow mb-3">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h5 class="m-0 font-weight-bold" style="color: #D2691E;">Daily Capture</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                        
                        <?php
                        $imagePath = 'captured_images/';
                        $images = glob($imagePath . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);

                        if (count($images) > 0) {
                            // Sort images by filemtime (last modified time) to get the most recent image first
                            array_multisort(array_map('filemtime', $images), SORT_DESC, $images);

                            // Get the most recent image
                            $latestImage = $images[0];

                            // Display only the most recent image with specified width and height
                            echo '<img src="' . $latestImage . '" class="card-img-top" alt="Captured Image" style="width: 100%; height: auto;">';
                        } else {
                            echo '<p>No images found.</p>';
                        }
                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                                              
                    </div>
                    
                        

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Dipersembahkan &copy; Politeknik Negeri Malang</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Anda akan keluar?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih Keluar untuk meninggalkan halaman</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Kembali</button>
                    <a class="btn btn-primary" style="background-color:#D2691E;" href="login.php">Keluar</a>
                </div>
            </div>
        </div>
    </div>

    

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    

</body>

</html>