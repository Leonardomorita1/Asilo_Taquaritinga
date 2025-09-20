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
        * {
            padding: 0;
            margin: 0;
        }

        #top-bar li a {
            text-decoration: none;
            margin: 30px;
            color: #38a9ff;
            font-size: 14pt;
        }

        header {
            padding: 10px;
            display: flex;
            z-index: 3;
            position: sticky;
            top: 0;
            width: 100%;
        }

        #top-bar {
            margin: auto;
        }

        header img {
            height: 50px;
            margin: 10px;
        }

        #sqr {
            width: 50px;
        }
    </style>
</head>

<body>
    <header class="shadow p-3 mb-5 bg-white">
        <img src="https://cdn-icons-png.flaticon.com/512/4807/4807620.png" alt="logo">
        <ul id="top-bar">
            <li class="d d-inline">
                <a href="#">
                    <i class="bi bi-house"></i>
                    INICIO
                </a>
                <a href="#">
                    <i class="bi bi-file-earmark"></i>
                    TRANSPARÊNCIA
                </a>
                <a href="#">
                    <i class="bi bi-bank"></i>
                    HISTÓRIA
                </a>
                <a href="#">
                    <i class="bi bi-people"></i>
                    SOBRE NÓS
                </a>
                <a href="#">
                    <i class="bi bi-currency-dollar"></i>
                    DOAR
                </a>
            </li>
        </ul>
        <div id="sqr"></div>
    </header>
    <div id="carrossel-imagens" class="carousel slide">
        <div class="carousel inner">
            <div class="carousel item" style="height: 100px;">
                <img src="https://blog.fretebras.com.br/wp-content/uploads/2022/08/Fretebras_Veiculos_pesados_img-blog.png"height="100%"width="100%"
                    class="d-block w-100">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>
