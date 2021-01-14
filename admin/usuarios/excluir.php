<!DOCTYPE html>

<?php 

  if(session_status() == 1)
    session_start();

  if(!isset($_SESSION["user_id"]) || $_SESSION["acess"] != 'admin') {
    header('location:/site-de-filmes/admin/login.php');
  }

  try {
    $pdo = new PDO("mysql:host=localhost; dbname=localdb", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("set names utf8");
  } catch (PDOException $error) {
    echo "Erro na conexão:".$error->getMessage();
  }

  try {
    $id = (isset($_GET["id"]) && $_GET["id"] != null) ? $_GET["id"] : "";
  
    $query = "SELECT * FROM clientes WHERE id=?";    
  
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(1, $id);
  
    if ($stmt->execute()) {            
      $result = $stmt->fetch(PDO::FETCH_OBJ);

      if (!isset($usuario)) 
        $usuario = new stdClass();
      $usuario->nome = $result->nome;

    } else {
      throw new PDOException("Erro: Não foi possível executar a declaração sql");
    }
  } catch (PDOException $error) {
    echo "Erro: ".$error->getMessage();
  }

  if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "delete") {

    if (!isset($errorMessages)) 
      $errorMessages = new stdClass();

    if(count((array)$errorMessages) == 0) {
      try {
        $query = "DELETE FROM clientes WHERE id=?";

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(1, $id);

        if ($stmt->execute()) {
          if ($stmt->rowCount() > 0) {
            
            header('location:../listar.php');

          } else {
            $errorMessages->form = "Erro ao tentar efetuar a exclusão";
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
  <?php include('../../components/Head.php') ?> 
  <body>
    <?php include('../../components/Navbar.php') ?> 
    <div class="wrapper">
      <form action="?id=<?php echo $id ?>&act=delete" method="POST" class="form">
        <h1 class="form-title">EXCLUIR</h1>
        <p class="form-text">Você tem certeza que deseja excluir o usuário selecionado, cujo nome é <?php echo $usuario->nome ?>?</p>
        <button class="button delete" type="submit"> <i class="icon fa fa-trash"></i>Excluir </button>
        <a class="button" href="../listar.php"> <i class="icon fa fa-chevron-left"></i>Voltar </a>
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
              background: #e53e3e;
              width: 72px;
              height: 5px;
              position: absolute;
              bottom: 0;
              left: 50%;
              transform: translateX(-50%);
            }

          .form-text {
            margin-bottom: 1.5rem;
            text-align: center;
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
          
          .delete {
            background: #e53e3e;
          }

            .delete:hover {
              background: #9b2c2c;
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

    </style>
  </body>
</html>