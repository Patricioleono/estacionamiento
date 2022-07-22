<?php

class PersonaModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('EstacionamientoLogModel');
    }

    public function conectarOdbc(){
        $odbc = "PHP_SAM";
        $user = "ssmsa";
        $pass = "sambops00";
        return odbc_pconnect($odbc,$user,$pass);
    }

    public function buscarxRut($rut)
    {
        $ret = "";
        //echo $rut;
        $conn = $this->conectarOdbc();
        $query = "SELECT FIRST 1 codigo, apellpat, apellmat, nombres FROM sabst030 WHERE rut=".$rut." AND estado = 1" ;;
        $result = odbc_exec($conn,$query);
        if($result)
        {
            if ($row = odbc_fetch_object($result)){
                $ret .= $row->nombres." ".$row->apellpat." ".$row->apellmat;
                $codigo = $row->codigo;

            }
        }
        
        return utf8_encode($ret);
    }

    public function buscarCargo($codigo)
    {
        $conn = $this->conectarOdbc();
        $query = "SELECT cargo FROM sabst035 WHERE persona=".$codigo;
        $cargo = array();
        $result = odbc_exec($conn,$query);
        while ($row = odbc_fetch_object($result))
        {
            array_push($cargo, $row->cargo);
        }

        return $cargo;
    }

    public function get_persona($id)
    {
        $this->db->get_where('persona',array('id'=>$id))->row_array();
    }

    public function get_all_persona()
    {
        $this->db->order_by('id');
        $this->db->select('*');
        $this->db->from('persona');
     
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_id($rut)
    {
        //$this->db->get_where('persona',array('rut'=>$rut))->row_array();
        $this->db->select('*');
        $this->db->from('persona');
        $this->db->where('rut', $rut);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function add_persona_modelo($data)
    {
        $query = $this->db->get_where('persona',array('rut'=>$data['rut']))->row_array();

        if($query['rut'] != $data['rut']){
            $insert = $this->db->insert('persona', $data);
            $ultimoId = $this->db->insert_id();       
        }else{
            $ultimoId = 'Persona ya existe'; 
        }
        
        return $ultimoId;
    }

    public function update_persona_modelo($data)
    {
        $update = $this->db->where('id', $data['id'])->update('persona', $data);
        return $data['id'];        
    }

    public function buscarPermiso()
    {
        $rut = $sesion = $this->session->cabrut;  
        $this->db->select(' permiso');
        $this->db->from  (' permisos ');
        $this->db->where (' rut', $rut); 
        $this->db->where (' estado',1); 
        
        $query = $this->db->get(); 
        //echo $this->db->last_query(); 

        if ($query->result() ){
            foreach ($query->result() as $row) {            
                $permiso = $row->permiso;  
            }
        }
        else
        {        
            $permiso = 0;
        } 

       return $permiso ;   

    }

    public function desactivar_solicitudes_persona($id,$fecha,$usumod)
    {
        $this->db->order_by('id');
        $this->db->select('*');
        $this->db->from('solicitud');
        $this->db->where('idpersona',$id);
        $this->db->where('estado !=', 9);

        $query = $this->db->get();

        foreach($query->result() as $row)
        {

            $this->db->order_by('id');
            $this->db->select('*');
            $this->db->from('solicitud');
            $this->db->where('correlativolistaespera >',$row->correlativolistaespera);
            $this->db->where('tipo',$row->tipo);

            $query2 = $this->db->get();

            if ($row->estado == 0){
                foreach($query2->result() as $row2)
                {
                    if($row2->correlativolistaespera > 0){
    
                        $maxid = $row2->correlativolistaespera;
                        $maxid--;
    
                        $data2 = array(
                            'correlativolistaespera' => $maxid
                        );
                        
                        $update = $this->db->where('correlativolistaespera', $row2->correlativolistaespera)->where('tipo',$row->tipo)->update('solicitud', $data2);
                        
                    }
                }
            }
            
            $data = array(
                'estado'            => 9,
                'fechaanulacion'    => $fecha,
                'observacionanula'  => "Persona inactivada",
                'fechamod'          => $fecha,
                'usumod'            => $usumod
            );
            $update = $this->db->where('id', $row->id)->update('solicitud', $data);
            $data2 = array(
                'correlativolistaespera' => 0
            );
            $update = $this->db->where('id', $row->id)->update('solicitud', $data2);

            $data2 = array(
                'tipo'      => "Persona inactivada - Solicitud ANULADA",
                'fechamod'  => $fecha,
                'valormod'  => 'id='.$row->id.'|| id persona='.$id.'|| tipo='.$row->tipo.'|| estado=9 || observacion anula=Persona inactivada',
                'usumod'    => $usumod
            );
            $this->EstacionamientoLogModel->add_log_modelo($data2);

            $this->db->select('*');
            $this->db->from('vehiculo');
            $this->db->where('idsolicitud', $row->id);

            $vehiculo = $this->db->get();

            foreach($vehiculo->result() as $row3)
            {
                $data3 = array(
                    'estado'      => 0
                );
                $update = $this->db->where('id', $row3->id)->update('vehiculo', $data3);
            }
                
        }
    }

}