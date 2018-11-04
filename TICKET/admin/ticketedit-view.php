<?php
	if(isset($_POST['id_edit']) && isset($_POST['solucion_ticket']) && isset($_POST['estado_ticket'])){
		$id_edit=MysqlQuery::RequestPost('id_edit');
		$estado_edit=  MysqlQuery::RequestPost('estado_ticket');
		$solucion_edit=  MysqlQuery::RequestPost('solucion_ticket');
		$radio_email=  MysqlQuery::RequestPost('optionsRadios');

		$cabecera="From: LinuxStore El Salvador<linuxstore@hifenix.com>";
		$mensaje_mail="Estimado usuario la solución a su problema es la siguiente : ".$solucion_edit;
		$mensaje_mail=wordwrap($mensaje_mail, 70, "\r\n");

		if(MysqlQuery::Actualizar("ticket", "estado_ticket='$estado_edit', solucion='$solucion_edit'", "id='$id_edit'")){

			echo '
                <div class="alert alert-info alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="text-center">TICKET Actualizado</h4>
                    <p class="text-center">
                        El ticket fue actualizado con exito
                    </p>
                </div>
            ';
			if($radio_email=="option2"){
				mail($email_edit, $asunto_edit, $mensaje_mail, $cabecera);
			}

		}else{
			echo '
                <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="text-center">OCURRIÓ UN ERROR</h4>
                    <p class="text-center">
                        No hemos podido actualizar el ticket
                    </p>
                </div>
            '; 
		}
	}     

	     
	$id = MysqlQuery::RequestGet('id');
	$sql = Mysql::consulta("SELECT * FROM ticket WHERE id= '$id'");
	$reg=mysqli_fetch_array($sql, MYSQLI_ASSOC);

?>


        <!--************************************ Page content******************************-->
        <div class="container">
          <div class="row">
            <div class="col-sm-3">
                <img src="./img/Edit.png" alt="Image" class="img-responsive animated tada">
            </div>
            <div class="col-sm-9">
                <a href="./admin.php?view=ticketadmin" class="btn btn-primary btn-sm pull-right"><i class="fa fa-reply"></i>&nbsp;&nbsp;Volver administrar Tickets</a>
            </div>
          </div>
        </div>
            
            
          <div class="container">
            <div class="col-sm-12">
                <form class="form-horizontal" role="form" action="" method="POST">
                		<input type="hidden" name="id_edit" value="<?php echo $reg['id']?>">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Fecha</label>
                            <div class='col-sm-10'>
                                <div class="input-group">
                                    <input class="form-control" readonly="" type="text" name="fecha_ticket" readonly="" value="<?php echo $reg['fecha']?>">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Serie</label>
                            <div class='col-sm-10'>
                                <div class="input-group">
                                    <input class="form-control" readonly="" type="text" name="serie_ticket" readonly="" value="<?php echo $reg['serie']?>">
                                    <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                </div>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Estado</label>
                            <div class='col-sm-10'>
                                <div class="input-group">
                                    <select class="form-control" name="estado_ticket">
                                        <option value="<?php echo $reg['estado_ticket']?>"><?php echo $reg['estado_ticket']?> (Actual)</option>
                                        <option value="Pendiente">Pendiente</option>
                                        <option value="En proceso">En proceso</option>
                                        <option value="Resuelto">Resuelto</option>
                                      </select>
                                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                          <label  class="col-sm-2 control-label">Nombre</label>
                          <div class="col-sm-10">
                              <div class='input-group'>
                                  <input type="text" readonly="" class="form-control"  name="name_ticket" readonly="" value="<?php echo $reg['nombre_usuario']?>">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                              </div>
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                          <div class="col-sm-10">
                              <div class='input-group'>
                                  <input type="email" readonly="" class="form-control"  name="email_ticket" readonly="" value="<?php echo $reg['email_cliente']?>">
                                <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                              </div> 
                          </div>
                        </div>

                        <div class="form-group">
                          <label  class="col-sm-2 control-label">Departamento</label>
                          <div class="col-sm-10">
                              <div class='input-group'>
                                  <input type="text" readonly="" class="form-control"  name="departamento_ticket" readonly="" value="<?php echo $reg['departamento']?>">
                                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                              </div> 
                          </div>
                        </div>

                        <div class="form-group">
                          <label  class="col-sm-2 control-label">Asunto</label>
                          <div class="col-sm-10">
                              <div class='input-group'>
                                  <input type="text" readonly="" class="form-control"  name="asunto_ticket" readonly="" value="<?php echo $reg['asunto']?>">
                                <span class="input-group-addon"><i class="fa fa-paperclip"></i></span>
                              </div> 
                          </div>
                        </div>

                        <div class="form-group">
                          <label  class="col-sm-2 control-label">Mensaje</label>
                          <div class="col-sm-10">
                              <textarea class="form-control" readonly="" rows="3"  name="mensaje_ticket" readonly=""><?php echo $reg['mensaje']?></textarea>
                          </div>
                        </div>
                    
                        <div class="form-group">
                          <label  class="col-sm-2 control-label">Solución</label>
                          <div class="col-sm-10">
                            <textarea class="form-control" rows="3"  name="solucion_ticket" required=""><?php echo $reg['solucion']?></textarea>
                          </div>
                        </div>
                    
                        <div class="row">
                            <div class="col-sm-offset-5">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="optionsRadios" value="option1" checked>
                                        No enviar solución al email del usuario
                                    </label>
                                 </div>


                                <div class="radio">
                                    <label>
                                        <input type="radio" name="optionsRadios" value="option2">
                                         Enviar solución al email del usuario
                                    </label>
                                 </div>
                            </div>
                        </div>
                    
                    <br>
                    
                        <div class="form-group">
                          <div class="col-sm-offset-2 col-sm-10 text-center">
                              <button type="submit" class="btn btn-info">Actualizar ticket</button>
                          </div>
                        </div>

                      </form>
            </div><!--col-md-12-->
          </div><!--container-->