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
  
    $query = "SELECT * FROM filmes WHERE id=?";    
  
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(1, $id);
  
    if ($stmt->execute()) {            
      $result = $stmt->fetch(PDO::FETCH_OBJ);

      if (!isset($filme)) 
        $filme = new stdClass();
      $filme->titulo = $result->titulo;
      $filme->sinopse = $result->sinopse;
      $filme->imagem = $result->imagem;
      $filme->video = $result->video;

    } else {
      throw new PDOException("Erro: Não foi possível executar a declaração sql");
    }
  } catch (PDOException $error) {
    echo "Erro: ".$error->getMessage();
  }
  
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $filme->titulo = (isset($_POST["titulo"]) && $_POST["titulo"] != null) ? $_POST["titulo"] : "";
    $filme->sinopse = (isset($_POST["sinopse"]) && $_POST["sinopse"] != null) ? $_POST["sinopse"] : "";
    $filme->imagem = (isset($_POST["imagem"]) && $_POST["imagem"] != null) ? $_POST["imagem"] : "";
    $filme->video = (isset($_POST["video"]) && $_POST["video"] != null) ? $_POST["video"] : "";
  }
  
  if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "edit") {

    if (!isset($errorMessages)) 
      $errorMessages = new stdClass();

    foreach($filme as $key => $value) {
      if($value == "") {
        $errorMessages->$key = "Você deve preencher este campo" ;
      }
    }

    if(count((array)$errorMessages) == 0) {
      try {
        $query = "UPDATE filmes SET titulo=?, sinopse=?, imagem=?, video=? WHERE id=?";

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(1, $filme->titulo);
        $stmt->bindParam(2, $filme->sinopse);
        $stmt->bindParam(3, $filme->imagem);
        $stmt->bindParam(4, $filme->video);
        $stmt->bindParam(5, $id);

        if ($stmt->execute()) {
          if ($stmt->rowCount() > 0) {
            
            header('location:../listar.php');

          } else {
            $errorMessages->form = "Erro ao tentar efetuar a edição";
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
      <form action="?id=<?php echo $id ?>&act=edit" method="POST" class="form <?php if(isset($errorMessages->form)) { echo 'global-error'; } ?>">
        <h1 class="form-title">EDITAR</h1>
        <input class="form-input <?php if(isset($errorMessages->titulo)) { echo 'error'; } ?>" <?php if(isset($filme->titulo)) { echo "value=\"$filme->titulo\""; } ?> type="text" name="titulo" placeholder="Título" />
        <small class="form-error <?php if(isset($errorMessages->titulo)) { echo "show"; } ?>"> <?php if(isset($errorMessages->titulo)) { echo $errorMessages->titulo; } ?> </small>
        <input class="form-input <?php if(isset($errorMessages->sinopse)) { echo 'error'; } ?>" <?php if(isset($filme->sinopse)) { echo "value=\"$filme->sinopse\""; } ?> type="text" name="sinopse" placeholder="Sinopse" />
        <small class="form-error <?php if(isset($errorMessages->sinopse)) { echo "show"; } ?>"> <?php if(isset($errorMessages->sinopse)) { echo $errorMessages->sinopse; } ?> </small>
        <input class="form-input <?php if(isset($errorMessages->imagem)) { echo 'error'; } ?>" <?php if(isset($filme->imagem)) { echo "value=\"$filme->imagem\""; } ?> type="text" name="imagem" placeholder="Imagem (URL)" />
        <small class="form-error <?php if(isset($errorMessages->imagem)) { echo "show"; } ?>"> <?php if(isset($errorMessages->imagem)) { echo $errorMessages->imagem; } ?> </small>
        <input class="form-input <?php if(isset($errorMessages->video)) { echo 'error'; } ?>" <?php if(isset($filme->video)) { echo "value=\"$filme->video\""; } ?> type="text" name="video" placeholder="Vídeo (URL)" />
        <small class="form-error <?php if(isset($errorMessages->video)) { echo "show"; } ?>"> <?php if(isset($errorMessages->video)) { echo $errorMessages->video; } ?> </small>
        <button class="button edit" type="submit"> <i class="icon fa fa-edit" style="font-size: 1.05rem;"></i>Editar </button>
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
              background: #ecc94b;
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
              margin-right: .5rem;
            }
          
          .edit {
            background: #ecc94b;          
          }

            .edit:hover {
              background: #d69e2e;
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