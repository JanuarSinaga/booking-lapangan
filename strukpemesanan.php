<?php
require_once __DIR__ . "/config/configs.php";

if(isset($_GET['pesanan']) && !empty($_GET['pesanan'])){

    $nama = base64_decode($_GET['pesanan']);
    $res = sql("SELECT * FROM `pemesanan` WHERE nama = :nama", [":nama" => $nama]);

    if($res['row'] === 0){
        echo "<script>alert('Pesanan tidak ditemukan!'); window.location.href='pemesanan.php';</script>";
        exit;
    }
    
    foreach($res['data'] as $pesan){
        $nama = $pesan['nama'];
        $nohp = $pesan['nomorhp'];
        $waktu = $pesan['waktubermain'];
        $durasi = $pesan['durasi'];
        $presdis = $pesan['diskon'];
        $final = $pesan['final'];
        $jamMulai = $pesan['jam_mulai']; 
        $tglpesan = $pesan["tglpesan"];      
    }

    // Definisikan tipe agar bisa tampil gambar
    $tipe = $waktu; 
}
else{
    echo "<script>alert('Buat pesanan terlebih dahulu!'); window.location.href='pemesanan.php';</script>";
    exit;
}

function image(string $tipe){
    switch(strtolower($tipe)){
        case "pagi" : return "./res/img/lapangan-pagi.png";
        case "siang" : return "./res/img/lapangan-siang.png";
        case "malam" : return "./res/img/lapangan-malam.png";
        default: return "./res/img/lapangan-default.png";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="./res/css/bootstrap.css" />
    <title>Struk Pesanan</title>
    <style>
        #img{
            width: 100%;
            height:200px;
            object-fit: cover;
            object-position: center;
        }
    </style>
</head>
<body class="d-flex flex-column vh-100 w-100 align-items-center">
    <table class="table" style="width:400px;">
        <tr>
            <th class="fs-4 text-center" colspan="2">LAPANGAN TERMINAL FUTSAL</th>
        </tr>
        <tr>
            <th colspan="2" class="text-center fs-6">Struk Pesanan lapangan</th>
        </tr>
        <tr>
            <th colspan="2">
                <img src="<?= image($tipe); ?>" id="img" alt="Lapangan <?=htmlspecialchars($tipe)?>">
            </th>
        </tr>
        <tr>
            <td>Nama pemesan</td>
            <td><?=htmlspecialchars($nama)?></td>
        </tr>            
        <tr>
            <td>Nomor Telepon</td>
            <td><?=htmlspecialchars($nohp)?></td>
        </tr> 
        <tr>
            <td>Waktu Bermain</td>
            <td><?=htmlspecialchars($tipe)?></td>
        </tr>
        <tr>
            <td>Durasi bermain</td>
            <td><?=htmlspecialchars($durasi)?> Jam</td>
        </tr>
        <tr>
            <td>Diskon</td>
            <td><?=htmlspecialchars($presdis * 100)?> %</td>
        </tr>
        <tr>
            <td>Total Bayar</td>
            <td>Rp <?=htmlspecialchars(number_format($final,0,',','.'))?></td>
        </tr>
        <tr>
            <td colspan="2"><a href="pemesanan.php" class="btn btn-primary">Pesan lagi</a></td>
        </tr>
    </table>            
</body>
</html>
