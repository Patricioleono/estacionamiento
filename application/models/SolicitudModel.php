<?php

class SolicitudModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->db2 = $this->load->database('db2', TRUE);
    }

    public function get_solicitud($id)
    {
        $this->db->get_where('solicitud',array('id'=>$id))->row_array();
    }

    public function get_all_solicitud()
    {
        $this->db->order_by('id');
        $this->db->select('*');
        $this->db->from('solicitud');
     
        $query = $this->db->get();
        return $query->result_array();
    }

    
    public function get_all_servicios()
    {
        $this->db2->order_by('descripcion_cc');
        $this->db2->select(' ccosto_aba, descripcion_cc');
        $this->db2->from  (' cc_abasam');
        $this->db2->where (' estado',1); 
        
        $query = $this->db2->get(); 
        //echo $this->db2->last_query(); 

       return $query->result() ;     

    }

    public function get_all_solicitud_persona()
    {
        $this->db->select('s.id, s.idpersona, p.rut, s.tipo, s.fechasolicitud, s.estado, s.fechaautorizacion, s.fecharechazo, s.correlativolistaespera, s.idpersona, s.fechaanulacion, s.observaciones, s.motivorechazo, s.calidadjuridica, s.serviciounidad, s.jornadalaboral,s.fechacrea, s.usucrea, s.fechamod, s.usumod, s.observacionanula, s.observacionautoriza, s.tarjeta');
        $this->db->from('solicitud s');
        $this->db->join('persona p', 's.idpersona = p.id');
        $this->db->where('s.estado !=',9);
     
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_all_solicitud_persona_mantenedor()
    {
        $this->db->select('s.id, s.idpersona, p.rut, s.tipo, s.fechasolicitud, s.estado, s.fechaautorizacion, s.fecharechazo, s.correlativolistaespera, s.idpersona, s.fechaanulacion, s.observaciones, s.motivorechazo, s.calidadjuridica, s.serviciounidad, s.jornadalaboral,s.fechacrea, s.usucrea, s.fechamod, s.usumod, s.observacionanula, s.observacionautoriza, s.tarjeta');
        $this->db->from('solicitud s');
        $this->db->join('persona p', 's.idpersona = p.id');
        $this->db->where('s.estado',0);
     
        $query = $this->db->get();
        return $query->result_array();
    }
    //Pendientes
    public function get_all_solicitud_auto()
    {
        $this->db->select('s.id, p.rut, s.tipo, s.fechasolicitud, s.correlativolistaespera, s.observaciones');
        $this->db->from('solicitud s');
        $this->db->join('persona p', 's.idpersona = p.id');
        $this->db->where('s.tipo',1);
        $this->db->where('s.correlativolistaespera >',0);
     
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_all_solicitud_moto()
    {
        $this->db->select('s.id, p.rut, s.tipo, s.fechasolicitud, s.correlativolistaespera, s.observaciones');
        $this->db->from('solicitud s');
        $this->db->join('persona p', 's.idpersona = p.id');
        $this->db->where('s.tipo',2);
        $this->db->where('s.correlativolistaespera >',0);
     
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_all_solicitud_bicicleta()
    {
        $this->db->select('s.id, p.rut, s.tipo, s.fechasolicitud, s.correlativolistaespera, s.observaciones');
        $this->db->from('solicitud s');
        $this->db->join('persona p', 's.idpersona = p.id');
        $this->db->where('s.tipo',3);
        $this->db->where('s.correlativolistaespera >',0);
     
        $query = $this->db->get();
        return $query->result_array();
    }
    //Autorizados
    public function get_all_solicitud_auto2()
    {
        $this->db->select('s.id, p.rut, s.tipo, s.fechasolicitud,, s.fechaautorizacion, s.observaciones, s.observacionautoriza');
        $this->db->from('solicitud s');
        $this->db->join('persona p', 's.idpersona = p.id');
        $this->db->where('s.tipo',1);
        $this->db->where('s.estado',1);
     
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_all_solicitud_moto2()
    {
        $this->db->select('s.id, p.rut, s.tipo, s.fechasolicitud,, s.fechaautorizacion, s.observaciones, s.observacionautoriza');
        $this->db->from('solicitud s');
        $this->db->join('persona p', 's.idpersona = p.id');
        $this->db->where('s.tipo',2);
        $this->db->where('s.estado',1);
     
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_all_solicitud_bicicleta2()
    {
        $this->db->select('s.id, p.rut, s.tipo, s.fechasolicitud,, s.fechaautorizacion, s.observaciones, s.observacionautoriza');
        $this->db->from('solicitud s');
        $this->db->join('persona p', 's.idpersona = p.id');
        $this->db->where('s.tipo',3);
        $this->db->where('s.estado',1);
     
        $query = $this->db->get();
        return $query->result_array();
    }
    //Rechazo
    public function get_all_solicitud_auto3()
    {
        $this->db->select('s.id, p.rut, s.tipo, s.fechasolicitud,, s.fecharechazo, s.observaciones, s.motivorechazo');
        $this->db->from('solicitud s');
        $this->db->join('persona p', 's.idpersona = p.id');
        $this->db->where('s.tipo',1);
        $this->db->where('s.estado',2);
     
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_all_solicitud_moto3()
    {
        $this->db->select('s.id, p.rut, s.tipo, s.fechasolicitud,, s.fecharechazo, s.observaciones, s.motivorechazo');
        $this->db->from('solicitud s');
        $this->db->join('persona p', 's.idpersona = p.id');
        $this->db->where('s.tipo',2);
        $this->db->where('s.estado',2);
     
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_all_solicitud_bicicleta3()
    {
        $this->db->select('s.id, p.rut, s.tipo, s.fechasolicitud,, s.fecharechazo, s.observaciones, s.motivorechazo');
        $this->db->from('solicitud s');
        $this->db->join('persona p', 's.idpersona = p.id');
        $this->db->where('s.tipo',3);
        $this->db->where('s.estado',2);
     
        $query = $this->db->get();
        return $query->result_array();
    }

    //COUNT PENDIENTE
    public function get_all_autoP()
    {
        $this->db->where('tipo',1);
        $this->db->where('estado',0);
        $query = $this->db->get('solicitud');
        return $query->num_rows();
    }
    public function get_all_motoP()
    {
        $this->db->where('tipo',2);
        $this->db->where('estado',0);
        $query = $this->db->get('solicitud');
        return $query->num_rows();
    }
    public function get_all_biciP()
    {
        $this->db->where('tipo',3);
        $this->db->where('estado',0);
        $query = $this->db->get('solicitud');
        return $query->num_rows();
    }
    //COUNT AUTORIZADO
    public function get_all_autoA()
    {
        $this->db->where('tipo',1);
        $this->db->where('estado',1);
        $query = $this->db->get('solicitud');
        return $query->num_rows();
    }
    public function get_all_motoA()
    {
        $this->db->where('tipo',2);
        $this->db->where('estado',1);
        $query = $this->db->get('solicitud');
        return $query->num_rows();
    }
    public function get_all_biciA()
    {
        $this->db->where('tipo',3);
        $this->db->where('estado',1);
        $query = $this->db->get('solicitud');
        return $query->num_rows();
    }
    //COUNT RECHAZADO
    public function get_all_autoE()
    {
        $this->db->where('tipo',1);
        $this->db->where('estado',2);
        $query = $this->db->get('solicitud');
        return $query->num_rows();
    }
    public function get_all_motoE()
    {
        $this->db->where('tipo',2);
        $this->db->where('estado',2);
        $query = $this->db->get('solicitud');
        return $query->num_rows();
    }
    public function get_all_biciE()
    {
        $this->db->where('tipo',3);
        $this->db->where('estado',2);
        $query = $this->db->get('solicitud');
        return $query->num_rows();
    }

    //PARAMETROS AUTOS
    public function parametrosA()
    {
        $this->db->select('*');
        $this->db->limit(1);

        $query = $this->db->get('parametro');
        //echo $this->db->last_query();

        foreach($query->result() as $row)
        {
            $cupoauto = $row->cupoauto;
        }
        $cupoauto;

        return $cupoauto;
    }
    //PARAMETROS MOTOS
    public function parametrosM()
    {
        $this->db->select('*');
        $this->db->limit(1);

        $query = $this->db->get('parametro');
        //echo $this->db->last_query();

        foreach($query->result() as $row)
        {
            $cupomoto = $row->cupomoto;
        }
        $cupomoto;

        return $cupomoto;
    }
    //PARAMETROS BICI
    public function parametrosB()
    {
        $this->db->select('*');
        $this->db->limit(1);

        $query = $this->db->get('parametro');
        //echo $this->db->last_query();

        foreach($query->result() as $row)
        {
            $cupobici = $row->cupobici;
        }
        $cupobici;

        return $cupobici;
    }

    public function max_espera($tipo)
    {
        $this->db->select_max('correlativolistaespera');
        $this->db->where('tipo',$tipo);
        $query = $this->db->get('solicitud');
        //$query++;
        //echo $this->db->last_query();
        foreach($query->result() as $row)
        {
            $maxid = $row->correlativolistaespera;
        }
        $maxid++;

        return $maxid;        
    }

    public function add_solicitud_modelo($data)
    {
        $insert = $this->db->insert('solicitud', $data);
        $ultimoId = $this->db->insert_id();
        return $ultimoId;        
    }

    public function anular_solicitud_modelo($data)
    {

        $query = $this->db->get_where('solicitud',array('id'=>$data['id']))->row_array();
        

        if($query['estado'] == 0){

            $this->db->select('*');
            $this->db->from('solicitud');
            $this->db->where('correlativolistaespera >',$data['correlativolistaespera']);
            $this->db->where('tipo',$data['tipo']);

            $query2 = $this->db->get();

            foreach($query2->result() as $row)
            {
                if($row->correlativolistaespera > 0){

                    $maxid = $row->correlativolistaespera;
                    $maxid--;

                    $data2 = array(
                        'correlativolistaespera' => $maxid
                    );
                    
                    $update = $this->db->where('correlativolistaespera', $row->correlativolistaespera)->where('tipo',$data['tipo'])->update('solicitud', $data2);
            
                    
                }
            }
            $update = $this->db->where('id', $data['id'])->update('solicitud', $data);
            $data2 = array(
                'correlativolistaespera' => 0
            );
            $update = $this->db->where('id', $data['id'])->update('solicitud', $data2);

            $this->db->select('*');
            $this->db->from('vehiculo');
            $this->db->where('idsolicitud', $data['id']);

            $vehiculo = $this->db->get();

            foreach($vehiculo->result() as $row)
            {
                $data2 = array(
                    'estado'      => 0
                );
                $update = $this->db->where('id', $row->id)->update('vehiculo', $data2);
            }

            $ultimoId = "Solicitud Anulada";       
        }elseif($query['estado'] == 1){
            $update = $this->db->where('id', $data['id'])->update('solicitud', $data);

            $this->db->select('*');
            $this->db->from('vehiculo');
            $this->db->where('idsolicitud', $data['id']);

            $vehiculo = $this->db->get();

            foreach($vehiculo->result() as $row)
            {
                $data2 = array(
                    'estado'      => 0
                );
                $update = $this->db->where('id', $row->id)->update('vehiculo', $data2);
            }
            $ultimoId = "Se anulo una solicitud Autorizada";
        }elseif($query['estado'] == 2){
            $update = $this->db->where('id', $data['id'])->update('solicitud', $data);

            $this->db->select('*');
            $this->db->from('vehiculo');
            $this->db->where('idsolicitud', $data['id']);

            $vehiculo = $this->db->get();

            foreach($vehiculo->result() as $row)
            {
                $data2 = array(
                    'estado'      => 0
                );
                $update = $this->db->where('id', $row->id)->update('vehiculo', $data2);
            }
            $ultimoId = "Se anulo una solicitud Rechazada";
        }else{
            $ultimoId = "Solicitud ya esta Anulada"; 
        }

        return $ultimoId;        
    }

    public function autorizar_solicitud_modelo($data)
    {

        $query = $this->db->get_where('solicitud',array('id'=>$data['id']))->row_array();
        
        if($query['estado'] == 0){
            if($query['correlativolistaespera'] == 1){
                $this->db->order_by('id');
                $this->db->select('*');
                $this->db->from('solicitud');
                $this->db->where('correlativolistaespera >',$data['correlativolistaespera']);

                $query2 = $this->db->get();

                foreach($query2->result() as $row)
                {
                    if($row->correlativolistaespera > 0){

                        if($row->tipo == $query['tipo']){
                            $maxid = $row->correlativolistaespera;
                            $maxid--;

                            $data2 = array(
                                'correlativolistaespera' => $maxid
                            );
                            
                            $update = $this->db->where('correlativolistaespera', $row->correlativolistaespera)->where('tipo',$data['tipo'])->update('solicitud', $data2);
                        }
                        
                    }
                }
                $update = $this->db->where('id', $data['id'])->update('solicitud', $data);
                $data2 = array(
                    'correlativolistaespera' => 0
                );
                $update = $this->db->where('id', $data['id'])->update('solicitud', $data2);
                $ultimoId = "Solicitud Autorizada";  

            }else{
                $ultimoId = "Debe autorizar al primero de la lista"; 
            }
            
                 
        }elseif($query['estado'] == 9){
            $ultimoId = "Esta solicitud esta Anulada";
        }elseif($query['estado'] == 2){
            /*
            $update = $this->db->where('id', $data['id'])->update('solicitud', $data);

            $ultimoId = "Se autorizo una solicitud Rechazada";
            */
            $ultimoId = "Solicitud no puede actualizarse a este estado siendo 'Autorizada'"; 
        }else{
            $ultimoId = "Solicitud ya esta Autorizada"; 
        }

        
        return $ultimoId;        
    }

    public function rechazo_solicitud_modelo($data)
    {
        
        $query = $this->db->get_where('solicitud',array('id'=>$data['id']))->row_array();
        
        if($query['estado'] == 0){
            
            $this->db->order_by('id');
            $this->db->select('*');
            $this->db->from('solicitud');
            $this->db->where('correlativolistaespera >',$data['correlativolistaespera']);

            $query2 = $this->db->get();

            foreach($query2->result() as $row)
            {
                if($row->correlativolistaespera > 0){

                    if($row->tipo == $query['tipo']){
                        $maxid = $row->correlativolistaespera;
                        $maxid--;

                        $data2 = array(
                            'correlativolistaespera' => $maxid
                        );
                        
                        $update = $this->db->where('correlativolistaespera', $row->correlativolistaespera)->where('tipo',$data['tipo'])->update('solicitud', $data2);
                    }
                    
                }
            }
            $update = $this->db->where('id', $data['id'])->update('solicitud', $data);
            $data2 = array(
                'correlativolistaespera' => 0
            );
            $update = $this->db->where('id', $data['id'])->update('solicitud', $data2);

            $this->db->select('*');
            $this->db->from('vehiculo');
            $this->db->where('idsolicitud', $data['id']);

            $vehiculo = $this->db->get();

            foreach($vehiculo->result() as $row)
            {
                $data2 = array(
                    'estado'      => 0
                );
                $update = $this->db->where('id', $row->id)->update('vehiculo', $data2);
            }
            $ultimoId = "Solicitud Rechazada";
        }elseif($query['estado'] == 1){
            /*
            $update = $this->db->where('id', $data['id'])->update('solicitud', $data);

            $ultimoId = "Se rechazo una solicitud Autorizada";
            */
            $ultimoId = "Solicitud no puede actualizarse a este estado siendo 'Autorizada'";
        }elseif($query['estado'] == 9){
            $ultimoId = "Esta solicitud esta Anulado";
        }else{
            $ultimoId = "Solicitud ya esta Rechazada"; 
        }

        
        return $ultimoId;          
    }

    public function update_solicitud_modelo($data)
    {
        $permiso = $this->PersonaModel->buscarPermiso();

        $query = $this->db->get_where('solicitud',array('id'=>$data['id']))->row_array();

        if ($query['estado'] != $data['estado'] && $query['tipo'] != $data['tipo']) {
            $ultimoId = "No se puede actualizar el ESTADO y TIPO de la solicitud al mismo tiempo";
        }else if($query['estado'] == 0){

            if($data['estado'] == 0){

                if ($query['tipo'] != $data['tipo']){
                    $tipo = $data['tipo'];
                    $tipo2 = $query['tipo'];
                    $update = $this->db->where('id', $data['id'])->update('solicitud', $data);

                    $this->db->select('*');
                    $this->db->from('solicitud');
                    $this->db->where('correlativolistaespera >',$data['correlativolistaespera']);
                    $this->db->where('tipo',$tipo2);
    
                    $query2 = $this->db->get();
    
                    foreach($query2->result() as $row)
                    {
                        if($row->correlativolistaespera > 0){
    
                            $maxid = $row->correlativolistaespera;
                            $maxid--;
    
                            $data2 = array(
                                'correlativolistaespera' => $maxid
                            );
                            
                            $update = $this->db->where('correlativolistaespera', $row->correlativolistaespera)->where('tipo',$tipo2)->update('solicitud', $data2);
                        }
                    }
                        
                    $this->db->select('correlativolistaespera');
                    $this->db->where('tipo', $tipo);
                    $this->db->where('estado', 0);
                    $query3 = $this->db->get('solicitud');
                    //echo $this->db->last_query();
                    
                    $maxid = $query3->num_rows(); 
                    
                    $data2 = array(
                        'correlativolistaespera' => $maxid
                    );
                    $update = $this->db->where('id', $data['id'])->update('solicitud', $data2);

                    $this->db->select('*');
                    $this->db->from('vehiculo');
                    $this->db->where('idsolicitud', $data['id']);
    
                    $vehiculo = $this->db->get();
    
                    foreach($vehiculo->result() as $row)
                    {
                        $data2 = array(
                            'estado'      => 0
                        );
                        $update = $this->db->where('id', $row->id)->update('vehiculo', $data2);
                    }

                    $ultimoId = "Solicitud se actualiza cambiando el tipo de solicitud y mantiene en Pendiente";
                }else{
                    $update = $this->db->where('id', $data['id'])->update('solicitud', $data);
                    $ultimoId = "Solicitud se actualiza y mantiene en Pendiente";
                }

            }elseif($data['estado'] == 1){
                if($query['correlativolistaespera'] == 1){
                    $this->db->order_by('id');
                    $this->db->select('*');
                    $this->db->from('solicitud');
                    $this->db->where('correlativolistaespera >',$data['correlativolistaespera']);

                    $query2 = $this->db->get();

                    foreach($query2->result() as $row)
                    {
                        if($row->correlativolistaespera > 0){

                            if($row->tipo == $data['tipo']){
                                $maxid = $row->correlativolistaespera;
                                $maxid--;

                                $data2 = array(
                                    'correlativolistaespera' => $maxid
                                );
                                
                                $update = $this->db->where('correlativolistaespera', $row->correlativolistaespera)->where('tipo',$data['tipo'])->update('solicitud', $data2);
                            }
                            
                        }
                    }
                    $update = $this->db->where('id', $data['id'])->update('solicitud', $data);
                    $data2 = array(
                        'correlativolistaespera' => 0
                    );
                    $update = $this->db->where('id', $data['id'])->update('solicitud', $data2);
                    $ultimoId = "Solicitud actualizada a Autorizada"; 
                }else{
                    $ultimoId = "Debe autorizar al primero de la lista"; 
                }

                 

            }elseif($data['estado'] == 2){
                $this->db->order_by('id');
                $this->db->select('*');
                $this->db->from('solicitud');
                $this->db->where('correlativolistaespera >',$data['correlativolistaespera']);
                $this->db->where('tipo',$data['tipo']);

                $query2 = $this->db->get();

                foreach($query2->result() as $row)
                {
                    if($row->correlativolistaespera > 0){

                        $maxid = $row->correlativolistaespera;
                        $maxid--;

                        $data2 = array(
                            'correlativolistaespera' => $maxid
                        );
                        
                        $update = $this->db->where('correlativolistaespera', $row->correlativolistaespera)->where('tipo',$data['tipo'])->update('solicitud', $data2);
                        
                    }
                }
                $update = $this->db->where('id', $data['id'])->update('solicitud', $data);
                $data2 = array(
                    'correlativolistaespera' => 0
                );
                $update = $this->db->where('id', $data['id'])->update('solicitud', $data2);
    
                $this->db->select('*');
                $this->db->from('vehiculo');
                $this->db->where('idsolicitud', $data['id']);
    
                $vehiculo = $this->db->get();
    
                foreach($vehiculo->result() as $row)
                {
                    $data2 = array(
                        'estado'      => 0
                    );
                    $update = $this->db->where('id', $row->id)->update('vehiculo', $data2);
                }
                $ultimoId = "Solicitud actualizada a Rechazado";     

            }elseif($data['estado'] == 9){

                $this->db->select('*');
                $this->db->from('solicitud');
                $this->db->where('correlativolistaespera >',$data['correlativolistaespera']);
                $this->db->where('tipo',$data['tipo']);

                $query2 = $this->db->get();

                foreach($query2->result() as $row)
                {
                    if($row->correlativolistaespera > 0){

                        $maxid = $row->correlativolistaespera;
                        $maxid--;

                        $data2 = array(
                            'correlativolistaespera' => $maxid
                        );
                        
                        $update = $this->db->where('correlativolistaespera', $row->correlativolistaespera)->where('tipo',$data['tipo'])->update('solicitud', $data2);
                
                        
                    }
                }
                $update = $this->db->where('id', $data['id'])->update('solicitud', $data);
                $data2 = array(
                    'correlativolistaespera' => 0
                );
                $update = $this->db->where('id', $data['id'])->update('solicitud', $data2);

                $this->db->select('*');
                $this->db->from('vehiculo');
                $this->db->where('idsolicitud', $data['id']);

                $vehiculo = $this->db->get();

                foreach($vehiculo->result() as $row)
                {
                    $data2 = array(
                        'estado'      => 0
                    );
                    $update = $this->db->where('id', $row->id)->update('vehiculo', $data2);
                }

                $ultimoId = "Solicitud actualizada a Anulada"; 
            }
        }elseif($query['estado'] == 1){

            if($data['estado'] == 0){
                /*
                $update = $this->db->where('id', $data['id'])->update('solicitud', $data);
                
                $this->db->select_max('correlativolistaespera');
                $this->db->where('tipo', $data['tipo']);
                $this->db->where('estado', 0);
                $query = $this->db->get('solicitud');
                
                foreach($query->result() as $row)
                {
                    $maxid = $row->correlativolistaespera;
                }
                $maxid++; 
                
                $data2 = array(
                    'correlativolistaespera' => $maxid
                );
                $update = $this->db->where('id', $data['id'])->update('solicitud', $data2);
                */
                $ultimoId = "Solicitud no puede actualizarse a este estado siendo 'Autorizada'"; 
            }elseif($data['estado'] == 1){
                $update = $this->db->where('id', $data['id'])->update('solicitud', $data);
                $ultimoId = "Solicitud se actualiza y mantiene en Autorizada";
            }elseif($data['estado'] == 2){
                /*
                $update = $this->db->where('id', $data['id'])->update('solicitud', $data);

                $this->db->select('*');
                $this->db->from('vehiculo');
                $this->db->where('idsolicitud', $data['id']);

                $vehiculo = $this->db->get();

                foreach($vehiculo->result() as $row)
                {
                    $data2 = array(
                        'estado'      => 0
                    );
                    $update = $this->db->where('id', $row->id)->update('vehiculo', $data2);
                }

                $ultimoId = "Solicitud actualizada a Rechazado";
                */
                $ultimoId = "Solicitud no puede actualizarse a este estado siendo 'Autorizada'"; 
            }elseif($data['estado'] == 9){
                $update = $this->db->where('id', $data['id'])->update('solicitud', $data);

                $this->db->select('*');
                $this->db->from('vehiculo');
                $this->db->where('idsolicitud', $data['id']);

                $vehiculo = $this->db->get();

                foreach($vehiculo->result() as $row)
                {
                    $data2 = array(
                        'estado'      => 0
                    );
                    $update = $this->db->where('id', $row->id)->update('vehiculo', $data2);
                }
                $ultimoId = "Solicitud actualizada a Anulada"; 
            }

        }elseif($query['estado'] == 2){

            if($data['estado'] == 0){
                $ultimoId = "Solicitud no puede actualizarse a este estado siendo 'Rechazada'"; 
            }elseif($data['estado'] == 1){
                $ultimoId = "Solicitud no puede actualizarse a este estado siendo 'Rechazada'";
            }elseif($data['estado'] == 2){
                $update = $this->db->where('id', $data['id'])->update('solicitud', $data);
                $ultimoId = "Solicitud se actualiza y mantiene en Rechazado";
            }elseif($data['estado'] == 9){
                $update = $this->db->where('id', $data['id'])->update('solicitud', $data);

                $this->db->select('*');
                $this->db->from('vehiculo');
                $this->db->where('idsolicitud', $data['id']);

                $vehiculo = $this->db->get();

                foreach($vehiculo->result() as $row)
                {
                    $data2 = array(
                        'estado'      => 0
                    );
                    $update = $this->db->where('id', $row->id)->update('vehiculo', $data2);
                }
                $ultimoId = "Solicitud actualizada a Anulada"; 
            }

        }elseif($query['estado'] == 9){

            if($data['estado'] == 0){
                
                $ultimoId = "Solicitud no puede actualizarse a este estado siendo 'Anulada'"; 
            }elseif($data['estado'] == 1){

                $ultimoId = "Solicitud no puede actualizarse a este estado siendo 'Anulada'";
            }elseif($data['estado'] == 2){

                $ultimoId = "Solicitud no puede actualizarse a este estado siendo 'Anulada'";
            }elseif($data['estado'] == 9){
                $update = $this->db->where('id', $data['id'])->update('solicitud', $data);
                $ultimoId = "Solicitud actualizada a Anulada"; 
            }

        }
        
        return $ultimoId;        
    }

    public function comprobar_solicitudes_modelo($data)
    {
        $this->db->where('idpersona',$data['idpersona']);
        $this->db->where('tipo',$data['tipo']);
        $this->db->where('estado >=',0);
        $this->db->where('estado <=',1);
        $query = $this->db->get('solicitud');
        $num = $query->num_rows();

        if ($num > 0){
            $result = 1; //equivale a que no dejara actualizar
        }else{
            $result = $num;
        }

        return $result;

    }

    public function comprobar_update_solicitudes_modelo($data)
    {
        $this->db->where('idpersona',$data['idpersona']);
        $this->db->where('tipo',$data['tipo']);
        $this->db->where('estado >=',0);
        $this->db->where('estado <=',1);
        $query = $this->db->get('solicitud');
        $num = $query->num_rows(); 
        $query2 = $query->row_array();

        if ($data['tipoWard'] == $query2['tipo']){
            if ($num <= 1){
                $result = 0; 
            }else{
                $result = 1;
            }
        }else{
            if ($num > 0){
                $result = 1;
            }else{
                $result = $num;
            }
        }
        
        

        return $result;

    }

    public function comprobar_patentes_modelo($patente)
    {
        $this->db->where('patente',$patente);
        $this->db->where('estado',1);
        $query = $this->db->get('vehiculo');
        $num = $query->num_rows();
        //echo $num;
        //echo $this->db->last_query();
        

        if ($num > 0){
            $result = 1; 
        }else{
            $result = $num;
        }

        //echo $result;

        return $result;

    }

}