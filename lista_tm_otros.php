<?php
session_start();
if(isset($_SESSION["datosusuario"])){
$almm = $_SESSION["datosusuario"];
foreach ($almm as $reg) {
if($reg["id_rol"] == 1){
}else{
    header("location: index.php");
}}}else{
    header("location: index.php");
}
?>

<?php
require_once 'controller/config/tm_otros.controller.php';

// Todo esta lógica hara el papel de un FrontController
if(!isset($_REQUEST['c'])){
    $controller = new ConfigController();
    $controller->Index();    
} else {
    
    // Obtenemos el controlador que queremos cargar
    $controller = $_REQUEST['c'] . 'Controller';
    $accion     = isset($_REQUEST['a']) ? $_REQUEST['a'] : 'Index';
    
    
    // Instanciamos el controlador
    $controller = new $controller();
    
    // Llama la accion
    call_user_func( array( $controller, $accion ) );
}

?>
