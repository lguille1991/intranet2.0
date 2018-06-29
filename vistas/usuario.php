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
                          <th>Clave</th>
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
                          <th>Clave</th>
                          <th>Imagen</th>
                          <th>Habilitado/Deshabilitado</th>
                        </tfoot>
                      </table>    
                    </div>
                    <div class="panel-body" style="height: 400px;" id="formularioRegistros">
                      <form action="" name="formulario" id="formulario" method="POST">
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label>Nombre:</label>
                          <input type="hidden" name="txtidestado" id="txtidestado">
                          <input type="text" class="form-control" name="txtestado" id="txtestado" maxlength="50" placeholder="Nombre estado" required>
                          <br>
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