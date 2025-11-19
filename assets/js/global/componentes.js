document.addEventListener("DOMContentLoaded", function () {
    // Conteúdo do cabeçalho
    const headerHtml = `
    <header class="global-header">
    <a href="index.html" class="logo">
        <img src="https://www.ssvpbrasil.org.br/source/files/c/833/Logo_horizontal_SSVP_Brasil-357851_166-64-0-0.jpg">
    </a>
    <nav>
        <ul>
            <li><a href="index.html">INÍCIO</a></li>
            <li><a href="sobre.html">QUEM SOMOS</a></li>
            <li><a href="equipe.php">NOSSA EQUIPE</a></li>
            <li><a href="doar.html">DOAR</a></li>
            <li><a href="contato.html">FALE CONOSCO</a></li>
            <li><a href="transparencia.html">TRANSPARÊNCIA</a></li>
        </ul>
    </nav>
    <button class="menu-toggle" onclick="toggleMenu()" aria-label="Abrir menu">
        <i class="bi bi-list"></i>
    </button>
    <!-- Overlay -->
    <div class="overlay" id="overlay" onclick="toggleMenu()"></div>

    <!-- Sidebar Mobile -->
    <div class="sidebar" id="sidebar">
        <button class="sidebar-close" onclick="toggleMenu()" aria-label="Fechar menu">
            <i class="bi bi-x"></i>
        </button>
        <ul>
            <li><a href="index.html" onclick="toggleMenu()">INÍCIO</a></li>
            <li><a href="sobre.html" onclick="toggleMenu()">QUEM SOMOS</a></li>
            <li><a href="equipe.php" onclick="toggleMenu()">NOSSA EQUIPE</a></li>
            <li><a href="doar.html" onclick="toggleMenu()">DOAR</a></li>
            <li><a href="contato.html" onclick="toggleMenu()">FALE CONOSCO</a></li>
            <li><a href="transparencia.html" onclick="toggleMenu()">TRANSPARÊNCIA</a></li>
        </ul>
    </div>
</header>
  `;
    document.getElementById('header-placeholder').innerHTML = headerHtml;

    // Conteúdo do rodapé
    const footerHtml = `
    <footer class="site-footer pt-5">
        <div class="container">
            <div class="row g-4 g-lg-5">

                <div class="col-lg-4 col-md-6 footer-about text-center text-md-start">
                    <h5>SOCIEDADE DE SÃO VICENTE DE PAULA</h5>
                    <p class="pe-3">Há mais de 192 anos proporcionando esperança e dignidade.</p>
                    <a href="sobre.html" class="btn btn-sm btn-saiba-mais mt-2">Saiba Mais</a>
                </div>

                <div class="col-lg-3 col-md-6 footer-links text-center text-md-start">
                    <h5>Institucional</h5>
                    <ul class="list-unstyled footer-links-list">
                        <li><a href="index.html">Início</a></li>
                        <li><a href="sobre.html">Sobre Nós</a></li>
                        <li><a href="doar.html">Doe via pix</a></li>
                        <li><a href="equipe.php">Nossa equipe</a></li>
                        <li><a href="transparencia.html">Transparência</a></li>
                        <li><a href="contato.html">Contato</a></li>
                    </ul>
                </div>

                <div class="col-lg-5 col-md-12 footer-contact text-center text-md-start">
                    <h5>Contato</h5>
                    <ul class="list-unstyled footer-contact-list">
                        <li>
                            <i class="bi bi-telephone-fill"></i>
                            (XX) XXXX-XXXX
                        </li>
                        <li>
                            <i class="bi bi-envelope-at-fill"></i>
                            contato@larsvp.org.br
                        </li>
                        <li>
                            <i class="bi bi-geo-alt-fill"></i>
                            Rua Exemplo, 123 - Bairro, Cidade - UF, CEP 12345-678
                        </li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="footer-bottom mt-5 py-4">
            <div class="container">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                    
                    <div class="text-center text-md-start mb-3 mb-md-0">
                        <p>&copy; 2025 Lar São Vicente de Paulo. Todos os direitos reservados.</p>
                    </div>
                    
                    <div class="social-icons text-center text-md-end">
                        <a href="#" target="_blank" class="social-icon-circle" aria-label="WhatsApp">
                            <i class="bi bi-whatsapp"></i>
                        </a>
                        <a href="#" target="_blank" class="social-icon-circle" aria-label="Facebook">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="#" target="_blank" class="social-icon-circle" aria-label="Instagram">
                            <i class="bi bi-instagram"></i>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </footer>
  `;
    document.getElementById('footer-placeholder').innerHTML = footerHtml;
});