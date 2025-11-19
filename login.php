<?php
session_start();

// Se já estiver logado, redireciona para o dashboard
if (isset($_SESSION['admin_logado'])) {
    header('Location: admin.php');
    exit;
}

require_once 'conexao.php';

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $conexao->real_escape_string($_POST['email']);
    $senha = $_POST['senha'];
    
    $sql = "SELECT * FROM admin WHERE email_adm = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();
    
    if ($resultado->num_rows === 1) {
        $admin = $resultado->fetch_assoc();
        if (password_verify($senha, $admin['senha_adm'])) {
            $_SESSION['admin_logado'] = true;
            $_SESSION['admin_id'] = $admin['id_adm'];
            $_SESSION['admin_nome'] = $admin['nome_adm'];
            header('Location: admin.php');
            exit;
        } else {
            $erro = 'Email ou senha incorretos!';
        }
    } else {
        $erro = 'Email ou senha incorretos!';
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Admin SSVP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="https://www.ssvpbrasil.org.br/source/files/c/885/DECOM__-_Logotipo_SSVP_Brasil_-_azul_e_branco_01-716579_1022-1028-0-0.jpg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="assets/css/pages/login.css">
</head>
<body>
    <div class="login-card">
        <div class="text-center mb-4">
            <i class="fas fa-shield-lock login-icon"></i>
            <h3 class="mt-3" style="color: var(--color-primary);">Painel Administrativo</h3>
            <p class="text-muted">Lar São Vicente de Paulo</p>
        </div>
        
        <?php if ($erro): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle"></i> <?php echo $erro; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <div class="mb-3">
                <label class="form-label">Email</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    <input type="email" class="form-control" name="email" required>
                </div>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Senha</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" class="form-control" name="senha" required>
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary w-100 mb-3">
                <i class="fas fa-sign-in-alt"></i> Entrar
            </button>
        </form>
        
        <div class="text-center">
            <a href="index.html" class="text-muted text-decoration-none">
                <i class="fas fa-arrow-left"></i> Voltar ao site
            </a>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>