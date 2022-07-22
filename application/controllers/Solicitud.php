<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Solicitud extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
		$this->load->model('VehiculoModel');
        $this->load->model('PersonaModel');
        $this->load->model('SolicitudModel');
        $this->load->model('SemanaModel');
        $this->load->model('EstacionamientoLogModel');
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
            $data['solicitud'] = $this->SolicitudModel->get_all_solicitud();
            $data['servicios'] = $this->SolicitudModel->get_all_servicios();

            $data['parametrosA'] = $this->SolicitudModel->parametrosA();
            $data['parametrosM'] = $this->SolicitudModel->parametrosM();
            $data['parametrosB'] = $this->SolicitudModel->parametrosB();

            $data['autoA'] = $this->SolicitudModel->get_all_autoA();
            $data['motoA'] = $this->SolicitudModel->get_all_motoA();
            $data['biciA'] = $this->SolicitudModel->get_all_biciA();

            $data['permiso'] = $this->PersonaModel->buscarPermiso();

            $this->load->helper('url');
            $this->load->view('solicitud', $data);
            $this->load->view('modals/modalSolicitud');
            $this->load->view('scripts/scriptsSolicitud');
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

    public function refreshA()
    {
        $result = $this->SolicitudModel->get_all_autoA();
        echo $result; 
    }

    public function refreshM()
    {
        $result = $this->SolicitudModel->get_all_motoA();
        echo $result; 
    }

    public function refreshB()
    {
        $result = $this->SolicitudModel->get_all_biciA();
        echo $result; 
    }

    public function add_vehiculo()
    {
        $idsolicitud    = $this->input->post('idsolicitud');
        $idpersona      = $this->input->post('idpersona');
        $tipo           = $this->input->post('tipo');
        $marca          = $this->input->post('marca');    
        $modelo         = $this->input->post('modelo');
        $patente        = $this->input->post('patente');
        $propietario    = $this->input->post('propietario');
        $observacion    = $this->input->post('observacion');

        if($patente == null)
        {
            $patente = "No aplica";
        }
                            
        $data = array(
            'idsolicitud'   => $idsolicitud,
            'idpersona'     => $idpersona,
            'tipo'          => $tipo,
            'marca'         => strtoupper($marca), 
            'modelo'        => strtoupper($modelo), 
            'patente'       => strtoupper($patente), 
            'estado'        => 1,
            'propietario'   => $propietario,
            'observacion'   => $observacion
        );
    
        $result1 = $this->VehiculoModel->add_vehiculo_modelo($data); 

        echo json_encode($result1); 
    }

    public function vehiculo()
    {
        $idsolicitud   = $this->input->post('idsolicitud');
        $tipo          = $this->input->post('tipo');

        $data = array(
            'id'   => $idsolicitud,
            'tipo' => $tipo
        );
    
        $result3 = $this->VehiculoModel->get_all_vehiculo_id($data); 

        echo json_encode($result3); 
    }

    public function persona()
    {
        $result3 = $this->SolicitudModel->get_all_solicitud_persona(); 

        echo json_encode($result3); 
    }

    public function persona_mantenedor()
    {
        $result3 = $this->SolicitudModel->get_all_solicitud_persona_mantenedor(); 

        echo json_encode($result3); 
    }

    public function delete_vehiculo()
    {
        $id         = $this->input->post('id');
        $estado     = 0;
                            
        $data = array(
                'id'            => $id,
                'estado'        => $estado,
        );
    
        $this->VehiculoModel->update_vehiculo_modelo($data); 

        $idsolicitud   = $this->input->post('idsolicitud');
        $tipo          = $this->input->post('tipo');
    
        $result3 = $this->VehiculoModel->get_all_vehiculo_id($idsolicitud,$tipo); 

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

    public function add_solicitud()
    {
        $idpersona          = $this->input->post('idpersona');
        $tipo               = $this->input->post('tipo');
        $fechasolicitud     = $this->input->post('fecha');
        $fechacrea          = $this->input->post('fecha');
        $observaciones      = $this->input->post('observaciones');
        $usucrea            = $this->session->cabcodigo;


        $max = $this->SolicitudModel->max_espera($tipo); 

        $data = array(
            'idpersona'                 => $idpersona,
            'tipo'                      => $tipo,
            'fechasolicitud'            => $fechasolicitud,
            'fechacrea'                 => $fechacrea,
            'correlativolistaespera'    => $max,
            'observaciones'             => $observaciones,
            'usucrea'                   => $usucrea
        );
    
   
        $result1 = $this->SolicitudModel->add_solicitud_modelo($data); 

        echo json_encode($result1); 
    }

    public function anular_solicitud()
    {
        $id                     = $this->input->post('id');
        $estado                 = 9;
        $tipo                   = $this->input->post('tipo');
        $fechaanulacion         = $this->input->post('fecha');
        $observacionanula       = $this->input->post('observaciones');
        $correlativolistaespera = $this->input->post('correlativolistaespera');
        $fechamod               = $this->input->post('fecha');
        $usumod                 = $this->session->cabcodigo;
                            
        $data = array(
            'id'                     => $id,
            'estado'                 => $estado,
            'tipo'                   => $tipo,
            'fechaanulacion'         => $fechaanulacion,
            'observacionanula'       => $observacionanula,
            'correlativolistaespera' => $correlativolistaespera,
            'fechamod'               => $fechamod,
            'usumod'                 => $usumod
        );
    
        $result3 = $this->SolicitudModel->anular_solicitud_modelo($data); 

        $data2 = array(
            'tipo'      => "Solicitud modificada - ANULADA",
            'fechamod'  => $fechamod,
            'valormod'  => 'id='.$id.'|| tipo='.$tipo.'|| estado='.$estado.'|| observacion anula='.$observacionanula,
            'usumod'    => $usumod
        );
        $result5 = $this->EstacionamientoLogModel->add_log_modelo($data2);

        echo json_encode($result3); 
    }

    public function autorizar_solicitud()
    {
        $id                     = $this->input->post('id');
        $estado                 = 1;
        $tipo                   = $this->input->post('tipo');
        $fechaautorizacion      = $this->input->post('fecha');
        $observacionautoriza    = $this->input->post('observaciones');
        $correlativolistaespera = $this->input->post('correlativolistaespera');
        $fechamod               = $this->input->post('fecha');
        $usumod                 = $this->session->cabcodigo;
                            
        $data = array(
                'id'                        => $id,
                'estado'                    => $estado,
                'tipo'                      => $tipo,
                'fechaautorizacion'         => $fechaautorizacion,
                'correlativolistaespera'    => $correlativolistaespera,
                'observacionautoriza'       => $observacionautoriza,
                'fechamod'                  => $fechamod,
                'usumod'                    => $usumod
        );
    
        $result3 = $this->SolicitudModel->autorizar_solicitud_modelo($data); 

        $data2 = array(
            'tipo'      => "Solicitud modificada - AUTORIZADA",
            'fechamod'  => $fechamod,
            'valormod'  => 'id='.$id.'|| tipo='.$tipo.'|| estado='.$estado.'|| observacion autoriza='.$observacionautoriza,
            'usumod'    => $usumod
        );
        $result5 = $this->EstacionamientoLogModel->add_log_modelo($data2);

        echo json_encode($result3); 
    }

    public function rechazar_solicitud()
    {
        $id                     = $this->input->post('id');
        $estado                 = 2;
        $tipo                   = $this->input->post('tipo');
        $fecharechazo           = $this->input->post('fecha');
        $motivorechazo          = $this->input->post('motivorechazo');
        $correlativolistaespera = $this->input->post('correlativolistaespera');
        $fechamod               = $this->input->post('fecha');
        $usumod                 = $this->session->cabcodigo;
                            
        $data = array(
            'id'                     => $id,
            'estado'                 => $estado,
            'tipo'                   => $tipo,
            'fecharechazo'           => $fecharechazo,
            'motivorechazo'          => $motivorechazo,
            'correlativolistaespera' => $correlativolistaespera,
            'fechamod'               => $fechamod,
            'usumod'                 => $usumod
        );
    
        $result3 = $this->SolicitudModel->rechazo_solicitud_modelo($data); 

        $data2 = array(
            'tipo'      => "Solicitud modificada - RECHAZADA",
            'fechamod'  => $fechamod,
            'valormod'  => 'id='.$id.'|| tipo='.$tipo.'|| estado='.$estado.'|| motivo rechazo='.$motivorechazo,
            'usumod'    => $usumod
        );
        $result5 = $this->EstacionamientoLogModel->add_log_modelo($data2);

        echo json_encode($result3); 
    }

    public function update_solicitud()
    {
        $id                     = $this->input->post('id');
        $idpersona              = $this->input->post('idpersona');
        $tipo                   = $this->input->post('tipo');
        $tipoWard               = $this->input->post('tipoWard');
        $estado                 = $this->input->post('estado');
        $fechamod               = $this->input->post('fecha');
        $observaciones          = $this->input->post('observaciones');
        $observacionanula       = $this->input->post('observacionanula');
        $observacionautoriza    = $this->input->post('observacionautoriza');
        $motivorechazo          = $this->input->post('motivorechazo');
        $calidadjuridica        = $this->input->post('calidadjuridica');
        $serviciounidad         = $this->input->post('serviciounidad');
        $jornadalaboral         = $this->input->post('jornadalaboral');
        $correlativolistaespera = $this->input->post('correlativolistaespera');
        $tarjeta                = $this->input->post('tarjeta');
        $usumod                 = $this->session->cabcodigo;

        if ($estado == 9){
            $fechaanulacion     = $this->input->post('fecha');
            $fechaautorizacion  = null;
            $fecharechazo       = null;
        }elseif($estado == 1){
            $fechaautorizacion = $this->input->post('fecha');
            $fechaanulacion    = null;
            $fecharechazo      = null;
        }elseif($estado == 0){
            $fechaautorizacion = null;
            $fechaanulacion    = null;
            $fecharechazo      = null;
        }elseif($estado == 2){
            $fecharechazo      = $this->input->post('fecha');
            $fechaautorizacion = null;
            $fechaanulacion    = null;
        }

                            
        $data = array(
            'id'                        => $id,
            'idpersona'                 => $idpersona,
            'tipo'                      => $tipo,
            'estado'                    => $estado,
            'fechaautorizacion'         => $fechaautorizacion,
            'fechaanulacion'            => $fechaanulacion, 
            'fecharechazo'              => $fecharechazo,
            'fechamod'                  => $fechamod, 
            'correlativolistaespera'    => $correlativolistaespera,
            'observaciones'             => $observaciones,
            'observacionanula'          => $observacionanula,
            'observacionautoriza'       => $observacionautoriza,
            'motivorechazo'             => $motivorechazo,
            'calidadjuridica'           => $calidadjuridica,
            'serviciounidad'            => $serviciounidad,
            'jornadalaboral'            => $jornadalaboral,
            'tarjeta'                   => $tarjeta,
            'usumod'                    => $usumod
        );

        $data2 = array(
            'idpersona'                 => $idpersona,
            'tipo'                      => $tipo,
            'estado'                    => $estado,
            'tipoWard'                  => $tipoWard
        );

        
        $result = $this->SolicitudModel->comprobar_update_solicitudes_modelo($data2);
        
        if($result == 1){
            $result2 = 0;
        }else{
    
            $result2 = $this->SolicitudModel->update_solicitud_modelo($data); 

            $result4 = $this->SemanaModel->comprobar_semana_modelo($idpersona);

            
            if (isset($_POST['semana'])) {
                $semana = $_POST['semana'];
                if ($result4 == 1){
                    $result = $this->SemanaModel->update_semana_modelo($semana,$idpersona);
                }else{
                    $result = $this->SemanaModel->add_semana_modelo($semana,$idpersona);
                }

            }

            $tipolog = "Solicitud modificada";
            if($estado == 0){
                $tipolog = "Solicitud modificada - PENDIENTE";
            }else if($estado == 1){
                $tipolog = "Solicitud modificada - AUTORIZADA";
            }else if($estado == 2){
                $tipolog = "Solicitud modificada - RECHAZADA";
            }else if($estado == 9){
                $tipolog = "Solicitud modificada - ANULADA";
            }

            $data2 = array(
                'tipo'      => $tipolog,
                'fechamod'  => $fechamod,
                'valormod'  => 'id='.$id.'|| id persona='.$idpersona.'|| tipo='.$tipo.'|| estado='.$estado.'|| observaciones='.$observaciones.'|| observacion anula='.$observacionanula.'|| observacion autoriza='.$observacionautoriza.'|| motivo rechazo='.$motivorechazo.'|| calidad juridica='.$calidadjuridica.'|| servicio/unidad='.$serviciounidad.'|| jornada laboral='.$jornadalaboral,
                'usumod'    => $usumod
            );
            $result5 = $this->EstacionamientoLogModel->add_log_modelo($data2);
        }
        
        echo json_encode($result2); 
    }

    public function add_solicitudX()
    {

        $idpersona          = $this->input->post('idpersona');
        $tipo               = $this->input->post('tipo');
        $fechasolicitud     = $this->input->post('fecha');
        $fechacrea          = $this->input->post('fecha');
        $observaciones      = $this->input->post('observaciones');
        $calidadjuridica    = $this->input->post('calidadjuridica');
        $serviciounidad     = $this->input->post('serviciounidad');
        $jornadalaboral     = $this->input->post('jornadalaboral');
        $usucrea            = $this->session->cabcodigo;


        $max = $this->SolicitudModel->max_espera($tipo); 

        $data = array(
            'idpersona'                 => $idpersona,
            'tipo'                      => $tipo,
            'fechasolicitud'            => $fechasolicitud,
            'fechacrea'                 => $fechacrea,
            'correlativolistaespera'    => $max,
            'observaciones'             => $observaciones,
            'calidadjuridica'           => $calidadjuridica,
            'serviciounidad'            => $serviciounidad,
            'jornadalaboral'            => $jornadalaboral,
            'usucrea'                   => $usucrea
        );

        $data2 = array(
            'idpersona'                 => $idpersona,
            'tipo'                      => $tipo,
            'estado'                    => 0
        );

        
        $result = $this->SolicitudModel->comprobar_solicitudes_modelo($data2);

        if($result == 1){
            $idsolicitud = 0;
        }else{
            $idsolicitud = $this->SolicitudModel->add_solicitud_modelo($data);
            
            if (isset($_POST['semana'])) 
            {
                $semana= $_POST['semana'];
                $result2 = $this->SemanaModel->update_semana_modelo($semana,$idpersona);
            }
        
            
            if (isset($_POST['autos'])) 
            {
                $autos= $_POST['autos'];
                $result3 = $this->VehiculoModel->add_vehiculoS_modelo($autos,$idsolicitud,$idpersona,$tipo);
            }

            $data2 = array(
                'tipo'      => 'Solicitud añadida',
                'fechamod'  => $fechacrea,
                'valormod'  => 'id='.$idsolicitud.'|| id persona='.$idpersona.'|| tipo='.$tipo.'|| observaciones='.$observaciones.'|| calidad juridica='.$calidadjuridica.'|| servicio/unidad='.$serviciounidad.'|| jornada laboral='.$jornadalaboral,
                'usumod'    => $usucrea
            );
            $result4 = $this->EstacionamientoLogModel->add_log_modelo($data2); 

        }
                
        echo json_encode($idsolicitud);

    }

    public function comprobar_solicitudes()
    {
        $idpersona          = $this->input->post('idpersona');
        $tipo               = $this->input->post('tipo');

        $data = array(
            'idpersona'                 => $idpersona,
            'tipo'                      => $tipo,
            'estado'                    => 0
        );

        $result = $this->SolicitudModel->comprobar_solicitudes_modelo($data);

        echo json_encode($result);
    }

    public function comprobar_patentes()
    {
        $patente          = $this->input->post('patente');

        $result = $this->SolicitudModel->comprobar_patentes_modelo($patente);

        echo json_encode($result);
    }

    public function semana()
    {
        $idpersona   = $this->input->post('idpersona');

        $comprobar = $this->SemanaModel->comprobar_semana_modelo($idpersona);

        if ($comprobar == 1){
            $result3 = $this->SemanaModel->get_all_semana_id($idpersona);
        }else{
            $this->SemanaModel->add_semana_modeloX($idpersona);
            $result3 = $this->SemanaModel->get_all_semana_id($idpersona);
        }

        echo json_encode($result3); 
    }
}