<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Beranda IBATEK</title>
    <link rel="shortcut icon" href="{{ asset('assets-new/images/logo/ibtk.png') }}" type="image/x-icon">

    <!-- Font & Icons -->
    <link rel="stylesheet" crossorigin="anonymous"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Bootstrap & Theme -->
    <link href="vendors/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="assets/css/theme.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css" />
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            scroll-behavior: smooth;
        }

        .hero-text {
            font-family: 'Lora', serif;
        }

        .navbar {
            transition: all 0.4s ease;
            background: white;
        }

        .img-fluid {
            animation: float 3s ease-in-out infinite;
            /* Nama animasi, durasi, timing function, dan infinite loop */
        }

        .floating-circle {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 119, 0, 0.1);
            z-index: -19;
        }

        .circle-1 {
            width: 250px;
            height: 250px;
            top: -75px;
            left: -50px;
        }

        .circle-2 {
            width: 250px;
            height: 250px;
            bottom: -85px;
            right: -50px;
        }

        .circle-3 {
            width: 100px;
            height: 100px;
            top: -20%;
            right: 300px;
        }

        @keyframes float {
            0% {
                transform: translatey(0px);
                /* Posisi awal */
            }

            50% {
                transform: translatey(-20px);
                /* Bergerak ke atas 20px dari posisi awal */
            }

            100% {
                transform: translatey(0px);
                /* Kembali ke posisi awal */
            }
        }

        .navbar.scrolled {
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .btn-primary,
        .btn-info,
        .btn-secondary {
            border-radius: 30px;
            padding: 10px 25px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover,
        .btn-info:hover,
        .btn-secondary:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
        }

        section {
            padding: 60px 0;
        }

        .features-items {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .features-items:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s ease;
        }

        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .navbar .btn-custom {
            background-color: #ff9900;
            color: #fff;
            border: none;
            border-radius: 50px;
            padding: 8px 20px;
            font-weight: 600;
            transition: all 0.3s ease-in-out;
        }

        .navbar .btn-custom:hover {
            background-color: #e68900;
            color: #fff;
        }

        .social-icon {
            color: #555;
            font-size: 1.5rem;
            margin-right: 15px;
            transition: color 0.3s ease;
        }

        .social-icon:hover {
            color: #ff9900;
        }

        #typing-text {
            border-right: 1px solid;
            margin-right: 15px;
            white-space: nowrap;
            overflow: hidden;
            animation:
                blink-caret 0.75s step-end infinite;
        }

        @keyframes blink-caret {

            from,
            to {
                border-color: transparent
            }

            50% {
                border-color: initial
            }
        }

        .logo-section {
            padding: 100px 0;
            background-color: #f8f9fa;
        }

        .logo-section h2 {
            font-size: 2rem;
            color: #ff9900;
            margin-bottom: 50px;
            font-family: 'Poppins';
            text-align: center;
            /* Menambahkan ini agar judul rata tengah */
        }

        .logo-container {
            overflow: hidden;
            /* Menyembunyikan konten di luar area */
            white-space: nowrap;
            /* Menjaga semua logo dalam satu baris */
        }

        .logo-list {
            display: inline-block;
            animation: scroll-left 20s linear infinite;
            /* Animasi bergerak ke kiri */
            padding-right: 100%;
            /* Penting untuk animasi berulang tanpa jeda */
        }

        .logo-item {
            display: inline-block;
            text-align: center;
            margin: 0 15px;
            /* Jarak yang lebih rapi antar logo */
        }

        .logo-item img {
            max-width: 100px;
            height: auto;
            opacity: 0.3;
            transition: opacity 0.3s ease;
        }

        .logo-item img:hover {
            opacity: 1;
        }

        @keyframes scroll-left {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-100%);
            }
        }

        .hero-slider {
            position: relative;
            width: 100%;
            height: 320px;
            /* tinggi default mobile */
            background: #fff;
        }

        @media (min-width: 768px) {
            .hero-slider {
                height: 420px;
            }

            /* tinggi tablet/desktop */
        }

        .hero-slider .swiper-slide {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero-slider img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            /* biar gambar tidak terpotong */
            border-radius: 1rem;
        }

        /* Aksen warna brand pada kontrol */
        .hero-swiper .swiper-button-next,
        .hero-swiper .swiper-button-prev {
            color: #ff9900;
        }

        .hero-swiper .swiper-pagination-bullet-active {
            background: #ff9900;
        }
    </style>
</head>

<body>
    <main class="main" id="top">
        <nav class="navbar navbar-light sticky-top">
            <div class="container py-2 d-flex justify-content-between align-items-center">
                <a class="navbar-brand" href="/login">
                    <img src="{{ asset('assets-new/images/logo/ibatek.png') }}" alt="IBATEK" height="50" />
                </a>
                <div class="d-flex gap-2">
                    <button class="btn btn-custom rounded-pill px-4 py-1"
                        onclick="window.location.href='/login'">Login</button>
                    <button class="btn btn-custom rounded-pill px-4 py-1"
                        onclick="window.location.href='/register'">Register</button>
                    <button class="btn btn-danger rounded-pill px-4 py-1"
                        onclick="window.location.href='/about'">Tentang</button>
                </div>
            </div>
            </div>
        </nav>

        <!-- Hero -->
        <section class="mt-6 fade-in">
            <div class="container position-relative">
                <div class="floating-circle circle-1"></div>
                <div class="floating-circle circle-2"></div>
                <div class="floating-circle circle-3"></div>

                <div class="row align-items-center text-center text-md-start">
                    <!-- Kolom kiri: teks tetap -->
                    <div class="col-md-6">
                        <h1 class="display-6 fw-bold">
                            Sistem Kendali Mahasiswa <span id="typing-text"></span>
                        </h1>
                        <p class="fs-2 mt-3">
                            Platform terintegrasi untuk memantau, mengelola, dan mengevaluasi aktivitas
                            mahasiswa penerima beasiswa IBATEK.
                        </p>
                        <button class="btn btn-secondary mt-3" onclick="window.location.href='/login'">Masuk ke
                            Sistem</button>
                        <button class="btn btn-secondary mt-3" onclick="window.location.href='/register'">Daftar
                            Sekarang</button>
                    </div>

                    <!-- Kolom kanan: slider gambar -->
                    <div class="col-md-6 mt-4 mt-md-0">
                        <div class="hero-slider swiper hero-swiper rounded-4 shadow-sm">
                            <div class="swiper-wrapper">
                                <!-- Slide 1 -->
                                <div class="swiper-slide">
                                    <img src="{{ asset('1.jpeg') }}" alt="Dashboard IBATEK" />
                                </div>
                                <!-- Slide 2 -->
                                <div class="swiper-slide">
                                    <img src="{{ asset('2.jpeg') }}" alt="Logo" />
                                </div>
                                <!-- Slide 3 -->
                                <div class="swiper-slide">
                                    <img src="{{ asset('4.jpeg') }}" alt="Manajemen Profil" />
                                </div>
                                <div class="swiper-slide">
                                    <img src="{{ asset('5.jpeg') }}" alt="Manajemen Profil" />
                                </div>
                                <div class="swiper-slide">
                                    <img src="{{ asset('6.jpeg') }}" alt="Manajemen Profil" />
                                </div>
                                <div class="swiper-slide">
                                    <img src="{{ asset('7.jpeg') }}" alt="Manajemen Profil" />
                                </div>
                                <div class="swiper-slide">
                                    <img src="{{ asset('8.jpeg') }}" alt="Manajemen Profil" />
                                </div>
                                <div class="swiper-slide">
                                    <img src="{{ asset('9.jpeg') }}" alt="Manajemen Profil" />
                                </div>
                                <div class="swiper-slide">
                                    <img src="{{ asset('10.jpeg') }}" alt="Manajemen Profil" />
                                </div>
                                <div class="swiper-slide">
                                    <img src="{{ asset('11.jpeg') }}" alt="Manajemen Profil" />
                                </div>
                                <div class="swiper-slide">
                                    <img src="{{ asset('12.jpeg') }}" alt="Manajemen Profil" />
                                </div>
                                <div class="swiper-slide">
                                    <img src="{{ asset('13.jpeg') }}" alt="Manajemen Profil" />
                                </div>
                                <div class="swiper-slide">
                                    <img src="{{ asset('14.jpeg') }}" alt="Manajemen Profil" />
                                </div>
                                <div class="swiper-slide">
                                    <img src="{{ asset('15.jpeg') }}" alt="Manajemen Profil" />
                                </div>
                                <!-- Tambah slide sesuka hati -->
                            </div>

                            <!-- Pagination & Arrows -->
                            <div class="swiper-pagination"></div>
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features -->
        <section id="features" class="py-5 bg-light">
            <div class="container">
                <h1 class="display-8 fw-bold text-center mb-3">Fitur Utama</h1>
                <p class="fs-2 text-center text-muted mb-5">Fasilitas lengkap untuk mendukung pengelolaan mahasiswa
                    penerima beasiswa.</p>

                <div class="row g-4">
                    <!-- Feature 1 -->
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm feature-card text-center border-0">
                            <div class="card-body p-4">
                                <img src="assets/img/gallery/dashboardicon.png" alt="Dashboard" class="mb-3"
                                    style="width:60px;height:60px;" />
                                <h5 class="fw-bold">Dashboard Interaktif</h5>
                                <p class="text-muted">Pantau data mahasiswa dan kegiatan secara real-time dalam satu
                                    tampilan ringkas.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Feature 3 -->
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm feature-card text-center border-0">
                            <div class="card-body p-4">
                                <img src="assets/img/gallery/statistics.png" alt="Statistik" class="mb-3"
                                    style="width:60px;height:60px;" />
                                <h5 class="fw-bold">Statistik & Laporan</h5>
                                <p class="text-muted">Hasilkan laporan kegiatan Mahasiswa</p>
                            </div>
                        </div>
                    </div>

                    <!-- Feature 4 -->
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm feature-card text-center border-0">
                            <div class="card-body p-4">
                                <img src="assets/img/gallery/profile.png" alt="Profil" class="mb-3"
                                    style="width:60px;height:60px;" />
                                <h5 class="fw-bold">Manajemen Profil</h5>
                                <p class="text-muted">Kelola biodata dan riwayat kegiatan setiap
                                    mahasiswa dalam satu sistem.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="logo-section">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <h2>Support By</h2>
                    </div>
                </div>
                <div class="row justify-content-center align-items-center">
                    <div class="col-md-3 col-sm-6 mb-4 logo-item">
                        <img src="{{ asset('assets-new/images/logo/UTI.png') }}" alt="Logo UTI" class="img-fluid">
                    </div>
                    <div class="col-md-3 col-sm-6 mb-4 logo-item">
                        <img src="{{ asset('assets-new/images/logo/ibtk.png') }}" alt="Logo IBATEK"
                            class="img-fluid">
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA -->
        <section class="bg-primary-gradient text-white text-center fade-in">
            <div class="container p-5 rounded-3">
                <h4 class="opacity-75">KIP-K Universitas Teknokrat Indonesia</h4>
                <h2 class="fw-bold mt-2" style="font-family: Dancing Script", cursive;>"Cerdas, Berprestasi, Dengan
                    Beasiswa"</h2>
                <button class="btn btn-light mt-3" onclick="window.location.href='/login'">
                    Login Sekarang <span class="fas fa-arrow-right"></span>
                </button>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-light text-dark pt-4 mt-5">
            <div class="container">
                <div class="row">

                    <!-- Logo & Deskripsi -->
                    <div class="col-md-4 mb-3">
                        <a class="navbar-brand" href="/">
                            <img src="{{ asset('assets-new/images/logo/ibatek.png') }}" alt="IBATEK"
                                height="50">
                        </a>
                        <p class="mt-2 text-muted">
                            Sistem Kendali Mahasiswa Beasiswa IBATEK <br>
                            Platform untuk memantau, mengelola, dan mengevaluasi aktivitas mahasiswa penerima beasiswa.
                        </p>
                    </div>

                    <!-- Navigasi -->
                    <div class="col-md-4 mb-3">
                        <h5 class="fw-bold" style="color: #ff9900;">Navigasi</h5>
                        <ul class="list-unstyled">
                            <li><a href="/" class="footer-link">Beranda</a></li>
                            <li><a href="/login" class="footer-link">Login</a></li>
                            <li><a href="/register" class="footer-link">Register</a></li>
                            <li><a href="/about" class="footer-link">Tentang</a></li>
                        </ul>
                    </div>

                    <!-- Kontak -->
                    <div class="col-md-4 mb-3">
                        <h5 class="fw-bold" style="color: #ff9900;">Kontak</h5>
                        <p class="mb-1 text-muted"><i class="bi bi-geo-alt-fill text-warning"></i> Jl. ZA. Pagar Alam
                            No.9 -11, Labuhan Ratu, Kec. Kedaton, Kota Bandar Lampung, Lampung 35132</p>
                        <p class="mb-1 text-muted"><i class="bi bi-envelope-fill text-warning"></i> teknokrat.ac.id
                        </p>
                        <p class="mb-1 text-muted"><i class="bi bi-telephone-fill text-warning"></i> 0721 - 702022
                        </p>
                    </div>

                    <div class="mt-3">
                        <a href=" https://www.instagram.com/ibatek.uti/" class="social-icon"><i
                                class="bi bi-instagram"></i></a>
                        <a href=" https://x.com/teknokrat_id" class="social-icon"><i class="bi bi-facebook"></i></a>
                        <a href="https://www.youtube.com/channel/UCYVRIU8V_Td9fHJRA2u57cg" class="social-icon"><i
                                class="bi bi-twitter"></i></a>
                        <a href="https://www.facebook.com/teknokrat" class="social-icon"><i
                                class="bi bi-youtube"></i></a>
                    </div>

                </div>

                <!-- Copyright -->
                <div class="text-center py-3 border-top mt-3">
                    <small class="text-muted">© 2025 IBATEK. All rights reserved.</small>
                </div>
            </div>
        </footer>
        <style>
            .footer-link {
                color: #808080;
                text-decoration: none;
                transition: color 0.3s ease;
            }

            .footer-link:hover {
                color: #ff9900;
            }
        </style>


        <!-- Scripts -->
        <script src="vendors/@popperjs/popper.min.js"></script>
        <script src="vendors/bootstrap/bootstrap.min.js"></script>
        <script src="vendors/is/is.min.js"></script>
        <script src="vendors/swiper/swiper-bundle.min.js"></script>
        <script src="assets/js/theme.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js"></script>
        <script>
            // Navbar shrink effect
            window.addEventListener("scroll", function() {
                const navbar = document.querySelector(".navbar");
                navbar.classList.toggle("scrolled", window.scrollY > 50);
            });

            // Fade-in on scroll
            const fadeEls = document.querySelectorAll(".fade-in");

            function checkFade() {
                fadeEls.forEach(el => {
                    const rect = el.getBoundingClientRect();
                    if (rect.top < window.innerHeight - 100) {
                        el.classList.add("visible");
                    }
                });
            }
            window.addEventListener("scroll", checkFade);
            window.addEventListener("load", checkFade);

            document.addEventListener('DOMContentLoaded', function() {
                const textElement = document.getElementById('typing-text');
                const textToType = " IBATEK";
                let isTyping = true;
                let charIndex = 0;
                const typingSpeed = 150;
                const erasingSpeed = 100;
                const delayBetweenActions = 1500;

                function typeText() {
                    if (isTyping) {
                        if (charIndex < textToType.length) {
                            textElement.textContent += textToType.charAt(charIndex);
                            charIndex++;
                            setTimeout(typeText, typingSpeed);
                        } else {
                            isTyping = false;
                            setTimeout(typeText, delayBetweenActions);
                        }
                    } else {
                        if (charIndex > 0) {
                            textElement.textContent = textToType.substring(0, charIndex - 1);
                            charIndex--;
                            setTimeout(typeText, erasingSpeed);
                        } else {
                            isTyping = true;
                            setTimeout(typeText, delayBetweenActions);
                        }
                    }
                }

                typeText();
            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                new Swiper('.hero-swiper', {
                    loop: true,
                    speed: 800,
                    autoplay: {
                        delay: 3500,
                        disableOnInteraction: false
                    },
                    pagination: {
                        el: '.hero-swiper .swiper-pagination',
                        clickable: true
                    },
                    navigation: {
                        nextEl: '.hero-swiper .swiper-button-next',
                        prevEl: '.hero-swiper .swiper-button-prev'
                    },
                    a11y: {
                        enabled: true
                    }
                });
            });
        </script>
</body>

</html>
