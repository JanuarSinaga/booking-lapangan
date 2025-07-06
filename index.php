<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
        <link rel="stylesheet" href="./res/css/bootstrap.css">
        <script src="./res/js/jquery.js"></script>
        <title>Selamat datang di Lapangan Futsal Terminal</title>
        <style>
            nav{
                height:68px;
            }

            main{
                height:calc(100dvh - 68px);
            }

            #bgimg{
                background-position: center !important;
                background-repeat: no-repeat !important;
                background-size: cover !important;
                transform: scaleX(-1);
            }

            #bgimg > div{
                transform: scaleX(-1);
                background: rgba(0, 0, 0, 0.6);
                backdrop-filter: blur(2px);
            }

            .card-img-top{
                height:15rem !important;
                position:relative;
            }
            
            img{
                object-fit: cover;
                object-position: center;
            }

            .card{
                width: 20rem !important;
                border-radius: .5rem !important;
                overflow:hidden;
                height:max-content;
                flex-shrink: 0;
            }
            
            .shade{
                opacity:0;
                width: 100%;
                height: 100%;
                background-color: #000;
                position:absolute;
                top:0;
                left:0;
                transition:opacity .2s ease;
            }
            
            .shade:hover{
                opacity:.6;
            }

            .fa-play-circle {
                font-size:4rem;
            }

            #review{
                background: rgba(0, 0, 0, 0.6);
                backdrop-filter: blur(2px);
            }

            #dropdown-btn{
                display: none;
            }

            .yt-frame{
                height:325px;
            }

            @media screen and (max-width:768px) {
                #tipe-Lapangan{
                    flex-direction:column !important;
                    gap:2rem
                }
                
                #tipe-Lapangan{
                    padding: 2rem 0;
                }

                #dropdown-btn{
                    border:none;
                    background:transparent;
                    display: block;
                    padding: 1rem;
                }

                #menu{
                    flex-direction: column !important;
                    position:fixed !important;
                    padding: 1rem !important;
                    right:1rem !important;
                    top:54px !important;
                    border-radius:6px;
                }

                #menu > * {
                    width: 100%;
                }

                .hide{
                    display:none !important;
                }

                .yt-frame{
                    width:calc(100vw - 8rem);
                }
            }

            @media screen and (min-width:768px) {
                #about-us > p:not(.fs-3), #contact-us{
                    font-size:1rem !important;
                }

                .space{
                    display:none;
                }
                
                .yt-frame{
                    width:600px;
                }
            }

            .video-container{
                position:relative !important;
                width:max-content !important;
                height:max-content !important;
            }

            .video-close-btn{
                position:absolute !important;
                width:2rem !important;
                height:2rem !important;
                top:-2.25rem;
                right:-2.25rem;
                border:none;
                color:white;
                border-radius:50%;
                padding:0;
                margin:0;
            }
        </style>
    </head>
    <body class="d-flex flex-column vh-100">
        <nav class="w-100 sticky-top bg-primary d-flex flex-row align-items-center justify-content-between">
            <p class="fs-4 fw-bold text-light m-0 p-3">Terminal Futsal</p>
            <button id="dropdown-btn" class="text-white fas fa-bars" onclick="$('#menu').toggleClass('hide');$(this).toggleClass('fa-bars');$(this).toggleClass('fa-xmark');"></button>
            <div class="sticky-top bg-primary d-flex flex-row align-items-center justify-content-end gap-3 px-4 hide" id="menu">
                <a class="btn <?=(!isset($_GET['page'])) ? "btn-light" : "text-light"?>" href="index.php">Beranda</a>
                <a class="btn <?=(isset($_GET['page']) && !empty($_GET['page']) && $_GET['page'] === "Lapangan") ? "btn-light" : "text-light"?>" href="?page=Lapangan">Lapangan</a>
                <a class="btn <?=(isset($_GET['page']) && !empty($_GET['page']) && $_GET['page'] === "tentang") ? "btn-light" : "text-light"?>" href="?page=tentang">Tentang</a>
                <a class="btn btn-outline-light" href="pemesanan.php">Booking sekarang</a>
            </div>
        </nav>
        <main class="w-100 d-flex align-items-center justify-content-center">
            <?php if(!isset($_GET['page'])) {?>
            <div class="w-100 h-100 d-flex flex-column justify-content-center" id="bgimg" style="background:url(./res/img/Lapangan.png);">
                <div class="w-100 h-100 text-light d-flex flex-column align-items-center">
                    <div class="container d-flex flex-column justify-content-center h-100">
                        <p class="fs-1 fw-bold m-0 mb-2">Selamat datang di Lapangan Terminal Futsal</p>
                        <p class="fs-4 fw-medium">Pengalaman bermain futsal yang menyenangkan!</p>
                        <div class="d-flex flex-row align-items-center gap-3">
                            <a href="pemesanan.php" class="btn btn-primary" style="width:max-content;">Pesan sekarang!</a>
                            <a href="?page=Lapangan" class="btn btn-outline-light" style="width:max-content;">Lihat lapangan yang ada</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
            <?php if(isset($_GET['page']) && !empty($_GET['page']) && $_GET['page'] === "Lapangan") {?>
                <div class="w-100 h-100 text-light d-flex flex-row align-items-center justify-content-evenly" id="tipe-Lapangan">
                    <div class="card">
                        <div class="card-img-top">
                            <button onclick="previewVideo('pagi-video')" class="shade d-flex flex-column align-items-center justify-content-center gap-1">
                                <p class="far fa-play-circle text-light"></p>
                                <p class="text-light">Lihat review</p>
                            </button>
                            <img src="./res/img/Lapangan-pagi.png" class="w-100 h-100" alt="Lapangan pagi">
                        </div>
                        <div class="card-body text-dark">
                            <h5 class="card-title">Booking pagi</h5>
                            <p class="card-text">Mulai dari pukul 07.00 - 11.00 WIB</p>
                            <p class="text-primary fs-5 m-0 fw-bold">Rp 100.000,- /jam</p>
                        </div>
                    </div>    
                    <div class="card">
                        <div class="card-img-top">
                            <button onclick="previewVideo('siang-video')" class="shade d-flex flex-column align-items-center justify-content-center gap-1">
                                <p class="far fa-play-circle text-light"></p>
                                <p class="text-light">Lihat review</p>
                            </button>
                            <img src="./res/img/Lapangan-siang.png" class="w-100 h-100" alt="Lapangan siang">
                        </div>
                        <div class="card-body text-dark">
                            <h5 class="card-title fw-bold">Booking Siang - Sore</h5>
                            <p class="card-text">2Mulai dari pukul 12.00 - 17.00 WIB</p>
                            <p class="text-primary fs-5 m-0 fw-bold">Rp 110.000,- /jam</p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-img-top">
                            <button onclick="previewVideo('malam-video')" class="shade d-flex flex-column align-items-center justify-content-center gap-1">
                                <p class="far fa-play-circle text-light"></p>
                                <p class="text-light">Lihat review</p>
                            </button>
                            <img src="./res/img/Lapangan-malam.png" class="w-100 h-100" alt="Lapangan malam">
                        </div>
                        <div class="card-body text-dark">
                            <h5 class="card-title fw-bold">Booking Malam</h5>
                            <p class="card-text">Mulai dari pukul 18.00 - 00.00 WIB</p>
                            <p class="text-primary fs-5 m-0 fw-bold">Rp 135.000,- /jam</p>
                        </div>
                    </div>
                    <div class="p-4 space"></div>
                </div>
            <?php } ?>
            <?php if(isset($_GET['page']) && !empty($_GET['page']) && $_GET['page'] === "tentang") {?>
                <div class="w-100 h-100 d-flex flex-column p-4" style="font-size:.9rem; text-align:justify;">
                    <div class="flex flex-column" id="about-us">
                <p class="fs-3 fw-bold">Tentang Kami</p>
                <p>
                    Selamat datang di Lapangan Futsal Terminal!  
                    Kami adalah penyedia layanan reservasi lapangan futsal terpercaya dan terdepan.  
                    Dengan dedikasi tinggi, kami berkomitmen memberikan pengalaman pemesanan yang mudah, cepat, dan nyaman bagi setiap pelanggan.  
                    Nikmati berbagai pilihan booking terbaik dengan harga yang ramah di kantong.  
                    Kami memastikan Anda mendapatkan lapangan yang sempurna untuk mendukung setiap pertandingan futsal Anda.
                </p>
                <p>
                    Misi kami adalah menyediakan layanan reservasi lapangan futsal terbaik dengan harga kompetitif,  
                    didukung oleh tim profesional yang siap membantu Anda 24/7.  
                    Kami unggul dalam kemudahan navigasi situs web, beragam pilihan pembayaran, dan penawaran eksklusif  
                    yang dirancang untuk memenuhi kebutuhan setiap penggemar futsal.
                </p>
                <p>
                    Di Lapangan Futsal Terminal, kepuasan Anda adalah prioritas utama kami.  
                    Kami berkomitmen menjadikan setiap pertandingan futsal Anda lebih menyenangkan melalui proses reservasi yang mudah dan cepat.  
                    Terima kasih telah memilih kami sebagai mitra terbaik untuk kebutuhan permainan futsal Anda.
                </p>
                <p>
                    Selamat memesan dan selamat menikmati permainan futsal Anda bersama kami!
                </p>

                        <div class="d-flex flex-column gap-2">
                            <p class="fs-3 fw-bold mb-2">Kontak kami</p>
                            <table class="table-responsive" style="width:max-content;" id="contact-us">
                                <tr>
                                    <td>Alamat</td>
                                    <td>Jl. SMTK Medan No.10,</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Padang Bulan Selayang I, Kec. Medan Selayang, Kota Medan </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Sumatera Utara 20154</td>
                                </tr>
                                <tr>
                                    <td style="padding-right:1rem">No.Telpon</td>
                                    <td><a href="https://wa.me/">085668877270</a></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><a href="mailto:terminalfutsal@gmail.com">terminalfutsal@gmail.com</a></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="vw-100 vh-100 fixed-top d-none align-items-center justify-content-center" id="review">
                <div class="video-container d-none" id="pagi-video">
                    <button class="fas fa-xmark bg-primary video-close-btn" onclick="$('#pagi').css('display','none');$('#review').removeClass('d-flex');$('#review').addClass('d-none');"></button>
                    <iframe class="yt-frame" src="https://www.youtube.com/embed/F3uYuiYGKXg?si=rMBdVvJ9sniBAtUS" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>
                <div class="video-container d-none" id="siang-video">
                    <button class="fas fa-xmark bg-primary video-close-btn" onclick="$('#pagi').css('display','none');$('#review').removeClass('d-flex');$('#review').addClass('d-none');"></button>
                    <iframe class="yt-frame" src="https://www.youtube.com/embed/qwnriBIJGm0?si=29qU2oYN8ECRmrqj" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>
                <div class="video-container d-none" id="malam-video">
                    <button class="fas fa-xmark bg-primary video-close-btn" onclick="$('#pagi').css('display','none');$('#review').removeClass('d-flex');$('#review').addClass('d-none');"></button>
                    <iframe class="yt-frame" src="https://www.youtube.com/embed/tsgctLYxnWI?si=1XoEduN8dC2t8xn1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>
            </div>
        </main>
    </body>
    <script>
        const previewVideo = (videoIndex) => {
            $("#review").removeClass("d-none");
            $("#review").addClass("d-flex");
            $(".video-container").removeClass("d-flex");
            $(".video-container").addClass("d-none");
            $("#"+videoIndex).removeClass("d-none");
            $("#"+videoIndex).addClass("d-flex");
        }
    </script>
</html>
