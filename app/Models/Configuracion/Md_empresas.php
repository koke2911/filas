<?php namespace App\Models\Configuracion;

use CodeIgniter\Model;

class Md_empresas extends Model {

  protected $table      = 'empresas';
  protected $primaryKey = 'id';

  protected $returnType = 'array';
  // protected $useSoftDeletes = true;

  protected $allowedFields = [
   'id',
   'rut',
   'dv',
   'id_usuario',
   'nombre',
   'id_comuna',
   'resto_direccion',
   'fono',
   'email',
   'calle',
   'numero',
   'activity',
   'website',
   'fecha'
  ];


  public function datatable_empresas($db) {
    $consulta = "SELECT 
							  empresas.id as id_empresa,
						    concat(empresas.rut, '-', empresas.dv) as rut_empresa,
						    empresas.nombre as nombre_empresas,
						    p.id_region,
						    c.id_provincia,
						    empresas.id_comuna,
                empresas.website,
                empresas.email,
                c.nombre as comuna,
						    empresas.calle,
						    empresas.numero,
						    empresas.resto_direccion,
						    u.usuario,
						    date_format(empresas.fecha, '%d-%m-%Y %H:%i:%s') as fecha,
						    empresas.fono
               
						from 
							empresas
							inner join usuarios u on u.id = empresas.id_usuario
						    inner join comunas c on c.id = empresas.id_comuna
						    inner join provincias p on p.id = c.id_provincia";

    $query = $db->query($consulta);
    $apr   = $query->getResultArray();

    foreach ($apr as $key) {
      $row = [
       "id_empresa"      => $key["id_empresa"],
       "rut_empresa"     => $key["rut_empresa"],
       "nombre_empresas" => $key["nombre_empresas"],
       "id_region"        => $key["id_region"],
       "id_provincia"   => $key["id_provincia"],
       "id_comuna"      => $key["id_comuna"],
       "comuna"        => $key["comuna"],
       "calle"          => $key["calle"],
       "numero"         => $key["numero"],
       "resto_direccion" => $key["resto_direccion"],
       "usuario"         => $key["usuario"],
       "fecha"          => $key["fecha"],
       "fono"          => $key["fono"],
       "website"       => $key["website"],
       "email"         => $key["email"]
       
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