<?php
    if (!class_exists("LogSystem")) {
        include $_SERVER["DOCUMENT_ROOT"].'/store/models/Logs/LogSystem.php';
        // include '../../models/Logs/LogSystem.php ';
    }

    $LogSystem = new LogSystem();
    $Log = $LogSystem->List_Log(" where t99_pk01 = '".$_REQUEST['logID']."' ","",false)->records[0];
    // print_r($Log);
    // echo $_SERVER["DOCUMENT_ROOT"].'/store/models/Logs/LogSystem.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://www.jqueryscript.net/demo/jQuery-Plugin-For-Easily-Readable-JSON-Data-Viewer/json-viewer/jquery.json-viewer.css">
    <title>Log del pedido : <?php echo $Log->Log_NumDoc['value'] ?></title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Respuesta</div>
                    <div class="panel-body">
                        Message = <?php echo $Log->Log_Message['value'] ?> <br>
                        Pedido = <?php echo $Log->Log_NumDoc['value'] ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">Solicitud</div>
                    <div class="panel-body">
                        <pre id="json-renderer-solititud"></pre>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">Respuesta</div>
                    <div class="panel-body">
                        <pre id="json-renderer-respuesta"></pre>
                    </div>
                </div>
            </div>
        
        </div>
    </div>
   



    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://www.jqueryscript.net/demo/jQuery-Plugin-For-Easily-Readable-JSON-Data-Viewer/json-viewer/jquery.json-viewer.js"></script>

    <script>
        $(document).ready( function () {
            var JsonRequest = '<?php echo $Log->Log_Request['value'] ?>';
            var JsonResponse = '<?php echo $Log->Log_Response['value'] ?>';

            var input_JsonRequest = eval('(' + JsonRequest + ')');
            var input_JsonResponse = eval('(' + JsonResponse + ')');

            $('#json-renderer-solititud').json_viewer(input_JsonRequest);
            $('#json-renderer-respuesta').json_viewer(input_JsonResponse);
        } );
    
    </script>

</body>
</html>