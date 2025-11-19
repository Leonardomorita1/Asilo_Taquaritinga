<?php
session_start();

// Verifica se está logado
if (!isset($_SESSION['admin_logado'])) {
    header('Location: login.php');
    exit;
}

require_once 'conexao.php';

// Diretório de upload
$uploadDir = 'upload/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$statusMessage = "";
$statusType = "";

// Processamento de formulários
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // CADASTRO DE MEMBRO
    if (isset($_POST['acao']) && $_POST['acao'] === 'cadastrar_membro') {
        $nome = $conexao->real_escape_string($_POST['nome_membro']);
        $cargo = $conexao->real_escape_string($_POST['cargo_membro']);
        
        if (isset($_FILES['imagem_membro']) && $_FILES['imagem_membro']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['imagem_membro']['tmp_name'];
            $fileName = $_FILES['imagem_membro']['name'];
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
            $destPath = $uploadDir . $newFileName;
            $caminho_imagem = $uploadDir . $newFileName;
            
            $allowedExtensions = array('jpg', 'gif', 'png', 'jpeg', 'webp');
            
            if (in_array($fileExtension, $allowedExtensions)) {
                if (move_uploaded_file($fileTmpPath, $destPath)) {
                    $sql = "INSERT INTO equipe (nome_membro, cargo_membro, caminho_imagem_membro) VALUES (?, ?, ?)";
                    $stmt = $conexao->prepare($sql);
                    
                    if ($stmt) {
                        $stmt->bind_param("sss", $nome, $cargo, $caminho_imagem);
                        
                        if ($stmt->execute()) {
                            $statusMessage = "Membro cadastrado com sucesso!";
                            $statusType = "success";
                        } else {
                            $statusMessage = "Erro ao inserir no banco: " . $stmt->error;
                            $statusType = "danger";
                        }
                        $stmt->close();
                    }
                } else {
                    $statusMessage = "Erro ao mover arquivo. Verifique permissões.";
                    $statusType = "danger";
                }
            } else {
                $statusMessage = "Formato não suportado. Use JPG, PNG, WEBP ou GIF.";
                $statusType = "danger";
            }
        } else {
            $statusMessage = "Erro no upload ou nenhuma imagem selecionada.";
            $statusType = "danger";
        }
    }
    
    // EXCLUIR MEMBRO
    if (isset($_POST['acao']) && $_POST['acao'] === 'excluir_membro') {
        $id_membro = (int)$_POST['id_membro'];
        
        // Busca o caminho da imagem antes de excluir
        $sql = "SELECT caminho_imagem_membro FROM equipe WHERE id_membro = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("i", $id_membro);
        $stmt->execute();
        $resultado = $stmt->get_result();
        
        if ($row = $resultado->fetch_assoc()) {
            $caminhoImagem = $row['caminho_imagem_membro'];
            
            // Exclui do banco
            $sqlDelete = "DELETE FROM equipe WHERE id_membro = ?";
            $stmtDelete = $conexao->prepare($sqlDelete);
            $stmtDelete->bind_param("i", $id_membro);
            
            if ($stmtDelete->execute()) {
                // Remove o arquivo físico
                if (file_exists($caminhoImagem)) {
                    unlink($caminhoImagem);
                }
                $statusMessage = "Membro excluído com sucesso!";
                $statusType = "success";
            } else {
                $statusMessage = "Erro ao excluir membro.";
                $statusType = "danger";
            }
            $stmtDelete->close();
        }
        $stmt->close();
    }
    
    // ATUALIZAR PERFIL DO ADMIN
    if (isset($_POST['acao']) && $_POST['acao'] === 'atualizar_perfil') {
        $nome_novo = $conexao->real_escape_string($_POST['nome_admin']);
        $email_novo = $conexao->real_escape_string($_POST['email_admin']);
        $senha_atual = $_POST['senha_atual'];
        $senha_nova = $_POST['senha_nova'];
        $confirmar_senha = $_POST['confirmar_senha'];
        
        $admin_id = $_SESSION['admin_id'];
        
        // Verifica senha atual
        $sql = "SELECT senha_adm FROM admin WHERE id_adm = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("i", $admin_id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $admin = $resultado->fetch_assoc();
        
        if (password_verify($senha_atual, $admin['senha_adm'])) {
            // Atualiza nome e email
            $sqlUpdate = "UPDATE admin SET nome_adm = ?, email_adm = ?";
            $params = [$nome_novo, $email_novo];
            $types = "ss";
            
            // Se forneceu nova senha
            if (!empty($senha_nova)) {
                if ($senha_nova === $confirmar_senha) {
                    $senha_hash = password_hash($senha_nova, PASSWORD_DEFAULT);
                    $sqlUpdate .= ", senha_adm = ?";
                    $params[] = $senha_hash;
                    $types .= "s";
                } else {
                    $statusMessage = "As senhas não coincidem!";
                    $statusType = "danger";
                    goto fim_update;
                }
            }
            
            $sqlUpdate .= " WHERE id_adm = ?";
            $params[] = $admin_id;
            $types .= "i";
            
            $stmtUpdate = $conexao->prepare($sqlUpdate);
            $stmtUpdate->bind_param($types, ...$params);
            
            if ($stmtUpdate->execute()) {
                $_SESSION['admin_nome'] = $nome_novo;
                $statusMessage = "Perfil atualizado com sucesso!";
                $statusType = "success";
            } else {
                $statusMessage = "Erro ao atualizar perfil.";
                $statusType = "danger";
            }
            $stmtUpdate->close();
        } else {
            $statusMessage = "Senha atual incorreta!";
            $statusType = "danger";
        }
        
        fim_update:
        $stmt->close();
    }
}

// Busca membros da equipe
$sqlMembros = "SELECT * FROM equipe ORDER BY id_membro DESC";
$resultadoMembros = $conexao->query($sqlMembros);

// Busca dados do admin
$sqlAdmin = "SELECT * FROM admin WHERE id_adm = ?";
$stmtAdmin = $conexao->prepare($sqlAdmin);
$stmtAdmin->bind_param("i", $_SESSION['admin_id']);
$stmtAdmin->execute();
$dadosAdmin = $stmtAdmin->get_result()->fetch_assoc();
$stmtAdmin->close();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - SSVP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="https://www.ssvpbrasil.org.br/source/files/c/885/DECOM__-_Logotipo_SSVP_Brasil_-_azul_e_branco_01-716579_1022-1028-0-0.jpg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="assets/css/pages/admin.css">
</head>
<body>
    <div class="admin-container">
        <!-- Header -->
        <div class="admin-header">
            <div>
                <h2 style="color: var(--color-primary); margin: 0;">
                    <i class="fas fa-tachometer-alt"></i> Dashboard Administrativo
                </h2>
                <small class="text-muted">Bem-vindo, <?php echo htmlspecialchars($_SESSION['admin_nome']); ?>!</small>
            </div>
            <div>
                <a href="index.html" class="btn btn-outline-primary me-2">
                    <i class="fas fa-home"></i> Ver Site
                </a>
                <a href="logout.php" class="btn btn-outline-danger">
                    <i class="fas fa-sign-out-alt"></i> Sair
                </a>
            </div>
        </div>

        <!-- Mensagens de Status -->
        <?php if ($statusMessage): ?>
        <div class="alert alert-<?php echo $statusType; ?> alert-dismissible fade show" role="alert">
            <i class="fas fa-<?php echo $statusType === 'success' ? 'check-circle' : 'exclamation-circle'; ?>"></i>
            <?php echo $statusMessage; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?>

        <!-- Conteúdo Principal -->
        <div class="admin-card">
            <ul class="nav nav-tabs" id="adminTabs" role="tablist">
                <li class="nav-item">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#equipe">
                        <i class="fas fa-users"></i> Gerenciar Equipe
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#cadastro">
                        <i class="fas fa-user-plus"></i> Cadastrar Membro
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#configuracoes">
                        <i class="fas fa-cog"></i> Configurações
                    </button>
                </li>
            </ul>

            <div class="tab-content pt-4">
                <!-- Tab Equipe -->
                <div class="tab-pane fade show active" id="equipe">
                    <h4 class="section-title">Membros da Equipe</h4>
                    
                    <?php if ($resultadoMembros->num_rows > 0): ?>
                        <?php while ($membro = $resultadoMembros->fetch_assoc()): ?>
                        <div class="team-member-card">
                            <img src="<?php echo htmlspecialchars($membro['caminho_imagem_membro']); ?>" 
                                 alt="<?php echo htmlspecialchars($membro['nome_membro']); ?>">
                            <div class="team-member-info">
                                <h5 class="mb-1"><?php echo htmlspecialchars($membro['nome_membro']); ?></h5>
                                <p class="text-muted mb-0">
                                    <i class="bi bi-briefcase-fill"></i> <?php echo htmlspecialchars($membro['cargo_membro']); ?>
                                </p>
                            </div>
                            <form method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este membro?');">
                                <input type="hidden" name="acao" value="excluir_membro">
                                <input type="hidden" name="id_membro" value="<?php echo $membro['id_membro']; ?>">
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash"></i> Excluir
                                </button>
                            </form>
                        </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i> Nenhum membro cadastrado ainda.
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Tab Cadastro -->
                <div class="tab-pane fade" id="cadastro">
                    <h4 class="section-title">Cadastrar Novo Membro</h4>
                    
                    <form method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="acao" value="cadastrar_membro">
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nome Completo</label>
                                <input type="text" class="form-control" name="nome_membro" required>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Cargo / Função</label>
                                <input type="text" class="form-control" name="cargo_membro" required>
                            </div>
                            
                            <div class="col-md-12 mb-4">
                                <label class="form-label">Foto do Membro</label>
                                <input type="file" class="form-control" name="imagem_membro" accept="image/*" required>
                                <small class="text-muted">Formatos aceitos: JPG, PNG, GIF</small>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save"></i> Cadastrar Membro
                        </button>
                    </form>
                </div>

                <!-- Tab Configurações -->
                <div class="tab-pane fade" id="configuracoes">
                    <h4 class="section-title">Configurações do Administrador</h4>
                    
                    <form method="POST">
                        <input type="hidden" name="acao" value="atualizar_perfil">
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nome</label>
                                <input type="text" class="form-control" name="nome_admin" 
                                       value="<?php echo htmlspecialchars($dadosAdmin['nome_adm']); ?>" required>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email_admin" 
                                       value="<?php echo htmlspecialchars($dadosAdmin['email_adm']); ?>" required>
                            </div>
                            
                            <div class="col-12"><hr class="my-4"></div>
                            
                            <div class="col-12 mb-3">
                                <h5 class="text-muted">Alterar Senha (opcional)</h5>
                            </div>
                            
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Senha Atual *</label>
                                <input type="password" class="form-control" name="senha_atual" required>
                            </div>
                            
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Nova Senha</label>
                                <input type="password" class="form-control" name="senha_nova">
                            </div>
                            
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Confirmar Nova Senha</label>
                                <input type="password" class="form-control" name="confirmar_senha">
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save"></i> Salvar Alterações
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>