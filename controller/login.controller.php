<?php
header('Content-type: text/html; charset=utf-8' , true );
$mensaje="";
require_once '../model/login.model.php';

if(isset($_POST["txt_usuario"]) and isset($_POST["txt_password"])){

	$usuario_login =trim($_POST["txt_usuario"]);
	$usuario_clave=trim($_POST["txt_password"]);
	$rol=trim($_POST["txt_rol"]);
	$caja=trim($_POST["txt_caja"]);
	$turno=trim($_POST["txt_turno"]);
	
	//Declaramos el Objeto
	$objeto_usuario = new Usuarios();
	$login=$objeto_usuario->Login($usuario_login,$usuario_clave,$rol);
	$datos_usuario=$objeto_usuario->DatosUsuario($usuario_login);
	$datos_empresa=$objeto_usuario->DatosEmpresa();
	$apc=$objeto_usuario->AperCaja($usuario_login,$caja,$turno);
	$_SESSION["datosusuario"]=$datos_usuario;

	if($login == 1){
		//INGRESA AL SISTEMA
		$almm = $_SESSION["datosusuario"];
		foreach ($almm as $reg) {
			
			if($reg["id_rol"]==1){
				//ADMINISTRADOR
					$datos_caja=$objeto_usuario->DatosCaja($usuario_login,$caja,$turno);
					$objeto_usuario=NULL;
					session_start();

					$_SESSION["datosusuario"]=$datos_usuario;
					$_SESSION["datosempresa"]=$datos_empresa;
					$_SESSION["datoscaja"]=$datos_caja;

					$du = $_SESSION["datosusuario"];
					foreach ($du as $d) {
						$id_usu = $d['id_usu'];
					}

					$de = $_SESSION["datosempresa"];
					foreach ($de as $d) {
						$igv = ($d['igv'] / 100);
						$moneda = $d['moneda'];
					}

					$dc = $_SESSION["datoscaja"];
					foreach ($dc as $d) {
						$id_apc = $d['id_apc'];
					}

					$_SESSION["id_usu"] = $id_usu;
					$_SESSION["igv"] = $igv;
					$_SESSION["moneda"] = $moneda;
					$_SESSION["id_apc"] = $id_apc;
					$_SESSION["apertura"] = $apc;
					$_SESSION["rol_usr"] = $reg["id_rol"];

				if($apc == 1){
					//CAJA APERTURADA
	    			header("Location: ../lista_tm_tablero.php");
	    			
	    		} else{
	    			//CAJA SIN APERTURAR
	    			header("Location: ../advertencia.php");
	    		}
				
			}else if($reg["id_rol"]==2){
				//CAJERO
				$datos_caja=$objeto_usuario->DatosCaja($usuario_login,$caja,$turno);
				if($apc == 1){
					//CAJA APERTURADA
					$objeto_usuario=NULL;
					session_start();

					$_SESSION["datosusuario"]=$datos_usuario;
					$_SESSION["datosempresa"]=$datos_empresa;
					$_SESSION["datoscaja"]=$datos_caja;

					$du = $_SESSION["datosusuario"];
					foreach ($du as $d) {
						$id_usu = $d['id_usu'];
					}

					$de = $_SESSION["datosempresa"];
					foreach ($de as $d) {
						$igv = ($d['igv'] / 100);
						$moneda = $d['moneda'];
					}

					$dc = $_SESSION["datoscaja"];
					foreach ($dc as $d) {
						$id_apc = $d['id_apc'];
					}

					$_SESSION["id_usu"] = $id_usu;
					$_SESSION["igv"] = $igv;
					$_SESSION["moneda"] = $moneda;
					$_SESSION["id_apc"] = $id_apc;
					$_SESSION["apertura"] = $apc;
					$_SESSION["rol_usr"] = $reg["id_rol"];
		      		
					header("Location: ../inicio.php");
						
				} else {
					//CAJA NO APERTURADA
					header("Location: ../index.php?me=a");
				}

			}else if($reg["id_rol"]==3){

				//AREA DE PRODUCCION
				$objeto_usuario=NULL;
				session_start();
				$_SESSION["datosusuario"]=$datos_usuario;
				$_SESSION["datosempresa"]=$datos_empresa;

				$du = $_SESSION["datosusuario"];
				foreach ($du as $d) {
					$id_areap = $d['id_areap'];
				}
				$_SESSION["id_areap"] = $id_areap;
    			header("Location: ../lista_area_prod.php");

			}else if($reg["id_rol"]==4){

				//MOSO
				$objeto_usuario=NULL;
				session_start();
				$_SESSION["datosusuario"]=$datos_usuario;
				$du = $_SESSION["datosusuario"];
				foreach ($du as $d) {
					$id_usu = $d['id_usu'];
				}

				$_SESSION["datosempresa"]=$datos_empresa;
				$de = $_SESSION["datosempresa"];
				foreach ($de as $d) {
					$moneda = $d['moneda'];
				}

				$_SESSION["id_usu"] = $id_usu;
				$_SESSION["moneda"] = $moneda;
				$_SESSION["rol_usr"] = $reg["id_rol"];
				$_SESSION["apertura"] = 1;
    			header("Location: ../inicio.php");

			}else {
				header("Location: ../index.php");
			}
		}
	}else{
		//NO INGRESA AL SISTEMA
		header("Location: ../index.php?m=e");
	}						
}
?>
