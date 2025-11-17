// componentes.js - Versão com integração ao painel admin

document.addEventListener("DOMContentLoaded", async function () {
    // Carregar dados do admin
    const dados = await carregarDadosAdmin();
    
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

    // Conteúdo do rodapé com dados dinâmicos
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
                            <h6><i class="bi bi-telephone" style="color: var(--color-secondary);"></i> ${dados.contatos.telefone || '...'}</h6>
                        </li>
                        <li class="nav-item mb-2">
                            <h6><i class="bi bi-envelope" style="color: var(--color-secondary);"></i> ${dados.contatos.email || '...'}</h6>
                        </li>
                        ${dados.contatos.endereco ? `
                        <li class="nav-item mb-2">
                            <h6 class="small"><i class="bi bi-geo-alt" style="color: var(--color-secondary);"></i> ${dados.contatos.endereco}</h6>
                        </li>
                        ` : ''}
                    </ul>
                </div>
                <div class="col-6 col-md-2 mb-3" id="text-color">
                    <h5>SOCIAIS</h5>
                    <ul class="nav flex-column">
                        ${dados.contatos.facebook ? `
                        <li class="nav-item mb-2">
                            <a href="${dados.contatos.facebook}" target="_blank" class="nav-link p-0">
                                <h6>
                                    <i class="bi bi-facebook" style="color: var(--color-secondary);"></i> Facebook
                                </h6>
                            </a>
                        </li>
                        ` : ''}
                        ${dados.contatos.instagram ? `
                        <li class="nav-item mb-2">
                            <a href="${dados.contatos.instagram}" target="_blank" class="nav-link p-0">
                                <h6>
                                    <i class="bi bi-instagram" style="color: var(--color-secondary);"></i> Instagram
                                </h6>
                            </a>
                        </li>
                        ` : ''}
                    </ul>
                </div>
                
            </div>
            <div class="d-flex flex-column flex-sm-row justify-content-between py-4 my-4 border-top" id="text-color">
                <p>&copy; 2025 Lar São Vicente de Paulo. Todos os direitos reservados.</p>
                <p><a href="admin.html" style="color: var(--color-gray-400); text-decoration: none;"><i class="bi bi-gear"></i> Admin</a></p>
            </div>
        </footer>
    </div>
</div>
  `;
    document.getElementById('footer-placeholder').innerHTML = footerHtml;

    // Carregar conteúdo específico da página
    carregarConteudoPagina(dados);
});

// Função para carregar dados do admin
async function carregarDadosAdmin() {
    const dados = {
        contatos: {
            telefone: '',
            email: '',
            endereco: '',
            facebook: 'https://www.facebook.com/lar.asilo/?locale=pt_BR',
            instagram: ''
        },
        equipe: [],
        carrossel: {
            img1: '',
            img2: 'https://scontent-gru1-2.xx.fbcdn.net/v/t39.30808-6/366353050_5883493625083679_824507837487954901_n.png',
            img3: 'https://asvptaquaritinga.wordpress.com/wp-content/uploads/2013/06/6087_273496662750098_810615361_n.jpg'
        },
        doacao: {
            chavePix: '47.509.126/00001-03',
            qrCodePix: 'assets/img/qrcode.png'
        },
        conteudo: {
            missao: 'Ser uma rede de amigos, buscando a santificação por meio do serviço ao necessitado com respeito, amor, alegria e em defesa da justiça social.',
            visao: 'Ser reconhecida como uma organização nacional que promove a dignidade integral dos mais necessitados.',
            valores: 'Caridade, empatia, simplicidade, justiça e espiritualidade.'
        }
    };

    // Carregar contatos
    try {
        const contatosData = await window.storage.get('ssvp_contatos', true);
        if (contatosData) {
            dados.contatos = { ...dados.contatos, ...JSON.parse(contatosData.value) };
        }
    } catch (error) {
        console.log('Usando dados padrão de contatos');
    }

    // Carregar equipe
    try {
        const equipeData = await window.storage.get('ssvp_equipe', true);
        if (equipeData) {
            dados.equipe = JSON.parse(equipeData.value);
        }
    } catch (error) {
        console.log('Usando dados padrão de equipe');
    }

    // Carregar carrossel
    try {
        const carrosselData = await window.storage.get('ssvp_carrossel', true);
        if (carrosselData) {
            dados.carrossel = { ...dados.carrossel, ...JSON.parse(carrosselData.value) };
        }
    } catch (error) {
        console.log('Usando dados padrão de carrossel');
    }

    // Carregar doação
    try {
        const doacaoData = await window.storage.get('ssvp_doacao', true);
        if (doacaoData) {
            dados.doacao = { ...dados.doacao, ...JSON.parse(doacaoData.value) };
        }
    } catch (error) {
        console.log('Usando dados padrão de doação');
    }

    // Carregar conteúdo
    try {
        const conteudoData = await window.storage.get('ssvp_conteudo', true);
        if (conteudoData) {
            dados.conteudo = { ...dados.conteudo, ...JSON.parse(conteudoData.value) };
        }
    } catch (error) {
        console.log('Usando dados padrão de conteúdo');
    }

    return dados;
}

// Função para carregar conteúdo específico de cada página
async function carregarConteudoPagina(dados) {
    const pagina = window.location.pathname.split('/').pop();

    switch(pagina) {
        case 'index.html':
        case '':
            carregarIndex(dados);
            break;
        case 'equipe.html':
            carregarEquipe(dados);
            break;
        case 'doar.html':
            carregarDoar(dados);
            break;
    }
}

// Carregar dados da página Index
function carregarIndex(dados) {
    // Atualizar carrossel
    const carouselInner = document.querySelector('.carousel-inner');
    if (carouselInner && dados.carrossel) {
        const imagens = [dados.carrossel.img1, dados.carrossel.img2, dados.carrossel.img3];
        const items = carouselInner.querySelectorAll('.carousel-item');
        
        items.forEach((item, index) => {
            if (imagens[index]) {
                const img = item.querySelector('img');
                if (img) img.src = imagens[index];
            }
        });
    }

    // Atualizar cards de missão, visão e valores
    const cards = document.querySelectorAll('.cards .card');
    if (cards.length >= 3 && dados.conteudo) {
        // Card Missão
        const missaoText = cards[0].querySelector('.card-text');
        if (missaoText && dados.conteudo.missao) {
            missaoText.innerHTML = dados.conteudo.missao;
        }

        // Card Visão
        const visaoText = cards[1].querySelector('.card-text');
        if (visaoText && dados.conteudo.visao) {
            visaoText.innerHTML = dados.conteudo.visao;
        }

        // Card Valores
        const valoresText = cards[2].querySelector('.card-text');
        if (valoresText && dados.conteudo.valores) {
            valoresText.innerHTML = dados.conteudo.valores;
        }
    }
}

// Carregar dados da página Equipe
function carregarEquipe(dados) {
    const container = document.querySelector('.row.row-cols-1.row-cols-md-2.row-cols-lg-4');
    if (!container || dados.equipe.length === 0) return;

    // Limpar cards existentes
    container.innerHTML = '';

    // Adicionar novos membros
    dados.equipe.forEach(membro => {
        const col = document.createElement('div');
        col.className = 'col';
        col.innerHTML = `
            <div class="card h-100 text-center team-member-card shadow-sm">
                <img src="${membro.photo}" 
                     class="card-img-top mx-auto mt-3 rounded-circle border-lg p-1" 
                     alt="${membro.name}"
                     onerror="this.src='https://via.placeholder.com/150'">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title fw-bold" style="color: var(--color-primary);">${membro.name}</h5>
                    <p class="card-text text-muted">${membro.role}</p>
                    ${membro.linkedin ? `
                    <ul class="list-unstyled mt-auto">
                        <li>
                            <a href="${membro.linkedin}" target="_blank" class="text-secondary">
                                <i class="bi bi-linkedin me-2"></i>
                            </a>
                        </li>
                    </ul>
                    ` : ''}
                </div>
            </div>
        `;
        container.appendChild(col);
    });
}

// Carregar dados da página Doar
function carregarDoar(dados) {
    // Atualizar chave PIX
    const chavePixInput = document.getElementById('chavePix');
    if (chavePixInput && dados.doacao.chavePix) {
        chavePixInput.value = dados.doacao.chavePix;
    }

    // Atualizar QR Code
    const qrCodeImg = document.querySelector('.qr-code-container img');
    if (qrCodeImg && dados.doacao.qrCodePix) {
        qrCodeImg.src = dados.doacao.qrCodePix;
    }
}

// Expor função globalmente para uso em outros scripts
window.carregarDadosAdmin = carregarDadosAdmin;