<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Estacionamiento - Personas</title>
    <link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.css"); ?>" />
    <link rel="stylesheet" href="<?php echo base_url("assets/css/dataTables.bootstrap5.min.css"); ?>" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #D1F5F5;
		margin-top: 100px;
        margin-left: 100px;
        margin-right: 100px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
		text-decoration: none;
	}

	a:hover {
		color: #97310e;
	}

	h1 {
		color: #FFFF;
		background-color: #337ab7;
		font-size: 25px;
		font-weight: normal;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
		min-height: 96px;
	}

	p {
		margin: 0 0 10px;
		padding:0;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		border: 1px solid #337ab7;
		box-shadow: 0 0 8px #337ab7;
        background-color: #fff;
        border-radius: 0.25rem;
	}
    thead input {
        width: 100%;
    }

    .dataTables_filter, .dataTables_info { display: none; }

	</style>
    <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo base_url("index.php/inicio/index") ?>"><i class="fas fa-road"></i> ESTACIONAMIENTO</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav justify-content-end">
                <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url("index.php/inicio/index") ?>">Inicio</a>
                </li>
                <? if ($permiso > 0) { ?>
                <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url("index.php/solicitud/index") ?>">Mantenedor Solicitudes</a>
                </li>
                <? if ($permiso > 1) { ?>
                <li class="nav-item">
                <a class="nav-link active" href="<?php echo base_url("index.php/persona/index") ?>">Mantenedor Personas</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url("index.php/vehiculo/index") ?>">Mantenedor Vehiculos</a>
                </li>
                <? } ?>
                <? } ?>
                <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url("index.php/espera/index") ?>">Lista de Espera</a>
                </li>
            </ul>
            </div>
            <ul class="navbar-nav nav justify-content-end" id="navbarSupportedContent">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle fs-5" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user-circle"></i> &nbsp; <?php echo ($_SESSION['cabnombre']); ?> <?php echo ($_SESSION['cabapellido']); ?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="<?= site_url('inicio/cerrar'); ?>"><i class="fas fa-sign-out-alt"></i> Cerrar sesion</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="navbar-nav nav justify-content-end" id="navbarSupportedContent">
                <a class="nav-link" href="http://10.5.225.24"><i class="fas fa-home"></i> Volver a intranet</a>
            </ul>
        </div>
    </nav>
</head>

<body>
<div id="container">
	<h1><i class="fas fa-user"></i> Mantenedor de Personas</h1>
    <div class="form-group">
    <? if ($permiso > 1) { ?>
    <div id="liveAlertPlaceholder"></div>
    <div class="row p-3">
        <div class="col-md-6 p-2">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">RUT</div>
                </div>
                <input class="form-control" type="text" name="rut" id="rut" placeholder="Ingrese rut - (12345678)" maxlength="8" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" min="1">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button" id="botonBuscarRut"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </div>  
        <div class="col-md-6 p-2">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">NOMBRE</span>
                </div>
                <input class="form-control" type="text" name="nombres" id="nombres" placeholder="Nombre completo" disabled>
            </div>
        </div>
        <input class="form-control" type="text" name="fecha" id="fecha" hidden>
        <div class="p-2 d-grid gap-2 d-md-flex justify-content-md-end">
        <button class="btn btn-secondary" type="button" id="refresh"><i class="fas fa-sync-alt"></i></button>
        </div>
        <div class="col-12 p-2">
            <table id="tablaP" class="table" style="width:100%">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">RUT</th>
                    <th scope="col">ESTADO</th>
                    <th scope="col">COMANDOS</th>
                </tr>

                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    <? }else{ ?>
        <div class="alert alert-danger">
            <h4 class="alert-heading"><i class="fas fa-exclamation-triangle"></i> &nbsp; ADVERTENCIA!</h4>
            <p>Usted no tiene acceso a esta pagina, porfavor de volver al inicio</p>
            <hr>
            <a type="button" class="btn btn-danger" href="<?php echo base_url("index.php/inicio/index") ?>">Volver a Inicio</a>
        </div>
    <? } ?>
    </div>
</div>

