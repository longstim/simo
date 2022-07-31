
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">

    <title>SIMO-Aplikasi Survei & Monitoring</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('simo-asset/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

<!--

Aplikasi Survey dan Monitoring (SIMO)

-->

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <link rel="stylesheet" href="{{asset('simo-asset/assets/css/templatemo-chain-app-dev.css')}}">
    <link rel="stylesheet" href="{{asset('simo-asset/assets/css/animated.css')}}">
    <link rel="stylesheet" href="{{asset('simo-asset/assets/css/owl.css')}}">


  </head>

<body>

  <!-- ***** Preloader Start ***** -->
  <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>
  <!-- ***** Preloader End ***** -->

  <!-- ***** Header Area Start ***** -->
  <header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav class="main-nav">
            <!-- ***** Logo Start ***** -->
            <a href="{{url('/')}}" class="logo">
              <img src="{{asset('image/simo.png')}}" alt="Chain App Dev" style ="width:200px;" align="top">
            </a>
            <!-- ***** Logo End ***** -->
            <!-- ***** Menu Start ***** -->
            <ul class="nav">
              <li class="scroll-to-section"><a href="#top" class="active">Home</a></li>
              <li class="scroll-to-section"><a href="#services">Features</a></li>
              <li class="scroll-to-section"><a href="#about">Program</a></li>
              <li class="scroll-to-section"><a href="#newsletter">Contact Us</a></li>
              @guest
                  <li><div class="gradient-button"><a id="modal_trigger" href="{{url('login')}}"><i class="fa fa-sign-in-alt"></i> Log In Now</a></div></li> 
              @else
              
                  <li><div class="gradient-button"><a id="modal_trigger" href="{{url('login')}}"><i class="fa fa-user"></i> {{Auth::user()->name}}</a></div></li> 
              @endguest
  
            </ul>        
            <a class='menu-trigger'>
                <span>Menu</span>
            </a>
            <!-- ***** Menu End ***** -->
          </nav>
        </div>
      </div>
    </div>
  </header>
  <!-- ***** Header Area End ***** -->
  
 

  <div class="main-banner wow fadeIn" id="top" data-wow-duration="1s" data-wow-delay="0.5s">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="row">
            <div class="col-lg-6 align-self-center">
              <div class="left-content show-up header-text wow fadeInLeft" data-wow-duration="1s" data-wow-delay="1s">
                <div class="row">
                  <div class="col-lg-12">
                    <h2 align = "left">SIMO (Aplikasi Survei & Monitoring)</h2>
                    <p align = "justify">Aplikasi ini merupakan aplikasi internal Balai Standardisasi dan Pelayanan Jasa
                      <br>Industri (BSPJI) Medan  yang berfungsi untuk kegiatan survey dan monitoring IKM.</br></p>
                  </div>
                  
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="right-image wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.5s">
                <img src="{{asset('simo-asset/assets/images/slider-dec.png')}}" alt="">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="services" class="services section">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 offset-lg-2">
          <div class="section-heading  wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.5s">
            <h4>Amazing <em>Features</em> for you</h4>
            <img src="{{asset('simo-asset/assets/images/heading-line-dec.png')}}" alt="">
            <p>Aplikasi ini memiliki berbagai fitur yang akan mempermudah Anda dalam melakukan survey dan monitoring.</p>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-lg-3">
          <div class="service-item first-service">
            <div class="icon"></div>
            <h4>To Do List</h4>
            <p align = "justify">Anda dapat merencanakan kegiatan survey dan monitoring IKM sesuai timeline beserta waktu pelaksanaannya.</p>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="service-item third-service">
            <div class="icon"></div>
            <h4>Data Project</h4>
            <p align = "justify">Anda dapat mengelola semua data project yang diperoleh dari survey dan monitoring IKM dalam database Aplikasi SIMO.</p>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="service-item second-service">
            <div class="icon"></div>
            <h4>Statistik</h4>
            <p align = "justify">Anda dapat melihat perkembangan perusahaan berdasarkan produktivitas, biaya produksi, dan penjualan dengan fitur ini.</p>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="service-item fourth-service">
            <div class="icon"></div>
            <h4>Progress Project</h4>
            <p align = "justify">Fitur ini membantu Anda untuk melihat realisasi pelaksanaan project berdasarkan anggaran yang telaah digunakan.</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="about" class="about-us section">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 align-self-center">
          <div class="section-heading">
            <h4> <em>DAPATI</em> &amp; PINOTI</h4>
            <img src="{{asset('simo-asset/assets/images/heading-line-dec.png')}}" alt="">
            <p align = "justify">Program kerja BSPJI Medan serta Pusat Optimalisasi Pemanfaatan Teknologi Industri dan Kebijakan Jasa Industri (POPTIKJI) untuk memajukan IKM di Indonesia melalui Dana Kemitraan Peningkatan Teknologi Industri (DAPATI) dan Penguatan Industri Melalui Optimalisasi Teknologi Industri (PINOTI).</p>
          </div>
          <div class="row">
            <div class="col-lg-6">
              <div class="box-item">
                <h4><a>Solve Problem</a></h4>
                <p>Menyelesaikan permasalahan IKM.</p>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="box-item">
                <h4><a>Konsultansi</a></h4>
                <p>Meningkatkan kapabilitas IKM.</p>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="box-item">
                <h4><a>Optimalisasi Teknologi</a></h4>
                <p>Pengembangan teknologi IKM.</p>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="box-item">
                <h4><a>Komersialisasi</a></h4>
                <p>Membantu pemasaran produk IKM.</p>
              </div>
            </div>
            <div class="col-lg-12">
              <p>IKM Maju, Indonesia Jaya!!!</p>
              <div class="gradient-button">
                <a>Bangga Melayani Bangsa</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="right-image">
            <img src="{{asset('simo-asset/assets/images/about-right-dec.png')}}" alt="">
          </div>
        </div>
      </div>
    </div>
  </div>

  <footer id="newsletter">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 offset-lg-2">
          <div class="section-heading">
            <h4>Serve IKM, Make it Optimal</h4>
          </div>
        </div>
    
      <div class="row" align = "justify">
        <div class="col-lg-3" >
          <div class="footer-widget">
            <h4>Contact Us</h4>
            <p align = "justify">Jl. Sisingamangaraja No.24, Ps. Merah, Kec. Medan Kota, Kota Medan, Sumatera Utara 20217, Indonesia</p>
            <p><a>061 - 7363471</a></p>
            <p><a>bind_medan@kemenperin.go.id</a></p>
          </div>
        </div>
       
        <div class="col-lg-3">
          <div class="footer-widget">
            <h4>About Our Office</h4>
            <div class="logo">
              <img src="{{asset('simo-asset/assets/images/white-logo.png')}}" alt="">
            </div>
            <p>Balai Standardisasi dan Pelayanan Jasa Industri Medan</p>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="copyright-text">
            <p>Copyright © 2022 BSPJI Medan. All Rights Reserved. 
          <br>Design: <a>BSPJI Medan</a></p>
          </div>
        </div>
      </div>
    </div>
  </footer>


  <!-- Scripts -->

  <script src="{{asset('simo-asset/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('simo-asset/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('simo-asset/assets/js/owl-carousel.js')}}"></script>
  <script src="{{asset('simo-asset/assets/js/animation.js')}}"></script>
  <script src="{{asset('simo-asset/assets/js/imagesloaded.js')}}"></script>
  <script src="{{asset('simo-asset/assets/js/popup.js')}}"></script>
  <script src="{{asset('simo-asset/assets/js/custom.js')}}"></script>
</body>
</html>