<?php
session_start();

/* USUÁRIOS INICIAIS */

if(!isset($_SESSION['usuarios'])){
$_SESSION['usuarios'] = [
["id"=>1,"nome"=>"Eric Freitas","email"=>"eric@unifev.edu.br","acesso"=>"Administrador","status"=>"Ativo"],
["id"=>2,"nome"=>"Ana Souza","email"=>"ana.souza@email.com","acesso"=>"Editor","status"=>"Ativo"],
["id"=>3,"nome"=>"Carlos Lima","email"=>"carlos.lima@servidor.com","acesso"=>"Usuário","status"=>"Inativo"]
];
}

/* CADASTRAR */

if(isset($_POST['nome']) && !isset($_POST['salvar'])){

$novo = [
"id"=>count($_SESSION['usuarios'])+1,
"nome"=>$_POST['nome'],
"email"=>$_POST['email'],
"acesso"=>$_POST['acesso'],
"status"=>$_POST['status']
];

$_SESSION['usuarios'][]=$novo;

}

/* EXCLUIR */

if(isset($_GET['excluir'])){

$id=$_GET['excluir'];

foreach($_SESSION['usuarios'] as $k=>$u){
if($u['id']==$id){
unset($_SESSION['usuarios'][$k]);
}
}

}

/* VER USUÁRIO */

$usuarioVer=null;

if(isset($_GET['ver'])){

$id=$_GET['ver'];

foreach($_SESSION['usuarios'] as $u){
if($u['id']==$id){
$usuarioVer=$u;
}
}

}

/* EDITAR */

$usuarioEditar=null;

if(isset($_GET['editar'])){

$id=$_GET['editar'];

foreach($_SESSION['usuarios'] as $u){
if($u['id']==$id){
$usuarioEditar=$u;
}
}

}

/* SALVAR EDIÇÃO */

if(isset($_POST['salvar'])){

$id=$_POST['id'];

foreach($_SESSION['usuarios'] as $k=>$u){

if($u['id']==$id){

$_SESSION['usuarios'][$k]['nome']=$_POST['nome'];
$_SESSION['usuarios'][$k]['email']=$_POST['email'];
$_SESSION['usuarios'][$k]['acesso']=$_POST['acesso'];
$_SESSION['usuarios'][$k]['status']=$_POST['status'];

}

}

}

$usuarios=$_SESSION['usuarios'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>

<meta charset="UTF-8">
<title>Gestão de Usuários</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>

body{
margin:0;
font-family:Arial;
background:#f3f4f6;
}

/* MENU */

.sidebar{
width:220px;
height:100vh;
background:#2f3e4e;
color:white;
position:fixed;
padding-top:30px;
}

.sidebar h2{
text-align:center;
margin-bottom:30px;
}

.sidebar a{
display:block;
padding:12px 20px;
color:white;
text-decoration:none;
}

.sidebar a:hover{
background:#1f2a36;
}

/* CONTEÚDO */

.content{
margin-left:220px;
padding:30px;
}

table{
width:100%;
border-collapse:collapse;
background:white;
margin-top:20px;
}

th{
background:#2f3e4e;
color:white;
padding:10px;
text-align:left;
}

td{
padding:10px;
border-bottom:1px solid #eee;
}

/* zebra */

tr:nth-child(even){
background:#f9fafb;
}

/* hover */

tr:hover{
background:#eef2f7;
}

/* status */

.badge{
padding:4px 8px;
border-radius:5px;
font-size:12px;
}

.ativo{
background:#d1fae5;
color:#065f46;
}

.inativo{
background:#fee2e2;
color:#7f1d1d;
}

/* botões */

.btn{
background:#2f3e4e;
color:white;
padding:8px 12px;
border:none;
cursor:pointer;
}

.icon-btn{
border:none;
background:none;
cursor:pointer;
margin-right:5px;
font-size:14px;
}

form input,select{
padding:6px;
margin:5px;
}

</style>

</head>

<body>

<div class="sidebar">

<h2>Painel</h2>

<a href="#">Início</a>
<a href="#">Usuários</a>
<a href="#">Relatórios</a>

</div>

<div class="content">

<h1>Gestão de Usuários</h1>

<p>Visualize e gerencie as permissões dos usuários do sistema.</p>

<h3>Cadastrar Usuário</h3>

<form method="post">

<input type="text" name="nome" placeholder="Nome" required>

<input type="email" name="email" placeholder="Email" required>

<select name="acesso">
<option>Administrador</option>
<option>Editor</option>
<option>Usuário</option>
</select>

<select name="status">
<option>Ativo</option>
<option>Inativo</option>
</select>

<button class="btn">Cadastrar</button>

</form>

<?php if($usuarioVer){ ?>

<h3>Dados do Usuário</h3>

<p><b>Nome:</b> <?php echo $usuarioVer['nome']; ?></p>
<p><b>Email:</b> <?php echo $usuarioVer['email']; ?></p>
<p><b>Acesso:</b> <?php echo $usuarioVer['acesso']; ?></p>
<p><b>Status:</b> <?php echo $usuarioVer['status']; ?></p>

<hr>

<?php } ?>

<?php if($usuarioEditar){ ?>

<h3>Editar Usuário</h3>

<form method="post">

<input type="hidden" name="id" value="<?php echo $usuarioEditar['id']; ?>">

<input type="text" name="nome" value="<?php echo $usuarioEditar['nome']; ?>">

<input type="email" name="email" value="<?php echo $usuarioEditar['email']; ?>">

<select name="acesso">

<option <?php if($usuarioEditar['acesso']=="Administrador") echo "selected"; ?>>Administrador</option>
<option <?php if($usuarioEditar['acesso']=="Editor") echo "selected"; ?>>Editor</option>
<option <?php if($usuarioEditar['acesso']=="Usuário") echo "selected"; ?>>Usuário</option>

</select>

<select name="status">

<option <?php if($usuarioEditar['status']=="Ativo") echo "selected"; ?>>Ativo</option>
<option <?php if($usuarioEditar['status']=="Inativo") echo "selected"; ?>>Inativo</option>

</select>

<button name="salvar" class="btn">Salvar</button>

</form>

<hr>

<?php } ?>

<table>

<tr>
<th>ID</th>
<th>NOME</th>
<th>E-MAIL</th>
<th>ACESSO</th>
<th>STATUS</th>
<th>AÇÕES</th>
</tr>

<?php foreach($usuarios as $u){ ?>

<tr>

<td><?php echo $u['id']; ?></td>
<td><?php echo $u['nome']; ?></td>
<td><?php echo $u['email']; ?></td>
<td><?php echo $u['acesso']; ?></td>

<td>

<?php if($u['status']=="Ativo"){ ?>

<span class="badge ativo">Ativo</span>

<?php }else{ ?>

<span class="badge inativo">Inativo</span>

<?php } ?>

</td>

<td>

<a href="?ver=<?php echo $u['id']; ?>">
<button class="icon-btn">
<i class="fa-solid fa-eye"></i>
</button>
</a>

<a href="?editar=<?php echo $u['id']; ?>">
<button class="icon-btn">
<i class="fa-solid fa-pen"></i>
</button>
</a>

<a href="?excluir=<?php echo $u['id']; ?>">
<button class="icon-btn">
<i class="fa-solid fa-trash"></i>
</button>
</a>

</td>

</tr>

<?php } ?>

</table>

</div>

</body>
</html>
