<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Estacionamiento - Inicio</title>
    <link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.css"); ?>" />
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
		color: #444;
		background-color: transparent;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
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
                <a class="nav-link active" aria-current="page" href="<?php echo base_url("index.php/inicio/index") ?>">Inicio</a>
                </li>
                <? if ($permiso > 0) { ?>
                <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url("index.php/solicitud/index") ?>">Mantenedor Solicitudes</a>
                </li>
                <? if ($permiso > 1) { ?>
                <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url("index.php/persona/index") ?>">Mantenedor Personas</a>
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
    <div class="row p-4">
        <? if ($permiso == 2) { ?>
        <div class="col-md-3 p-2">
            <div class="input-group justify-content-center">
                <div class="card text-center" style="width: 18rem;border: 3px solid #003399;background-color: #FAFBFD;">
                    <a class="card-body stretched-link text-decoration-none" href="<?php echo base_url("index.php/solicitud/index") ?>">
                        <p class="fs-1"><i class="fas fa-file"></i></p>
                        <h5 class="card-title">Mantenedor de Solicitudes</h5>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-3 p-2">
            <div class="input-group justify-content-center">
                <div class="card text-center" style="width: 18rem;border: 3px solid #003399;background-color: #FAFBFD;">
                    <a class="card-body stretched-link text-decoration-none" href="<?php echo base_url("index.php/persona/index") ?>">
                        <p class="fs-1"><i class="fas fa-user"></i></p>
                        <h5 class="card-title">Mantenedor de Personas</h5>
                    </a>
                </div>
            </div>
        </div>  
        <div class="col-md-3 p-2">
            <div class="input-group justify-content-center">
                <div class="card text-center" style="width: 18rem;border: 3px solid #003399;background-color: #FAFBFD;">
                    <a class="card-body stretched-link text-decoration-none" href="<?php echo base_url("index.php/vehiculo/index") ?>">
                        <p class="fs-1"><i class="fas fa-car-side"></i></p>
                        <h5 class="card-title">Mantenedor de Vehiculos</h5>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-3 p-2">
            <div class="input-group justify-content-center">
                <div class="card text-center" style="width: 18rem;border: 3px solid #003399;background-color: #FAFBFD;"  >
                    <a class="card-body stretched-link text-decoration-none" href="<?php echo base_url("index.php/espera/index") ?>">
                        <p class="fs-1"><i class="fas fa-clock"></i></p>
                        <h5 class="card-title">Lista de Espera</h5>
                    </a>
                </div>
            </div>
        </div>
        <? }else if ($permiso == 1){ ?>
        <div class="col-md-6 p-2">
            <div class="input-group justify-content-center">
                <div class="card text-center" style="width: 18rem;border: 3px solid #003399;background-color: #FAFBFD;">
                    <a class="card-body stretched-link text-decoration-none" href="<?php echo base_url("index.php/solicitud/index") ?>">
                        <p class="fs-1"><i class="fas fa-file"></i></p>
                        <h5 class="card-title">Mantenedor de Solicitudes</h5>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-6 p-2">
            <div class="input-group justify-content-center">
                <div class="card text-center" style="width: 18rem;border: 3px solid #003399;background-color: #FAFBFD;"  >
                    <a class="card-body stretched-link text-decoration-none" href="<?php echo base_url("index.php/espera/index") ?>">
                        <p class="fs-1"><i class="fas fa-clock"></i></p>
                        <h5 class="card-title">Lista de Espera</h5>
                    </a>
                </div>
            </div>
        </div>
        <? }else{ ?>
        <div class="col-md-12 p-2">
            <div class="input-group justify-content-center">
                <div class="card text-center" style="width: 18rem;border: 3px solid #003399;background-color: #FAFBFD;"  >
                    <a class="card-body stretched-link text-decoration-none" href="<?php echo base_url("index.php/espera/index") ?>">
                        <p class="fs-1"><i class="fas fa-clock"></i></p>
                        <h5 class="card-title">Lista de Espera</h5>
                    </a>
                </div>
            </div>
        </div>
        <? } ?>
        <div class="col-md-9">
            <div class="row">
                <div class="text-center">
                    <hr>
                    <h4 id="form-title fw-bold">SOLICITUDES PENDIENTES</h4>
                    <hr>
                </div>
                <!-- PENDIENTES -->
                <div class="col-md-4">
                    <div class="input-group justify-content-center">
                        <div class="text-center">
                            <p class="fs-1" style="border-radius: 50%;color: #fff;background-color: #003399;width: 100px;height: 100px;"><i class="fas fa-car" style="margin: 10px;"></i><br><?php echo $autoP ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group justify-content-center">
                        <div class="text-center">
                            <p class="fs-1" style="border-radius: 50%;color: #fff;background-color: #003399;width: 100px;height: 100px;"><i class="fas fa-motorcycle" style="margin: 10px;"></i><br><?php echo $motoP ?></p>
                        </div>
                    </div>
                </div>  
                <div class="col-md-4">
                    <div class="input-group justify-content-center">
                        <div class="text-center">
                            <p class="fs-1" style="border-radius: 50%;color: #fff;background-color: #003399;width: 100px;height: 100px;"><i class="fas fa-bicycle" style="margin: 10px;"></i><br><?php echo $biciP ?></p>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <hr>
                    <h4 id="form-title fw-bold">SOLICITUDES AUTORIZADAS</h4>
                    <hr>
                </div>
                <!-- AUTORIZADOS -->
                <div class="col-md-4">
                    <div class="input-group justify-content-center">
                        <div class="text-center">
                            <p class="fs-1" style="border-radius: 50%;color: #fff;background-color: #2C6F31;width: 100px;height: 100px;"><i class="fas fa-car" style="margin: 10px;"></i><br><?php echo $autoA ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group justify-content-center">
                        <div class="text-center">
                            <p class="fs-1" style="border-radius: 50%;color: #fff;background-color: #2C6F31;width: 100px;height: 100px;"><i class="fas fa-motorcycle" style="margin: 10px;"></i><br><?php echo $motoA ?></p>
                        </div>
                    </div>
                </div>  
                <div class="col-md-4">
                    <div class="input-group justify-content-center">
                        <div class="text-center">
                            <p class="fs-1" style="border-radius: 50%;color: #fff;background-color: #2C6F31;width: 100px;height: 100px;"><i class="fas fa-bicycle" style="margin: 10px;"></i><br><?php echo $biciA ?></p>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <hr>
                    <h4 id="form-title fw-bold">SOLICITUDES RECHAZADAS</h4>
                    <hr>
                </div>
                <!-- RECHAZADAS -->
                <div class="col-md-4">
                    <div class="input-group justify-content-center">
                        <div class="text-center">
                            <p class="fs-1" style="border-radius: 50%;color: #fff;background-color: #7F0E0E;width: 100px;height: 100px;"><i class="fas fa-car" style="margin: 10px;"></i><br><?php echo $autoE ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group justify-content-center">
                        <div class="text-center">
                            <p class="fs-1" style="border-radius: 50%;color: #fff;background-color: #7F0E0E;width: 100px;height: 100px;"><i class="fas fa-motorcycle" style="margin: 10px;"></i><br><?php echo $motoE ?></p>
                        </div>
                    </div>
                </div>  
                <div class="col-md-4">
                    <div class="input-group justify-content-center">
                        <div class="text-center">
                            <p class="fs-1" style="border-radius: 50%;color: #fff;background-color: #7F0E0E;width: 100px;height: 100px;"><i class="fas fa-bicycle" style="margin: 10px;"></i><br><?php echo $biciE ?></p>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
        <!-- CUPOS DISPONIBLES -->
        <div class="col-md-3 p-3">
            <div class="input-group justify-content-center">
                <div class="card text-center" style="width: 18rem;border: 3px solid #003399; background-color: #337ab7; box-shadow: 0 0 8px #D0D0D0;">
                    <div class="col-md-12">
                            <div class="input-group justify-content-center">
                                <div class="text-center" style="margin: 50px;">
                                    <p class="fs-1 fw-bold" style="color: white">CUPOS</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="input-group justify-content-center">
                                <div class="text-center">
                                    <p class="fs-1" style="border-radius: 50%;background-color: white;width: 100px;height: 100px;margin: 20px;color: black"><i class="fas fa-car" style="margin: 10px;"></i><br><?php echo $parametrosA - $autoA ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="input-group justify-content-center">
                                <div class="text-center">
                                    <p class="fs-1" style="border-radius: 50%;background-color: white;width: 100px;height: 100px;margin: 20px;color: black"><i class="fas fa-motorcycle" style="margin: 10px;"></i><br><?php echo $parametrosM - $motoA ?></p>
                                </div>
                            </div>
                        </div>  
                        <div class="col-md-12">
                            <div class="input-group justify-content-center">
                                <div class="text-center">
                                    <p class="fs-1" style="border-radius: 50%;background-color: white;width: 100px;height: 100px;margin: 20px;color: black"><i class="fas fa-bicycle" style="margin: 10px;"></i><br><?php echo $parametrosB - $biciA ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="input-group justify-content-center">
                                <div class="text-center">
                                    <p class="fs-1" style="margin: 26px;"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



</body>

<!-- SCRIPTS -->
<script type="text/javascript" src="<?php echo base_url("assets/js/jquery-3.5.1.min.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>

</html>