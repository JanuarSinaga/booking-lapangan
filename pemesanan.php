<?php
require_once __DIR__ . "/config/configs.php";

// Definisi konstanta diletakkan di luar if
define("DISCOUNT", 0.1);
define("LAMA_HARI_DSC", 3);
define("WAKTU_BERMAIN", [
    "100000" => "Pagi",
    "110000" => "Siang",
    "130000" => "Malam"
]);

if(isset($_POST['pesan']) && $_SERVER['REQUEST_METHOD'] === "POST"){

    if(
        isset($_POST['pemesan']) && 
        isset($_POST['nomorhp']) && 
        isset($_POST['waktubermain']) && 
        isset($_POST['tanggalpesan']) && 
        isset($_POST['durasibermain']) &&
        isset($_POST['jammulai']) 
    ){
        $nama = htmlspecialchars(trim($_POST['pemesan']));
        $nohp = htmlspecialchars(trim($_POST['nomorhp']));
        $hargaLapangan = intval(htmlspecialchars($_POST['waktubermain']));
        $tglpesan = htmlspecialchars($_POST['tanggalpesan']); // format yyyy-mm-dd
        $jamMulai = htmlspecialchars($_POST['jammulai']);     // format HH:ii
        $durasi = intval(htmlspecialchars($_POST['durasibermain']));
        
        // Gabungkan tanggal dan jam mulai menjadi datetime
        $waktuMulai = $tglpesan . ' ' . $jamMulai . ':00';

        // Validasi nomor HP: harus mulai 08 dan panjang 10-14 digit
        if(preg_match('/^08[0-9]{8,12}$/', $nohp)){

            $airmineral = 0;
            if(isset($_POST['water'])){
                $airmineral = intval(htmlspecialchars($_POST['water']));
            }

            $hitung = ($durasi * $hargaLapangan);
            $presdis = 0;

            if($durasi > LAMA_HARI_DSC){
                $presdis = DISCOUNT;
                $hargadis = $hitung * DISCOUNT;
                $final = ($hitung - $hargadis) + $airmineral;
            }
            else{
                $final = $hitung + $airmineral;
            }

            if(array_key_exists($hargaLapangan, WAKTU_BERMAIN)){
                $tipe = WAKTU_BERMAIN[$hargaLapangan];
            } else {
                $tipe = "Tidak diketahui";
            }

            // Simpan ke DB
            sql("INSERT INTO `pemesanan` 
                (nama, nomorhp, waktubermain, tglpesan, jam_mulai, durasi, airmineral, diskon, final) 
                VALUES (:nama, :nomorhp, :waktubermain, :tglpesan, :jam_mulai, :durasi, :airmineral, :diskon, :final)", [
                ":nama" => $nama,
                ":nomorhp" => $nohp,
                ":waktubermain" => $tipe,
                ":tglpesan" => $tglpesan,
                ":jam_mulai" => $jamMulai,
                ":durasi" => $durasi,
                ":airmineral" => $airmineral,
                ":diskon" => $presdis,
                ":final" => $final
            ]);

            header("location:strukpemesanan.php?pesanan=" . base64_encode($nama));
            exit;
        }
        else{
            $nohp_invalid = true;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="./res/css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <script src="./res/js/jquery.js"></script>
    <title>Pemesanan Lapangan</title>
</head>
<body class="d-flex flex-column vh-100 w-100 align-items-center">
    <form class="d-flex flex-column mt-2 pb-5" style="width:400px" action="pemesanan.php" method="POST">
        <div class="d-flex flex-row align-items-center gap-3 mb-3">
            <a href="index.php" class="fas fa-house fs-6 text-primary"></a>|
            <p class="fs-3 fw-bold m-0">Pesan Lapangan</p>
        </div>
        <div class="mb-3">
            <label for="namapemesan" class="form-label">Nama lengkap</label>
            <input type="text" class="form-control" id="namapemesan" name="pemesan" required>
        </div>
        <div class="mt-1 mb-3">
            <label for="nomorhp" class="form-label">Nomor Telepon</label>
            <!-- Ganti type number ke tel supaya nomor 08 tidak hilang leading zero -->
            <input type="tel" pattern="08[0-9]{8,12}" class="form-control" id="nomorhp" name="nomorhp" required>
            <?php if(isset($nohp_invalid)) : ?>
                <label for="nomorhp" class="form-text text-danger" style="font-size:.9rem">
                    Nomor Telepon salah, harus dimulai dari 08 dan minimal 10 digit!
                </label>
            <?php endif;?>
        </div>
        <label for="waktubermain" class="mb-2">Waktu Bermain</label>
        <select class="form-select" id="waktubermain" name="waktubermain" required>
            <option selected value="0">- Pilih Waktu Bermain -</option>
            <option value="100000">Pagi (Rp 100.000,-)</option>
            <option value="110000">Siang (Rp 110.000,-)</option>
            <option value="130000">Malam (Rp 130.000,-)</option>
        </select>
        <label for="waktubermain" class="form-text text-danger d-none" id="waktubermain-notice" style="font-size:.9rem">Pilih Waktu Bermain anda!</label>
        <div class="mt-3">
            <label for="tanggalpesan" class="form-label">Tanggal pesan</label>
            <input type="date" class="form-control" id="tanggalpesan" name="tanggalpesan" required>
        </div>    
        <div class="mt-3">
            <label for="jammulai" class="form-label">Jam Mulai Bermain</label>
            <input type="time" class="form-control" id="jammulai" name="jammulai" required>
        </div>
        <div class="mt-3">
            <label for="durasibermain" class="form-label">Durasi bermain futsal (jam) (Lebih 3 jam diskon 10%)</label>
            <input type="number" min="1" class="form-control" id="durasibermain" name="durasibermain" required>
            <label for="durasibermain" class="form-text text-danger d-none" id="durasi-notice" style="font-size:.9rem">Masukkan durasi bermain anda!</label>
        </div>    
        <div class="d-flex flex-row align-items-center gap-3 mt-3">
            <input class="form-check-input" type="checkbox" id="water" value="25000" name="water">
            <label for="water">Termasuk Air Mineral (Rp 25.000,-)</label>
        </div>
        <div class="input-group mt-3">
            <input type="text" readonly class="form-control" placeholder="Harga total" id="final" required>
        </div>
        <button type="submit" name="pesan" class="btn btn-primary mt-4" id="submit">Buat pesanan</button>
    </form>

<script>
    const calc = () => {
        const presdis = 0.1;
        const lapangan = parseFloat($("#waktubermain").val());
        const durasi = parseFloat($("#durasibermain").val());
        var airmineral = 0;

        if(durasi === "" || durasi <= 0){
            $("#durasi-notice").removeClass("d-none").addClass("d-flex");
            return false;
        }
        else{
            $("#durasi-notice").removeClass("d-flex").addClass("d-none");
        }

        if(lapangan === "" || lapangan <= 0){
            $("#waktubermain-notice").removeClass("d-none").addClass("d-flex");
            return false;
        }
        else{
            $("#waktubermain-notice").removeClass("d-flex").addClass("d-none");
        }

        if($("#water").is(":checked")){
            airmineral = parseFloat($("#water").val());
        }

        var harga = 0;
        if(durasi > 3){
            var hargadis = lapangan * durasi * presdis;
            harga = ((lapangan * durasi) - hargadis) + airmineral;
        }
        else{
            harga = (lapangan * durasi) + airmineral;
        }

        $("#final").val("Rp " + harga.toLocaleString("id-ID"));
        return true;
    }

    $("#water").click(() => {
        if(!calc()){
            $("#submit").attr("type","button");
        }
        else{
            $("#submit").attr("type","submit");
        }
    });

    $("#final,#durasibermain,#waktubermain").on("input",() => {
        if(!calc()){
            $("#submit").attr("type","button");
        }
        else{
            $("#submit").attr("type","submit");
        }
    });
</script>
</body>
</html>
