<?php

  if(session_status() == 1)
    session_start();

  if(isset($_SESSION["user_id"]) && $_SESSION["acess"] == 'admin') {
    header('location:/site-de-filmes/login.php');
  }

  try {
    $pdo = new PDO("mysql:host=localhost; dbname=localdb", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("set names utf8");
  } catch (PDOException $error) {
    echo "Erro na conexão:" . $error->getMessage();
  }

?>

<html>
  <?php include('../components/Head.php') ?> 
  <body>
    <?php include('../components/Navbar.php') ?> 

    <div class="container">
      <h1 class="section-title"> FILMES </h1>
      <div class="section">

        <?php
          try {
            $id = (isset($_GET["id"]) && $_GET["id"] != null) ? $_GET["id"] : "";

            $query = "SELECT * FROM filmes WHERE id=?";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(1, $id);

            if ($stmt->execute()) {            
              while ($result = $stmt->fetch(PDO::FETCH_OBJ)) {
                echo '
                  <div class="card">
                    <div class="image-wrapper">
                      <img src="'.$result->imagem.'" class="image"></img>
                    </div>
                    <div class="card-text">
                      <h3 class="card-title">'.$result->titulo.'</h3>
                      <p class="card-description">
                        '.$result->sinopse.'
                      </p>
                    </div>
                  </div>    
                  <div class="card video-wrapper">
                    <video class="video" width="100%" height="100%" controls>
                    <source src="'.$result->video.'" type="video/mp4">
                    Your browser does not support the video tag.
                    </video>
                  </div>
                                
                ';
              }
            } else {
              throw new PDOException("Erro: Não foi possível executar a declaração sql");
            }
          } catch (PDOException $error) {
            echo "Erro: ".$error->getMessage();
          }
        ?>
      </div>    
    </div>    
    <style>

      .container {
        padding: 5rem 1.5rem;
      }
        
        @media (min-width: 640px){
          .container {
            padding: 5rem;
          }
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

        .section {
          display: grid;
          grid-gap: 1.5rem;
          grid-template-columns: repeat(1, minmax(0, 1fr));
        }

        .card {
          height: 209px;
          display: flex;
          box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
          background: white;
        }
        
          .image-wrapper {
              position: relative;          
          }

            .image {  
              height: 100%;
            }

          .card-text {
            padding: 1rem;
          }

            .card-title {
              font-weight: 500;
              margin-bottom: .5rem;
              color: #222222;
            }

            .card-description {
              color: #777777;
            } 

        .video-wrapper {
          height: auto;
        }

          .video {
            outline: none;
          }


    </style>
  </body>
</html>