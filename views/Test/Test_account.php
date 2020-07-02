<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <title>test of account web services</title>
</head>
<body>
    <div class="container-fluid" >
        <div class="row" id="">
            <form action="" method="get">
                <div class="form-group col-lg-6">
                    <label for="">URL</label>
                    <select name="" id="url" class="form-control">
                        <option value="http://fibremex.co/store/views/Cuenta/B2B/Generales/datos_generales.php">Datos generales**</option>
                        <option value="http://fibremex.co/store/views/Cuenta/B2B/Dashboard/dashboard_360.php">dashboard 360</option>
                        <option value="http://fibremex.co/store/views/Cuenta/B2B/EnProceso/">En proceso</option>
                        <option value="http://fibremex.co/store/views/Cuenta/B2B/HistoricoPedidos">Historico de pedidos</option>
                        <option value="http://fibremex.co/store/views/Cuenta/B2B/Rechazados">Rechazados</option>
                        <option value="http://fibremex.co/store/views/Cuenta/B2B/Pagos">Pagos</option>
                        <option value="http://fibremex.co/store/views/Cuenta/B2B/DatosEnvio">DatosEnvio</option>
                        <option value="http://fibremex.co/store/views/Cuenta/B2B/DatosFacturacion">DatosFacturacion</option>
                    </select>
                </div>
                <div class="form-group col-lg-3">
                    <label for="">Number of executionss</label>
                    <input type="number" class="form-control" id="NoExcecutions">
                </div>
                <div class="form-group col-lg-3">
                    <label for="">action</label>
                    <input type="button" class="form-control" value="Ejecutar" onclick="Run(this)">
                </div>
            </form>
        </div>
    </div>
    <div class="container-fluid" >
        <div class="row" id="Responses">
        
        </div>
    </div>


    <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous">
    </script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script>
    
    var url = document.getElementById("url");
    var NoExcecutions = document.getElementById("NoExcecutions");
    var ajax = function(url, method, type, data, success){
        $.ajax({
            url: url,
            method: method, 
            data : data,
            dataType: type,
            beforeSend: function(){

            },
            success: function(response){ 
            if(response != null && success != null){
                success(response);

            }              
            },
            error: function( jqXHR, textStatus, errorThrown){
            console.log("Error: " + errorThrown,"Hubo un error en la llamada:  " + url + " | " + textStatus)
            }
        });
    };

    var ejecutar = function(url, iteration){
        ajax(url,"GET","HTML",{},function (response) {
            if(response != null){
                var currentDiv = document.getElementById("Responses");
                var DivContainer = document.createElement("div"); 
                DivContainer.classList.add("panel");
                DivContainer.classList.add("panel-default");
                DivContainer.classList.add("col-lg-4");
                var DivHeader = document.createElement("div"); 
                DivHeader.classList.add("panel-heading");
                DivHeader.innerHTML = "Respuesta -- iteration number : " + iteration;
                DivContainer.appendChild(DivHeader);
                var DivBody = document.createElement("div"); 
                DivBody.classList.add("panel-body");
                DivBody.innerHTML = response;
                DivContainer.appendChild(DivBody);
                currentDiv.appendChild(DivContainer);
            }else{

            }
        })
    }
    
    function Run(){
        var currentDiv = document.getElementById("Responses");
        currentDiv.innerHTML = "";
        this.Disabled = true;
        for (let i = 0; i < NoExcecutions.value; i++) {
            ejecutar(url.value, i)
        }
        this.Disabled = false;
    }
    </script>
</body>
</html>