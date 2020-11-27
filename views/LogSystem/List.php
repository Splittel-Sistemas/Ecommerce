<?php
    if (!class_exists("LogSystem")) {
        include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Logs/LogSystem.php';
    }

    $LogSystem = new LogSystem();

    if(isset($_REQUEST['SQL_Where']) && $_REQUEST['SQL_Where'] != null && $_REQUEST['SQL_Where'] != ''){
        $SQL_Where = $_REQUEST['SQL_Where'];
        $LOGs = $LogSystem->List_Log("".$SQL_Where ," ",false)->records;
    }else{
        $SQL_Where = "";
        $LOGs = $LogSystem->List_Log("","",false)->records;
    }
    
    // print_r($LOGs);
?>
<br>
<br>
<div class="row">
    <div class="col-lg-12">
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">Consulta where</div>
                <div class="panel-body">
                    <form action="./">
                        <div class="form-group">
                            <label for=""></label>
                            <input type="text" class="form-control" name="SQL_Where" placeholder = "No.Pedido" value="<?php echo $SQL_Where; ?>">
                        </div>
                        <input type="submit" value="Enviar">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Respuesta</div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-sm col-lg-4" id="myTable">
                            <thead>
                                <tr>
                                    <th><?php echo $LogSystem->Log_key['SQl_field'] ?></th>
                                    <th><?php echo $LogSystem->Log_Datetime['SQl_field'] ?></th>
                                    <th><?php echo $LogSystem->Log_Error['SQl_field'] ?></th>
                                    <th><?php echo $LogSystem->Log_NumDoc['SQl_field'] ?></th>
                                    <th><?php echo $LogSystem->Log_typeEcommerce['SQl_field'] ?></th>
                                    <th><?php echo $LogSystem->Log_Message['SQl_field'] ?></th>
                                    <th><?php echo $LogSystem->Log_Request['SQl_field'] ?></th>
                                    <th><?php echo $LogSystem->Log_Response['SQl_field'] ?></th>
                                </tr>
                                <tr>
                                    <th>#</th>
                                    <th>Datetime</th>
                                    <th>Error</th>
                                    <th>No.Pedido</th>
                                    <th>Ecommerce</th>
                                    <th>Message</th>
                                    <th>Request</th>
                                    <th>Response</th>
                                </tr>
                            </thead>
                            <tbody> 
                        <?php
                            foreach ($LOGs as $Log) {
                        ?>
                                <tr>
                                    <td><a href="viewerJson.php?logID=<?php echo $Log->Log_key['value'] ?>" target="_blank" rel="noopener noreferrer"><?php echo $Log->Log_key['value'] ?></a></td>
                                    <td><?php echo $Log->Log_Datetime['value'] ?></td>
                                    <td class = "bg-<?php echo $Log->Log_Error['value'] == 0 ? 'success' : 'warning' ?>"><?php echo $Log->Log_Error['value'] ?></td>
                                    <td><?php echo $Log->Log_NumDoc['value'] ?></td>
                                    <td><?php echo $Log->Log_typeEcommerce['value'] ?></td>
                                    <td><?php echo $Log->Log_Message['value'] ?></td>
                                    <td><?php echo $Log->Log_Request['value'] != '' ? 'ok' : '--' ?></td>
                                    <td><?php echo $Log->Log_Response['value'] != '' ? 'ok' : '--' ?></td>
                                </tr>
                        <?php
                            }
                        
                        ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>