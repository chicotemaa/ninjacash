<?php 

class GestorUsuariosController{
    // guardar usuario
    static public function guardarUsuariosController($datos){
        $responseinsert="";

        $datosController = array ("identificador"=>$datos["identificador"],
                           "primer_nombre"=>$datos["primer_nombre"],
                          "foto"=>$datos["foto"],
                        "nivel1"=>"ok");
            $responseselect = GestorUsuariosModel::seleccionarUsuariosModel($datosController);

        if (!$responseselect) {
            $responseinsert = GestorUsuariosModel::guardarUsuariosModel($datosController);
        }
            if ($responseselect || $responseinsert =="ok" ) {
                $responseselect = GestorUsuariosModel::seleccionarUsuariosModel($datosController);
                session_start();
                
                
                $_SESSION["validar"] = true;
                $_SESSION["id"] = $responseselect["id"];;
                $_SESSION["primer_nombre"] = $responseselect["primer_nombre"];
                $_SESSION["foto"] = $responseselect["foto"];
                $_SESSION["nivel1"] = $responseselect["nivel1"];
                $_SESSION["nivel2"] = $responseselect["nivel2"];
                $_SESSION["nivel3"] = $responseselect["nivel3"];
                $_SESSION["puntaje_nivel1"] = $responseselect["puntaje_nivel1"];
                $_SESSION["puntaje_nivel2"] = $responseselect["puntaje_nivel2"];
                $_SESSION["puntaje_nivel3"] = $responseselect["puntaje_nivel3"];



               echo "ok";
            }
        

    }
    	#MEJORES PUNTAJES NIVEL
	#------------------------------------------------------------
	static public function puntajesNivelController($datos){

		$respuesta = GestorUsuariosModel::puntajesNivelModel($datos);

		foreach ($respuesta as $row => $item){

			if($item[$datos] > 0){

				echo '<li>
						<img src="'.$item["foto"].'">
						<h3>'.$item["primer_nombre"].'</h3>
						<h2>'.$item[$datos].'</h2>
					</li>';
			}

		}

	

}
/**
 * Guardar Puntajes
 */
 static public function guardarPuntajesController($datos){
     $numeroNivel=0;
     if ($datos["numeroNivel"]==3) {
         $numeroNivel=3;
     }
     if ($datos["numeroNivel"]<3) {
        $numeroNivel=$datos["numeroNivel"]+1;

     }
     $datosController= array("nivel"=>$datos["nivel"],
                            "points"=>$datos["points"],
                            "numeroNivel"=>"nivel".$numeroNivel,
                            "puntajeNivel"=>"puntajeNivel".$datos["numeroNivel"],
                            "id"=>$datos["id"]);
    $response = GestorUsuariosModel:: guardarUsuariosModel($datosController,"usuarios");
 } 

}