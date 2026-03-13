<?php
session_start();

/* CRIA LISTA DE USUÁRIOS SE NÃO EXISTIR */

if(!isset($_SESSION["usuarios"])){

$_SESSION["usuarios"] = [

["id"=>1,"nome"=>"João","email"=>"joao@email.com","acesso"=>"Administrador","status"=>"Ativo"],
["id"=>2,"nome"=>"Maria","email"=>"maria@email.com","acesso"=>"Usuário","status"=>"Ativo"],
["id"=>3,"nome"=>"Carlos","email"=>"carlos@email.com","acesso"=>"Editor","status"=>"Inativo"]

];

}

/* CADASTRAR USUÁRIO */

if(isset($_POST["nome"])){

$novo = [
"id"=>count($_SESSION["usuarios"])+1,
"nome"=>$_POST["nome"],
"email"=>$_POST["email"],
"acesso"=>$_POST["acesso"],
"status"=>$_POST["status"]
];

$_SESSION["usuarios"][] = $novo;

}

/* EXCLUIR USUÁRIO */

if(isset($_GET["excluir"])){

$id = $_GET["excluir"];

foreach($_SESSION["usuarios"] as $chave => $u){

if($u["id"] == $id){
unset($_SESSION["usuarios"][$chave]);
}

}

}

/* VISUALIZAR USUÁRIO */

$usuarioVisualizar = null;

if(isset($_GET["ver"])){

$id = $_GET["ver"];

foreach($_SESSION["usuarios"] as $u){

if($u["id"] == $id){
$usuarioVisualizar = $u;
}

}

}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>

<meta charset="UTF-8">
<title>Gestão de Usuários</title>

<style>

body{
font-family:Arial;
background:#f0f0f0;
}

h1{
text-align:center;
}

/* FORMULÁRIO */

form{
width:60%;
margin:auto;
background:white;
padding:20px;
margin-bottom:20px;
}

input,select{
width:100%;
padding:8px;
margin-top:5px;
margin-bottom:10px;
}

.cadastrar{
background:green;
color:white;
padding:8px;
border:none;
}

/* TABELA */

table{
width:80%;
margin:auto;
border-collapse:collapse;
background:white;
}

th{
background:#333;
color:white;
padding:10px;
}

td{
padding:10px;
text-align:center;
}

tr:nth-child(even){
background:#f2f2f2;
}

/* STATUS */

.ativo{
color:green;
font-weight:bold;
}

.inativo{
color:red;
font-weight:bold;
}

/* BOTÕES */

.btn{
padding:5px 10px;
color:white;
text-decoration:none;
}

.visualizar{
background:blue;
}

.excluir{
background:red;
}

/* VISUALIZAÇÃO */

.caixa{
width:60%;
margin:20px auto;
background:white;
padding:15px;
}

/* RODAPÉ */

footer{
text-align:center;
margin-top:30px;
}

</style>

</head>
<body>

<h1>Gestão de Usuários</h1>

<form method="POST">

<h3>Cadastrar Novo Usuário</h3>

<label>Nome</label>
<input type="text" name="nome" required>

<label>Email</label>
<input type="email" name="email" required>

<label>Acesso</label>
<select name="acesso">
<option>Administrador</option>
<option>Usuário</option>
<option>Editor</option>
</select>

<label>Status</label>
<select name="status">
<option>Ativo</option>
<option>Inativo</option>
</select>

<button class="cadastrar">Cadastrar</button>

</form>

<?php if($usuarioVisualizar){ ?>

<div class="caixa">

<h3>Visualização do Usuário</h3>

<p><b>ID:</b> <?php echo $usuarioVisualizar["id"]; ?></p>
<p><b>Nome:</b> <?php echo $usuarioVisualizar["nome"]; ?></p>
<p><b>Email:</b> <?php echo $usuarioVisualizar["email"]; ?></p>
<p><b>Acesso:</b> <?php echo $usuarioVisualizar["acesso"]; ?></p>
<p><b>Status:</b> <?php echo $usuarioVisualizar["status"]; ?></p>

</div>

<?php } ?>

<table>

<tr>
<th>ID</th>
<th>Nome</th>
<th>Email</th>
<th>Acesso</th>
<th>Status</th>
<th>Ações</th>
</tr>

<?php

foreach($_SESSION["usuarios"] as $u){

$statusClasse = strtolower($u["status"]);

echo "<tr>";

echo "<td>".$u["id"]."</td>";
echo "<td>".$u["nome"]."</td>";
echo "<td>".$u["email"]."</td>";
echo "<td>".$u["acesso"]."</td>";
echo "<td class='$statusClasse'>".$u["status"]."</td>";

echo "<td>";

echo "<a class='btn visualizar' href='?ver=".$u["id"]."'>Ver</a> ";

echo "<a class='btn excluir' href='?excluir=".$u["id"]."'>Excluir</a>";

echo "</td>";

echo "</tr>";

}

?>

</table>

<footer>

<p>2026 - Desenvolvido por Pedro</p>

</footer>

</body>
</html>