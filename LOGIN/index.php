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
    <div id="corpo-form">
	    <h1>Entrar</h1>
	    <form method="POST">
		    <input type="email" name="email" placeholder="Email">
		    <input type="password" name="senha" placeholder="Senha">
		    <input type="submit" value="ACESSAR">
		    <a href="cadastrar.php">Ainda não é inscrito?<strong> Cadastre-se! </strong></a>
	    </form>
    </div>
<?php
if(isset($_POST['email'])){
    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);
    if(!empty($email) && !empty($senha)){

        $user->conectarBD("projeto_login","localhost","root","");
        if($user->msgErro == ""){
                if($user->logar($email,$senha)){

                    header("location: AreaPrivada.php");

                }else{
                      ?>
                        <div class="msg-erro">
                            Email e/ou senha estão incorretos!
                        </div>
                    <?php            
                }
        }else{
                ?>
                    <div class="msg-erro">
                        <?php echo "Erro: ".$user->msgErro;?>
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