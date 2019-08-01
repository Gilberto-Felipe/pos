
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

          <form role="form" method="post" class="formularioVenta">

            <div class="box-body">
              
              <div class="box">

                <!--=====================================
                ENTRADA DEL VENDEDOR
                ======================================-->
                
                <div class="form-group">
                  
                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                    <input type="text" class="form-control" id="nuevoVendedor" value="<?php echo $_SESSION["nombre"]; ?>" readonly>

                    <input type="hidden" name="idVendedor" value="<?php echo $_SESSION["id"]; ?>">

                  </div>

                </div>

                <!--=====================================
                ENTRADA DEL CÓDIGO
                ======================================--> 

                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>

                    <?php

                      $item = null;
                      $valor = null;

                      $ventas = ControladorVentas::ctrMostrarVentas($item, $valor);

                      if(!$ventas){

                        echo '<input type="text" class="form-control" id="nuevaVenta" name="nuevaVenta" value="10001" readonly>';
                    

                      }else{

                        foreach ($ventas as $key => $value) {
                          
                          
                        
                        }

                        $codigo = $value["codigo"] + 1;



                        echo '<input type="text" class="form-control" id="nuevaVenta" name="nuevaVenta" value="'.$codigo.'" readonly>';                    
                      }

                    ?>
                    
                  </div><!--.input-group-->
                
                </div><!--.form-group-->

                <!--=====================================
                ENTRADA DEL CLIENTE
                ======================================--> 

                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>

                    <select class="form-control select2-single" name="seleccionarCliente" id="seleccionarCliente" required>
                      
                      <option value="">Seleccionar cliente</option>

                      <?php

                        $item = null;
                        $valor = null;

                        $categorias = ControladorClientes::ctrMostrarClientes($item, $valor);

                         foreach ($categorias as $key => $value) {

                           echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';

                         }

                    ?>

                    </select>

                    <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalAgregarCliente" data-dismiss="modal">Agregar cliente</button></span>
                    
                  </div><!--.input-group-->
                
                </div><!--.form-group-->

               <!--=====================================
               ENTRADA AGREGAR PRODUCTO
               ======================================-->  

               <div class="form-group row nuevoProducto">



               </div>

              <!--=====================================
              BOTÓN AGREGAR PRODUCTO
              ======================================-->  

               <button type="button" class="btn btn-default hidden-lg btnAgregarProducto">Agregar producto</button>

               <hr>

               <!--=====================================
               ENTRADA IMPUESTOS Y TOTAL
               ======================================-->

               <div class="row">
                 
                <div class="col-xs-8 pull-right">
                  
                  <table class="table">
                    
                    <thead>
                      
                      <tr>
                        
                        <th>Impuesto</th>
                        <th>Total</th>

                      </tr>

                    </thead>

                    <tbody>
                      
                      <tr>
                        
                        <td style="width: 50%">

                          <div class="input-group">
                          
                            <input type="number" class="form-control input-lg" min="0" id="nuevoImpuestoVenta" name="nuevoImpuestoVenta" placeholder="0" required>

                            <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                          </div>

                        </td>

                        <td style="width: 50%">
                          
                          <div class="input-group">

                            <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                            
                            <input type="number" min="1" class="form-control input-lg" id="nuevoTotalVenta" name="nuevoTotalVenta" placeholder="00000" readonly required>

                          </div>

                        </td>

                      </tr>

                    </tbody>

                  </table>

                </div>

               </div>

               <hr>

              <!--=====================================
              ENTRADA MÉTODO DE PAGO
              ======================================-->
              
               <div class="form-group row">

                <div class="col-xs-6" style="padding-right: 0px">
                  
                  <div class="input-group">
                    
                    <select class="form-control" id="nuevoMetodoPago" name="nuevoMetodoPago" required>
                      <option value="">Seleccione método de pago</option>
                      <option value="Efectivo">Efectivo</option>
                      <option value="TC">Tarjeta crédito</option>
                      <option value="TD">Tarjeta débito</option>                  
                    </select>

                  </div>

                </div>

                <div class="col-xs-6" style="padding-left: 0px">
                  
                  <div class="input-group">
                    
                    <input type="text" class="form-control" id="nuevoCodigoTransaccion" name="nuevoCodigoTransaccion" placeholder="Código transacción" required>
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>

                  </div>

                </div>   

               </div>

               <br>

              </div>

            </div>

          <div class="box-footer">

            <button type="submit" class="btn btn-primary pull-right">Guardar venta</button>

          </div>

          </form>

        </div>

      </div>

        <!--=====================================
        TABLA DE PRODUCTOS
        ======================================-->
        
      <div class="col-lg-7 hidden-md hidden-sm hidden-xs">

        <div class="box box-warning">
          
          <div class="box-header with-border">
            
            <div class="box-body">
              
              <table class="table table-bordered table-striped dt-responsive tablaVentas" width="100%">
                
                <thead>
                  
                  <tr>
                    
                    <th style="width: 10px">#</th>
                    <th>Imagen</th>
                    <th>Código</th>
                    <th>Descripción</th>
                    <th>Stock</th>
                    <th>Acciones</th>

                  </tr>

                </thead>



              </table>

            </div>

          </div>

        </div>
        
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


