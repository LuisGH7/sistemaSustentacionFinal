<?php
    require_once 'datatable.php';
    require_once 'acceso-seguro.php';
?>

<style>
    .asignar{
        display: none;
    }
</style>

<div class="row">
    <div class="col-md-4">
        <div class=" card card-outline card-info">
            <div class="card-header">
                <p class="card-title mt-1" style="font-size: 22px" id="Aviso">Registro de Usuario</p>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="" id="formularioUsuario">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="idpersona">Seleccione una persona</label>
                                <select id="idpersona" class="form-control form-control-border">
                                </select>
                                <!-- disabled style="display: none;" -->
                                <input type="text" id="idusuariomod" class="form-control form-control-border asignar" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-3">
                                <label for="nombreusuario">Nombre de usuario</label>
                                <input id="nombreusuario" class="form-control form-control-border">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-3 mb-3">
                                <label for="idarea">Seleccione un área</label>
                                <select id="idarea" class="form-control form-control-border">
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-3 mb-3">
                                <label for="idespecialidad">Seleccione una especialidad</label>
                                <select id="idespecialidad" class="form-control form-control-border">
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-3">
                                <label for="codigoespecialista">Código de Especialista</label>
                                <input id="codigoespecialista" class="form-control form-control-border">
                            </div>
                        </div>
                    </div>
                    <p>Nota: La contraseña por defecto será 123456</p>
                </form>
            </div>
            <!-- /.card-body -->
            <div class="card-footer text-right bg-white">
                <button type="reset" class="btn bg-gradient-secondary " id="cancelar">Cancelar</button>
                <button type="button" class="btn bg-gradient-info" id="registrar">Guardar</button>
                <button type="button" class="btn bg-gradient-info asignar" id="actualizar">Actualizar</button>
            </div>
            <!-- /.card-footer -->
        </div>
        <div class="card card-outline card-info">
            <div class="card-body text-center">
                <p>Si la persona no se encuentra registrada de clic al siguiente botón.</p>
                <a href="main.php?view=personasregistro" >
                    <button style=" font-size: 18px;" type="button" class="btn btn-sm bg-gradient-info float-center"><i class="fas fa-user-check"></i> &nbsp;Registra una persona</button>
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div  class=" card card-outline card-info">
            <div class="card-header">
                <p class="card-title" style="font-size: 22px">Lista de Usuarios</p>
            </div>
            <div class="card-body table-responsive">
                <table class="table" id="tablaUsuario">
                    <thead>
                        <tr>
                            <th class="text-center">N°</th>
                            <th class="text-center">Apellidos</th>
                            <th class="text-center">Nombres</th>
                            <th class="text-center">Nombres de usuario</th>
                            <th class="text-center">Nivel de usuario</th>
                            <th class="text-center">Operaciones</th>
                        </tr>
                    </thead>
                    <tbody class="table" id="datosUsuario">
                        <!-- Se carga de manera dinamica -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<br>

<script src="js/usuarios.js"></script>

