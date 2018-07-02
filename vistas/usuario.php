<?php
require 'header.php';
?>
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">Usuarios <button class="btn btn-success" name="btnAgregar" id="btnAgregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoRegistros">
                      <table id="tblListado" class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                          <th>Opciones</th>
                          <th>Nombre</th>
                          <th>DUI</th>
                          <th>NIT</th>
                          <th>Email</th>
                          <th>Login</th>
                          <th>Imagen</th>
                          <th>Habilitado/Deshabilitado</th>    
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>
                          <th>Opciones</th>
                          <th>Nombre</th>
                          <th>DUI</th>
                          <th>NIT</th>
                          <th>Email</th>
                          <th>Login</th>
                          <th>Imagen</th>
                          <th>Habilitado/Deshabilitado</th>
                        </tfoot>
                      </table>    
                    </div>
                    <div class="panel-body" style="height: 500px;" id="formularioRegistros">
                      <form action="" name="formulario" id="formulario" method="POST">
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label>Nombre:</label>
                          <input type="hidden" name="txtidusuario" id="txtidusuario">
                          <input type="text" class="form-control" name="txtnombre" id="txtnombre" maxlength="50" placeholder="Nombre empleado" required>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label>DUI:</label>
                          <input type="text" class="form-control" name="txtdui" id="txtdui" maxlength="11" placeholder="DUI" required>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label>NIT:</label>
                          <input type="text" class="form-control" name="txtnit" id="txtnit" maxlength="20" placeholder="NIT" required>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label>Email:</label>
                          <input type="email" class="form-control" name="txtemail" id="txtemail" maxlength="50" placeholder="Email" required>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label>Nombre de usuario (login):</label>
                          <input type="text" class="form-control" name="txtlogin" id="txtlogin" maxlength="50" placeholder="Nombre de usuario" required>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label>Contraseña:</label>
                          <input type="password" class="form-control" name="txtclave" id="txtclave" maxlength="64" placeholder="Contraseña" required>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label>Permisos:</label>
                          <ul style="list-style: none" id="permisos">
                          </ul>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label>Imagen de perfil:</label>
                          <input type="file" class="form-control" name="txtimagen" id="txtimagen">
                          <input type="hidden" class="form-control" name="imagenactual" id="imagenactual">
                          <img src="" width="150px" height="120px" id="imagenmuestra">
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <button type="submit" class="btn btn-primary" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                          <button type="button" class="btn btn-danger" onclick="cancelarform()"><i class="fa fa-arrow-circle-left"></i> Cancelar</button> 
                        </div>
                      </form>  
                    </div>
                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->
  <?php
require 'footer.php';
?>
<script src="scripts/usuario.js"></script>