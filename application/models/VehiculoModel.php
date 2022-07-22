<?php

class VehiculoModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_vehiculo($id)
    {
        $this->db->get_where('vehiculo',array('idpersona'=>$id))->row_array();
    }

    public function get_all_vehiculo()
    {
        $this->db->select('v.id, v.idpersona, v.idsolicitud, p.rut, v.tipo, v.marca, v.modelo, v.patente, v.estado, v.propietario, v.observacion');
        $this->db->from('vehiculo v');
        $this->db->join('persona p', 'v.idpersona = p.id');
     
        $query = $this->db->get();
        return $query->result_array();
    }

    public function add_vehiculo_modelo($data)
    {
        $insert = $this->db->insert('vehiculo', $data);
        $ultimoId = $this->db->insert_id();
        return $ultimoId;        
    }

    public function add_vehiculoS_modelo($autos,$idsolicitud,$idpersona,$tipo)
    {
        $ultimoId = 0;
        if (isset($autos)) 
        {              
            foreach($autos as $val)  {
                $marca          = $val['marca'];
                $modelo         = $val['modelo'];
                $patente        = $val['patente'];
                $propietario    = $val['propietario'];
                $observacion    = $val['observacion'];
                if($patente == null)
                {
                    $patente = "No aplica";
                }

                if($propietario == "Si")
                {
                    $propietario = 1;
                }else{
                    $propietario = 0;
                }

                $data = array(
                    'idsolicitud' => $idsolicitud,
                    'idpersona'   => $idpersona,
                    'tipo'        => $tipo,
                    'marca'       => strtoupper($marca),
                    'modelo'      => strtoupper($modelo),
                    'patente'     => strtoupper($patente),
                    'estado'      => 1,
                    'propietario' => $propietario,
                    'observacion' => $observacion
                );


                $insert = $this->db->insert('vehiculo', $data);
                $ultimoId = $this->db->last_query();
            }
        }
        return $ultimoId;
    }

    public function update_vehiculo_modelo($data)
    {
        $update = $this->db->where('id', $data['id'])->update('vehiculo', $data);
        return $data['id'];        
    }

    public function get_all_vehiculo_id($data)
    {
        $this->db->order_by('v.id');
        $this->db->select('v.id, v.idpersona, v.idsolicitud, v.tipo, p.rut, v.marca, v.modelo, v.patente');
        $this->db->from('vehiculo v');
        $this->db->join('persona p', 'p.id = v.idpersona');
        $this->db->where('v.idsolicitud', $data['id']);
        $this->db->where('v.tipo', $data['tipo']);
        $this->db->where('v.estado',1);
     
        $query = $this->db->get();
        return $query->result_array();
    }

}