
<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Crear venta

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Crear venta</li>

    </ol>

  </section>

  <section class="content">

    <div class="row">

      <!--=====================================
      EL FORMULARIO
      ======================================-->
      
      <div class="col-xs-12 col-lg-5">

        <div class="box box-success">
          
          <div class="box-header with-border"></div>

          <div class="box-body">
            
            <form role="form" method="post">
              
              <div class="box">

                <!--=====================================
                ENTRADA DEL VENDEDOR
                ======================================-->
                
                <div class="form-group">
                  
                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                    <input type="text" class="form-control" id="nuevoVendedor" value="Usuario administrador" readonly>

                  </div>

                </div>

                <!--=====================================
                ENTRADA DEL CÓDIGO
                ======================================--> 

                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>

                    <input type="text" class="form-control" id="nuevaVenta" name="nuevaVenta" value="10002343" readonly>
                    
                  </div><!--.input-group-->
                
                </div><!--.form-group-->

                <!--=====================================
                ENTRADA DEL CLIENTE
                ======================================--> 

                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>

                    <select class="form-control" name="seleccionarCliente" id="seleccionarCliente" required>
                      
                      <option value="">Seleccionar cliente</option>

                    </select>

                    <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalAgregarCliente" data-dismiss="modal">Agregar cliente</button></span>
                    
                  </div><!--.input-group-->
                
                </div><!--.form-group-->

               <!--=====================================
               ENTRADA AGREGAR PRODUCTO
               ======================================-->  

               <div class="form-group row nuevoProducto">

                <!-- Descripción del producto -->
                 
                <div class="col-xs-6" style="padding-right: 0px">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button></span>

                    <input type="text" class="form-control" name="agregarProducto" id="agregarProducto" placeholder="Descripción del producto" required>

                  </div>

                </div>

                <!-- Cantidad del producto -->

                <div class="col-xs-3">
                  
                  <input type="number" class="form-control" id="nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" placeholder="0" required>

                </div>

                <!-- Precio del producto -->

                <div class="col-xs-3" style="padding-left: 0px">

                  <div class="input-group">
                    
                    <input type="number" min="1" class="form-control" id="nuevoPrecioProducto" name="nuevoPrecioProducto" placeholder="000000" readonly required>

                    <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                  </div>

                </div>

               </div>

              <!--=====================================
              BOTÓN AGREGAR PRODUCTO
              ======================================-->  

               <button type="button" class="btn btn-default hidden-lg">Agregar producto</button>

               <hr>

               <div class="row">
                 
                

               </div>


              </div>


            </form>

          </div>

        </div>

      </div>

        <!--=====================================
        TABLA DE PRODUCTOS
        ======================================-->
        
      <div class="col-lg-7 hidden-md hidden-sm hidden-xs">

        <div class="box box-warning"></div>
        
      </div>
        



    </div>

  </section><!-- /.content -->

</div><!-- /.content-wrapper -->


<!--=====================================
MODAL AGREGAR CLIENTE
======================================-->

<div id="modalAgregarCliente" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar cliente</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoCliente" placeholder="Ingresar nombre" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL DOCUMENTO ID -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="numnber" min="0" class="form-control input-lg" id="nuevoDocumentoId" name="nuevoDocumentoId" placeholder="Ingresar documento id" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL EMAIL -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 

                <input type="email" class="form-control input-lg" name="nuevoEmail" placeholder="Ingresar email" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL TELÉFONO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoTelefono" placeholder="Ingresar teléfono" data-inputmask="'mask':'(999) 999-9999'" data-mask required>

              </div>

            </div>

            <!-- ENTRADA PARA LA DIRECCIÓN -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaDireccion" placeholder="Ingresar dirección" required>

              </div>

            </div>

            <!-- ENTRADA PARA LA FECHA NACIMIENTO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaFechaNacimiento" placeholder="Ingresar fecha de nacimiento" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask required>

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cliente</button>

        </div>

      </form>

      <?php 

            $crearCliente = new ControladorClientes();
            $crearCliente -> ctrCrearCliente();

      ?>

    </div>

  </div>

</div>


