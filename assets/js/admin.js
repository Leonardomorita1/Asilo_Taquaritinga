// admin.js - Lógica do Painel Administrativo SSVP

// Configuração padrão
const DEFAULT_PASSWORD = 'admin123';
let currentUser = null;

// Login
document.getElementById('loginForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    try {
        const storedPassword = await window.storage.get('admin_password');
        const validPassword = storedPassword ? storedPassword.value : DEFAULT_PASSWORD;

        if (password === validPassword) {
            currentUser = username;
            document.getElementById('loginScreen').style.display = 'none';
            document.getElementById('adminPanel').style.display = 'block';
            loadAllData();
        } else {
            showLoginError('Senha incorreta!');
        }
    } catch (error) {
        if (password === DEFAULT_PASSWORD) {
            currentUser = username;
            document.getElementById('loginScreen').style.display = 'none';
            document.getElementById('adminPanel').style.display = 'block';
            loadAllData();
        } else {
            showLoginError('Senha incorreta!');
        }
    }
});

function showLoginError(message) {
    const errorDiv = document.getElementById('loginError');
    errorDiv.textContent = message;
    errorDiv.style.display = 'block';
    setTimeout(() => errorDiv.style.display = 'none', 3000);
}

function logout() {
    currentUser = null;
    document.getElementById('loginScreen').style.display = 'block';
    document.getElementById('adminPanel').style.display = 'none';
    document.getElementById('username').value = '';
    document.getElementById('password').value = '';
}

// Carregar todos os dados
async function loadAllData() {
    await loadContatos();
    await loadTeam();
    await loadCarrossel();
    await loadDoacao();
    await loadConteudo();
}

// ==================== CONTATOS ====================
document.getElementById('contatosForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    const data = {
        telefone: document.getElementById('telefone').value,
        email: document.getElementById('email').value,
        endereco: document.getElementById('endereco').value,
        facebook: document.getElementById('facebook').value,
        instagram: document.getElementById('instagram').value
    };

    try {
        await window.storage.set('ssvp_contatos', JSON.stringify(data), true);
        showAlert('✅ Contatos salvos com sucesso!', 'success');
    } catch (error) {
        showAlert('❌ Erro ao salvar contatos', 'danger');
        console.error(error);
    }
});

async function loadContatos() {
    try {
        const result = await window.storage.get('ssvp_contatos', true);
        if (result) {
            const data = JSON.parse(result.value);
            document.getElementById('telefone').value = data.telefone || '(16) 3252-2121';
            document.getElementById('email').value = data.email || '';
            document.getElementById('endereco').value = data.endereco || '';
            document.getElementById('facebook').value = data.facebook || '';
            document.getElementById('instagram').value = data.instagram || '';
        }
    } catch (error) {
        console.log('Nenhum dado de contatos encontrado');
    }
}

// ==================== EQUIPE ====================
async function loadTeam() {
    try {
        const result = await window.storage.get('ssvp_equipe', true);
        const team = result ? JSON.parse(result.value) : [];
        displayTeam(team);
    } catch (error) {
        displayTeam([]);
    }
}

function displayTeam(team) {
    const teamList = document.getElementById('teamList');
    if (team.length === 0) {
        teamList.innerHTML = '<p class="text-muted">Nenhum membro cadastrado ainda. Clique em "Adicionar Membro" para começar.</p>';
        return;
    }

    teamList.innerHTML = team.map((member, index) => `
        <div class="team-member-item">
            <div class="d-flex align-items-center">
                <img src="${member.photo}" 
                     alt="${member.name}" 
                     class="preview-image me-3"
                     onerror="this.src='https://via.placeholder.com/100'">
                <div>
                    <h6 class="mb-0">${member.name}</h6>
                    <small class="text-muted">${member.role}</small>
                    ${member.linkedin ? `<br><small><a href="${member.linkedin}" target="_blank"><i class="bi bi-linkedin"></i> LinkedIn</a></small>` : ''}
                </div>
            </div>
            <button class="btn btn-danger btn-sm" onclick="deleteMember(${index})">
                <i class="bi bi-trash"></i> Remover
            </button>
        </div>
    `).join('');
}

async function saveMember() {
    const member = {
        name: document.getElementById('memberName').value,
        role: document.getElementById('memberRole').value,
        photo: document.getElementById('memberPhoto').value,
        linkedin: document.getElementById('memberLinkedin').value
    };

    if (!member.name || !member.role || !member.photo) {
        showAlert('⚠️ Preencha todos os campos obrigatórios', 'warning');
        return;
    }

    try {
        const result = await window.storage.get('ssvp_equipe', true);
        const team = result ? JSON.parse(result.value) : [];
        team.push(member);
        await window.storage.set('ssvp_equipe', JSON.stringify(team), true);
        
        const modal = bootstrap.Modal.getInstance(document.getElementById('addMemberModal'));
        modal.hide();
        document.getElementById('addMemberForm').reset();
        loadTeam();
        showAlert('✅ Membro adicionado com sucesso!', 'success');
    } catch (error) {
        showAlert('❌ Erro ao adicionar membro', 'danger');
        console.error(error);
    }
}

async function deleteMember(index) {
    if (!confirm('Deseja realmente remover este membro da equipe?')) return;

    try {
        const result = await window.storage.get('ssvp_equipe', true);
        const team = JSON.parse(result.value);
        team.splice(index, 1);
        await window.storage.set('ssvp_equipe', JSON.stringify(team), true);
        loadTeam();
        showAlert('✅ Membro removido com sucesso!', 'success');
    } catch (error) {
        showAlert('❌ Erro ao remover membro', 'danger');
        console.error(error);
    }
}

// ==================== CARROSSEL ====================
document.getElementById('carrosselForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    const data = {
        img1: document.getElementById('carousel1').value,
        img2: document.getElementById('carousel2').value,
        img3: document.getElementById('carousel3').value
    };

    try {
        await window.storage.set('ssvp_carrossel', JSON.stringify(data), true);
        showAlert('✅ Imagens do carrossel salvas com sucesso!', 'success');
    } catch (error) {
        showAlert('❌ Erro ao salvar imagens', 'danger');
        console.error(error);
    }
});

async function loadCarrossel() {
    try {
        const result = await window.storage.get('ssvp_carrossel', true);
        if (result) {
            const data = JSON.parse(result.value);
            document.getElementById('carousel1').value = data.img1 || '';
            document.getElementById('carousel2').value = data.img2 || '';
            document.getElementById('carousel3').value = data.img3 || '';
        }
    } catch (error) {
        console.log('Nenhum dado de carrossel encontrado');
    }
}

// ==================== DOAÇÃO ====================
document.getElementById('doacaoForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    const data = {
        chavePix: document.getElementById('chavePix').value,
        qrCodePix: document.getElementById('qrCodePix').value
    };

    try {
        await window.storage.set('ssvp_doacao', JSON.stringify(data), true);
        showAlert('✅ Configurações de doação salvas com sucesso!', 'success');
    } catch (error) {
        showAlert('❌ Erro ao salvar configurações', 'danger');
        console.error(error);
    }
});

async function loadDoacao() {
    try {
        const result = await window.storage.get('ssvp_doacao', true);
        if (result) {
            const data = JSON.parse(result.value);
            document.getElementById('chavePix').value = data.chavePix || '';
            document.getElementById('qrCodePix').value = data.qrCodePix || '';
        }
    } catch (error) {
        console.log('Nenhum dado de doação encontrado');
    }
}

// ==================== CONTEÚDO ====================
document.getElementById('conteudoForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    const data = {
        missao: document.getElementById('missao').value,
        visao: document.getElementById('visao').value,
        valores: document.getElementById('valores').value
    };

    try {
        await window.storage.set('ssvp_conteudo', JSON.stringify(data), true);
        showAlert('✅ Conteúdo salvo com sucesso!', 'success');
    } catch (error) {
        showAlert('❌ Erro ao salvar conteúdo', 'danger');
        console.error(error);
    }
});

async function loadConteudo() {
    try {
        const result = await window.storage.get('ssvp_conteudo', true);
        if (result) {
            const data = JSON.parse(result.value);
            document.getElementById('missao').value = data.missao || '';
            document.getElementById('visao').value = data.visao || '';
            document.getElementById('valores').value = data.valores || '';
        }
    } catch (error) {
        console.log('Nenhum dado de conteúdo encontrado');
    }
}

// ==================== ALERTAS ====================
function showAlert(message, type) {
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type} alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3`;
    alertDiv.style.zIndex = '9999';
    alertDiv.style.minWidth = '300px';
    alertDiv.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    document.body.appendChild(alertDiv);
    setTimeout(() => alertDiv.remove(), 3000);
}