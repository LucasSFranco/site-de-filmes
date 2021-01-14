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
  <?php include('./components/Head.php') ?> 
  <body>
    <?php include('./components/Navbar.php') ?> 

    <div class="container">
      <h1 class="section-title"> FILMES </h1>
      <div class="section">

        <?php
          try {
            $query = "SELECT * FROM filmes";
            $stmt = $pdo->prepare($query);
            if ($stmt->execute()) {            
              while ($result = $stmt->fetch(PDO::FETCH_OBJ)) {
                echo '
                  <div class="card">
                    <div class="image-wrapper">
                      <img src="'.$result->imagem.'" class="image"></img>
                      <div class="image-after">
                        <a href="./filmes/ver.php/?id='.$result->id.'"><i class="play fa fa-play-circle"></i></a>
                      </div>
                    </div>
                    <div class="card-text">
                      <h3 class="card-title">'.$result->titulo.'</h3>
                      <p class="card-description">
                        '.$result->sinopse.'
                      </p>
                    </div>
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

          @media (min-width: 1024px){
            .section {
              grid-template-columns: repeat(2, minmax(0, 1fr));
            }
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

            .image-after {
              opacity: 0;
              position: absolute;
              top: 0; bottom: 0; right: 0; left: 0;
              background: rgba(255,255,255,.75);
            }

              .image-after:hover {
                opacity: 1;
              }

              .play {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                font-size: 4rem;
                color: #5a67d8; 
                cursor: pointer;
              }

                .play:hover {
                  color: #434190;
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
    </style>
  </body>
</html>