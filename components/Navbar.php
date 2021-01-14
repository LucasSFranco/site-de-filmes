<?php 

  if(session_status() == 1)
    session_start();

?>




<div class="navbar">
  <div class="navbar">
    <a class="brand"> SITE DE FILMES </a>
    <button class="nav-toggler"> <i class="fa fa-bars"></i> Menu </button>
    <div class="menu">
      <?php 

        if(isset($_SESSION["user_id"])) {
          if($_SESSION["acess"] == "admin") {
            echo '
              <a class="nav-link" href="/site-de-filmes/admin/filmes/listar.php">Filmes</a>
              <a class="nav-link" href="/site-de-filmes/admin/usuarios/listar.php">Usuários</a>
              <a class="nav-link" href="/site-de-filmes/logout.php">Sair</a>
            ';
          } else {
            echo '
              <a class="nav-link" href="/site-de-filmes/filmes.php">Filmes</a>
              <a class="nav-link" href="/site-de-filmes/perfil/perfil.php">Perfil</a>
              <a class="nav-link" href="/site-de-filmes/logout.php">Sair</a>
            ';
          }
        } else {
          echo '
          <a class="nav-link" href="/site-de-filmes/admin/login.php">Admin</a>
            <a class="nav-link" href="/site-de-filmes/filmes.php">Filmes</a>
            <a class="nav-link" href="/site-de-filmes/cadastro.php">Cadastrar</a>
            <a class="nav-link" href="/site-de-filmes/login.php">Entrar</a>
          ';
        }
      
      ?>
    </div>
  </div>
  <script>    
    let menu = document.querySelector('.menu');
    let navToggler = document.querySelector('.nav-toggler');

    navToggler.addEventListener('click', () => {
      menu.classList.toggle('show');
    });
  </script>
  <style>

    .navbar {
      width: 100%;
      background: #5a67d8;
      display: flex;
      vertical-align: center;
      justify-content: space-between;
      flex-wrap: wrap;
    }

      .brand {
        line-height: 4rem;
        vertical-align: center;
        color: white;
        font-size: 1.5rem;
        margin-left: 1.5rem;
        user-select: none;
      }

      .nav-toggler {
        background: none;
        border: none;
        font-size: 1rem;
        color: white;
        padding: 1rem 0;
        margin-right: 1.5rem;
        cursor: pointer;
        outline: none;
      }

        @media (min-width: 640px){
          .nav-toggler {
            display: none;
          }
        }

        .nav-toggler:hover {
          color: #c3dafe;
        }

      .menu {
        width: 100%;
        border-top: 1px solid white;
        display: none;
        background: #7f9cf5;
      }

        @media (min-width: 640px){
          .menu {
            width: auto;
            display: flex;
            background: none;
            border: none;
          }
        }

        .nav-link {
          display: block;
          width: 100%;
          padding: .5rem 1.5rem;
          color: white;
          font-size: 1rem;
          cursor: pointer;
          text-decoration: none;
        }

          @media (min-width: 640px){
            .nav-link {
              width: auto;
              display: flex;
              align-items: center;
              font-size: .875rem;
            }
          }

          .nav-link:hover {
            background: #5a67d8;
            color: #c3dafe;
          }

      .show {
        display: block;
      }

        @media (min-width: 640px){
          .show {
            display: flex;
          }
        }

  </style>
</div>