<?php

namespace App\Controllers\Configuracion;

use App\ThirdParty\Touchef;
use App\Controllers\BaseController;
use App\Models\Configuracion\Md_empresas;
use App\Models\Configuracion\Md_empresas_traza;

class Ctrl_empresas extends BaseController {

  protected $apr;
  protected $empresa_traza;
  protected $sesión;
  protected $db;

  public function __construct() {
    $this->empresa       = new Md_empresas();
    $this->empresa_traza = new Md_empresas_traza();
    $this->sesión    = session();
    $this->db        = \Config\Database::connect();
  }

  public function validar_sesion() {
    if (!$this->sesión->has("id_usuario_ses")) {
      echo "La sesión expiró, actualice el sitio web con F5";
      exit();
    }
  }

  public function get_data_empresa($id) {
    $this->validar_sesion();

    $obtener_id = $this->empresa->select("*")
                              ->where("id",$id)
                              ->first();
       
    echo json_encode($obtener_id);


  }

  public function datatable_empresas() {
    $this->validar_sesion();

    echo $this->empresa->datatable_empresas($this->db);
  }

  public function guardar_empre() {
    $this->validar_sesion();
    define("CREAR", 1);
    define("MODIFICAR", 2);

    define("OK", 1);

    $fecha      = date("Y-m-d H:i:s");
    $id_usuario = $this->sesión->id_usuario_ses;

    $id_empresa       = $this->request->getPost("id_empresa");
    $rut_empresa      = $this->request->getPost("rut_empresa");
    $nombre_empresas  = $this->request->getPost("nombre_empresas");
    $id_comuna        = $this->request->getPost("id_comuna");
    $resto_direccion  = $this->request->getPost("resto_direccion");
    $fono            = $this->request->getPost("fono");
    $email           = $this->request->getPost("email");
    $calle           = $this->request->getPost("calle");
    $numero          = $this->request->getPost("numero");
    $activity        = $this->request->getPost('activity');
    $website         = $this->request->getPost('website');

    $rut_completo = explode("-", $rut_empresa);
    $rut          = $rut_completo[0];
    $dv           = $rut_completo[1];
    $datosEMPRE     = [
     "nombre"               => $nombre_empresas,
     "id_comuna"            => $id_comuna,
     "resto_direccion"      => $resto_direccion,
     "rut"                  => $rut,
     "dv"                   => $dv,
     "id_usuario"           => $id_usuario,
     "fecha"                => $fecha,
     "fono"                 => $fono,
     'email'                => $email,
     'activity'             => $activity,    
     'calle'                => $calle,
     'numero'               => $numero,
     'website'              => $website
     
    ];

    // print_r($datosEMPRE);

    if ($id_empresa != "") {
      $estado_traza   = MODIFICAR;
      $datosEMPRE["id"] = $id_empresa;
    } else {
      $estado_traza = CREAR;
    }

    if ($this->empresa->save($datosEMPRE)) {

      
      echo OK;

      if ($id_empresa == "") {
        $obtener_id = $this->empresa->select("max(id) as id_empresa")
                                ->first();
        $id_empresa     = $obtener_id["id_empresa"];
      }

      $this->guardar_traza($id_empresa, $estado_traza, "");
    } else {
      echo "Error al guardar los datos de la EMPRESA";
    }
  }

  public function guardar_traza($id_empresa, $estado, $observacion) {
    $this->validar_sesion();

    $fecha      = date("Y-m-d H:i:s");
    $id_usuario = $this->sesión->id_usuario_ses;

    $datosTraza = [
     "id_empresa"  => $id_empresa,
     "estado"      => $estado,
     "observacion" => $observacion,
     "id_usuario"  => $id_usuario,
     "fecha"       => $fecha
    ];

    if (!$this->empresa_traza->save($datosTraza)) {
      echo "Falló al guardar la traza";
    }
  }

  public function v_empresa_traza() {
    $this->validar_sesion();
    echo view("Configuracion/empresas_traza");
  }

  public function datatable_empresa_traza($id_apr) {
    $this->validar_sesion();
    echo $this->empresa_traza->datatable_empresa_traza($this->db, $id_apr);
  }

}