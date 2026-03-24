<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="dash.css">
</head>

<body>

<div class="dashboard-container">

    <!-- Sidebar -->
    <nav>
        <div>
            <ul>
                <li><a href="#">Início</a></li>
                <li><a href="#">Projetos</a></li>
                <li><a href="#">Relatórios</a></li>
                <li><a href="#">Configurações</a></li>
            </ul>
        </div>

        <div class="perfil-usuario">
            <img src="https://ui-avatars.com/api/?name=Pedro+Henrique&background=008080&color=fff">
            <span>Pedro</span>
        </div>
    </nav>

    <!-- Conteúdo -->
    <main>

        <!-- Botões -->
        <div class="top-buttons">
            <button onclick="abrirLogin()" class="btn-login">Login</button>
            <button onclick="abrirLogin()" class="btn-add">+ Adicionar Usuário</button>
        </div>

        <div class="cards">

            <div class="card">
                <h3>Módulo de Usuários</h3>
                <p>Gerencie os acessos e permissões do sistema nesta área.</p>
                <a href="#">Acessar</a>
            </div>

            <div class="card">
                <h3>Relatórios de Vendas</h3>
                <p>Acompanhe os gráficos de desempenho deste mês.</p>
                <a href="#">Acessar</a>
            </div>

            <div class="card">
                <h3>Configurações do Servidor</h3>
                <p>Ajuste as portas do Apache e o banco de dados.</p>
                <a href="#">Acessar</a>
            </div>

        </div>
    </main>

</div>

<!-- Modal Login -->
<div id="modalLogin" class="modal">
    <div class="modal-content">
        <span class="fechar" onclick="fecharLogin()">&times;</span>
        <h2>Login</h2>

        <input type="text" placeholder="Usuário">
        <input type="password" placeholder="Senha">

         <button onclick="fazerLogin()">Entrar</button>
    </div>
</div>

<footer>
    © - Desenvolvido na aula
</footer>

<script>
function abrirLogin() {
    document.getElementById("modalLogin").style.display = "flex";
}

function fecharLogin() {
    document.getElementById("modalLogin").style.display = "none";
}
</script>

</body>
</html>
</body>
</html>
