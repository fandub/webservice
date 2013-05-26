<?php
include('lib/nusoap.php');

    $user1 = $_POST['rut'];
    $user2 = $_POST['digito'];
    $rut = "$user1-$user2";
    
    $parametros=array();
    $parametros['rut']= $rut;
    $parametros['password']= $_POST['Pass'];
    
    $parametros['password']=  strtoupper ( $parametros['password'] );
    $parametros['password']= hash( "sha256", $parametros['password'] );
    
    $objClienteSOAP = new soapclient("http://informatica.utem.cl:8011/dirdoc-auth/ws/auth?wsdl");
    $objRespuesta = $objClienteSOAP->autenticar($parametros);

    
    if($objRespuesta->return->codigo == 1)
    {
        echo "Acceso Concedido.";
    }
    else
    {
        if($objRespuesta->return->codigo == 0)
        {
            echo "Datos Incompletos.    Ingrese Datos Faltantes";
        }
        else
        {
            echo "Contraseña Y/O Usuario Invalidos.....";
        }
    }
 ?>
