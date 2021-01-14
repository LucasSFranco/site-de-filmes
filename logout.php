<!DOCTYPE html>

<?php 

  if(session_status() == 1)
    session_start();


  if(!isset($_SESSION["user_id"])) {
    header('location:/site-de-filmes/filmes.php');
  }

  if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "logout") {

    session_start();
    $_SESSION["user_id"] = null;
    $_SESSION["class"] = null;

    header('location:./login.php');
    
  }

?>

<html>
  <?php include('./components/Head.php') ?> 
  <body>
    <?php include('./components/Navbar.php') ?> 
    <div class="wrapper">
      <form action="?act=logout" method="POST" class="form">
        <h1 class="form-title">SAIR</h1>
        <p class="form-text">Você tem certeza que deseja sair?</p>
        <button class="button" type="submit"> <i class="icon fa fa-sign-out"></i>Sair </button>
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
              background: #5a67d8; 
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