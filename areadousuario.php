<?php session_start(); ?>
<?php include("php/conexao.php"); ?>
<?php if (isset($_SESSION['logado'])):
        if (isset($_SESSION['usuario'])) {
          $user_sessao = $_SESSION['usuario'];
        }
        header("location: php/usuarios/profile.php");
?>
<?php else: ?>
    
    
<?php
if (isset($_POST['submit'])) {
	# code...

    $user = $_POST['user'];
    $senha = $_POST['senha'];


    try {

        $query = "SELECT id_usuario, user,senha FROM usuario";
        $stmt = $conexao->query($query); #ESTANCIAMENTO
        $resultado = $stmt->fetchAll();
        $i = false;

        foreach ($resultado as $users) {
            # code...
           if($users['user']==$user and $users['senha']==$senha){
                $i = true;
                $id_usuario = (int)$users['id_usuario'];
                $_SESSION['logado'] = true;
                $_SESSION['usuario'] = $id_usuario;
           }
        }
			        
        } 
    catch (\PDOException $e) {
        die("Erro ao conectar ao DB".$e->getCode());
    }
    if ($i) {
        #die(var_dump($_POST));
    	header("location: php/usuarios/profile.php");
    }
    else{
    	?>
    	<script type="text/javascript">
            alert("Usuário ou senha Inválido");
        </script>
    	<?php
    }
}
?>

<?php 
    $nome_pagina = "Área do Usuário";
    include("cabecalho_usuario.php"); ?>
    <section class="bg-primary">
    <div class="container">
    	<div class="row">
    		<div class="col-lg-12 text-center">
    			<h2 class="section-heading">Login</h2>
    			<div class="row">
    				<div class="col-md-4"></div>
    				<div class="col-md-4">
    					<form class="form-horizontal" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        	<div class="control-group">
                                <label class="control-label" for="inputUser">Usuário</label>
                                <div class="controls">
                                	<input class="form-control" id="inputUser" type="text" name="user" placeholder="Digite o seu Usuário..." />
                           	</div>
                                    </div>
                            <div class="control-group">
                            	<label class="control-label" for="inputPassword">Senha</label>
                                <div class="controls">
                                	<input class="form-control" id="inputPassword" type="password" name="senha" placeholder="Digite a sua senha..." />
                                </div>
                            </div>
                            <div class="control-group">
                               <div class="controls">
                               		<label class="checkbox"><input type="checkbox" /> Lembrar senha</label>
                                	<p></p>
                                	<button class="btn btn-default btn-xl sr-button" name="submit" type="submit">Acessar</button>
                                </div>
                            </div>
                        </form>				
    				</div>
    				<div class="col-md-4"></div>
    			</div>
    		</div>
    	</div>
    </div>
    </section>

<?php include("rodape_usuario.php"); endif; ?>