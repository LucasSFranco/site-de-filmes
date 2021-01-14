<!DOCTYPE html>



<?php 

  if(session_status() == 1)
    session_start();

  if(!isset($_SESSION["user_id"]) || $_SESSION["acess"] != 'user') {
    header('location:/site-de-filmes/login.php');
  }

  try {
    $pdo = new PDO("mysql:host=localhost; dbname=localdb", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("set names utf8");
  } catch (PDOException $error) {
    echo "Erro na conexão:".$error->getMessage();
  }

  try {
    $id = $_SESSION["user_id"];
  
    $query = "SELECT * FROM clientes WHERE id=?";    
  
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(1, $id);
  
    if ($stmt->execute()) {            
      $result = $stmt->fetch(PDO::FETCH_OBJ);

      if (!isset($usuario)) 
        $usuario = new stdClass();
      $usuario->nome = $result->nome;
      $usuario->email = $result->email;
      $usuario->senha = $result->senha;

    } else {
      throw new PDOException("Erro: Não foi possível executar a declaração sql");
    }
  } catch (PDOException $error) {
    echo "Erro: ".$error->getMessage();
  }

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario->nome = (isset($_POST["nome"]) && $_POST["nome"] != null) ? $_POST["nome"] : "";
  }
  
?>

<html>
  <?php include('../components/Head.php') ?> 
  <body>
    <?php include('../components/Navbar.php') ?> 
    <div class="wrapper">
      <div class="form">
        <h1 class="form-title">PERFIL<a href="./editar.php"><i class="icon fa fa-edit" title="Editar"></i></a></h1>
        <input class="form-input" <?php if(isset($usuario->nome)) { echo "value=\"$usuario->nome\""; } ?> type="text" disabled/>
        <input class="form-input" <?php if(isset($usuario->email)) { echo "value=\"$usuario->email\""; } ?> type="email" disabled/>
        <input class="form-input" <?php if(isset($usuario->senha)) { echo "value=\"$usuario->senha\""; } ?> type="password" disabled/>
      </div>
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
            position:relative;
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
              color: #ecc94b;    
              font-size: 1rem;
              margin-left: .5rem;
              cursor: pointer;
              position: absolute;
            }
          
              .icon:hover {
                color: #d69e2e;
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