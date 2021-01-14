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
  } catch (PDOException $erro) {
    echo "Erro na conexão:" . $erro->getMessage();
  }

?>

<html>
  <?php include('../../components/Head.php') ?> 
  <body>
    <?php include('../../components/Navbar.php') ?> 
    <div class="container">
      <div class="table-header">
        <h1 class="section-title">FILMES</h1>
        <a href="./criar.php" class="icon-wrapper create"> <i class="icon fa fa-plus-square"></i><span class="icon-label">Criar</span></a>
      </div>
      <table class="table">
        <thead class="table-head">
          <tr class="table-row">
            <td class="table-cell"> Título
            <td class="table-cell"> Ações
        <tbody class="table-body">

          <?php
            try {
              $query = "SELECT * FROM filmes";
              $stmt = $pdo->prepare($query);
              if ($stmt->execute()) {            
                while ($result = $stmt->fetch(PDO::FETCH_OBJ)) {
                  echo '                    
                      <tr class="table-row">
                        <td class="table-cell">'.$result->titulo.'</td>
                        <td class="table-cell">
                          <a href="./editar.php/?id='.$result->id.'" class="icon-wrapper edit"><i class="icon fa fa-edit"></i><span class="icon-label">Editar</span></a>
                          <a href="./excluir.php/?id='.$result->id.'" class="icon-wrapper delete"><i class="icon fa fa-trash"></i><span class="icon-label">Excluir</span></a>
                        </td>
                      </tr>
                    ';
                }
              } else {
                throw new PDOException("Erro: Não foi possível executar a declaração sql");
              }
            } catch (PDOException $error) {
              echo "Erro: ".$error->getMessage();
            }
          ?>
        </tbody>
      </table>
    </div>
  </body>
  <style>

    .container {
      padding: 5rem 1.5rem;
    }
      
      @media (min-width: 640px){
        .container {
          padding: 5rem;
        }
      }

      .table-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
      }

        .section-title {
          margin-bottom: 1.5rem;
          position: relative;
          padding-bottom: .5rem;
          font-size: 2rem;
          font-weight: 500;
        }

          .section-title:after {
            content: '';
            background: #5a67d8; 
            width: 72px;
            height: 5px;
            position: absolute;
            bottom: 0;
            left: 0;
          }

          .create {
            color: #48bb78;
            margin-right: 1rem !important;
          }

            .create:hover {
              color: #2f855a;
            }

      .table {
        border: none;
        width: 100%;        
		    border-collapse: collapse;
      }

      .table-head .table-row {
        border-top: 2px solid #c3dafe;        
        border-bottom: 3px solid #c3dafe;
      }

        .table-head .table-cell {        
          font-weight: 500;
          font-size: 1.125rem;
          color: #222222;
        }

      .table-body .table-row {
        border-bottom: 2px solid #c3dafe;
      }

        .table-body .table-cell {
          font-weight: 400;
          text-align: start; 
          color: #777777;
        }

      .table-cell {
        padding: .5rem .75rem;
      }

        .table-cell:last-child {
          width: 1%;
          white-space: nowrap;
          text-align: end;
        }

          @media (min-width: 640px) {
            .table-cell:last-child {
              text-align: start;
            }
          }

        .edit {
          color: #ecc94b;          
          margin-right: 1rem;
        }

          .edit:hover {
            color: #d69e2e;
          }

          .edit .icon {            
            transform: translateY(2px);
          }

        .delete {
          color: #e53e3e;
        }

          .delete:hover {
            color: #9b2c2c;
          }

    .icon-wrapper {
      cursor: pointer;
      text-decoration: none;
    }
        
      .icon {
        font-size: 1.5rem;
      }

        @media (min-width: 640px){
          .icon {
            margin-right: .5rem;
          }
        }

      .icon-label {
        display: none;
      }

        @media (min-width: 640px){
          .icon-label {
            display: inline-block;
          }
        }

  </style>

</html>