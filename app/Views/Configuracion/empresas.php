<main>
  <div class="container-fluid">
    <h3 class="mt-4" align="center">EMPRESAS</h3>
    <div class="alert alerta-fijo hidden" role="alert" id="alerta"></div>

    <div class="container-fluid">
      <br>
      <div class="card shadow mb-12">
        <div class="card-body">
          <div class="container-fluid">
            <center>
              <button type="button" name="btn_nuevo" id="btn_nuevo" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo</button>
              <button type="button" name="btn_modificar" id="btn_modificar" class="btn btn-primary"><i class="fas fa-edit"></i> Modificar</button>
              <button type="button" name="btn_aceptar" id="btn_aceptar" class="btn btn-success"><i class="fas fa-check"></i> Aceptar</button>
              <button type="button" name="btn_cancelar" id="btn_cancelar" class="btn btn-danger"><i class="fas fa-ban"></i> Cancelar</button>
             
            </center>
          </div>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
          <div class="card mb-4">
            <div class="card-header" data-toggle="collapse" data-target="#datosEMPRE" aria-expanded="false" aria-controls="datosEMPRE">
              <i class="fas fa-house-user mr-1"></i> Datos Empresa
            </div>
            <div class="card shadow mb-12 collapse" id="datosEMPRE">
              <div class="card-body">
                <div class="container-fluid">
                  <form id="form_EMPRE" name="form_EMPRE" encType="multipart/form-data">

                    <div class="row">
                      <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                        <div class="form-group">
                          <label class="small mb-1" for="txt_id_EMPRE">Identificador</label>
                          <input type="text" class="form-control" name="txt_id_EMPRE" id="txt_id_EMPRE"/>
                        </div>
                      </div>
                      <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                        <div class="form-group">
                          <label class="small mb-1" for="txt_rut_EMPRE">RUT Empresa</label>
                          <input type='text' class="form-control" id='txt_rut_EMPRE' name="txt_rut_EMPRE"/>
                        </div>
                      </div>
                      <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                        <div class="form-group">
                          <label class="small mb-1" for="txt_nombre_EMPRE">Nombre Empresa</label>
                          <input type='text' class="form-control" id='txt_nombre_EMPRE' name="txt_nombre_EMPRE"/>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                        <div class="form-group">
                          <label class="small mb-1" for="cmb_email">E-mail</label>
                          <input type='email' class="form-control" id='cmb_email' name="cmb_email"/>
                        </div>
                      </div>
                      
                      <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                        <div class="form-group">
                          <label class="small mb-1" for="txt_website">Sitio web</label>
                          <input type='text' class="form-control" id='txt_website' name="txt_website"/>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                        <div class="form-group">
                          <label class="small mb-1" for="cmb_calle">Calle</label>
                          <input type='text' class="form-control" id='cmb_calle' name="cmb_calle"/>
                        </div>
                      </div>
                      <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                        <div class="form-group">
                          <label class="small mb-1" for="cmb_numero">Número</label>
                          <input type='number' class="form-control" id='cmb_numero' name="cmb_numero"/>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                        <div class="form-group">
                          <label class="small mb-1" for="cmb_region">Región</label>
                          <select id="cmb_region" name="cmb_region" class="form-control"></select>
                        </div>
                      </div>
                      <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                        <div class="form-group">
                          <label class="small mb-1" for="cmb_provincia">Provincia</label>
                          <select id="cmb_provincia" name="cmb_provincia" class="form-control"></select>
                        </div>
                      </div>
                      <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                        <div class="form-group">
                          <label class="small mb-1" for="cmb_comuna">Comuna</label>
                          <select id="cmb_comuna" name="cmb_comuna" class="form-control"></select>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                        <div class="form-group">
                          <label class="small mb-1" for="cmb_activity">Giro</label>
                          <input type='text' class="form-control" id='cmb_activity' name="cmb_activity"/>
                        </div>
                      </div>
                      
                    </div>

                    <div class="row">                      
                      <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                        <div class="form-group">
                          <label class="small mb-1" for="txt_fono">Fono</label>
                          <input type='text' class="form-control" id='txt_fono' name="txt_fono"/>
                        </div>
                      </div>
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                          <label class="small mb-1" for="txt_resto_direccion">Información</label>
                          <textarea class="form-control" id="txt_resto_direccion" name="txt_resto_direccion"></textarea>
                        </div>
                      </div>
                       
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
          <div class="card mb-4">
            <div class="card-header"><i class="fas fa-house-user mr-1"></i> Listado Empresas</div>
            <div class="card shadow mb-12">
              <div class="card-body">
                <div class="container-fluid">
                  <div class="table-responsive">
                    <table id="grid_empre" class="table table-bordered" width="100%">
                      <thead class="thead-dark">
                        <tr>
                          <th>id</th>
                          <th>RUT Empresa</th>
                          <th>Nombre Empresa</th>
                           <th>id_region</th>
                          <th>id_provincia</th>
                          <th>id_comuna</th>
                          <th>Comuna</th>
                          <th>Calle</th>
                          <th>Número</th>
                          <th>resto_direccion</th>
                          <th>Usuario Reg</th>
                          <th>Fecha</th>
                          <th>Traza</th>
                          <th>Fono</th>
                        </tr>
                      </thead>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div id="dlg_traza_empresa" class="modal fade" role="dialog">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Trazabilidad de la EMPRESA</h4>
            </div>
            <div class="modal-body">
              <div id="divContenedorTraza"></div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>
     

      
    </div>
  </div>
</main>
<script type="text/javascript" src="<?php echo base_url(); ?>/js/Configuracion/empresas.js"></script>