<?php

class EstacionamientoLogModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function add_log_modelo($data)
    {
        $insert = $this->db->insert('estacionamientolog', $data);
        $ultimoId = $this->db->insert_id();
        return $ultimoId;        
    }
}