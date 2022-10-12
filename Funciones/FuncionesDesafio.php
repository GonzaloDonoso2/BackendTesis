<?php

include "Conectores//ConectorBaseDatos.php";

class FuncionesDesafio extends ConectorBaseDatos {
    
    function registrarDesafio($nuevoValor){
        
        $idUsuario2 = $nuevoValor->idUsuario2;        
        $consulta = "select estado from Desafios where idUsuario2 = $idUsuario2 and estado = 'VIGENTE'";        
        $respuesta = $this->consultarBaseDatos($consulta);

        if(mysqli_num_rows($respuesta) > 0){
            
            echo "Este usuario ya tiene un desafío anterior vigente.";
            
        }else{

            $fecha = $nuevoValor->fecha;
            $idUsuario1 = $nuevoValor->idUsuario1;
            $colorUsuario1 = $nuevoValor->colorUsuario1;
            $consulta = "insert into Desafios (estado, fecha, idUsuario1, idUsuario2, colorUsuario1, colorUsuario2) values ('VIGENTE', '$fecha', $idUsuario1, $idUsuario2, '$colorUsuario1', 'SIN COLOR')";
            $this->consultarBaseDatos($consulta);
        }
    }
    
    function obtenerDesafio($nuevoValor){

        $idUsuario1 = $nuevoValor->idUsuario1;
        $idUsuario2 = $nuevoValor->idUsuario2;
        $colorUsuario1 = $nuevoValor->colorUsuario1;
        $fecha = $nuevoValor->fecha;
        $consulta = "select id from Desafios where idUsuario1 = $idUsuario1 and idUsuario2 = $idUsuario2 and colorUsuario1 = '$colorUsuario1' and colorUsuario2 = 'SIN COLOR' and fecha = '$fecha'";
        $respuesta = $this->consultarBaseDatos($consulta);
        
        foreach($respuesta as $key => $value){

            $idDesafio = $value["id"];
        }

        $jsonRespuesta[] = array(
            "idDesafio" => $idDesafio
        );

        $respuestaDesafio = json_encode($jsonRespuesta);

        echo $respuestaDesafio;
    }
    
    function obtenerRespuestaDesafio($nuevoValor){
        
        $idDesafio = $nuevoValor->id;
        $consulta = "select estado from Desafios where id = $idDesafio and estado != 'VIGENTE'";
        $respuesta = $this->consultarBaseDatos($consulta);

        if(mysqli_num_rows($respuesta) > 0){

            foreach($respuesta as $key => $value){
                
                $estadoDesafio = $value["estado"];
            }

            $jsonRespuesta[] = array(
                "estadoDesafio" => $estadoDesafio
            );

            $respuestaDesafio = json_encode($jsonRespuesta);

            echo $respuestaDesafio;
            
        }else{
            
            echo "Sin Respuesta.";
        }
    }
    
    function rechazarDesafio($nuevoValor){
        
        $idDesafio = $nuevoValor->idDesafio;
        $consulta = "update Desafios set estado = 'RECHAZADO' where id = $idDesafio";
        $this->consultarBaseDatos($consulta);
        echo "Desafío rechazado.";        
    }

    function buscarDesafio($nuevoValor){
        
        $idUsuario2 = $nuevoValor->idUsuario;
        $consulta = "select id, idUsuario1, colorUsuario1, fecha from Desafios where idUsuario2 = $idUsuario2 and estado = 'VIGENTE'";
        $respuesta = $this->consultarBaseDatos($consulta);
        $idDesafio = 0;
        $idUsuario1 = 0;
        $nombreUsuario1 = "";
        $colorUsuario1 = "";
        $fecha = "";

        if(mysqli_num_rows($respuesta) > 0){
            
            foreach($respuesta as $key => $value){

                $idDesafio = $value["id"];
                $idUsuario1 = $value["idUsuario1"];
                $colorUsuario1 = $value["colorUsuario1"];
                $fecha = $value["fecha"];
            }
            
            $consulta = "select nombre from Usuarios where id = $idUsuario1";
            $respuesta = $this->consultarBaseDatos($consulta);
            
            foreach($respuesta as $key => $value){

                $nombreUsuario1 = $value["nombre"];
            }

            $jsonRespuesta[] = array(
                
                "idDesafio" => $idDesafio,
                "idUsuario1" => $idUsuario1,
                "nombreUsuario1" => $nombreUsuario1,
                "colorUsuario1" => $colorUsuario1,
                "fecha" => $fecha
            );

            $respuestaDesafio = json_encode($jsonRespuesta);
            
            echo $respuestaDesafio;
            
        }else{
            
            echo "Sin desafios vigentes.";
        }        
    }
    
    function aceptarDesafio($nuevoValor){
        
        $idDesafio = $nuevoValor->idDesafio;
        $consulta = "update Desafios set estado = 'ACEPTADO' where id = $idDesafio";
        $this->consultarBaseDatos($consulta);
        $consulta = "insert into Batallas (estado, idDesafio) values ('VIGENTE', $idDesafio)";
        $this->consultarBaseDatos($consulta);
        echo "Desafío aceptado.";        
    }
    
    function seleccionarColorUsuario2($nuevoValor){
        
        $idDesafio = $nuevoValor->idDesafio;
        $colorUsuario2 = $nuevoValor->colorUsuario2;
        $consulta = "update Desafios set colorUsuario2 = '$colorUsuario2' where id = $idDesafio";
        $this->consultarBaseDatos($consulta);
        echo "Color seleccionado $colorUsuario2.";       
    }
}
