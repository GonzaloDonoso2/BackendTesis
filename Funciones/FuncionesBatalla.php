<?php

include "Conectores//ConectorBaseDatos.php";

class FuncionesBatalla extends ConectorBaseDatos {
    
    function iniciarBatalla ($nuevoValor) {
        
        $idDesafio = $nuevoValor->id;
        $consulta = "select idUsuario1, idUsuario2, colorUsuario1, colorUsuario2 from Desafios where id = $idDesafio";
        $respuesta = $this->consultarBaseDatos($consulta);
        $jsonRespuesta = array();
        
        foreach ($respuesta as $key => $value) {
            
            $idUsuario1 = $value["idUsuario1"];
            $idUsuario2 = $value["idUsuario2"];
            $colorUsuario1 = $value["colorUsuario1"];
            $colorUsuario2 = $value["colorUsuario2"];
        }
        
        $consulta = "select nombre from Usuarios where id = $idUsuario1";
        $respuesta = $this->consultarBaseDatos($consulta);
        
        foreach ($respuesta as $key => $value) {
            
            $nombreUsuario1 = $value["nombre"];
        }
        
        $consulta = "select nombre from Usuarios where id = $idUsuario2";
        $respuesta = $this->consultarBaseDatos($consulta);
        
        foreach ($respuesta as $key => $value) {
            
            $nombreUsuario2 = $value["nombre"];
        }
        
        $jsonRespuesta[] = array(
            "usuario1" => [
                "idUsuario1" => $idUsuario1,
                "nombreUsuario1" => $nombreUsuario1,
                "colorUsuario1" => $colorUsuario1                    
            ]
        );
        
        $jsonRespuesta[] = array(
            "usuario2" => [
                "idUsuario2" => $idUsuario2,
                "nombreUsuario2" => $nombreUsuario2,
                "colorUsuario2" => $colorUsuario2                    
            ]
        );
        
        $consulta = "select * from Personajes where idUsuario = $idUsuario1 and estado = 'VIGENTE'";
        $respuesta = $this->consultarBaseDatos($consulta);
        
        foreach ($respuesta as $key => $value) {
            
            $idPersonaje = $value["id"];
            $nombrePersonaje = $value["nombre"];
            $alcanceArma = $value["alcanceArma"];
            $ataqueArma = $value["ataqueArma"];
            $categoria = $value["categoria"];
            $danoArma = $value["danoArma"];
            $defensaArma = $value["defensaArma"];
            $defensaArmadura = $value["defensaArmadura"];
            $evasion = $value["evasion"];
            $iniciativa = $value["movimiento"];
            $punteriaArma = $value["punteriaArma"];
            $resistenciaArma = $value["resistenciaArma"];
            $resistenciaArmadura = $value["resistenciaArmadura"];
            $salud = $value["salud"];
            $tipoDano = $value["tipoDano"];    
            
            $jsonRespuesta[] = array(
                "personajesUsuario1" => [
                    "idPersonaje" => $idPersonaje,
                    "nombrePersonaje" => $nombrePersonaje,
                    "alcanceArma" => $alcanceArma,
                    "ataqueArma" => $ataqueArma,
                    "categoria" => $categoria,
                    "danoArma" => $danoArma,
                    "defensaArma" => $defensaArma,
                    "defensaArmadura" => $defensaArmadura,
                    "evasion" => $evasion,
                    "iniciativa" => $iniciativa,
                    "punteriaArma" => $punteriaArma,
                    "resistenciaArma" => $resistenciaArma,
                    "resistenciaArmadura" => $resistenciaArmadura,
                    "salud" => $salud,
                    "tipoDano" => $tipoDano,
                    "idUsuario" => $idUsuario1
                ]                
            );
        }
        
        $consulta = "select * from Personajes where idUsuario = $idUsuario2 and estado = 'VIGENTE'";
        $respuesta = $this->consultarBaseDatos($consulta);
        
        foreach ($respuesta as $key => $value) {
            
            $idPersonaje = $value["id"];
            $nombrePersonaje = $value["nombre"];
            $alcanceArma = $value["alcanceArma"];
            $ataqueArma = $value["ataqueArma"];
            $categoria = $value["categoria"];
            $danoArma = $value["danoArma"];
            $defensaArma = $value["defensaArma"];
            $defensaArmadura = $value["defensaArmadura"];
            $evasion = $value["evasion"];
            $iniciativa = $value["movimiento"];
            $punteriaArma = $value["punteriaArma"];
            $resistenciaArma = $value["resistenciaArma"];
            $resistenciaArmadura = $value["resistenciaArmadura"];
            $salud = $value["salud"];
            $tipoDano = $value["tipoDano"];    
            
            $jsonRespuesta[] = array(
                "personajesUsuario2" => [                
                    "idPersonaje" => $idPersonaje,
                    "nombrePersonaje" => $nombrePersonaje,
                    "alcanceArma" => $alcanceArma,
                    "ataqueArma" => $ataqueArma,
                    "categoria" => $categoria,
                    "danoArma" => $danoArma,
                    "defensaArma" => $defensaArma,
                    "defensaArmadura" => $defensaArmadura,
                    "evasion" => $evasion,
                    "iniciativa" => $iniciativa,
                    "punteriaArma" => $punteriaArma,
                    "resistenciaArma" => $resistenciaArma,
                    "resistenciaArmadura" => $resistenciaArmadura,
                    "salud" => $salud,
                    "tipoDano" => $tipoDano,
                    "idUsuario" => $idUsuario2
                ]                
            );
        }

        $respuestaBatalla = json_encode($jsonRespuesta);
        
        echo $respuestaBatalla;        
    }
}
