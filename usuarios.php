<?php
session_start();

/* lista inicial de usuários */

if(!isset($_SESSION['usuarios'])){

$_SESSION['usuarios'] = [

["id"=>1,"nome"=>"Ana Souza","email"=>"ana@email.com","perfil"=>"Administrador","status"=>"Ativo"],
["id"=>2,"nome"=>"João Silva","email"=>"joao@email.com","perfil"=>"Editor","status"=>"Ativo"],
["id"=>3,"nome"=>"Carlos Lima","email"=>"carlos@email.com","perfil"=>"Usuário","status"=>"Inativo"]

];

}

/* excluir usuário */

if(isset($_GET["excluir"])){

$id = $_GET["excluir"];

foreach($_SESSION["usuarios"] as $chave => $u){

if($u["id"] == $id){

unset($_SESSION["usuarios"][$chave]);

}

}

}

/* ver usuário */

$usuarioSelecionado = null;

if(isset($_GET["ver"])){

$id = $_GET["ver"];

foreach($_SESSION["usuarios"] as $u){

if($u["id"] == $id){

$usuarioSelecionado = $u;

}

}

}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>

<meta charset="UTF-8">
<title>Painel</title>

<style>

body{
margin:0;
font-family:Arial;
display:flex;
background:#f4f4f4;
}

.sidebar{
width:220px;
background:#1f2937;
color:white;
height:100vh;
padding:20px;
}

.sidebar a{
display:block;
color:white;
text-decoration:none;
margin:10px 0;
}

.main{
flex:1;
padding:30px;
}

table{
width:100%;
border-collapse:collapse;
background:white;
}

th{
background:#111827;
color:white;
padding:10px;
}

td{
padding:10px;
border-bottom:1px solid #ddd;
}

button{
padding:5px 10px;
border:none;
}

.ver{
background:#2563eb;
color:white;
}

.excluir{
background:red;
color:white;
}

.card{
background:white;
padding:20px;
margin-bottom:20px;
border-radius:6px;
}

</style>

</head>

<body>

<div class="sidebar">

<h2>Painel</h2>

<a href="index.php">Dashboard</a>
<a href="index.php">Usuários</a>

</div>

<div class="main">

<h1>Gestão de Usuários</h1>

<?php if($usuarioSelecionado){ ?>

<div class="card">

<h2>Detalhes do Usuário</h2>

<p><b>ID:</b> <?php echo $usuarioSelecionado["id"]; ?></p>
<p><b>Nome:</b> <?php echo $usuarioSelecionado["nome"]; ?></p>
<p><b>Email:</b> <?php echo $usuarioSelecionado["email"]; ?></p>
<p><b>Perfil:</b> <?php echo $usuarioSelecionado["perfil"]; ?></p>
<p><b>Status:</b> <?php echo $usuarioSelecionado["status"]; ?></p>

</div>

<?php } ?>

<table>

<tr>
<th>ID</th>
<th>Nome</th>
<th>Email</th>
<th>Perfil</th>
<th>Status</th>
<th>Ações</th>
</tr>

<?php foreach($_SESSION["usuarios"] as $u){ ?>

<tr>

<td><?php echo $u["id"]; ?></td>
<td><?php echo $u["nome"]; ?></td>
<td><?php echo $u["email"]; ?></td>
<td><?php echo $u["perfil"]; ?></td>
<td><?php echo $u["status"]; ?></td>

<td>

<a href="?ver=<?php echo $u["id"]; ?>">
<button class="ver">Ver</button>
</a>

<a href="?excluir=<?php echo $u["id"]; ?>">
<button class="excluir">Excluir</button>
</a>

</td>

</tr>

<?php } ?>

</table>

</div>

</body>
</html>