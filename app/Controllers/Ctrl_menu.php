<?php

namespace App\Controllers;

use App\Models\Configuracion\Md_usuarios;
use App\Models\Configuracion\Md_usuario_traza;
use App\Models\Configuracion\Md_permisos_usuario;

class Ctrl_menu extends BaseController {

  protected $sesión;
  protected $permisos_usuario;
  protected $usuarios;
  protected $usuario_traza;
  protected $db;

  public function __construct() {
    $this->sesión           = session();
    $this->permisos_usuario = new Md_permisos_usuario();
    $this->usuarios         = new Md_usuarios();
    $this->usuario_traza    = new Md_usuario_traza();
    $this->db               = \Config\Database::connect();
  }

  public function permisos_usuario() {
    $this->validar_sesion();
    $id_usuario = $this->sesión->id_usuario_ses;

    echo $this->permisos_usuario->permisos_usuario($this->db, $id_usuario);
  }

  public function actualizar_clave() {
    $clave_actual = $this->request->getPost("clave_actual");
    $clave_nueva  = $this->request->getPost("clave_nueva");
    $repetir      = $this->request->getPost("repetir");
    $id_usuario   = $this->sesión->id_usuario_ses;

    $datosUsuario = $this->usuarios->where("id", $id_usuario)
                                   ->first();

    if (password_verify($clave_actual, $datosUsuario["clave"])) {
      define("ACTUALIZAR_CLAVE", 9);
      define("OK", 1);

      $fecha        = date("Y-m-d H:i:s");
      $clave_hash   = password_hash($repetir, PASSWORD_DEFAULT);
      $estado_traza = ACTUALIZAR_CLAVE;

      $datosUsuSave = [
       "id"         => $id_usuario,
       "clave"      => $clave_hash,
       "id_usuario" => $id_usuario,
       "fecha"      => $fecha
      ];

      if ($this->usuarios->save($datosUsuSave)) {
        echo OK;
        $this->guardar_traza($id_usuario, $estado_traza, "");
      } else {
        echo "Error al activar la clave";
      }
    } else {
      echo "Clave actual incorrecta";
    }
  }

  public function guardar_traza($id_usuario, $estado) {
    $fecha = date("Y-m-d H:i:s");

    $datosTraza = [
     "id_usuario"  => $id_usuario,
     "estado"      => $estado,
     "usuario_reg" => $id_usuario,
     "fecha"       => $fecha
    ];

    if (!$this->usuario_traza->save($datosTraza)) {
      echo "Falló al guardar la traza";
    }
  }

  public function usuarios() {
    $this->validar_sesion();
    echo view('Configuracion/usuarios');
  }

  public function empresas() {
    $this->validar_sesion();
    echo view('Configuracion/empresas');
  }

  public function validar_sesion() {
    if (!$this->sesión->has("id_usuario_ses")) {
      echo "La sesión expiró, actualice el sitio web con F5";
      exit();
    }
  }

  public function dashboard() {
    $this->validar_sesion();
    echo view('dashboard');
  }
}