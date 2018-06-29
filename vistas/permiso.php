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
                          <h1 class="box-title">Permisos <button name="btnAgregar" id="btnAgregar" class="btn btn-success" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoRegistros">
                      <table id="tblListado" class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                          <th>Código permiso</th> 
                          <th>Nombre permiso</th>   
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>
                          <th>Código permiso</th>
                          <th>Nombre permiso</th>  
                        </tfoot>
                      </table>    
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
<script src="scripts/permiso.js"></script>