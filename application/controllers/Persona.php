<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Persona extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('PersonaModel');
        $this->load->library('session');
    } 

	public function index()
	{
        $validar = false;
        $validar = $this->valida_usuario();
        if($validar)
        {
            $data['persona'] = $this->PersonaModel->get_all_persona();

            $data['permiso'] = $this->PersonaModel->buscarPermiso();

            $this->load->helper('url');
            $this->load->view('persona', $data);
            $this->load->view('modals/modalPersona');
            $this->load->view('scripts/scriptsPersona');
        }
        else
        {
            $this->salir();
        }
	}

    public function valida_usuario()
    {        
        $sesion = $this->session->cabcodigo;
        if($sesion):
            return true;
        else:
            return false;            
        endif;
    }

    public function cerrar()
    {
        $this->load->helper('url');
        $this->session->sess_destroy();
        $this->load->view('salir');
    }


    public function salir()
    {
        $this->load->helper('url');
        $this->load->view('salir');
    }

    public function persona()
    {
    
        $result3 = $this->PersonaModel->get_all_persona(); 

        echo json_encode($result3); 
    }

    function search_persona()
    {
        $rut = $this->input->post('rut');

        $rutsep = explode("-", $rut);
        $rut    = $rutsep[0];

        if (strpos($rut,'.') !== false){
            $rutsep = explode(".", $rut);
            $rut    = $rutsep[0].$rutsep[1].$rutsep[2];
        }else{
            $rut = $rut;
        }

        $resultado = $this->PersonaModel->buscarxRut($rut);

        echo $resultado;
        
    }

    public function add_persona()
    {
        $rut    = $this->input->post('rut');
        $estado = 1;
        
        $rutsep = explode("-", $rut);
        $rut    = $rutsep[0];

        if (strpos($rut,'.') !== false){
            $rutsep = explode(".", $rut);
            $rut    = $rutsep[0].$rutsep[1].$rutsep[2];
        }else{
            $rut = $rut;
        }
                            
        $data = array(
            'rut'     => $rut,
            'estado'  => $estado   
        );
    
        $result3 = $this->PersonaModel->add_persona_modelo($data); 

        echo json_encode($result3); 
    }

    public function update_persona()
    {
        $id         = $this->input->post('id');
        $rut        = $this->input->post('rut');
        $estado     = $this->input->post('estado');
        $fecha      = $this->input->post('fecha');
        $usumod     = $this->session->cabcodigo;
        
        $rutsep = explode("-", $rut);
        $rut    = $rutsep[0];
                            
        $data = array(
            'id'      => $id,
            'rut'     => $rut,
            'estado'  => $estado   
        );
    
        $result3 = $this->PersonaModel->update_persona_modelo($data); 

        if ($estado == 0){
            $result4 = $this->PersonaModel->desactivar_solicitudes_persona($id,$fecha,$usumod);
        }

        echo json_encode($result3); 
    }

    public function delete_persona()
    {
        $id         = $this->input->post('id');
        $fecha      = $this->input->post('fecha');
        $estado     = '0';
        $usumod     = $this->session->cabcodigo;
                            
        $data = array(
                'id'            => $id,
                'estado'        => $estado,
        );
    
        $result3 = $this->PersonaModel->update_persona_modelo($data); 

        $result4 = $this->PersonaModel->desactivar_solicitudes_persona($id,$fecha,$usumod);

        echo json_encode($result3); 
    }

}