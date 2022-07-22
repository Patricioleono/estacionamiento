<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Estacionamiento - Lista de Espera</title>
    <link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.css"); ?>" />
    <link rel="stylesheet" href="<?php echo base_url("assets/css/dataTables.bootstrap5.min.css"); ?>" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <style type="text/css">
        ::selection {
            background-color: #E13300;
            color: white;
        }

        ::-moz-selection {
            background-color: #E13300;
            color: white;
        }

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

        #body {
            margin: 0 15px 0 15px;
            min-height: 96px;
        }

        p {
            margin: 0 0 10px;
            padding: 0;
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
            margin: 20px;
        }

        thead input {
            width: 100%;
        }

        .dataTables_filter,
        .dataTables_info {
            display: none;
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
                        <a class="nav-link" aria-current="page" href="<?php echo base_url("index.php/inicio/index") ?>">Inicio</a>
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
                        <a class="nav-link active" href="<?php echo base_url("index.php/espera/index") ?>">Lista de Espera</a>
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
        <h1><i class="fas fa-clock"></i> Lista de Espera</h1>
        <div class="form-group p-2">
            <div class="accordion" id="accordionPanelsStayOpenExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="false" aria-controls="panelsStayOpen-collapseOne">
                            <i class="fas fa-pause-circle"></i> &nbsp;&nbsp; Lista de espera de Solicitudes "Pendientes"
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingOne">
                        <div class="accordion-body">
                            <div id="container">
                                <h1><i class="fas fa-car"></i> Lista de Espera de Autos</h1>
                                <div class="form-group p-2">
                                    <div class="col-12 p-2">
                                        <table id="tablaDatos5" class="table" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th scope="col">ID</th>
                                                    <th scope="col">RUT</th>
                                                    <th scope="col">FECHA SOLICITUD</th>
                                                    <th scope="col">LISTA ESPERA</th>
                                                    <th scope="col">OBSERVACIONES</th>
                                                    <th scope="col">VEHICULO</th>
                                                </tr>
                                            </thead>
                                            <tbody">
                                                <?php foreach ($auto as $a) { ?>
                                                    <tr>
                                                        <td><?php echo $a['id']; ?></td>
                                                        <td><?php echo $a['rut']; ?></td>
                                                        <td><?php echo $a['fechasolicitud']; ?></td>
                                                        <td><?php echo $a['correlativolistaespera']; ?></td>
                                                        <td class="align-middle">
                                                            <?php if ($a['observaciones'] != "") { ?>
                                                                <a class="badge rounded-pill bg-secondary" data-bs-toggle="collapse" href="#observaciones_<?php echo $a['id'] ?>" role="button" aria-expanded="false" aria-controls="observaciones_<?php echo $a['id'] ?>"><i class="fas fa-eye"></i> Ver Observacion</a>
                                                                <div class="collapse" id="observaciones_<?php echo $a['id'] ?>">
                                                                    <?php echo $a['observaciones']; ?>
                                                                </div>
                                                            <?php } else { ?>
                                                                Sin Observaciones
                                                            <?php } ?>
                                                        </td>
                                                        <td class="align-middle">
                                                            <a class="badge rounded-pill bg-secondary" name="verAutoPendiente" data-id="<?php echo $a['id'] ?>" data-tipo="<?php echo $a['tipo'] ?>" data-bs-toggle="collapse" href="#vehiculo_<?php echo $a['id'] ?>" role="button" aria-expanded="false" aria-controls="vehiculo_<?php echo $a['id'] ?>"><i class="fas fa-car"></i> Ver Auto</a>
                                                            <div class="collapse" id="vehiculo_<?php echo $a['id'] ?>">
                                                                <p id="verAutoP_<?php echo $a['id'] ?>">

                                                                </p>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div id="container">
                                <h1><i class="fas fa-motorcycle"></i> Lista de Espera de Motos</h1>
                                <div class="form-group p-2">
                                    <div class="col-12 p-2">
                                        <table id="tablaDatos6" class="table" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th scope="col">ID</th>
                                                    <th scope="col">RUT</th>
                                                    <th scope="col">FECHA SOLICITUD</th>
                                                    <th scope="col">LISTA ESPERA</th>
                                                    <th scope="col">OBSERVACIONES</th>
                                                    <th scope="col">VEHICULO</th>
                                                </tr>
                                            </thead>
                                            <tbody">
                                                <?php foreach ($moto as $m) { ?>
                                                    <tr>
                                                        <td><?php echo $m['id']; ?></td>
                                                        <td><?php echo $m['rut']; ?></td>
                                                        <td><?php echo $m['fechasolicitud']; ?></td>
                                                        <td><?php echo $m['correlativolistaespera']; ?></td>
                                                        <td class="align-middle">
                                                            <?php if ($m['observaciones'] != "") { ?>
                                                                <a class="badge rounded-pill bg-secondary" data-bs-toggle="collapse" href="#observaciones_<?php echo $m['id'] ?>" role="button" aria-expanded="false" aria-controls="observaciones_<?php echo $m['id'] ?>"><i class="fas fa-eye"></i> Ver Observacion</a>
                                                                <div class="collapse" id="observaciones_<?php echo $m['id'] ?>">
                                                                    <div class="card card-body">
                                                                        <?php echo $m['observaciones']; ?>
                                                                    </div>
                                                                </div>
                                                            <?php } else { ?>
                                                                Sin Observaciones
                                                            <?php } ?>
                                                        </td>
                                                        </td>
                                                        <td class="align-middle">
                                                            <a class="badge rounded-pill bg-secondary" name="verMotoPendiente" data-id="<?php echo $m['id'] ?>" data-tipo="<?php echo $m['tipo'] ?>" data-bs-toggle="collapse" href="#vehiculo_<?php echo $m['id'] ?>" role="button" aria-expanded="false" aria-controls="vehiculo_<?php echo $m['id'] ?>"><i class="fas fa-motorcycle"></i> Ver Moto</a>
                                                            <div class="collapse" id="vehiculo_<?php echo $m['id'] ?>">
                                                                <p id="verMotoP<?php echo $m['id'] ?>">
                                                                    
                                                                </p>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                                </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div id="container">
                                <h1><i class="fas fa-bicycle"></i> Lista de Espera de Bicicletas</h1>
                                <div class="form-group p-2">
                                    <div class="col-12 p-2">
                                        <table id="tablaDatos7" class="table" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th scope="col">ID</th>
                                                    <th scope="col">RUT</th>
                                                    <th scope="col">FECHA SOLICITUD</th>
                                                    <th scope="col">LISTA ESPERA</th>
                                                    <th scope="col">OBERVACIONES</th>
                                                    <th scope="col">VEHICULO</th>
                                                </tr>
                                            </thead>
                                            <tbody">
                                                <?php foreach ($bici as $b) { ?>
                                                    <tr>
                                                        <td><?php echo $b['id']; ?></td>
                                                        <td><?php echo $b['rut']; ?></td>
                                                        <td><?php echo $b['fechasolicitud']; ?></td>
                                                        <td><?php echo $b['correlativolistaespera']; ?></td>
                                                        <td class="align-middle">
                                                            <?php if ($b['observaciones'] != "") { ?>
                                                                <a class="badge rounded-pill bg-secondary" data-bs-toggle="collapse" href="#observaciones_<?php echo $b['id'] ?>" role="button" aria-expanded="false" aria-controls="observaciones_<?php echo $b['id'] ?>"><i class="fas fa-eye"></i> Ver Observacion</a>
                                                                <div class="collapse" id="observaciones_<?php echo $b['id'] ?>">
                                                                    <div class="card card-body">
                                                                        <?php echo $b['observaciones']; ?>
                                                                    </div>
                                                                </div>
                                                            <?php } else { ?>
                                                                Sin Observaciones
                                                            <?php } ?>
                                                        </td>
                                                        <td class="align-middle">
                                                            <a class="badge rounded-pill bg-secondary" name="verBiciPendiente" data-id="<?php echo $b['id'] ?>" data-tipo="<?php echo $b['tipo'] ?>" data-bs-toggle="collapse" href="#vehiculo_<?php echo $b['id'] ?>" role="button" aria-expanded="false" aria-controls="vehiculo_<?php echo $b['id'] ?>"><i class="fas fa-bicycle"></i> Ver Bicicleta</a>
                                                            <div class="collapse" id="vehiculo_<?php echo $b['id'] ?>">
                                                                <p id="verBiciP_<?php echo $b['id'] ?>">
                                                                </p>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                                </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                            <i class="fas fa-check-circle"></i> &nbsp;&nbsp; Lista de Solicitudes "Autorizados"
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                        <div class="accordion-body">
                            <div id="container">
                                <h1><i class="fas fa-car"></i> Lista de Autos</h1>
                                <div class="form-group p-2">
                                    <div class="col-12 p-2">
                                        <table id="tablaDatos8" class="table" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th scope="col">ID</th>
                                                    <th scope="col">RUT</th>
                                                    <th scope="col">FECHA SOLICITUD</th>
                                                    <th scope="col">FECHA AUTORIZACION</th>
                                                    <th scope="col">OBSERVACIONES</th>
                                                    <th scope="col">OBSERVACION AUTORIZACION</th>
                                                    <th scope="col">VEHICULO</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($auto2 as $a2) { ?>
                                                    <tr>
                                                        <td><?php echo $a2['id']; ?></td>
                                                        <td><?php echo $a2['rut']; ?></td>
                                                        <td><?php echo $a2['fechasolicitud']; ?></td>
                                                        <td><?php echo $a2['fechaautorizacion']; ?></td>
                                                        <td class="align-middle">
                                                            <?php if ($a2['observaciones'] != "") { ?>
                                                                <a class="badge rounded-pill bg-secondary" data-bs-toggle="collapse" href="#observaciones_<?php echo $a2['id'] ?>" role="button" aria-expanded="false" aria-controls="observaciones_<?php echo $a2['id'] ?>"><i class="fas fa-eye"></i> Ver Observacion</a>
                                                                <div class="collapse" id="observaciones_<?php echo $a2['id'] ?>">
                                                                    <div class="card card-body">
                                                                        <?php echo $a2['observaciones']; ?>
                                                                    </div>
                                                                </div>
                                                            <?php } else { ?>
                                                                Sin Observaciones
                                                            <?php } ?>
                                                        </td>
                                                        <td class="align-middle">
                                                            <?php if ($a2['observacionautoriza'] != "") { ?>
                                                                <a class="badge rounded-pill bg-secondary" data-bs-toggle="collapse" href="#observacionesA_<?php echo $a2['id'] ?>" role="button" aria-expanded="false" aria-controls="observacionesA_<?php echo $a2['id'] ?>"><i class="fas fa-eye"></i> Ver Observacion</a>
                                                                <div class="collapse" id="observacionesA_<?php echo $a2['id'] ?>">
                                                                    <div class="card card-body">
                                                                        <?php echo $a2['observacionautoriza']; ?>
                                                                    </div>
                                                                </div>
                                                            <?php } else { ?>
                                                                Sin Observaciones
                                                            <?php } ?>
                                                        </td>
                                                        <td class="align-middle">
                                                            <a class="badge rounded-pill bg-secondary" name="verAutoAutorizada" data-id="<?php echo $a2['id'] ?>" data-tipo="<?php echo $a2['tipo'] ?>" data-bs-toggle="collapse" href="#vehiculo_<?php echo $a2['id'] ?>" role="button" aria-expanded="false" aria-controls="vehiculo_<?php echo $a2['id'] ?>"><i class="fas fa-car"></i> Ver Auto</a>
                                                            <div class="collapse" id="vehiculo_<?php echo $a2['id'] ?>">
                                                                <p id="verAutoA_<?php echo $a2['id'] ?>">

                                                                </p>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div id="container">
                                <h1><i class="fas fa-motorcycle"></i> Lista de Motos</h1>
                                <div class="form-group p-2">
                                    <div class="col-12 p-2">
                                        <table id="tablaDatos9" class="table" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th scope="col">ID</th>
                                                    <th scope="col">RUT</th>
                                                    <th scope="col">FECHA SOLICITUD</th>
                                                    <th scope="col">FECHA AUTORIZACION</th>
                                                    <th scope="col">OBSERVACIONES</th>
                                                    <th scope="col">OBSERVACION AUTORIZACION</th>
                                                    <th scope="col">VEHICULO</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($moto2 as $m2) { ?>
                                                    <tr>
                                                        <td><?php echo $m2['id']; ?></td>
                                                        <td><?php echo $m2['rut']; ?></td>
                                                        <td><?php echo $m2['fechasolicitud']; ?></td>
                                                        <td><?php echo $m2['fechaautorizacion']; ?></td>
                                                        <td class="align-middle">
                                                            <?php if ($m2['observaciones'] != "") { ?>
                                                                <a class="badge rounded-pill bg-secondary" data-bs-toggle="collapse" href="#observaciones_<?php echo $m2['id'] ?>" role="button" aria-expanded="false" aria-controls="observaciones_<?php echo $m2['id'] ?>"><i class="fas fa-eye"></i> Ver Observacion</a>
                                                                <div class="collapse" id="observaciones_<?php echo $m2['id'] ?>">
                                                                    <div class="card card-body">
                                                                        <?php echo $m2['observaciones']; ?>
                                                                    </div>
                                                                </div>
                                                            <?php } else { ?>
                                                                Sin Observaciones
                                                            <?php } ?>
                                                        </td>
                                                        <td class="align-middle">
                                                            <?php if ($m2['observacionautoriza'] != "") { ?>
                                                                <a class="badge rounded-pill bg-secondary" data-bs-toggle="collapse" href="#observacionesA_<?php echo $m2['id'] ?>" role="button" aria-expanded="false" aria-controls="observacionesA_<?php echo $m2['id'] ?>"><i class="fas fa-eye"></i> Ver Observacion</a>
                                                                <div class="collapse" id="observacionesA_<?php echo $m2['id'] ?>">
                                                                    <div class="card card-body">
                                                                        <?php echo $m2['observacionautoriza']; ?>
                                                                    </div>
                                                                </div>
                                                            <?php } else { ?>
                                                                Sin Observaciones
                                                            <?php } ?>
                                                        </td>
                                                        <td class="align-middle">
                                                            <a class="badge rounded-pill bg-secondary" name="verMotoAutorizada" data-id="<?php echo $m2['id'] ?>" data-tipo="<?php echo $m2['tipo'] ?>" data-bs-toggle="collapse" href="#vehiculo_<?php echo $m2['id'] ?>" role="button" aria-expanded="false" aria-controls="vehiculo_<?php echo $m2['id'] ?>"><i class="fas fa-motorcycle"></i> Ver Moto</a>
                                                            <div class="collapse" id="vehiculo_<?php echo $m2['id'] ?>">
                                                                <p id="verMotoA_<?php echo $m2['id'] ?>">
                                                                    
                                                                </p>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div id="container">
                                <h1><i class="fas fa-bicycle"></i> Lista de Bicicletas</h1>
                                <div class="form-group p-2">
                                    <div class="col-12 p-2">
                                        <table id="tablaDatos10" class="table" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th scope="col">ID</th>
                                                    <th scope="col">RUT</th>
                                                    <th scope="col">FECHA SOLICITUD</th>
                                                    <th scope="col">FECHA AUTORIZACION</th>
                                                    <th scope="col">OBSERVACIONES</th>
                                                    <th scope="col">OBSERVACION AUTORIZACION</th>
                                                    <th scope="col">VEHICULO</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($bici2 as $b2) { ?>
                                                    <tr>
                                                        <td><?php echo $b2['id']; ?></td>
                                                        <td><?php echo $b2['rut']; ?></td>
                                                        <td><?php echo $b2['fechasolicitud']; ?></td>
                                                        <td><?php echo $b2['fechaautorizacion']; ?></td>
                                                        <td class="align-middle">
                                                            <?php if ($b2['observaciones'] != "") { ?>
                                                                <a class="badge rounded-pill bg-secondary" data-bs-toggle="collapse" href="#observaciones_<?php echo $b2['id'] ?>" role="button" aria-expanded="false" aria-controls="observaciones_<?php echo $b2['id'] ?>"><i class="fas fa-eye"></i> Ver Observacion</a>
                                                                <div class="collapse" id="observaciones_<?php echo $b2['id'] ?>">
                                                                    <div class="card card-body">
                                                                        <?php echo $b2['observaciones']; ?>
                                                                    </div>
                                                                </div>
                                                            <?php } else { ?>
                                                                Sin Observaciones
                                                            <?php } ?>
                                                        </td>
                                                        <td class="align-middle">
                                                            <?php if ($b2['observacionautoriza'] != "") { ?>
                                                                <a class="badge rounded-pill bg-secondary" data-bs-toggle="collapse" href="#observacionesA_<?php echo $b2['id'] ?>" role="button" aria-expanded="false" aria-controls="observacionesA_<?php echo $b2['id'] ?>"><i class="fas fa-eye"></i> Ver Observacion</a>
                                                                <div class="collapse" id="observacionesA_<?php echo $b2['id'] ?>">
                                                                    <div class="card card-body">
                                                                        <?php echo $b2['observacionautoriza']; ?>
                                                                    </div>
                                                                </div>
                                                            <?php } else { ?>
                                                                Sin Observaciones
                                                            <?php } ?>
                                                        </td>
                                                        <td class="align-middle">
                                                            <a class="badge rounded-pill bg-secondary" name="verBiciAutorizada" data-id="<?php echo $b2['id'] ?>" data-tipo="<?php echo $b2['tipo'] ?>" data-bs-toggle="collapse" href="#vehiculo_<?php echo $b2['id'] ?>" role="button" aria-expanded="false" aria-controls="vehiculo_<?php echo $b2['id'] ?>"><i class="fas fa-bicycle"></i> Ver Bicicleta</a>
                                                            <div class="collapse" id="vehiculo_<?php echo $b2['id'] ?>">
                                                                <p id="verBiciA_<?php echo $b2['id'] ?>">
                                                                </p>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                            <i class="fas fa-times-circle"></i> &nbsp;&nbsp; Lista de Solicitudes "Rechazados"
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">
                        <div class="accordion-body">
                            <div id="container">
                                <h1><i class="fas fa-car"></i> Lista de Autos</h1>
                                <div class="form-group p-2">
                                    <div class="col-12 p-2">
                                        <table id="tablaDatos11" class="table" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th scope="col">ID</th>
                                                    <th scope="col">RUT</th>
                                                    <th scope="col">FECHA SOLICITUD</th>
                                                    <th scope="col">FECHA RECHAZO</th>
                                                    <th scope="col">OBSERVACIONES</th>
                                                    <th scope="col">MOTIVO</th>
                                                </tr>
                                            </thead>
                                            <tbody">
                                                <?php foreach ($auto3 as $a3) { ?>
                                                    <tr>
                                                        <td><?php echo $a3['id']; ?></td>
                                                        <td><?php echo $a3['rut']; ?></td>
                                                        <td><?php echo $a3['fechasolicitud']; ?></td>
                                                        <td><?php echo $a3['fecharechazo']; ?></td>
                                                        <td class="align-middle">
                                                            <?php if ($a3['observaciones'] != "") { ?>
                                                                <a class="badge rounded-pill bg-secondary" data-bs-toggle="collapse" href="#observaciones_<?php echo $a3['id'] ?>" role="button" aria-expanded="false" aria-controls="observaciones_<?php echo $a3['id'] ?>"><i class="fas fa-eye"></i> Ver Observacion</a>
                                                                <div class="collapse" id="observaciones_<?php echo $a3['id'] ?>">
                                                                    <div class="card card-body">
                                                                        <?php echo $a3['observaciones']; ?>
                                                                    </div>
                                                                </div>
                                                            <?php } else { ?>
                                                                Sin Observaciones
                                                            <?php } ?>
                                                        </td>
                                                        <td class="align-middle">
                                                            <?php if ($a3['motivorechazo'] != "") { ?>
                                                                <a class="badge rounded-pill bg-secondary" data-bs-toggle="collapse" href="#motivorechazo_<?php echo $a3['id'] ?>" role="button" aria-expanded="false" aria-controls="motivorechazo_<?php echo $a3['id'] ?>"><i class="fas fa-eye"></i> Ver Motivo</a>
                                                                <div class="collapse" id="motivorechazo_<?php echo $a3['id'] ?>">
                                                                    <div class="card card-body">
                                                                        <?php echo $a3['motivorechazo']; ?>
                                                                    </div>
                                                                </div>
                                                            <?php } else { ?>
                                                                Sin Motivos
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                                </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div id="container">
                                <h1><i class="fas fa-motorcycle"></i> Lista de Motos</h1>
                                <div class="form-group p-2">
                                    <div class="col-12 p-2">
                                        <table id="tablaDatos12" class="table" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th scope="col">ID</th>
                                                    <th scope="col">RUT</th>
                                                    <th scope="col">FECHA SOLICITUD</th>
                                                    <th scope="col">FECHA RECHAZO</th>
                                                    <th scope="col">OBSERVACIONES</th>
                                                    <th scope="col">MOTIVO</th>
                                                </tr>
                                            </thead>
                                            <tbody">
                                                <?php foreach ($moto3 as $m3) { ?>
                                                    <tr>
                                                        <td><?php echo $m3['id']; ?></td>
                                                        <td><?php echo $m3['rut']; ?></td>
                                                        <td><?php echo $m['fechasolicitud']; ?></td>
                                                        <td><?php echo $m3['fecharechazo']; ?></td>
                                                        <td class="align-middle">
                                                            <?php if ($m3['observaciones'] != "") { ?>
                                                                <a class="badge rounded-pill bg-secondary" data-bs-toggle="collapse" href="#observaciones_<?php echo $m3['id'] ?>" role="button" aria-expanded="false" aria-controls="observaciones_<?php echo $m3['id'] ?>"><i class="fas fa-eye"></i> Ver Observacion</a>
                                                                <div class="collapse" id="observaciones_<?php echo $m3['id'] ?>">
                                                                    <div class="card card-body">
                                                                        <?php echo $m3['observaciones']; ?>
                                                                    </div>
                                                                </div>
                                                            <?php } else { ?>
                                                                Sin Observaciones
                                                            <?php } ?>
                                                        </td>
                                                        <td class="align-middle">
                                                            <?php if ($m3['motivorechazo'] != "") { ?>
                                                                <a class="badge rounded-pill bg-secondary" data-bs-toggle="collapse" href="#motivorechazo_<?php echo $m3['id'] ?>" role="button" aria-expanded="false" aria-controls="motivorechazo_<?php echo $m3['id'] ?>"><i class="fas fa-eye"></i> Ver Motivo</a>
                                                                <div class="collapse" id="motivorechazo_<?php echo $m3['id'] ?>">
                                                                    <div class="card card-body">
                                                                        <?php echo $m3['motivorechazo']; ?>
                                                                    </div>
                                                                </div>
                                                            <?php } else { ?>
                                                                Sin Motivos
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                                </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div id="container">
                                <h1><i class="fas fa-bicycle"></i> Lista de Bicicletas</h1>
                                <div class="form-group p-2">
                                    <div class="col-12 p-2">
                                        <table id="tablaDatos13" class="table" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th scope="col">ID</th>
                                                    <th scope="col">RUT</th>
                                                    <th scope="col">FECHA SOLICITUD</th>
                                                    <th scope="col">FECHA RECHAZO</th>
                                                    <th scope="col">OBSERVACIONES</th>
                                                    <th scope="col">MOTIVO</th>
                                                </tr>
                                            </thead>
                                            <tbody">
                                                <?php foreach ($bici3 as $b3) { ?>
                                                    <tr>
                                                        <td><?php echo $b3['id']; ?></td>
                                                        <td><?php echo $b3['rut']; ?></td>
                                                        <td><?php echo $b3['fechasolicitud']; ?></td>
                                                        <td><?php echo $b3['fecharechazo']; ?></td>
                                                        <td class="align-middle">
                                                            <?php if ($b3['observaciones'] != "") { ?>
                                                                <a class="badge rounded-pill bg-secondary" data-bs-toggle="collapse" href="#observaciones_<?php echo $b3['id'] ?>" role="button" aria-expanded="false" aria-controls="observaciones_<?php echo $b3['id'] ?>"><i class="fas fa-eye"></i> Ver Observacion</a>
                                                                <div class="collapse" id="observaciones_<?php echo $b3['id'] ?>">
                                                                    <div class="card card-body">
                                                                        <?php echo $b3['observaciones']; ?>
                                                                    </div>
                                                                </div>
                                                            <?php } else { ?>
                                                                Sin Observaciones
                                                            <?php } ?>
                                                        </td>
                                                        <td class="align-middle">
                                                            <?php if ($b3['motivorechazo'] != "") { ?>
                                                                <a class="badge rounded-pill bg-secondary" data-bs-toggle="collapse" href="#motivorechazo_<?php echo $b3['id'] ?>" role="button" aria-expanded="false" aria-controls="motivorechazo_<?php echo $b3['id'] ?>"><i class="fas fa-eye"></i> Ver Motivo</a>
                                                                <div class="collapse" id="motivorechazo_<?php echo $b3['id'] ?>">
                                                                    <div class="card card-body">
                                                                        <?php echo $b3['motivorechazo']; ?>
                                                                    </div>
                                                                </div>
                                                            <?php } else { ?>
                                                                Sin Motivos
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                                </tbody>
                                        </table>
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
<script type="text/javascript" src="<?php echo base_url("assets/js/jquery.dataTables.min.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/dataTables.bootstrap5.min.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/views/espera.js"); ?>"></script>
<script>
    $("body").delegate( "[name=verAutoPendiente]", "click",function() {
        var id = $(this).attr("data-id");
        var tipo = $(this).attr("data-tipo");

        $.ajax({
            url: '<?=base_url()?>index.php/vehiculo/ver_vehiculo',
            method: 'post',
            data: {
                id             : id,
                tipo           : tipo
            },
            dataType: 'json'
        }).done(function(result) 
        {
            $("#verAutoP_"+id+"").empty();
            $.each(result, function(idx, opt) {
                
            $("#verAutoP_"+opt.idsolicitud+"").append('<li>Marca: ' + opt.marca + '</li><li>Modelo: ' + opt.modelo + '</li><li>Patente: ' + opt.patente + '</li>');
            });
            
        })
    })
    $("body").delegate( "[name=verMotoPendiente]", "click",function() {
        var id = $(this).attr("data-id");
        var tipo = $(this).attr("data-tipo");

        $.ajax({
            url: '<?=base_url()?>index.php/vehiculo/ver_vehiculo',
            method: 'post',
            data: {
                id             : id,
                tipo           : tipo
            },
            dataType: 'json'
        }).done(function(result) 
        {
            $("#verMotoP_"+id+"").empty();
            $.each(result, function(idx, opt) {
                
            $("#verMotoP_"+opt.idsolicitud+"").append('<li>Marca: ' + opt.marca + '</li><li>Modelo: ' + opt.modelo + '</li><li>Patente: ' + opt.patente + '</li>');
            });
            
        })
    })
    $("body").delegate( "[name=verBiciPendiente]", "click",function() {
        var id = $(this).attr("data-id");
        var tipo = $(this).attr("data-tipo");

        $.ajax({
            url: '<?=base_url()?>index.php/vehiculo/ver_vehiculo',
            method: 'post',
            data: {
                id             : id,
                tipo           : tipo
            },
            dataType: 'json'
        }).done(function(result) 
        {
            $("#verBiciP_"+id+"").empty();
            $.each(result, function(idx, opt) {
                
            $("#verBiciP_"+opt.idsolicitud+"").append('<li>Marca: ' + opt.marca + '</li><li>Modelo: ' + opt.modelo + '</li>');
            });
            
        })
    })
    $("body").delegate( "[name=verAutoAutorizada]", "click",function() {
        var id = $(this).attr("data-id");
        var tipo = $(this).attr("data-tipo");

        $.ajax({
            url: '<?=base_url()?>index.php/vehiculo/ver_vehiculo',
            method: 'post',
            data: {
                id             : id,
                tipo           : tipo
            },
            dataType: 'json'
        }).done(function(result) 
        {
            $("#verAutoA_"+id+"").empty();
            $.each(result, function(idx, opt) {
                
            $("#verAutoA_"+opt.idsolicitud+"").append('<li>Marca: ' + opt.marca + '</li><li>Modelo: ' + opt.modelo + '</li><li>Patente: ' + opt.patente + '</li>');
            });
            
        })
    })
    $("body").delegate( "[name=verMotoAutorizada]", "click",function() {
        var id = $(this).attr("data-id");
        var tipo = $(this).attr("data-tipo");

        $.ajax({
            url: '<?=base_url()?>index.php/vehiculo/ver_vehiculo',
            method: 'post',
            data: {
                id             : id,
                tipo           : tipo
            },
            dataType: 'json'
        }).done(function(result) 
        {
            $("#verMotoA_"+id+"").empty();
            $.each(result, function(idx, opt) {
                
            $("#verMotoA_"+opt.idsolicitud+"").append('<li>Marca: ' + opt.marca + '</li><li>Modelo: ' + opt.modelo + '</li><li>Patente: ' + opt.patente + '</li>');
            });
            
        })
    })
    $("body").delegate( "[name=verBiciAutorizada]", "click",function() {
        var id = $(this).attr("data-id");
        var tipo = $(this).attr("data-tipo");

        $.ajax({
            url: '<?=base_url()?>index.php/vehiculo/ver_vehiculo',
            method: 'post',
            data: {
                id             : id,
                tipo           : tipo
            },
            dataType: 'json'
        }).done(function(result) 
        {
            $("#verBiciA_"+id+"").empty();
            $.each(result, function(idx, opt) {
                
            $("#verBiciA_"+opt.idsolicitud+"").append('<li>Marca: ' + opt.marca + '</li><li>Modelo: ' + opt.modelo + '</li>');
            });
            
        })
    })
</script>

</html>