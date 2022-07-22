<?php

class SemanaModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_semana($id)
    {
        $this->db->get_where('semana',array('id'=>$id))->row_array();
    }

    public function get_all_semana()
    {
        $this->db->order_by('id');
        $this->db->select('*');
        $this->db->from('semana');
     
        $query = $this->db->get();
        return $query->result_array();
    }

    public function add_semana_modelo($semana,$idpersona)
    {

        $ultimoId = 0;
        if (isset($semana)) 
        {  
            
            for($i = 1; $i <= 7; $i++)  {
                $data = array(
                    'idpersona'   => $idpersona,
                    'dia'         => $i,
                    'estado'      => 0
                );


                $insert = $this->db->insert('semana', $data);
                $ultimoId = $this->db->last_query();
            }

            foreach($semana as $val)  {
                $dia       = $val['codigo'];
                $data = array(
                    'idpersona'   => $idpersona,
                    'dia'         => $dia,
                    'estado'      => 1
                );


                $insert = $this->db->where('idpersona', $idpersona)->where('dia', $dia)->update('semana', $data);
                $ultimoId = $this->db->last_query();
            }


        }
        return $ultimoId;
    }

    public function add_semana_modeloX($idpersona)
    {
          
        for($i = 1; $i <= 7; $i++)  {
            $data = array(
                'idpersona'   => $idpersona,
                'dia'         => $i,
                'estado'      => 0
            );


            $insert = $this->db->insert('semana', $data);
            $ultimoId = $this->db->last_query();
        }

        return $ultimoId;
    }

    public function update_semana_modelo($semana,$idpersona)
    {
        $ultimoId = 0;
        if (isset($semana)) 
        {  
            
            for($i = 1; $i <= 7; $i++)  {
                $data = array(
                    'idpersona'   => $idpersona,
                    'dia'         => $i,
                    'estado'      => 0
                );


                $insert = $this->db->where('idpersona', $idpersona)->where('dia', $i)->update('semana', $data);
                $ultimoId = $this->db->last_query();
            }

            foreach($semana as $val)  {
                $dia       = $val['codigo'];
                $data = array(
                    'idpersona'   => $idpersona,
                    'dia'         => $dia,
                    'estado'      => 1
                );


                $insert = $this->db->where('idpersona', $idpersona)->where('dia', $dia)->update('semana', $data);
                $ultimoId = $this->db->last_query();
            }


        }
        return $ultimoId;
    }

    public function get_all_semana_id($idpersona)
    {
        $this->db->order_by('id');
        $this->db->select('dia');
        $this->db->from('semana');
        $this->db->where('idpersona', $idpersona);
        $this->db->where('estado',1);
     
        $query = $this->db->get();
        return $query->result_array();
    }

    public function comprobar_semana_modelo($idpersona)
    {
        $this->db->where('idpersona',$idpersona);
        $query = $this->db->get('semana');
        $num = $query->num_rows();
        //echo $num;
        //echo $this->db->last_query();
        

        if ($num == 7){
            $result = 1; 
        }else{
            $result = $num;
        }

        //echo $result;

        return $result;

    }

}