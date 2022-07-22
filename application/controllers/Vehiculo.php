<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vehiculo extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
		$this->load->model('VehiculoModel');
        $this->load->model('PersonaModel');
        $this->load->library('session');
    } 

	public function index()
	{
        $validar = false;
        $validar = $this->valida_usuario();
        if($validar)
        {
            $data['vehiculo'] = $this->VehiculoModel->get_all_vehiculo();
            $data['persona'] = $this->PersonaModel->get_all_persona();

            $data['permiso'] = $this->PersonaModel->buscarPermiso();

            $this->load->helper('url');
            $this->load->view('vehiculo', $data);
            $this->load->view('modals/modalVehiculo');
            $this->load->view('scripts/scriptsVehiculo');
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

    public function vehiculo()
    {
        $result3 = $this->VehiculoModel->get_all_vehiculo(); 

        echo json_encode($result3); 
    }

    public function update_vehiculo()
    {
        $id             = $this->input->post('id');
        $idpersona      = $this->input->post('idpersona');
        $tipo           = $this->input->post('tipo');
        $marca          = $this->input->post('marca');    
        $modelo         = $this->input->post('modelo');
        $patente        = $this->input->post('patente');
        $estado         = $this->input->post('estado');
        $propietario    = $this->input->post('propietario');
        $observacion    = $this->input->post('observacion');

        if ($propietario == 1){
            $observacion = "";
        }
                            
        $data = array(
                'id'            => $id,
                'idpersona'     => $idpersona,
                'tipo'          => $tipo,
                'marca'         => strtoupper($marca), 
                'modelo'        => strtoupper($modelo), 
                'patente'       => strtoupper($patente), 
                'estado'        => $estado,
                'propietario'   => $propietario,
                'observacion'   => $observacion,
        );
    
        $result2 = $this->VehiculoModel->update_vehiculo_modelo($data); 

        echo json_encode($result2); 
    }

    public function delete_vehiculo()
    {
        $id         = $this->input->post('id');
        $estado     = '0';
                            
        $data = array(
                'id'            => $id,
                'estado'        => $estado,
        );
    
        $result3 = $this->VehiculoModel->update_vehiculo_modelo($data); 

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

    function search_persona_id()
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

        $resultado2 = $this->PersonaModel->get_id($rut);

        echo json_encode($resultado2);
    }

    function ver_vehiculo()
    {
        $id = $this->input->post('id');
        $tipo = $this->input->post('tipo');

        $data = array(
            'id'     => $id,
            'tipo'  => $tipo   
        );

        $resultado2 = $this->VehiculoModel->get_all_vehiculo_id($data);

        echo json_encode($resultado2);
    }

}