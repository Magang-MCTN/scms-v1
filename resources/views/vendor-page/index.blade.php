<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="storage/vendor.css">
        <script src="storage/vendor.js"></script>
        <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <div class="carousel slide" data-ride="carousel" style="z-index:1">
            <div class="container-fluid text-white" id="change-color">
              <div class="row" id="top-containt">
                <div class="col-4 text-center">
                  <a href="/vendor"><img src="{{ asset ('dashboard/template/images/MCTN.png')}}" height="100px" ></a>
                </div>
                <div class="col-8 pt-4 mt-1 text-center">
                  <span class="menu-1"><a href="/vendor" class="color">Beranda</a></span>
                  <span class="menu"><a href="ecommerce-price-men.html" class="color">Pengadaan</a></span>
                  <span class="menu"><a href="/profile/vendor" class="color">Status</a></span>
                  <span class="menu"><a href="/profile/vendor" class="color">Profile</a></span>
                  <span class="menu"><a href="/logout/vendor" class="color">Logout</a></span>
                  <span class="menu"><a href="login-form.html" class="color" style="color:black">Contact</a></span>
                </div>
              </div>
            </div>
            {{-- <div class="carousel-inner text-center">
              <div class="carousel-item" style="height:100vh"> 
                <div style="height:100vh;width:100vw" class="text-right pr-5">
                  <div class="container pt-4">
                    <div class="row mt-3 pt-5">
                      <div class="col-12 text-center pt-5">
                        <a href="all-top-container.html"><span class="box"><img src="Images/sale-box.jpg" height="320px"  style="transform: translateY(10%);"></span></a>
                        <a href="all-top-container.html"><img src="Images/sale-1..png" height="300px" class="sale-img"></a>
                      </div>
                    </div>
                  </div>
                </div>
              </div> 
              <div class="carousel-item" style="height:100vh">
                  <div class="container mt-4 pt-5">
                    <div class="row pt-5 pb-5">
                      <div class="col-12 text-center pb-4">
                        <a href="all-top-container.html"><span class="hide-banner"><img src="Images/ballon.jpg" height="350px;"></span></a>
                        <a href="all-top-container.html"><img src="Images/background-image.jpg" height="450px" class="sift-girl" style="margin-top:-3%"></a>
                        <a href="all-top-container.html"><span class="hide-girl"><img src="Images/sale-tag.jpg" height="430px;"></span></a>
                      </div>
                    </div>
                  </div>
              </div>
              <div class="carousel-item active" style="height:100vh">
                <div class="container pt-2 pt-5 pb-5">
                  <div class="row pt-5 pb-5">
                    <div class="col-12 text-center pb-5 pt-4">
                        <a href="all-top-container.html"><span class="hide-lady-1"><img src="Images/background-image-1.jpg" height="350px" style="padding-left:6%;margin-top:3%;"></span></a>
                        <a href="all-top-container.html"><span class="special"><img src="Images/sale.jpg" height="350px" style="padding-left:3%;margin-top:3%"></span></a>
                        <a href="all-top-container.html"><span class="hide-lady"><img src="Images/background-image-2.jpg" height="320px"></span></a>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div> --}}
          {{-- <div class='container-fluid pb-3'>
            <div class="row">
              <div class="col text-center">
                <a href="ecommerce-price-men.html"><span style="font-size:30px;text-transform:uppercase;font-weight:bold" data-aos="zoom-in">popular</span></a>
              </div>
            </div>
          </div>
          <div class="container-fluid pt-5" style="background-color:white">
            <div class="container"> 
              <div class="row text-center">
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 text-center">
                  <div class="container pl-0" height="250px" width="250px" style="overflow:hidden">
                    <a href="ecommerce-price-men.html"><img src="Images/girl.jpg" class="img-men" data-aos="fade-up" style="border-radius:20px;"><br></a>
                    <a href="ecommerce-price-men.html"><span class="image-lable" data-aos="fade-up">afordable & tradesional dress<br>$101.00</span></a>
                  </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 text-center popular-sift-down">
                  <div class="container pl-0" height="250px" width="250px" style="overflow:hidden">
                    <a href="ecommerce-price-men.html"><img src="Images/kids.jpg" class="img-men" style="border-radius:20px;" data-aos="fade-up"><br></a>
                    <a href="ecommerce-price-men.html"><span class="image-lable" data-aos="fade-up" >toddler children's dress<br>$203.00</span></a>
                  </div>
                </div>
                <div class="col-xl-3 col-lg-4 hide-lady-1">
                  <div class="container pl-0 text-center" height="250px" width="250px" style="overflow:hidden">
                    <a href="ecommerce-price-men.html"><img src="Images/blazers.jpg" class="img-men" style="border-radius:20px;" data-aos="fade-up"></a>
                    <a href="ecommerce-price-men.html"><span class="image-lable" data-aos="fade-up">men's black sweatshirt<br>$60.00</span></a>
                  </div>
                </div>
                <div class="col-xl-3 hide-lady">
                  <div class="container pl-0 text-center" height="250px" width="250px" style="overflow:hidden">
                    <a href="ecommerce-price-men.html"><img src="Images/boys-kids.jpg" class="img-men" style="border-radius:20px;" data-aos="fade-up"></a>
                    <a href="ecommerce-price-men.html"><span class="image-lable pl-3" data-aos="fade-up">boys flower print shirt<br>$320.00</span></a>
                  </div>
                </div>
              </div>
              <div class="row pt-5 pb-4 text-center">
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 text-center">
                  <div class="container pl-0" height="250px" width="250px" style="overflow:hidden">
                    <a href="ecommerce-price-men.html"><img src="Images/boys-kids-1.jpg" class="img-men" style="border-radius:20px;" data-aos="fade-up"><br></a>
                    <a href="ecommerce-price-men.html"><span class="image-lable" data-aos="fade-up">formal toxedo dress suits<br>$117.00</span></a>
                  </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 text-center popular-sift-down">
                    <div class="container pl-0" height="250px" width="250px" style="overflow:hidden">
                    <a href="ecommerce-price-men.html"><img src="Images/girl (2).jpg" class="img-men" style="border-radius:20px;" data-aos="fade-up"><br></a>
                    <a href="ecommerce-price-men.html"><span class="image-lable" data-aos="fade-up">girls flower print skirt<br>$400.00</span></a>
                  </div>
                </div>
                <div class="col-xl-3 col-lg-4 text-center hide-lady-1">
                  <div class="container pl-0" height="250px" width="250px" style="overflow:hidden">
                    <a href="ecommerce-price-men.html"><img src="Images/men.jpg" class="img-men" style="border-radius:20px;" data-aos="fade-up"></a>
                    <a href="ecommerce-price-men.html"><span class="image-lable" data-aos="fade-up">plain pink cotton saree<br>$400.00</span></a>
                  </div>
                </div>
                <div class="col-xl-3 text-center hide-lady">
                  <div class="container pl-0" height="250px" width="250px" style="overflow:hidden">
                    <a href="ecommerce-price-men.html"><img src="Images/men-1.jpg" class="img-men" style="border-radius:20px;" data-aos="fade-up"></a>
                    <a href="ecommerce-price-men.html"><span class="image-lable" data-aos="fade-up">accessories & tradesional dress<br>$117.00</span></a>
                  </div>
                </div>
              </div> --}}
              <div class="row mb-1 pb-3">
                <div class="col-12 pb-5 text-center">
                  {{-- <a href="ecommerce-price-men.html"><span style="font-weight:700;font-size:20px;color:blue" data-aos="zoom-in">see more</span><span class="pl-3" style="color:blue"><i class="fa fa-arrow-right" aria-hidden="true" data-aos="zoom-in"></i></span></a> --}}
                </div>
              </div>
            </div>
          </div>
          <div class="container-fluid transparent pt-5 pb-5" id="parallax1" style="background-image:url('Images/desktop.jpg');background-size:cover;background-attachment:fixed;">
            <div class="container sift-couple" height="200px">
              <div class="row">
                <div class="col-xl-5 col-lg-5 col-md-6 col-sm-12 col-12 text-center">
                  <a href="/vendor"><img src="{{ asset ('storage/ptmctn.PNG')}}" height="230px" class="pl-5" data-aos="fade-up"></a>
                </div>
                <div class="col-xl-7 col-lg-7 col-md-6 col-sm-12 col-12 pt-4 text-center"> 
                  <span style="font-weight:700;font-size:20px;" data-aos="zoom-in">PT Mandau Cipta Tenaga Nusantara
                    PT Mandau Cipta Tenaga Nusantara (MCTN) adalah anak perusahaan
                    PT PLN (Persero). Pada awalnya, PT MCTN merupakan perusahaan
                    Pembangkit Tenaga Listrik dan Uap yang memasok kebutuhan
                    operasional eksplorasi minyak Blok Hulu Rokan. PT MCTN memproduksi
                    listrik sebesar 70% atau sekitar 280 MW pada system blok Hulu Rokan,
                    termasuk produksi uap dengan kontribusi 70% terhadap kebutuhan
                    ekplorasi duri atau sebesar 46.850 Ton/hari.</span><br><br><a href="ecommerce-price-men.html"><span style="font-size:20px;color:rgb(180, 69, 69);font-weight: 800;text-transform: uppercase;" data-aos="zoom-in">Join With US</span></a>
                </div>
              </div>
            </div>
          </div>
          {{-- <div class="container-fluid mt-5">
           <div class="container pt-3 pb-3">
             <div class="row">
              <div class="col-sm-12 text-center pb-4 pt-4">
                <a href="ecommerce-price-men.html"><span style="text-transform: uppercase;font-weight: 700;font-size:30px;" data-aos="zoom-in">men's dress</span></a>
              </div>
             </div>
            <div class="row pt-1">
              <div class="col-xl-5 col-lg-5 text-center pt-5 hide-popular">
                <a href="ecommerce-price-men.html"><img src="Images/mens-dress.jpg" height="400px" data-aos="fade-up"><br></a>
                <a href="ecommerce-price-men.html"><span class="image-lable" data-aos="zoom-in">accessories & tradesional dress<br>$117.00</span></a>
              </div>
              <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12">
                <div class="row">
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 text-center pt-3">
                    <a href="ecommerce-price-men.html"><img src="Images/mens-dress-1.jpg" height="200px" data-aos="fade-up"><br></a>
                <a href="ecommerce-price-men.html"><span class="image-lable" data-aos="zoom-in">accessories & tradesional dress<br>$117.00</span></a>
                  </div>
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 text-center pt-3">
                    <a href="ecommerce-price-men.html"><img src="Images/mens-dress-2.jpg" height="200px" data-aos="fade-up"><br></a>
                    <a href="ecommerce-price-men.html"><span class="image-lable" data-aos="zoom-in">accessories & tradesional dress<br>$117.00</span></a>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 text-center pt-3">
                    <a href="ecommerce-price-men.html"><img src="Images/mens-dress-3.jpg" height="200px" data-aos="fade-up"><br></a>
                    <a href="ecommerce-price-men.html"><span class="image-lable" data-aos="zoom-in">accessories & tradesional dress<br>$117.00</span></a>
                  </div>
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 text-center pt-3">
                    <a href="ecommerce-price-men.html"><img src="Images/mens-dress-4.jpg" height="200px" data-aos="fade-up"><br></a>
                    <a href="ecommerce-price-men.html"><span class="image-lable" data-aos="zoom-in">accessories & tradesional dress<br>$117.00</span></a>
                  </div>
                </div>
              </div>
            </div>
            <div class="container pr-5 text-center mt-2 pb-3">
              <div class="row pt-5">
                <div class="col">
                  <a href="ecommerce-price-men.html"><span style="border:3px solid rgb(180, 69, 69);border-radius:10px;padding:1% 2%;background-color:rgb(177, 84, 84);" class="ml-4" data-aos="zoom-in"><span style="font-weight:700;font-size:20px;color:white;text-transform: uppercase;">more</span><span class="pl-3" style="color:white;"><i class="fa fa-arrow-right" aria-hidden="true"></i></span></span></a>
                </div>
              </div>
            </div>
          </div> 
          </div>
           <div class="container-fluid mt-4 pt-2">
            <div class="container pt-4 pb-4">
              <div class="row">
               <div class="col-sm-12 text-center pb-4">
                 <a href="ecommerce-price-men.html"><span style="text-transform: uppercase;font-weight: 700;font-size:30px;" data-aos="zoom-in">ladies dress</span></a>
               </div>
              </div>
             <div class="row">
               <div class="col-xl-5 col-lg-5 text-center pt-5 hide-popular">
                 <a href="ecommerce-price-men.html"><img src="Images/ladies-dress.jpg" height="400px" data-aos="fade-up"><br></a>
                 <a href="ecommerce-price-men.html"><span class="image-lable" data-aos="zoom-in">accessories & tradesional dress<br>$117.00</span></a>
               </div>
               <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12">
                 <div class="row">
                   <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 text-center pt-3">
                     <a href="ecommerce-price-men.html"><img src="Images/ladies-dress-1.jpg" height="200px" data-aos="fade-up"><br></a>
                 <a href="ecommerce-price-men.html"><span class="image-lable" data-aos="zoom-in">accessories & tradesional dress<br>$117.00</span></a>
                   </div>
                   <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 text-center pt-3">
                     <a href="ecommerce-price-men.html"><img src="Images/ladies-dress-2.jpg" height="200px" data-aos="fade-up"><br></a>
                     <a href="ecommerce-price-men.html"><span class="image-lable" data-aos="zoom-in">accessories & tradesional dress<br>$117.00</span></a>
                   </div>
                 </div>
                 <div class="row">
                   <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 text-center pt-3">
                     <a href="ecommerce-price-men.html"><img src="Images/ladies-dress-3.jpg" height="200px" data-aos="fade-up"><br></a>
                     <a href="ecommerce-price-men.html"><span class="image-lable" data-aos="zoom-in">accessories & tradesional dress<br>$117.00</span></a>
                   </div>
                   <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 text-center pt-3">
                     <a href="ecommerce-price-men.html"><img src="Images/ladies-dress-4.jpg" height="200px" data-aos="fade-up"><br></a>
                     <a href="ecommerce-price-men.html"><span class="image-lable" data-aos="zoom-in">accessories & tradesional dress<br>$117.00</span></a>
                   </div>
                 </div>
               </div>
             </div>
           </div>
           <div class="container pr-5 text-center mt-4 pb-5">
            <div class="row pt-2 pb-3">
              <div class="col">
                <a href="ecommerce-price-men.html"><span style="border:3px solid rgb(180, 69, 69);border-radius:10px;padding:1% 2%;background-color:rgb(177, 84, 84);" class="ml-4" data-aos="zoom-in"><span style="font-weight:700;font-size:20px;color:white;text-transform: uppercase;">more</span><span class="pl-3" style="color:white;"><i class="fa fa-arrow-right" aria-hidden="true"></i></span></span></a>
              </div>
            </div>
          </div>
          </div> 
          <div class="container pt-4 pb-5">
            <div class="row">
              <div class="col-sm-12 text-center">
                <a href="ecommerce-price-men.html"><span style="text-transform: uppercase;font-weight: 700;font-size:30px;" data-aos="zoom-in">kids dress</span></a>
              </div>
            </div>
          </div> 
          <div class="container-fluid pt-5 pb-3 px-0" id = "parallax2" style="background-image:url('Images/desktop-1.jpg');background-size:cover;background-attachment: fixed;">
            <div class="container" height="200px">
              <div class="row pt-1">
               <div class="col-xl-3 col-lg-3  col-md-4 col-sm-6 col-12 pb-3 text-center">
                <a href="ecommerce-price-men.html"><img src="Images/kids-dress-1.jpg" height="200px" style="border-radius:20px;" data-aos="fade-up"><br></a>
                     <a href="ecommerce-price-men.html"><span class="image-lable" data-aos="zoom-in">accessories & tradesional dress<br>$117.00</span></a>
               </div>
               <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12 text-center">
                <a href="ecommerce-price-men.html"><img src="Images/boys-dress-1.jpeg" height="200px" style="border-radius:20px;" data-aos="fade-up"><br></a>
                <a href="ecommerce-price-men.html"><span class="image-lable" data-aos="zoom-in">accessories & tradesional dress<br>$117.00</span></a>
               </div>
               <div class="col-xl-3 col-lg-3 col-md-4 hide-kids-dress text-center">
                <a href="ecommerce-price-men.html"><img src="Images/kids-dress-2.jpg" height="200px" style="border-radius:20px;" data-aos="fade-up"><br></a>
                <a href="ecommerce-price-men.html"><span class="image-lable" data-aos="zoom-in">accessories & tradesional dress<br>$117.00</span></a>
               </div>
               <div class="col-xl-3 col-lg-3 hide-popular text-center">
                <a href="ecommerce-price-men.html"><img src="Images/boys-dress-2.jpeg" height="200px" style="border-radius:20px;" data-aos="fade-up"><br></a>
                <a href="ecommerce-price-men.html"><span class="image-lable" data-aos="zoom-in">accessories & tradesional dress<br>$117.00</span></a>
               </div>
              </div>
            </div>
            <div class="row">
              <div class="col pt-4 pb-5 text-center">
                <a href="ecommerce-price-men.html"><span style="border:3px solid rgb(180, 69, 69);border-radius:10px;padding:1% 2%;background-color:rgb(177, 84, 84);" class="ml-4" data-aos="zoom-in"><span style="font-weight:700;font-size:20px;color:white;text-transform: uppercase;">more</span><span class="pl-3" style="color:white;"><i class="fa fa-arrow-right" aria-hidden="true"></i></span></span></a>
              </div>
            </div>
          </div>
          <div class="container-fluid mt-5 pt-2 bg-dark text-white">
            <div class="container">
            <div class="row">
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 footer pt-5">
                <a href="#/"><p style="font-size:20px;text-transform: uppercase;font-weight: 800;color:white" data-aos="slide-right">company name</p></a>
                <p data-aos="slide-right">Here you can use rows and<br>
                to organize your footer content.<br>
                Lorem ipsum dolor sit amet,<br> 
                consectetur adipisicing elit.<br></p>
              </div>
              <div class="col-xl-3 pt-5 hide-girl">
                <a href="#/"><span style="font-size:20px;text-transform: uppercase;font-weight: 800;color:white" data-aos="zoom-in-left">products</span><br></a>
                <p style="margin-top:3%" data-aos="slide-up">M D Bootstrap</p>
                <p style="margin-top:-3%" data-aos="slide-up">M D Bootstrap</p>
                <p style="margin-top:-3%" data-aos="slide-up">M D Bootstrap</p>
                <p style="margin-top:-3%;" data-aos="slide-up">M D Bootstrap</p>
             </div>
              <div class="col-xl-3 col-lg-4 col-md-4 col-sm-12 col-12 footer  pt-5">
                <a href="#/"><span style="font-size:20px;text-transform: uppercase;font-weight: 800;color:white" class="text-center" data-aos="zoom-in-left">useful link</span><br></a>
                <p style="margin-top:3%;margin-left:1%;"data-aos="fade-up">your account</p>
                <p style="margin-top:-3%;margin-left:1%;"data-aos="fade-up">your account</p>
                <p style="margin-top:-3%;margin-left:1%;"data-aos="fade-up">your account</p>
                <p style="margin-top:-3%;margin-left:1%;"data-aos="fade-up">your account</p>
              </div>
              <div class="col-xl-2 col-lg-4 col-md-4 col-sm-12 col-12 footer pt-5 pb-3">
                <a href="#/"><p style="font-size:20px;text-transform: uppercase;font-weight: 800;color:white" data-aos="slide-left">contact</p></a>
                <p data-aos="fade-up"><i class="fa fa-home" aria-hidden="true" style="font-size:20px;"></i>&nbsp; New York, 10012,</p>
                <p data-aos="fade-up"><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp; info@gmail.com</p>
                <p data-aos="fade-up"><i class="fa fa-phone" aria-hidden="true"></i>&nbsp; + 01 234 567 88</p>
                <p data-aos="fade-up"><i class="fa fa-print" aria-hidden="true"></i>&nbsp; + 01 234 567 89</p>
              </div>
            </div>
          </div>
          <hr style="color:white;width:100%;border:1px solid">
          <div class="container mt-4 pb-4">
            <div class="row">
              <div class="col-12 col-xl-6 col-lg-6 col-md-6 col-sm-6 ">
                <p><a href="#/" style="color:white">© 2020 Copyright:</a><span style="font-weight:600;"><a href="#/" style="color:white">MDBootstrap</a></span></p></a>
              </div>
              <div class="col-12 col-xl-6 col-lg-6 col-md-6 col-sm-6 icon-head">
                <a href="#/"><span class="icons-2" style="color:white"><i class="fa fa-facebook" aria-hidden="true"></i></span></a>
                <a href="#/"><span class="icons-3" style="color:white"><i class="fa fa-twitter" aria-hidden="true"></i></span></a>
                <a href="#/"><span class="icons-1" style="color:white"><i class="fa fa-google-plus" aria-hidden="true"></i></span></a>
                <a href="#/"><span class="icons" style="color:white"><i class="fa fa-instagram" aria-hidden="true"></i></span></a>
              </div>
            </div>
          </div>
          </div> --}}
          <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
          <script>
            AOS.init({
              once:true,
              duration:1000,
            });
          /* const parallax1 =document.getElementById('parallax1');
          const parallax2 =document.getElementById('parallax2');
          window.addEventListener("scroll",function(){
            let offset = window.pageYOffset;
            parallax1.style.backgroundPositionY = offset * 0.4 + 'px';
            parallax2.style.backgroundPositionY = offset * 0.9 + 'px';
          });*/
        </script>
        <script>
          document.addEventListener('DOMContentLoaded', function () {
        var user = @json(auth()->guard('web_vendor')->user());
        if (user.perwakilan_daftar === false) {
            alert('Selamat datang! Anda perlu mengisi data perwakilan.');
            window.location.href = '/profile/vendor';
        }
    });
        </script>
    </body>
</html>