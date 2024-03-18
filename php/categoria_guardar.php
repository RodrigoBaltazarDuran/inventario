<?php
    require_once "./main.php";

    // Almacenando datos
    $nombre = limpiar_cadena($_POST['categoria_nombre']);
    $ubicacion = limpiar_cadena($_POST['categoria_ubicacion']);

    // Validar campos obligatorios no esten vacios
    if($nombre=="") {
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong>
                <br>
                No has llenado todos los campos que son obligatorios
            </div>
        ';
        exit();
    }
    
    // Verificando integridad de los datos
    if(verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{4,50}", $nombre)) {
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong>
                <br>
                El nombre no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    if ($ubicacion!="") {
        if(verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{5,150}", $ubicacion)) {
            echo '
                <div class="notification is-danger is-light">
                    <strong>¡Ocurrio un error inesperado!</strong>
                    <br>
                    La ubicación no coincide con el formato solicitado
                </div>
            ';
            exit();
        }
    }

    // Verificando categoria
    $check_nombre=conexion();
    $check_nombre=$check_nombre->query("SELECT categoria_nombre FROM categoria WHERE categoria_nombre='$nombre'");
    if ($check_nombre->rowCount()>0) {
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong>
                <br>
                La categoria ingresada ya se encuentra registrada, favor de agregar una categoría diferente
            </div>
        ';
        exit();
    }
    $check_nombre=null;

    // Guardando datos
    $guardar_categoria=conexion();
    $guardar_categoria=$guardar_categoria->prepare("INSERT INTO categoria(categoria_nombre,categoria_ubicacion) VALUES(:nombre,:ubicacion)");

    $marcadores = [
        ":nombre" => $nombre,
        ":ubicacion" => $ubicacion
    ];

    $guardar_categoria->execute($marcadores);

    if ($guardar_categoria->rowCount()==1) {
        echo '
            <div class="notification is-info is-light">
                <strong>CATEGORÍA REGISTRADA!</strong>
                <br>
                La categoría se registro con éxito
            </div>
        ';
    } else {
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong>
                <br>
                No se pudo registrar la categoría, por favor intente nuevamente
            </div>
        ';
    }
    // Cerrar conexión de base de datos
    $guardar_categoria=null;
