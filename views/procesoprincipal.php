
<link href="https://cdn.jsdelivr.net/npm/smartwizard@6/dist/css/smart_wizard_all.min.css" rel="stylesheet" type="text/css" />
<!-- SmartWizard html -->

<?php
  require_once 'SmartWizard.php';
?>
<div id="smartwizard">
    <ul class="nav">
        <li class="nav-item">
          <a class="nav-link" href="#step-1">
            <div class="num">1</div>
            Registro de Pacientes
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link default done" href="#step-2">
            <span class="num">2</span>
            Crear Atención
          </a>
        </li>
    </ul>
 
    <div class="tab-content">
        <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1">
          <?php require_once "pacientesregistro.php"?>
        </div>
        <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2">
          <?php require_once "historia-buscar.php"?>
        </div>
    </div>
 
    <!-- Include optional progressbar HTML -->
    <div class="progress">
      <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
</div>  
<!-- JavaScript -->
<script src="js/home.js"></script>
