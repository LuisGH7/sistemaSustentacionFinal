<?php 
  session_start();
  
  if ($_SESSION['acceso'] == false){
    //Login
    header('Location:index.php');
  }
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <!-- <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png"> -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Clínica Famisalud
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> -->

  <!-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet"> -->
  <!-- CSS Files -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <!-- <link href="assets/demo/demo.css" rel="stylesheet" /> -->
  
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">

  <link rel="icon" href="images/favicon.png">

  <!-- Theme style -->
  <!-- <link rel="stylesheet" href="dist/css/adminlte.min.css"> -->
  
  <link rel="stylesheet" href="dist/css/user-account.css">
  <link rel="stylesheet" href="dist/css/switch-dark-mode.css">
  <link rel="stylesheet" href="dist/css/themes.css">
  <link rel="stylesheet" href="dist/css/preloader.css">
  <link rel="stylesheet" href="dist/css/loader.css">
  <link rel="stylesheet" href="views/switch.css">

  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <script src="https://cdn.tiny.cloud/1/4wqx4j9cpb6doqzr81ox1xrsx2e9fgddsqtvmdx1mwij8gr8/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
</head>

<body>
<style>

    body {
      background-color: #eff1f4 !important;
      color: #2c2c2c;
      font-size: 14px;
      font-family: "Montserrat", "Helvetica Neue", Arial, sans-serif;
      -moz-osx-font-smoothing: grayscale;
      -webkit-font-smoothing: antialiased;
    }

    .card-info.card-outline {
      border-top: 3px solid #0056B4;
    }
    .bg-gradient-info {
      background: #0056B4 !important;
      color: #ececec;
    }
    .btn-info {
      background: #0056B4 !important;
      color: #ececec;
    }
    
    .bg-gradient-info.btn:hover {
      background: #0056B4 !important;
      border-color: #0056B4;
      color: #ececec;
    }
    .bg-gradient-info.btn:not(:disabled):not(.disabled):active, .bg-gradient-info.btn:not(:disabled):not(.disabled).active, .bg-gradient-info.btn:active, .bg-gradient-info.btn.active {
      background: #0056B4  !important;
      border-color: #0056B4;
      color: #ececec;
    }
    /* paginacion del datatable */
    .page-item.active .page-link {
    background-color: #0056B4;
    border-color: #0056B4;
    }
    .page-link {
    color: #0056B4;
    }
    .control-sidebar-dark {
    background-color: #548cbe;
    color: #ffffff;
    }

    .main-panel {
    background-color: #eff1f4 !important;
    }

    .botones-card.btn:not(:disabled):not(.disabled):active, .botones-card.btn:not(:disabled):not(.disabled).active, .botones-card.btn:active, .botones-card.btn.active {
      background: #ffffff  !important;
      color: black !important;
    }

    .botones-card{
      background: #ffffff  !important;
      color: #3D3D3D !important;
      font-size: 17px;
    }

    .botones-card:hover{
      background: #ffffff  !important;
      color: #3D3D3D !important;
    }

    .w3-green, .w3-hover-green:hover {
      color: #b5b2b0!important;
      background-color: #ffffff!important;
    }

    .sidebar .nav i, .off-canvas-sidebar .nav i {
      font-size: 24px;
      float: left;
      margin-right: 12px;
      line-height: 30px;
      width: 34px;
      text-align: center;
      color: #66615B;
      opacity: 0.6;
      position: relative;
    }

    .w3-button:hover {
      background-color: #fff!important;
    }

    .listgraf:focus {
      outline: 0px dotted;
      outline: 0px auto -webkit-focus-ring-color;
    }

    .w3-card-4, .w3-hover-shadow:hover {
      box-shadow: 0 0px 0px 0 rgb(0 0 0 / 20%), 0 0px 0px 0 rgb(0 0 0 / 19%);
    }

    
    .btn, .navbar .navbar-nav > a.btn {
      margin: 0px 0px
    }

    fieldset{
      border: 0;
      padding: 0;
    }

  </style>
  <div class="wrapper ">
    <div class="sidebar" data-color="white" data-active-color="danger">
      <div class="logo">
        <a href="https://www.creative-tim.com" class="simple-text logo-mini">
          <div class="logo-image-small">
            <img src="./images/favicon.png">
          </div>
          <!-- <p>CT</p> -->
        </a>
        <a href="main.php?view=procesoprincipal" class="simple-text logo-normal">
          Clínica FamiSalud
          <!-- <div class="logo-image-big">
            <img src="../assets/img/logo-big.png">
          </div> -->
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <?php
            if($_SESSION['nombrerol'] == 'Admisión' || $_SESSION['nombrerol'] == 'Gerencia' || $_SESSION['nombrerol'] == 'Admisión General'){
              echo"
              <li class='nav-header pl-3'>Admisión</li>
                <li class=''>
                  <a href='main.php?view=procesoprincipal'>
                    <i class='nc-icon nc-bank'></i>
                    <p>Proceso Principal</p>
                  </a>
                </li>
                <li>
                  <a href='main.php?view=historia-buscar'>
                    <i  class='nc-icon nc-diamond'></i>
                    <p >Historias Clínicas</p>
                  </a>
                </li>
                <li>
                  <a href='main.php?view=personaslistar'>
                    <i class='nc-icon nc-pin-3'></i>
                    <p>Lista de personas</p>
                  </a>
                </li>
                <li>
                  <a href='main.php?view=pacientesbuscar'>
                    <i class='nc-icon nc-pin-3'></i>
                    <p>Buscar Paciente</p>
                  </a>
                </li>
                <li >
                  <a href='main.php?view=atencion'>
                    <i class='nc-icon nc-pin-3'></i>
                    <p>Generar Atención</p>
                  </a>
                </li>
                <li >
                  <a href='main.php?view=revisionmedica-listar'>
                    <i class='nc-icon nc-pin-3'></i>
                    <p>Pacientes Atendidos</p>
                  </a>
                </li>
                <li>
                  <a href='main.php?view=egresosproceso'>
                    <i class='nc-icon nc-pin-3'></i>
                    <p>Egresos</p>
                  </a>
                </li>
              ";
            }
          ?>

          <?php
            if($_SESSION['nombrerol'] == 'Triaje'){
              echo"
                <li class='nav-header pl-3' >Triaje</li>
              ";
            }
          ?>

          <?php
            if($_SESSION['nombrerol'] == 'Medicina'){
              echo"
                <li class='nav-header pl-3' >Medicina</li>
              ";
            }
          ?>

          <?php
            if($_SESSION['nombrerol'] == 'Gerencia'){
              echo"
              <hr>
                <li class='nav-header pl-3'> Triaje y Medicina</li>
              ";
            }
          ?>

          <?php
            if($_SESSION['nombrerol'] == 'Gerencia' || $_SESSION['nombrerol'] == 'Medicina' || $_SESSION['nombrerol'] == 'Triaje'){
              echo"
              
                <li>
                  <a  href='main.php?view=atencionxrealizar'>
                    <i class='fas fa-stethoscope nav-icon'></i>
                    <p >Realizar Atención</p>
                  </a>
                </li>
              ";
            }
          ?>
          <?php
            if($_SESSION['nombrerol'] == 'Gerencia'){
              echo "
              <hr>

              <li class='nav-header pl-3'>Gerencia</li>
              <li>
                <a href='main.php?view=usuariosadministrar'>
                <i class='fas fa-cog nav-icon'></i>
                  <p>Usuarios</p>
                </a>
              </li>

              <button class='w3-button w3-block w3-left-align listgraf' style='margin-left: -18px;' onclick='myAccFunc()'>
                <li>
                  <a href='#'>
                    <i class='nav-icon fas fa-angle-left'></i>
                    <p>Gráficos</p>
                  </a>
                </li>
              </button>

              <div id='demoAcc' class='w3-bar-block w3-hide w3-white w3-card-4'>
                <li class='nav-item'>
                  <a href='main.php?view=graficoAtencionesAnuales'>
                    <i class='nav-icon fas fa-chart-line'></i>
                    <p>Atenciones anuales</p>
                  </a>
                </li>
                <li class='nav-item'>
                  <a href='main.php?view=graficoEgresosAnuales'>
                    <i class='nav-icon fas fa-chart-line'></i>
                    <p>Egresos anuales</p>
                  </a>
                </li>
                <li class='nav-item'>
                  <a href='main.php?view=productividad-medicos'>
                    <i class='nav-icon fas fa-chart-line'></i>
                    <p>Productividad de médicos</p>
                  </a>
                </li>
              </div>              
              ";
            } 
          ?>

          <?php 
            if($_SESSION['nombrerol'] == 'Administrador' || $_SESSION['nombrerol'] == 'Gerencia'){
              echo "
              <hr>
                <li class='nav-header pl-3'>Administrador</li>
                <li class='nav-item'>
                  <a href='main.php?view=especialidadesprocesos'>
                    <i class='fas fa-save nav-icon'></i>
                    <p>Procesos de especialidades</p>
                  </a>
                </li>
                <li class='nav-item'>
                  <a href='main.php?view=arealista'>
                    <i class='fas fa-save nav-icon'></i>
                    <p>Áreas</p>
                  </a>
                </li>
                <li class='nav-item'>
                  <a href='main.php?view=especialidadeslista'>
                    <i class='fas fa-save nav-icon'></i>              
                    <p>Especialidades</p>
                  </a>
                </li>
                <li class='nav-item'>
                  <a href='main.php?view=preciosprocesos'>
                    <i class='fas fa-save nav-icon'></i>              
                    <p>Proceso de precios</p>
                  </a>
                </li>
                <li class='nav-item'>
                  <a href='main.php?view=epslista'>
                    <i class='fas fa-save nav-icon'></i>              
                    <p>EPS listado</p>
                  </a>
                </li>
                <li class='nav-item'>
                  <a href='main.php?view=esquemaprecioslista'>
                    <i class='fas fa-save nav-icon'></i>              
                    <p>Esquema de precios</p>
                  </a>
                </li>
                <li class='nav-item'>
                  <a href='main.php?view=precioslista'>
                  <i class='fas fa-save nav-icon'></i>
                    <p>Precios Listado</p>
                  </a>
                </li>
              ";
            }
          ?>

        </ul>
      </div>
      
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="javascript:;"><?= $_SESSION['nombrerol']?></a>
            <div id="reloj" style="font-size:20px;"></div>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="navbar-nav">
              <li class="nav-item btn-rotate dropdown">
                <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <?= $_SESSION['apellidos']?> <?= $_SESSION['nombres']?>
                  <p>
                    <span class="d-lg-none d-md-block">Some Actions</span>
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="main.php?view=usuariocambiarcontrasena">Cambiar Contraseña</a>
                  <a class="dropdown-item" href="controllers/Usuario.controller.php?op=cerrar-sesion">Cerrar Sesión</a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      
      <section class="content"> 
          <div class="container-fluid mb-5" id="content-data">
        <!-- Aqui se cargan los datos dinamicos -->        
          </div>
      </section>
      

      <footer class="footer"  style=" background-color:#eff1f4 !important; bottom: 0;  width: 100%;">
        <div class="container-fluid">
          <div class="row">
            <nav class="footer-nav">
              <ul>
                <li><a href="https://www.famisalud.com.pe/web/" target="_blank" id="activo"><i class="fas fa-globe-americas"></i> Página Web</a></li>
                <li><a href="https://www.facebook.com/Clinicafamisaludoficial/" target="_blank" id="activo"><i class="fab fa-facebook"></i> Facebook</a></li>
              </ul>
            </nav>
            <div class="credits ml-auto">
              <span class="copyright">
              Copyright © 2020
              </span>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
  

  <script src="assets/js/loadweb.js"></script>
    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.js"></script>
    <!-- Config theme -->
    <script src="./dist/js/config.js"></script>
  <!-- horarios -->
  <script src="./dist/js/moment/moment-with-locales.js"></script>
  <script src="./dist/js/moment/moment.js"></script>
  <!-- Bootstrap autocomplete -->
  <script src="https://cdn.jsdelivr.net/gh/xcash/bootstrap-autocomplete@v2.3.7/dist/latest/bootstrap-autocomplete.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/smartwizard@6/dist/js/jquery.smartWizard.min.js" type="text/javascript"></script>
  <script src="js/alertas.js"></script>
  <!-- Bootstrap -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.js"></script>
  <!-- SweetAlert2 -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.1/chart.min.js" integrity="sha512-ymysWHuTOgC1h8/MdSMcEyWmmjtfSh/7PYIDCZYIjW9sfS5Lfs5VBGbkPYZSM11L+JzJ3+id+gXDF4ImKcnxgA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script>
    $(document).ready(function (){
      var view = getParam("view");

      if (view != false){
        $("#content-data").load(`views/${view}.php`);}
      else{
        $("#content-data").load(`views/welcome.php`);
      }
    });

    function startTime(){
      today=new Date();
      h=today.getHours();
      m=today.getMinutes();
      s=today.getSeconds();
      m=checkTime(m);
      s=checkTime(s);
      document.getElementById('reloj').innerHTML=h+":"+m+":"+s;
      t=setTimeout('startTime()',500);
    }
    function checkTime(i){
      if (i<10) {i="0" + i;}return i;
    }
    window.onload=function(){
      startTime();
    }

    function myAccFunc() {
      var x = document.getElementById("demoAcc");
      if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
        x.previousElementSibling.className += " w3-green";
      } else { 
        x.className = x.className.replace(" w3-show", "");
        x.previousElementSibling.className = 
        x.previousElementSibling.className.replace(" w3-green", "");
      }
    }
  </script>

</body>

</html>
