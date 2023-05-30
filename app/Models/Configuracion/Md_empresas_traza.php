<?php namespace App\Models\Configuracion;

use CodeIgniter\Model;

class Md_empresas_traza extends Model {

  protected $table      = 'empresas_traza';
  protected $primaryKey = 'id';

  protected $returnType = 'array';
  // protected $useSoftDeletes = true;

  protected $allowedFields = [
   'id',
   'id_empresa',
   'estado',
   'observacion',
   'id_usuario',
   'fecha'
  ];

  public function datatable_empresa_traza($db, $id_empresa) {
    $consulta = "SELECT 
							ate.glosa as estado,
						    ifnull(at.observacion, 'No registrado') as observacion,
						    u.usuario,
						    date_format(at.fecha, '%d-%m-%Y %H:%i:%s') as fecha
						from 
							empresas_traza at
						    inner join usuarios u on u.id = at.id_usuario
						    inner join empresa_traza_estados ate on ate.id = at.estado
						where 
							at.id_empresa = $id_empresa";

    $query     = $db->query($consulta, [$id_empresa]);
    $empresa_traza = $query->getResultArray();

    foreach ($empresa_traza as $key) {
      $row = [
       "estado"      => $key["estado"],
       "observacion" => $key["observacion"],
       "usuario"     => $key["usuario"],
       "fecha"       => $key["fecha"]
      ];

      $data[] = $row;
    }

    if (isset($data)) {
      $salida = ["data" => $data];

      return json_encode($salida);
    } else {
      return "{ \"data\": [] }";
    }
  }
}

?>