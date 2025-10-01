<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asilo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: sans-serif;
            background-color: #ffffff;
        }

        /* Header */
        header {
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            width: 100%;
            background-color: #ffffff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .logo img {
            height: 40px;
            margin-right: 10px;
        }

        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        nav ul li {
            margin-left: 25px;
        }

        nav ul li a {
            text-decoration: none;
            color: #555;
            font-size: 16px;
            padding: 5px 0;
            transition: color 0.3s ease;
        }

        nav ul li a:hover {
            color: #007bff;
        }

        /* Menu Hamburguer */
        .menu-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 28px;
            color: #333;
            cursor: pointer;
        }

        /* Sidebar Mobile */
        .sidebar {
            position: fixed;
            top: 0;
            right: -300px;
            width: 300px;
            height: 100vh;
            background-color: #ffffff;
            box-shadow: -2px 0 10px rgba(0, 0, 0, 0.2);
            transition: right 0.3s ease;
            z-index: 2000;
            padding: 60px 20px 20px 20px;
        }

        .sidebar.active {
            right: 0;
        }

        .sidebar-close {
            position: absolute;
            top: 15px;
            right: 15px;
            background: none;
            border: none;
            font-size: 30px;
            color: #333;
            cursor: pointer;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar ul li {
            margin: 25px 0;
        }

        .sidebar ul li a {
            text-decoration: none;
            color: #555;
            font-size: 18px;
            display: block;
            transition: color 0.3s ease;
        }

        .sidebar ul li a:hover {
            color: #007bff;
        }

        /* Overlay */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
            z-index: 1500;
        }

        .overlay.active {
            opacity: 1;
            visibility: visible;
        }

        /* Carousel */
        #carouselExampleIndicators {
            width: 100%;
            height: 450px;
        }

        .carousel-item img {
            height: 450px;
            object-fit: cover;
        }

        /* Cards */
        .cards {
            padding: 4% 10%;
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
        }

        /* Footer */
        #footer {
            background-color: #131313;
        }

        #text-color h5 {
            color: #ffcc7f;
        }

        #text-color p,
        #text-color h6 {
            color: #8d8d8d;
        }

        #text-color h6:hover {
            color: #ececec;
        }

        /* Responsividade */
        @media (max-width: 992px) {
            nav {
                display: none;
            }

            .menu-toggle {
                display: block;
            }

            .cards {
                padding: 4% 5%;
            }
        }

        @media (max-width: 768px) {
            #carouselExampleIndicators,
            .carousel-item img {
                height: 250px;
            }
        }

        @media (max-width: 576px) {
            .logo img {
                height: 30px;
            }

            #carouselExampleIndicators,
            .carousel-item img {
                height: 200px;
            }
        }
    </style>
</head>

<body>
    <header>
        <a href="#" class="logo">
            <img src="https://ssvptaquaritinga.com.br/wp-content/uploads/2022/11/ssvp-logo-04FCDEF145-seeklogo.com_.png"
                alt="Logo SSVP">
        </a>
        <nav>
            <ul>
                <li><a href="#">INÍCIO</a></li>
                <li><a href="#">SOBRE</a></li>
                <li><a href="#">EVENTOS</a></li>
                <li><a href="#">NOSSA EQUIPE</a></li>
                <li><a href="#">DOAR</a></li>
                <li><a href="#">TRANSPARÊNCIA</a></li>
            </ul>
        </nav>
        <button class="menu-toggle" onclick="toggleMenu()">
            <i class="bi bi-list"></i>
        </button>
    </header>

    <!-- Overlay -->
    <div class="overlay" id="overlay" onclick="toggleMenu()"></div>

    <!-- Sidebar Mobile -->
    <div class="sidebar" id="sidebar">
        <button class="sidebar-close" onclick="toggleMenu()">
            <i class="bi bi-x"></i>
        </button>
        <ul>
            <li><a href="#" onclick="toggleMenu()">INÍCIO</a></li>
            <li><a href="#" onclick="toggleMenu()">SOBRE</a></li>
            <li><a href="#" onclick="toggleMenu()">EVENTOS</a></li>
            <li><a href="#" onclick="toggleMenu()">NOSSA EQUIPE</a></li>
            <li><a href="#" onclick="toggleMenu()">DOAR</a></li>
            <li><a href="#" onclick="toggleMenu()">TRANSPARÊNCIA</a></li>
        </ul>
    </div>

    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="foto1.jpg" class="d-block w-100" alt="Imagem 1">
            </div>
            <div class="carousel-item">
                <img src="https://scontent-gru1-2.xx.fbcdn.net/v/t39.30808-6/366353050_5883493625083679_824507837487954901_n.png?_nc_cat=103&ccb=1-7&_nc_sid=cc71e4&_nc_ohc=hsyv_qJFTI0Q7kNvwEABZPZ&_nc_oc=Admz-FaLJKX5PQNKYGgk__iQXBBrFdgw20-nhyn3OPVqulru-8l2fjv4Nr2Bqp8glCs&_nc_zt=23&_nc_ht=scontent-gru1-2.xx&_nc_gid=RAFM9KUarr6wvmxjfZTvaA&oh=00_Afbjol2RJb4uPbRxpXdKqMc6IuPBv7_qxTD8II6nO5fpqQ&oe=68E093CB" class="d-block w-100" alt="Imagem 2">
            </div>
            <div class="carousel-item">
                <img src="https://asvptaquaritinga.wordpress.com/wp-content/uploads/2013/06/6087_273496662750098_810615361_n.jpg" class="d-block w-100" alt="Imagem 3">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Próximo</span>
        </button>
    </div>

    <div class="cards">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col">
                <div class="card h-100">
                    <img src="https://img.freepik.com/fotos-gratis/uma-boa-transaccao-e-o-sucesso_329181-14663.jpg?semt=ais_hybrid&w=740&q=80"
                        class="card-img-top" alt="Transação">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to
                            additional content. This content is a little bit longer.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <img src="https://img.freepik.com/fotos-gratis/cuidadora-feminina-na-casa-de-seu-cliente-cuidando-de-pessoa-idosa_23-2150216408.jpg?semt=ais_hybrid&w=740&q=80"
                        class="card-img-top" alt="Cuidadora">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to
                            additional content. This content is a little bit longer.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <img src="https://clinicaportal.com.br/wp-content/uploads/2021/09/Por-que-e-errado-chamar-uma-clinica-de-repouso-para-idosos-de-asilo.jpg"
                        class="card-img-top" alt="Clínica">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to
                            additional content.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mapa mt-5">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1268.3359849204649!2d-48.50658994255741!3d-21.403293326852104!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94b9396c54979ad9%3A0x24f576fc8085ac03!2sLar%20S%C3%A3o%20Vicente%20de%20Paulo!5e1!3m2!1spt-BR!2sbr!4v1759163889672!5m2!1spt-BR!2sbr"
                width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>

    <div id="footer">
        <div class="container">
            <footer class="py-5">
                <div class="row">
                    <div class="col-6 col-md-2 mb-3" id="text-color">
                        <h5>Section</h5>
                        <ul class="nav flex-column">
                            <li class="nav-item mb-2">
                                <a href="#" class="nav-link p-0">
                                    <h6>Home</h6>
                                </a>
                            </li>
                            <li class="nav-item mb-2">
                                <a href="#" class="nav-link p-0">
                                    <h6>Features</h6>
                                </a>
                            </li>
                            <li class="nav-item mb-2">
                                <a href="#" class="nav-link p-0">
                                    <h6>Pricing</h6>
                                </a>
                            </li>
                            <li class="nav-item mb-2">
                                <a href="#" class="nav-link p-0">
                                    <h6>FAQs</h6>
                                </a>
                            </li>
                            <li class="nav-item mb-2">
                                <a href="#" class="nav-link p-0">
                                    <h6>About</h6>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-6 col-md-2 mb-3" id="text-color">
                        <h5>Section</h5>
                        <ul class="nav flex-column">
                            <li class="nav-item mb-2">
                                <a href="#" class="nav-link p-0">
                                    <h6>Home</h6>
                                </a>
                            </li>
                            <li class="nav-item mb-2">
                                <a href="#" class="nav-link p-0">
                                    <h6>Features</h6>
                                </a>
                            </li>
                            <li class="nav-item mb-2">
                                <a href="#" class="nav-link p-0">
                                    <h6>Pricing</h6>
                                </a>
                            </li>
                            <li class="nav-item mb-2">
                                <a href="#" class="nav-link p-0">
                                    <h6>FAQs</h6>
                                </a>
                            </li>
                            <li class="nav-item mb-2">
                                <a href="#" class="nav-link p-0">
                                    <h6>About</h6>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-6 col-md-2 mb-3" id="text-color">
                        <h5>Section</h5>
                        <ul class="nav flex-column">
                            <li class="nav-item mb-2">
                                <a href="#" class="nav-link p-0">
                                    <h6>Home</h6>
                                </a>
                            </li>
                            <li class="nav-item mb-2">
                                <a href="#" class="nav-link p-0">
                                    <h6>Features</h6>
                                </a>
                            </li>
                            <li class="nav-item mb-2">
                                <a href="#" class="nav-link p-0">
                                    <h6>Pricing</h6>
                                </a>
                            </li>
                            <li class="nav-item mb-2">
                                <a href="#" class="nav-link p-0">
                                    <h6>FAQs</h6>
                                </a>
                            </li>
                            <li class="nav-item mb-2">
                                <a href="#" class="nav-link p-0">
                                    <h6>About</h6>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-5 offset-md-1 mb-3">
                        <form id="text-color">
                            <h5>Subscribe to our newsletter</h5>
                            <p>Monthly digest of what's new and exciting from us.</p>
                            <div class="d-flex flex-column flex-sm-row w-100 gap-2">
                                <label for="newsletter1" class="visually-hidden">Email address</label>
                                <input id="newsletter1" type="email" class="form-control" placeholder="Email address" />
                                <button class="btn btn-primary" type="button">Subscribe</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="d-flex flex-column flex-sm-row justify-content-between py-4 my-4 border-top"
                    id="text-color">
                    <p>&copy; 2025 Company, Inc. All rights reserved.</p>
                    <ul class="list-unstyled d-flex">
                        <li class="ms-3">
                            <a class="link-body-emphasis" href="#" aria-label="Instagram">
                                <i class="bi bi-instagram" style="font-size: 24px; color: #8d8d8d;"></i>
                            </a>
                        </li>
                        <li class="ms-3">
                            <a class="link-body-emphasis" href="#" aria-label="Facebook">
                                <i class="bi bi-facebook" style="font-size: 24px; color: #8d8d8d;"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
    
    <script>
        function toggleMenu() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        }
    </script>
</body>

</html>
