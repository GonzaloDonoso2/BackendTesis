<?php

include "Funciones//FuncionesBatalla.php";

class ControladorBatalla extends FuncionesBatalla {
    
    function recibirSolicitud($metodo, $parametro){
        
        $nuevoParametro = urldecode($parametro[0]);
        
        if ($metodo === "DELETE"){
            
            if ($nuevoParametro === "usuario") {
                
                $valor = urldecode($parametro[1]);
                $nuevoValor = json_decode($valor);
                $this->borrarRegistro($nuevoValor);
            }
            
        }elseif($metodo === "GET"){
            
            if($nuevoParametro === "desafio"){
                
                $valor = urldecode($parametro[1]);
                $nuevoValor = json_decode($valor);
                $this->iniciarBatalla($nuevoValor);
            
            }elseif($nuevoParametro === "idDesafio"){
                
                $valor = urldecode($parametro[1]);
                $nuevoValor = json_decode($valor);
                $this->obtenerRespuestaDesafio($nuevoValor);
                
            } elseif($nuevoParametro === "usuario"){
                
                $valor = urldecode($parametro[1]);
                $nuevoValor = json_decode($valor);
                $this->buscarDesafio($nuevoValor);            
            }
            
        }elseif($metodo === "POST") {
            
            if ($nuevoParametro === "desafio"){
                
                $valor = urldecode($parametro[1]);
                $nuevoValor = json_decode($valor);
                $this->registrarDesafio($nuevoValor);
            }
            
        } elseif($metodo === "PUT"){
            
            if($nuevoParametro === "desafioAceptado"){

                $valor = urldecode($parametro[1]);
                $nuevoValor = json_decode($valor);
                $this->aceptarDesafio($nuevoValor);
                
            }else if($nuevoParametro === "desafioRechazado"){
                
                $valor = urldecode($parametro[1]);
                $nuevoValor = json_decode($valor);
                $this->rechazarDesafio($nuevoValor); 
                
            }else if($nuevoParametro === "desafio"){
                
                $valor = urldecode($parametro[1]);
                $nuevoValor = json_decode($valor);
                $this->seleccionarColorUsuario2($nuevoValor);
            }           
        }
    }
}
