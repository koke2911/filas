<main>
  <div class="container-fluid">
    <h3 class="mt-4" align="center"><i class="fas fa-chart-line mr-1"></i> Bienvenido <?php $sesión = session();
      echo $sesión->apr_ses; ?></h3>
    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
          <div class="card mb-4">
            <div class="card-header" aria-expanded="false">
              <i class="fas fa-chart-line mr-1"></i> Accesos Directos
            </div>
            <div class="card shadow mb-12">
              <div class="card-body">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-xl-3 col-md-6">
                      <div class="card bg-primary text-white mb-4">
                        <div class="card-body">Usuarios</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                          <a class="small text-white stretched-link" id="card_usuarios" href="#">Ver usuarios</a>
                          <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                      <div class="card bg-warning text-white mb-4">
                        <div class="card-body">Empresa</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                          <a class="small text-white stretched-link" id="card_empresa" href="#">Ver Empresa</a>
                          <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                      <div class="card bg-danger text-white mb-4">
                        <div class="card-body">Afecto a corte</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                          <a class="small text-white stretched-link" id="card_afecto_corte" href="#">Ver Detalles</a>
                          <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                      <div class="card bg-light text-dark mb-4">
                        <div class="card-body"><img src="<?php echo base_url(); ?>/imagenes/gestor_icon.png" width="100%"></div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                          <a class="small text-dark stretched-link" target="_blank" href="https://gestiondefilas.cl">Gestión de Filas</a>
                          <div class="small text-dark"><i class="fas fa-angle-right"></i></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
          <div class="card mb-4">
            <div class="card-header" aria-expanded="false">
              <i class="fas fa-chart-line mr-1"></i> Gráficos
            </div>
            <div class="card shadow mb-12">
              <div class="card-body">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-xl-6">
                      <div class="card mb-4">
                        <div class="card-header">
                          <i class="fas fa-chart-bar mr-1"></i>
                          Clientes
                        </div>
                        <div class="card-body">
                          <canvas id="graf_socios" width="100%" height="40"></canvas>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-6">
                      <div class="card mb-4">
                        <div class="card-header">
                          <i class="fas fa-chart-bar mr-1"></i>
                          % Espera
                        </div>
                        <div class="card-body">
                          <canvas id="graf_mensual" width="100%" height="40"></canvas>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<script type="text/javascript" src="<?php echo base_url(); ?>/js/dashboard.js"></script>