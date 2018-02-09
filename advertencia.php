<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema para restaurantes, cevicherias, entre otros</title>
    <link href='assets/img/restepe.ico' rel='shortcut icon' type='image/x-icon'/>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="assets/css/animate.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body class="gray-bg" style="background: url(assets/img/login-bg.png) #e9e9e9 repeat;">
    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div class="ibox-content">
                <center><img src="assets/img/logo-sistema.png"/></center>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-transparent text-center p-md"> <i class="fa fa-warning fa-3x text-warning"></i> <h2 class="m-t-none m-b-sm">Advertencia</h2> <p>Los datos seleccionados no coinciden con una Apertura de Caja</p><br>¿Desea continuar de todas formas?</div>
                    </div>
                </div>
            </div>
            <div class="ibox-footer">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="text-left">
                            <a href="close_session.php" class="btn btn-warning">Regresar</a>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="text-right">
                            <a href="lista_tm_tablero.php" class="btn btn-primary">Continuar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<!-- Mainly scripts -->
<script src="assets/js/jquery-2.1.1.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script type="text/javascript">
    /*<![CDATA[*/
    document.oncontextmenu=function(){return!1},document.onselectstart=function(){return"text"!=event.srcElement.type&&"textarea"!=event.srcElement.type&&"password"!=event.srcElement.type?!1:!0},window.sidebar&&(document.onmousedown=function(e){var t=e.target;return"SELECT"==t.tagName.toUpperCase()||"INPUT"==t.tagName.toUpperCase()||"TEXTAREA"==t.tagName.toUpperCase()||"PASSWORD"==t.tagName.toUpperCase()?!0:!1}),document.ondragstart=function(){return!1};
    /*]]>*/
</script>
</html>
