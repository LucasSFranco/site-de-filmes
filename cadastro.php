<!DOCTYPE html>

<?php 

  if(session_status() == 1)
    session_start();

  if(isset($_SESSION["user_id"])) {
    if($_SESSION["acess"] == 'admin') {
      header('location:/site-de-filmes/admin/filmes/listar.php');
    } else {
      header('location:/site-de-filmes/filmes.php');
    }
  }

  try {
    $pdo = new PDO("mysql:host=localhost; dbname=localdb", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("set names utf8");
  } catch (PDOException $error) {
    echo "Erro na conexão:".$error->getMessage();
  }

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($user)) 
      $user = new stdClass();
    $user->nome = (isset($_POST["nome"]) && $_POST["nome"] != null) ? $_POST["nome"] : "";
    $user->email = (isset($_POST["email"]) && $_POST["email"] != null) ? $_POST["email"] : "";
    $user->senha = (isset($_POST["senha"]) && $_POST["senha"] != null) ? $_POST["senha"] : "";
  }

  if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "create") {

    if (!isset($errorMessages)) 
      $errorMessages = new stdClass();

    foreach($user as $key => $value) {
      if($value == "") {
        $errorMessages->$key = "Você deve preencher este campo" ;
      }
    }

    try {
      $query = "SELECT * FROM clientes WHERE email=?";
  
      $stmt = $pdo->prepare($query);
      $stmt->bindParam(1, $user->email);
  
      if($stmt->execute()) {
        if(!isset($errorMessages->email) && $stmt->rowCount() > 0) {
          $errorMessages->email = "Esse e-mail já existe";
        }
      } else {
        throw new PDOException("Erro: Não foi possível executar a declaração sql");
      }
    } catch (PDOException $error) {
      echo "Erro: ".$error->getMessage();
    }

    if(count((array)$errorMessages) == 0) {
      try {  

        $query = "INSERT INTO clientes (nome, email, senha) VALUES (?, ?, ?)";

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(1, $user->nome);
        $stmt->bindParam(2, $user->email);
        $stmt->bindParam(3, $user->senha);        

        if ($stmt->execute()) {           
          if($stmt->rowCount() > 0) { 
            header('location:login.php');
          } else {
            $errorMessages->form = "Erro ao tentar efetuar o cadastro";
          }       
        } else {
          throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
      } catch (PDOException $error) {
        echo "Erro: ".$error->getMessage();
      }
    }
  }

?>

<html>
  <?php include('./components/Head.php') ?> 
  <body>
    <?php include('./components/Navbar.php') ?> 
    <div class="wrapper">
      <form action="?act=create" method="POST" class="form <?php if(isset($errorMessages->form)) { echo 'global-error'; } ?>">
        <h1 class="form-title">CADASTRAR</h1>        
        <input class="form-input <?php if(isset($errorMessages->nome)) { echo 'error'; } ?>" <?php if(isset($user->nome)) { echo "value=\"$user->nome\""; } ?> type="text" name="nome" placeholder="Nome" />
        <small class="form-error <?php if(isset($errorMessages->nome)) { echo "show"; } ?>"> <?php if(isset($errorMessages->nome)) { echo $errorMessages->nome; } ?> </small>    
        <input class="form-input <?php if(isset($errorMessages->email)) { echo 'error'; } ?>" <?php if(isset($user->email)) { echo "value=\"$user->email\""; } ?> type="email" name="email" placeholder="E-mail" />     
        <small class="form-error <?php if(isset($errorMessages->email)) { echo "show"; } ?>"> <?php if(isset($errorMessages->email)) { echo $errorMessages->email; } ?> </small>        
        <input class="form-input <?php if(isset($errorMessages->senha)) { echo 'error'; } ?>" <?php if(isset($user->senha)) { echo "value=\"$user->senha\""; } ?> type="password" name="senha" placeholder="Senha" />
        <small class="form-error <?php if(isset($errorMessages->senha)) { echo "show"; } ?>"> <?php if(isset($errorMessages->senha)) { echo $errorMessages->senha; } ?> </small>  
        <button class="button" type="submit"> <i class="icon fa fa-user-plus"></i>Cadastrar </button>
        <small class="form-error <?php if(isset($errorMessages->form)) { echo "show"; } ?>"> <?php if(isset($errorMessages->form)) { echo $errorMessages->form; } ?> </small>    
      </form>
    </div>

    <style>
      .wrapper {
        height: auto;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 5rem 0;
      }

        .form {
          margin: 1.5rem;
          width: 100%;
          max-width: 450px;
          padding: 1rem;
          display: flex;
          flex-direction: column;
          box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
          background: white;
        }

          .form-title {
            margin-bottom: 1.5rem;
            position: relative;
            padding-bottom: .5rem;
            text-align: center;
            font-size: 1.375rem;
            font-weight: 500;
          }

            .form-title:after {
              content: '';
              background: #48bb78; 
              width: 72px;
              height: 5px;
              position: absolute;
              bottom: 0;
              left: 50%;
              transform: translateX(-50%);
            }

          .form-input {
            padding: 1rem;
            background: rgba(0,0,0,.05);
            font-size: 1rem;
            margin-bottom: .5rem;
            text-align: center;
            outline: none;
            border: none;
          }

            .form-input::placeholder {
              font-family: "Poppins", Arial, sans-serif;
              font-size: 1rem;
              color: rgba(0,0,0,.8);
              font-weight: 500;
            }

          .error {
            background: #fed7d7;
            margin: 0;
          }

          .button {
            color: white;
            outline: none;
            padding: 1rem;
            background: #48bb78;
            cursor: pointer;
            text-decoration: none;
            font-size: 1rem;
            border: none;
            text-align: center;
            margin-bottom: .5rem;
          }

            .button:hover {
              background: #2f855a;
            }

            .icon {
              margin-right: .5rem;
            }
          
          .form-error {
            color: #e53e3e;
            font-size: .875rem;
            margin-bottom: .5rem;
            display: none;
          }

          .show {
            display: block;
          }
        
        .global-error .form-input {
          background: #fed7d7;
        }

    </style>
  </body>
</html>