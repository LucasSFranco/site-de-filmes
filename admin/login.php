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
    if (!isset($credentials)) 
      $credentials = new stdClass();
    $credentials->email = $_REQUEST['email'];
    $credentials->senha = $_REQUEST['senha'];
  }

  if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "auth") {

    if (!isset($errorMessages)) 
      $errorMessages = new stdClass();

    foreach($credentials as $key => $value) {
      if($value == "") {
        $errorMessages->$key = "Você deve preencher este campo" ;
      }
    }

    if(count((array)$errorMessages) == 0) {
      try {
        $query = "SELECT * FROM admins WHERE email=? AND senha=?";

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(1, $credentials->email);
        $stmt->bindParam(2, $credentials->senha);

        if ($stmt->execute()) {

          
          if($stmt->rowCount() > 0) {

            $result = $stmt->fetch(PDO::FETCH_OBJ);
            $id = $result->id;  

            session_start();
            $_SESSION['user_id'] = $id;
            $_SESSION['acess'] = 'admin';

            header('location:./filmes/listar.php');

          } else {
            $errorMessages->form = 'Email e/ou senha inválidos';
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
  <?php include('../components/Head.php') ?> 
  <body>
    <?php include('../components/Navbar.php') ?> 
    <div class="wrapper">
      <form action="?act=auth" method="POST" class="form <?php if(isset($errorMessages->form)) { echo 'global-error'; } ?>">
        <h1 class="form-title">ENTRAR<span class="info">ADMIN</span></h1>
        
        <input class="form-input <?php if(isset($errorMessages->email)) { echo 'error'; } ?>" <?php if(isset($credentials->email)) { echo "value=\"$credentials->email\""; } ?> type="text" name="email" placeholder="E-mail" />
        <small class="form-error <?php if(isset($errorMessages->email)) { echo "show"; } ?>"> <?php if(isset($errorMessages->email)) { echo $errorMessages->email; } ?> </small> 
        <input class="form-input <?php if(isset($errorMessages->senha)) { echo 'error'; } ?>" <?php if(isset($credentials->senha)) { echo "value=\"$credentials->senha\""; } ?> type="password" name="senha" placeholder="Senha" />
        <small class="form-error <?php if(isset($errorMessages->senha)) { echo "show"; } ?>"> <?php if(isset($errorMessages->senha)) { echo $errorMessages->senha; } ?> </small> 
        <button class="button" type="submit"> <i class="icon fa fa-sign-in"></i>Entrar </button>
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
            position: relative;
            margin-bottom: 1.5rem;
            position: relative;
            padding-bottom: .5rem;
            text-align: center;
            font-size: 1.375rem;
            font-weight: 500;
          }

            .form-title:after {
              content: '';
              background: #5a67d8; 
              width: 72px;
              height: 5px;
              position: absolute;
              bottom: 0;
              left: 50%;
              transform: translateX(-50%);
            }

            .info {
              color: #777777;    
              font-size: .675rem;
              margin-left: .25rem;
              position: absolute;
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
            background: #5a67d8; 
            cursor: pointer;
            text-decoration: none;
            font-size: 1rem;
            border: none;
            text-align: center;
            margin-bottom: .5rem;
          }

            .button:hover {
              background: #434190;
            }

            .icon {
              margin-right: .5rem;
            }
          
          .form-error {
            display: none;
            color: #e53e3e;
            font-size: .875rem;
            margin-bottom: .5rem;
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