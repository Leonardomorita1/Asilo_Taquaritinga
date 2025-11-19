<?php
require_once 'conexao.php';

// Consulta SQL para buscar todos os membros da equipe
$sql = "SELECT nome_membro, cargo_membro, caminho_imagem_membro FROM equipe ORDER BY id_membro DESC";
$resultado = $conexao->query($sql);

$membros = [];
if ($resultado && $resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $membros[] = $row;
    }
}
?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipe - Lar São Vicente de Paulo</title>
    <link rel="stylesheet" href="assets/css/pages/equipe.css">
    <link rel="icon" href="https://www.ssvpbrasil.org.br/source/files/c/885/DECOM__-_Logotipo_SSVP_Brasil_-_azul_e_branco_01-716579_1022-1028-0-0.jpg">

</head>

<body>
    <div id="header-placeholder"></div>
    
    <main>
        <section class="container py-5">
            
            <h1 class="display-4 fw-bold mb-5 text-center fade-in-down" style="color: var(--color-primary);">
                Conheça Nossa Equipe
            </h1>
            <p class="lead text-center mb-5 fade-in-up delay-1">
                Nossa equipe é formada por profissionais dedicados e voluntários apaixonados, todos com o mesmo
                objetivo: oferecer cuidado, carinho e uma vida digna aos nossos idosos.
            </p>

            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                <?php if (count($membros) > 0): ?>
                    <?php 
                    $delay = 1;
                    foreach ($membros as $membro): 
                        $animationClass = "fade-in-up delay-" . (($delay % 5) + 1);
                        $delay++;
                    ?>
                        <div class="col">
                            <div class="card h-100 text-center team-member-card shadow-sm card-hover <?php echo $animationClass; ?>">
                                <img src="<?php echo htmlspecialchars($membro['caminho_imagem_membro']); ?>"
                                    class="card-img-top mx-auto mt-3 rounded-circle border-lg p-1"
                                    alt="<?php echo htmlspecialchars($membro['nome_membro']); ?>">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title fw-bold" style="color: var(--color-primary);">
                                        <?php echo htmlspecialchars($membro['nome_membro']); ?>
                                    </h5>
                                    <p class="card-text text-muted">
                                        <i class="bi bi-briefcase-fill"></i> <?php echo htmlspecialchars($membro['cargo_membro']); ?>
                                    </p>
                                    <ul class="list-unstyled mt-auto">
                                        <li><a href="#" class="text-secondary"><i class="fab fa-linkedin me-2"></i></a></li>
                                    </ul>
                                </div>
                            
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12 text-center fade-in-up">
                        <div class="alert alert-info" role="alert">
                            <i class="bi bi-info-circle me-2"></i>
                            <p class="lead text-muted mb-0">Nenhum membro da equipe cadastrado no momento.</p>
                        </div>
                    </div>
                <?php endif; ?>
                
            </div>

            <!-- Seção adicional sobre a equipe -->
            <div class="row mt-5 pt-5 border-top">
                <div class="col-12 text-center mb-4 fade-in-down">
                    <h2 class="display-5 fw-bold" style="color: var(--color-primary);">Faça Parte do Nosso Time</h2>
                    <p class="lead text-muted">Estamos sempre em busca de profissionais e voluntários dedicados</p>
                </div>
            </div>

            <div class="row g-4 mb-5">
                <div class="col-md-4 fade-in-left delay-1">
                    <div class="card h-100 text-center card-hover">
                        <div class="card-body">
                            <i class="bi bi-heart-pulse" style="font-size: 3rem; color: var(--color-primary);"></i>
                            <h5 class="card-title mt-3">Seja Voluntário</h5>
                            <p class="card-text">Dedique algumas horas do seu tempo para fazer a diferença na vida dos nossos idosos.</p>
                            <a href="contato.html" class="btn btn-outline-primary mt-2">Saiba Mais</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 fade-in-up delay-2">
                    <div class="card h-100 text-center card-hover">
                        <div class="card-body">
                            <i class="bi bi-briefcase" style="font-size: 3rem; color: var(--color-primary);"></i>
                            <h5 class="card-title mt-3">Trabalhe Conosco</h5>
                            <p class="card-text">Junte-se à nossa equipe profissional e construa uma carreira com propósito.</p>
                            <a href="contato.html" class="btn btn-outline-primary mt-2">Ver Vagas</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 fade-in-right delay-3">
                    <div class="card h-100 text-center card-hover">
                        <div class="card-body">
                            <i class="bi bi-people" style="font-size: 3rem; color: var(--color-primary);"></i>
                            <h5 class="card-title mt-3">Parcerias</h5>
                            <p class="card-text">Empresas e instituições interessadas em apoiar nossa causa são bem-vindas.</p>
                            <a href="contato.html" class="btn btn-outline-primary mt-2">Entre em Contato</a>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </main>

    <div id="footer-placeholder"></div>

    <script src="assets/js/pages/sobre.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>

    <script src="assets/js/global/global.js"></script>
    <script src="assets/js/global/componentes.js"></script>
</body>

</html>