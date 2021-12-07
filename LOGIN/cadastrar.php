<?php

	require_once 'CLASSES/users.php';
	$user = new Usuario;

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title> Projeto Login </title>
	<link rel="stylesheet" href="CSS/estilo.css">
</head>
<body>
<div id="corpo-form-Cad">
	    <h1>Cadastrar</h1>
	    <form method="POST">
	    	<input type="text" name="nome" placeholder="Nome Completo" maxlength="30">
		    <input type="text" name="telefone" placeholder="Telefone" maxlength="30">
		    <input type="email" name="email" placeholder="Email" maxlength="40">
		    <input type="password" name="senha" placeholder="Senha" maxlength="15">
		    <input type="password" name="confirmSenha" placeholder="Confirmar Senha" maxlength="15">
		    <input type="submit" value="CADASTRAR">
	    </form>
</div>
<?php 
//Verificar se clicou no botão Cadastrar

if(isset($_POST['nome'])){
	
	$nome = addslashes($_POST['nome']);
	$telefone = addslashes($_POST['telefone']);
	$email = addslashes($_POST['email']);
	$senha = addslashes($_POST['senha']);
	$confirmarSenha = addslashes($_POST['confirmSenha']);

	//Verificar se está vazio
	if(!empty($nome) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($confirmarSenha)){

		$user->conectarBD("projeto_login","localhost","root","");
		if($user->msgErro == ""){
            
            if($senha == $confirmarSenha){
               
               if($user->cadastrar($nome, $telefone, $email, $senha)){
               		?>
               		<div id="msg-sucesso"> 
               			Cadastrado com sucesso!
               		</div>
                    <?php

                }else{
                      ?>
                		<div class="msg-erro">
               		 		Email já cadastrado!	
            	    	</div>
            	       <?php
            	}
            }else{
            	  ?>
            		<div class="msg-erro">
            			Senha e Confirmar senha não correspondem!
            		</div>
            	   <?php
            }
		}else{
			  ?>
			  	<div class="msg-erro">
			  		<?php echo "Erro ".$user->msgErro;?>
			  	</div>
			  <?php
		}
	}else{
			?>
				<div class="msg-erro">
					Preencha todos os campos!
				</div>
			<?php
	}
}

?>
</body>
</html>