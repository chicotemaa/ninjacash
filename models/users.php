<?php 

require_once "conexion.php";

class GestorUsuariosModel{
    // selwccionar usuarios
    static public function seleccionarUsuariosModel($datosModel){
        $stmt = Conexion::conectar()->prepare("SELECT id, primer_nombre, foto, nivel1, puntaje_nivel1,
        nivel2, puntaje_nivel2, nivel3, puntaje_nivel3 FROM users WHERE identificador=:identificador ");
        $stmt->bindParam(":identificador",$datosModel["identificador"], PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
        $stmt->closeCursor();

    }



    // guardar usuarios
   static public function guardarUsuariosModel($datosModel){

    $stmt = Conexion::conectar()->prepare("INSERT INTO users(identificador, primer_nombre, foto, nivel1) VALUES
    (:identificador, :primer_nombre, :foto, :nivel1)");
    $stmt->bindParam(":identificador",$datosModel["identificador"], PDO::PARAM_INT);
    $stmt->bindParam(":primer_nombre",$datosModel["primer_nombre"], PDO::PARAM_STR);
    $stmt->bindParam(":foto",$datosModel["foto"], PDO::PARAM_STR);
    $stmt->bindParam(":nivel1",$datosModel["nivel1"], PDO::PARAM_STR);

    if($stmt->execute()){
        return "ok";
    }else{
        return "Error";
    }
    $stmt->closeCursor();

    }
    #SELECCIONAR PUNTAJES
	#------------------------------------------------------------
	static public function puntajesNivelModel($datos){

		$stmt = Conexion::conectar()->prepare("SELECT primer_nombre, foto, $datos FROM users ORDER BY $datos DESC LIMIT 3");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> closeCursor();

    }
    /**
     * Guardar Puntajes
     */

     static public function guardarPuntajesModel($datosModel,$tabla){
        $numeroNivel=$datosModel["numeroNivel"];
        $puntajeNivel=$datosModel["puntajeNivel"];
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $numeroNivel=:nivel, $puntajeNivel=:puntaje WHERE  id =:id");
     }

}