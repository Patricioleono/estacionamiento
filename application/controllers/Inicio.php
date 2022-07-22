<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
		$this->load->model('VehiculoModel');
        $this->load->model('PersonaModel');
        $this->load->model('SolicitudModel');
        $this->load->library('session');
    } 

	public function index()
	{
        $validar = false;
        $validar = $this->valida_usuario();
        if($validar)
        {
            $data['autoP'] = $this->SolicitudModel->get_all_autoP();
            $data['motoP'] = $this->SolicitudModel->get_all_motoP();
            $data['biciP'] = $this->SolicitudModel->get_all_biciP();

            $data['autoA'] = $this->SolicitudModel->get_all_autoA();
            $data['motoA'] = $this->SolicitudModel->get_all_motoA();
            $data['biciA'] = $this->SolicitudModel->get_all_biciA();

            $data['autoE'] = $this->SolicitudModel->get_all_autoE();
            $data['motoE'] = $this->SolicitudModel->get_all_motoE();
            $data['biciE'] = $this->SolicitudModel->get_all_biciE();

            $data['parametrosA'] = $this->SolicitudModel->parametrosA();
            $data['parametrosM'] = $this->SolicitudModel->parametrosM();
            $data['parametrosB'] = $this->SolicitudModel->parametrosB();
            
            $data['permiso'] = $this->PersonaModel->buscarPermiso();
            
            $this->load->helper('url');
            $this->load->view('inicio', $data);
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


}