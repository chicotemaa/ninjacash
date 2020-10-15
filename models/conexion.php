<?php

class Conexion{

static public function conectar(){

		$link = new PDO("mysql:host=localhost;dbname=ninjacash","root","36966519");
		return $link;
		
	}

}