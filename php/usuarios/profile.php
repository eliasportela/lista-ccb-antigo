
<?php session_start(); ?>
<?php
	include("../conexao.php");	
	
	$sessao_usuario = (int)$_SESSION['usuario'];
	unset($_SESSION['lista']);
	$query = "SELECT u.id_usuario, u.nome, u.sobrenome, i.ds_igreja, u.celular, u.email, t.ds_tipo_usuario, u.user, c.nome_cidade, e.sigla_estado
		FROM usuario u 
		INNER JOIN tipo_usuario t ON(t.id_tipo_usuario = u.id_tipo_usuario)
		INNER JOIN igreja i ON(i.id_igreja = u.id_igreja)
		INNER JOIN cidade c ON(c.id_cidade = i.id_cidade)
		INNER JOIN regiao r ON(r.id_regiao = c.id_regiao) 
		INNER JOIN estado e ON(e.id_estado = c.id_estado)
		WHERE id_usuario = $sessao_usuario";
	
	$stmt = $conexao->query($query); #ESTANCIAMENTO
    $resultado = $stmt->fetch();

    if (isset($_SESSION['logado'])):?>	

	<?php include("perfil.php")  ?>

 <?php include("../../rodape_usuario.php");?>
<?php
    else: echo "Erro na requisição da pagina, credenciais invalidas, redirecionando.. ";
    	echo "<meta HTTP-EQUIV='refresh' CONTENT='4;URL=../../areadousuario.php'>";
    	endif; ?>


