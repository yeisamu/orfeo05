<?php
    require_once "nusoap/nusoap.php";

      
    function genRadi($idPqrsGCI,$numCuenta,$nombreCompleto,$tipDoc,$numDoc,$email,$dirNoti,$telefono,$tipTramite,$detalleCausal,$Asunto) {
                  return "20143000000002";
    }
      
    function closeRadi($numRad) {
                  return "0";
    }

    $server = new soap_server();
    $server->configureWSDL("PQRS", "urn:PQRS");
      
    $server->register("genRadi",
        array("idPqrsGCI" => "xsd:int",
              "numCuenta" => "xsd:string",
              "nombreCompleto" => "xsd:string",
              "tipDoc" => "xsd:string",
              "numDoc" => "xsd:string",
              "email" => "xsd:string",
              "dirNoti" => "xsd:string",
              "telefono" => "xsd:string",
              "tipTramite" => "xsd:string",
              "detalleCausal" => "xsd:string",
              "Asunto" => "xsd:string"),
        array("return" => "xsd:string"),
        "urn:PQRS",
        "urn:PQRS#genRadi",
        "rpc",
        "encoded",
        "Genera el radicado de entrada en el SGD Orfeo, ingresando los datos adjuntados como variables en el metodo genRadi");

    $server->register("closeRadi",
        array("numRad" => "xsd:int"),
        array("return" => "xsd:int"),
        "urn:PQRS",
        "urn:PQRS#closeRadi",
        "rpc",
        "encoded",
        "Archiva el radicado de entrada en el SGD Orfeo, indicado bajo la variable -numRad-");


      
    $server->service($HTTP_RAW_POST_DATA);
?>
