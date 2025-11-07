document.addEventListener("DOMContentLoaded", function () {
    // Conteúdo do cabeçalho
    const headerHtml = `
    <header class="global-header">
    <a href="index.html" class="logo">
        <img src="https://www.ssvpbrasil.org.br/source/files/c/833/Logo_horizontal_SSVP_Brasil-357851_166-64-0-0.jpg"
            alt="Logo SSVP">
    </a>
    <nav>
        <ul>
            <li><a href="index.html">INÍCIO</a></li>
            <li><a href="sobre.html">QUEM SOMOS</a></li>
            <li><a href="equipe.html">NOSSA EQUIPE</a></li>
            <li><a href="doar.html">DOAR</a></li>
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
            <li><a href="equipe.html" onclick="toggleMenu()">NOSSA EQUIPE</a></li>
            <li><a href="doar.html" onclick="toggleMenu()">DOAR</a></li>
            <li><a href="transparencia.html" onclick="toggleMenu()">TRANSPARÊNCIA</a></li>
        </ul>
    </div>
</header>
  `;
    document.getElementById('header-placeholder').innerHTML = headerHtml;

    // Conteúdo do rodapé
    const footerHtml = `
    <div id="footer">
    <div class="container">
        <footer class="py-5">
            <div class="row">
                <div class="col-md-5 offset-md-1 mb-3" id="text-color">
                    <h5>SOCIEDADE DE SÃO VICENTE DE PAULA</h5>
                    <p>Há mais de 192 anos proporcionando esperança e dignidade.</p>
                    
                    <div id="sobre">
                        <a href="sobre.html"><i class="bi bi-arrow-return-right"></i> Saiba mais</a> 
                    </div>
                    
                </div>
                <div class="col-6 col-md-2 mb-3" id="text-color">
                    <h5>NAVEGAÇÃO</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2">
                            <a href="index.html" class="nav-link p-0">
                                <h6>Início</h6>
                            </a>
                        </li>
                        <li class="nav-item mb-2">
                            <a href="sobre.html" class="nav-link p-0">
                                <h6>Sobre</h6>
                            </a>
                        </li>
                        <li class="nav-item mb-2">
                            <a href="equipe.html" class="nav-link p-0">
                                <h6>Nossa equipe</h6>
                            </a>
                        </li>
                        <li class="nav-item mb-2">
                            <a href="doar.html" class="nav-link p-0">
                                <h6>Doar</h6>
                            </a>
                        </li>
                        <li class="nav-item mb-2">
                            <a href="transparencia.html" class="nav-link p-0">
                                <h6>Transparência</h6>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-6 col-md-2 mb-3" id="text-color">
                    <h5>CONTATOS</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2">
                            <h6><i class="bi bi-telephone" style="color: var(--color-secondary);"></i> ...</h6>
                        </li>
                        <li class="nav-item mb-2">
                            <h6><i class="bi bi-envelope" style="color: var(--color-secondary);"></i> ...</h6>
                        </li>
                        
                    </ul>
                </div>
                <div class="col-6 col-md-2 mb-3" id="text-color">
                    <h5>SOCIAIS</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2">
                            <a href="https://www.facebook.com/lar.asilo/?locale=pt_BR" target="_blank" class="nav-link p-0">
                                <h6>
                                    <i class="bi bi-facebook"style="color: var(--color-secondary);" ></i> Facebook
                                </h6>
                            </a>
                        </li>
                        <li class="nav-item mb-2">
                            <a href="#" class="nav-link p-0">
                                
                                <h6>...</h6>
                            </a>
                        </li>
                        
                    </ul>
                </div>
                
            </div>
            <div class="d-flex flex-column flex-sm-row justify-content-between py-4 my-4 border-top" id="text-color">
                <p>&copy; 2025 Lar São Vicente de Paulo. Todos os direitos reservados.</p>
                
            </div>
        </footer>
    </div>
</div>
  `;
    document.getElementById('footer-placeholder').innerHTML = footerHtml;
});
