<?php 

Class Usuario{
	
    	private $pdo;
    	public $msgErro = "";

	public function conectarBD($nome, $host, $usuario, $senha)
	{

		global $pdo;
		try {
		     $pdo = new PDO("mysql:dbname=".$nome.";host=".$host,$usuario,$senha);	
		} catch (PDOException $e) {
			
			$msgErro = $e->getMessage();
		}
	}


	public function cadastrar($nome, $telefone, $email, $senha){
       
        	global $pdo;
       	 	//Verificar se o email já existe
        	$sql = $pdo->prepare("SELECT id_user FROM users WHERE email = :e");
        	$sql->bindValue(":e",$email);
        	$sql->execute();
        	if($sql->rowCount() > 0){

       	  	  //Email já está cadastrado!
       	
       	  	  return false;

        	}else{
       	     	     //Email ainda não está cadastrado, então irá cadastrar
        
             	     $sql = $pdo->prepare("INSERT INTO users (nome,telefone,email,senha) VALUES (:n, :t, :e, :s)");
             	     $sql->bindValue(":n", $nome);
                     $sql->bindValue(":t", $telefone);
                     $sql->bindValue(":e", $email);
                     $sql->bindValue(":s", md5($senha));
                     $sql->execute();

                     return true; //Cadastrado com sucesso!
        	}

	}

        public function logar($email, $senha)
	{
       
       	    global $pdo;
            //Verificar se o email e senha já estão cadastrados no BD
            $sql = $pdo->prepare("SELECT id_user FROM users WHERE email = :e AND senha = :s");
            $sql->bindValue(":e",$email);
            $sql->bindValue(":s",md5($senha));
            $sql->execute();
            if($sql->rowCount() > 0){

       	      //Entrar no sistema (Session)
       	      $dado = $sql->fetch();
       	      session_start();
       	      $_SESSION['id_user'] = $dado['id_user'];
       	      
	      return true;
		    
       	     //Logado com sucesso!
            }else{

       	         //Não foi possível logar!
       	         return false;
            }
        }

}

?>
