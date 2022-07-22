<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Espera extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('SolicitudModel');
        $this->load->model('PersonaModel');
        $this->load->model('VehiculoModel');
        $this->load->library('session');
    } 

	public function index()
	{
        $validar = false;
        $validar = $this->valida_usuario();
        if($validar)
        {
            //Pendientes
            $data['auto'] = $this->SolicitudModel->get_all_solicitud_auto();
            $data['moto'] = $this->SolicitudModel->get_all_solicitud_moto();
            $data['bici'] = $this->SolicitudModel->get_all_solicitud_bicicleta();
            //Autorizados
            $data['auto2'] = $this->SolicitudModel->get_all_solicitud_auto2();
            $data['moto2'] = $this->SolicitudModel->get_all_solicitud_moto2();
            $data['bici2'] = $this->SolicitudModel->get_all_solicitud_bicicleta2();
            //Anulados
            $data['auto3'] = $this->SolicitudModel->get_all_solicitud_auto3();
            $data['moto3'] = $this->SolicitudModel->get_all_solicitud_moto3();
            $data['bici3'] = $this->SolicitudModel->get_all_solicitud_bicicleta3();
            
            $data['persona'] = $this->PersonaModel->get_all_persona();
            $data['vehiculo'] = $this->VehiculoModel->get_all_vehiculo();

            $data['permiso'] = $this->PersonaModel->buscarPermiso();

            $this->load->helper('url');
            $this->load->view('espera', $data);
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