<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masak.in Resep</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Coiny&family=Mystery+Quest&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Coiny&family=Mystery+Quest&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
        *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        scroll-padding-top:2rem;
        text-decoration: none;
        list-style: none;
        scroll-behavior: smooth;
        font-family: "Poppins",sans-serif;
        font-weight: 500;
        }
        
        :root {
            --main-color: rgb(26, 133, 10);
            --second-color:rgb(81, 39, 3);
        }
        section {
            padding: 5rem 10%;
        }
        *::selection{
            color: #fff;
            background: var(--main-color);
        }
        img{
        width: 100%;
        }
        .logo img{
        width: 50px;
        }
        header{
        position: fixed;
        width: 100%;
        top: 0;
        right: 0;
        z-index: 1000;
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #fff;
        box-shadow: 0 4px 41px rgb(14 55 54 / 14%);
        padding: 15px 10%;
        transition: 0.2s;
        }
        .logo{
        display: flex;
        align-items: center;
        }
        .navbar{
        display: flex;
        }
        .navbar a{
            font-size: 1rem;
            padding: 11px 20px;
            color:var(--second-color);
            font-weight: 600;
            text-transform: uppercase;
        }
        .navbar a:hover{
            color: var(--main-color);
        }
        #menu-icon{
            font-size: 24px;
            cursor: pointer;
            z-index: 1001;
            display: none;
        }
        
        .home {
            width: 100%;
            height: 100vh; /* Biar pas satu layar */
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            background: #ebdbc8;
            gap: 1rem;
            padding: 0 10%; /* Biar kontennya nggak terlalu mepet pinggir */
        }
        .home-text{
            flex: 1 1 17rem;
        }
        .home-img{
            flex: 1 1 2rem;
        }
        .home-img img{
            animation: animate 3s linear infinite;
        }
        @keyframes animate {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-11px);
            }
        }

        .home-text span{
            font-size: 1rem;
            text-transform: uppercase;
            font-weight: 600;
            color: var(--second-color);
        }
        .home-text h1{
            font-size: 3.2rem;
            color: var(--main-color);
            font-weight: bolder;
        }
        .home-text h2{
            font-size: 1.8rem;
            font-weight: 600;
            color: var(--second-color);
            text-transform: uppercase;
            margin: 0.5rem 0 1.4rem;
        }
        .btn {
            padding: 7px 16px;
            border: 2px solid var(--second-color);
            border-radius: 40px;
            color: var(--second-color);
            font-weight: 500;
        }
        .btn:hover{
            color: #fff;
            background: var(--second-color);
        }
        .heading{
            text-align: center;
            text-transform: uppercase;
        }
        .heading span{
            font-size: 1rem;
            font-weight: 600;
            color: var(--second-color);
        }
        .heading h1{
            font-size: 2rem;
            color: var(--main-color);
        }
        .shop-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); 
            gap: 2rem;
            justify-items: center;
            padding: 2rem 0;
        }

        .shop-container .box {
            background: #BDB76B;
            padding: 20px;
            border-radius: 0.5rem;
            text-align: center;
            width: 100%; /* Agar lebar kotak mengikuti grid */
            max-width: 280px;
            transition: transform 0.3s ease;
        }

        .shop-container .box:hover {
            transform: scale(1.05);
        }

        .shop-container .box .box-img {
            width: 150px;
            height: 150px;
            margin: 0 auto 1rem;
        }

        .shop-container .box h2,
        .shop-container .box span {
            color: #fff;
        }

        .box .btn {
            display: inline-block;
            margin-top: 0.5rem;
            padding: 7px 16px;
            border: 2px solid #ebdc8;
            border-radius: 40px;
            color: #ebdc8;
            font-weight: 500;
            transition: 0.3s;
        }

        .box{
            background: #ebdc8;
            color: var(--second-color);
        }
        .delivery{
            background: #ebdbc8;
        }
        .container{
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            margin-top: 2rem;
        }
        .delivery-img{
            flex: 1  11rem;
        }
        .delivery-text{
            flex: 1 1 21rem;
        }
        .delivery-text h2{
            font-size: 1.2rem;
            color:var(--second-color);
        }
        .delivery-text p{
            margin: 0.5rem 0 1rem;
            text-align: justify;
        }
        
        .contact{
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .social a{
            font-size: 27px;
            margin: 0.5rem;
        }
        .social {
            display: flex;
            gap: 5rem;
        }
        .social a .bx{
            padding: 5px;
            color: #fff;
            background:rgb(194, 173, 78);
            border-radius: 50%;
        }
        .social a .bx:hover{
            background:rgb(107, 191, 106);
            padding: 10px;
        }
        .links{
            margin: 1rem 0 1rem;
        }
        .links a{
            font-size: 1rem;
            font-weight: 500;
            color: var(--second-color);
            padding: 1rem;
        }
        .links a:hover{
            color: var(--main-color);
        }
        .contact p{
            text-align: center;
        }
        .contact-logo img {
            width: 380px;
            margin-bottom: 1rem;
        }
        @media (max-width:1150px){
            header{
                padding: 18px 7%;
            }
            section{
                padding: 50px 7%;
            }
            .home-text h1{
                font-size: 3rem;
            }
            .home-text h2{
                font-size: 1.5rem;
            }
        }
        @media (max-width:991px){
            header{
                padding: 18px 4%;
            }
            section{
                padding: 50px 4%;
            }
        }
        @media (max-width: 768px){
            header{
                padding: 11px 4%;
            }
            #menu-icon{
                display: initial;
            }
            header .navbar{
                position: absolute;
                top: -500px;
                left: 0;
                right: 0;
                display: flex;
                flex-direction: column;
                background: #fff;
                box-shadow: 0 4px 4px rgb(14 55 54 /14%);
                border-top: 2px solid var(--main-color);
                transition: 0.2s;
                text-align: left;
            }
            .navbar.active{
                top: 100%;
            }
            .navbar a{
                padding: 1.5rem;
                display: block;
                color: var(--second-color);
            }
            .home-text span{
                font-size: 0.9rem;
            }
            .home-text h1{
                font-size: 2.4rem;
            }
            .home-text h2{
                font-size: 1.2rem;
            }
        }
        @media (max-width: 768px){
            .home-text{
                padding-top: inherit;
            }
            .menu-container .box{
                margin-top: 6rem;
            }
            .heading h1{
                font-size: 1.5rem;
            }
            .heading span{
                font-size: 0.9rem;
            }
            .about{
                flex-direction: column-reverse ;
            }
        }
        @media (max-width: 364px){
            .links{
                display: flex;
                flex-direction: column;
            }
        
        }
        .logout-btn {
            background-color:rgb(243, 193, 193); /* Warna merah */
            color: rgb(117, 20, 20); /* Warna teks */
            padding: 10px 20px;
            border: 5px;
            border-radius: 40px;
            font-size: 12px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .logout-btn:hover {
            background-color: #cc0000; /* Warna merah lebih gelap saat hover */
        }

    </style>
</head>
<body>
    <header>
        <a href="#" class="logo"><img src="{{ asset('assets/logo.png') }}" alt=""></a>
        <div class="bx bx-menu" id="menu-icon"></div>

        <ul class="navbar">
            <li><a href="#home">Home</a></li>
            <li><a href="#shop">Menu</a></li>
            <li><a href="#delivery">About</a></li>
            <li><a href="#contact">Contact</a></li>
            <li><a href="{{ route('user.akun') }}">my account</a></li>
            <li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="logout-btn">Log out</button>
                </form>
            </li>
        </ul>
    </header>
    <section class="home" id="home">
        <div class="home-text">
            <span>Welcome to</span>
            <h1>Masak.In</h1>
            <h2>Resep Nusantara,<br> Cita Rasa Tiada Tara!</h2>
        </div>
        <div class="home-img">
            <img src="{{ asset('assets/logo.png') }}" alt="">
        </div>
    </section>
    <section class="shop" id="shop">
        <div class="heading">
            <span>Masak.In</span>
            <h1> Resep Menu </h1>
        </div>
        <div class="shop-container">
            <div class="box">
                <div class="box-img">
                    <img src="{{ asset('assets/jatim.png') }}" alt="">
                </div>
                <div class="stars">
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i>
                </div>
                <h2>Jawa Timur</h2>
                <a href="{{ route('user.jatim') }}" class="btn btn-secondary mb-3">detail</a>
            </div>

            <div class="box">
                <div class="box-img">
                    <img src="{{ asset('assets/jateng.png') }}" alt="">
                </div>
                <div class="stars">
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i>
                </div>
                <h2>Jawa Tengah</h2>
                <a href="{{ route('user.jateng') }}" class="btn btn-secondary mb-3">detail</a>
            </div>

            <div class="box">
                <div class="box-img">
                    <img src="{{ asset('assets/jabar.png') }}" alt="">
                </div>
                <div class="stars">
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i>
                </div>
                <h2>Jawa Barat</h2>
                <a href="{{ route('user.jabar') }}" class="btn btn-secondary mb-3">detail</a>
            </div>
        </div>
    </section>

    <section class="delivery" id="delivery">
        <div class="heading">
            <span>Masak.In</span>
            <h1>About us</h1>
        </div>
        <div class="container">
            <div class="delivery-img">
                <img src="{{ asset('assets/about.png') }}" alt="">
            </div>
            <div class="delivery-text">
                <h2>Resep Nusantara, Cita Rasa Tiada Tara!</h2>
                    <p>Selamat datang di Masak.In, rumah bagi cita rasa nusantara! 🌿🍛
                    Kami hadir untuk memperkenalkan kekayaan kuliner Indonesia dengan beragam resep autentik dari Sabang sampai Merauke. 
                    Dari makanan tradisional yang diwariskan turun-temurun hingga kreasi modern yang menggugah selera, Masak.In siap menjadi panduan kuliner Anda</p>
                    <p>Dengan Masak.In, mari kita lestarikan dan nikmati kekayaan kuliner Indonesia! 🍲✨
                    <br>📌 Jelajahi. Masak. Nikmati.</p>    
            </div>
        </div>
    </section>

    <section class="contact" id="contact">
        <div class="heading">
            <span>Masak.In</span>
            <h1>Contact</h1>
        </div>
        <div class="contact-logo">
            <img src="{{ asset('assets/contact.png') }}" alt="">
        </div>
        <div class="social">
            <a href="https://www.facebook.com/" target="_blank"><i class='bx bxl-facebook'></i></a>
            <a href="https://www.instagram.com/slvcffza" target="_blank"><i class='bx bxl-instagram'></i></a>
            <a href="https://twitter.com/" target="_blank"><i class='bx bxl-twitter'></i></a>
            <a href="https://www.youtube.com/" target="_blank"><i class='bx bxl-youtube'></i></a>
        </div>
   </section>
</body>
</html>

    