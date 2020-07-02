/**
 * Inicio de sesión
 *
 * @param {Object} Elem
 *
 * @return {number} b - Bar
 */
var Enviar = function() {

	let dataSolicitud = $('#form-solicitud-precalificacion').serializeArray()
	let checkIntegraSoluciones = []
	let checkProductos = []
	let checkTipoClientes = []
	let dataForm = {}
	var cont = 0
	let cont_ = 0
	let cont__ = 0
	
	
	dataSolicitud.forEach(function(elem, index){
		dataForm[elem.name] = elem.value
	});

	$(".respuesta-integras-soluciones").each(function(index) {
		let dataIntegraSoluciones = {}
		dataIntegraSoluciones['key'] = $(this).attr('preguntakey')
		dataIntegraSoluciones['value'] = $(this).prop('checked')
		if(this.checked){ cont++ }
		checkIntegraSoluciones.push(dataIntegraSoluciones)
	});

	if(cont == 0 ){
		toastAlert('info', '', '<strong>Integras soluciones como,</strong> seleccionar al menos 1 campo', 'topLeft', 'icon-ban')
		return false
	}

	$(".respuesta-productos").each(function(index) {
		let dataProductos = {}
		dataProductos['key'] = $(this).attr('preguntakey')
		dataProductos['value'] = $(this).prop('checked')
		if(this.checked){ cont_++ }
		checkProductos.push(dataProductos)
	});

	if(cont_ == 0 ){
		toastAlert('info', '', '<strong>Distribuyes/utilizas productos,</strong> seleccionar al menos 1 campo', 'topLeft', 'icon-ban')
		return false
	}

	$(".respuesta-tipo-clientes").each(function(index) {
		let dataTipoClientes = {}
		dataTipoClientes['key'] = $(this).attr('preguntakey')
		dataTipoClientes['value'] = $(this).prop('checked')
		if(this.checked){ cont__++ }
		checkTipoClientes.push(dataTipoClientes)
	});

	if(cont__ == 0 ){
		toastAlert('info', '', '<strong>Sector o tipo de clientes que atienden,</strong> seleccionar al menos 1 campo', 'topLeft', 'icon-ban')
		return false
	}

	let data = {
		Action: 'create',
		ActionPrecalificacion: true, 
		Terminos: document.getElementById('aviso-privacidad').checked ? 1 : 0,
		data: dataForm,
		IntegraSoluciones: checkIntegraSoluciones,
		Productos: checkProductos,
		TipoClientes: checkTipoClientes
	}

	ajax_('../../models/Solicitud/Precalificacion.Route.php', 'POST', 'JSON', data, 
	function(response){
		if(!response.error){
			toastAlert(response.typeError, '', response.message, 'topLeft', "icon-check-circle")
			location.reload();
		}else{
			toastAlert('danger', '', response.message, 'topLeft', 'icon-ban')
		}
	})
}

var fileInput = function(){
	$("#situacion-fiscal").fileinput({
		theme: "explorer-fas",
		language: "es",
		uploadUrl: "../../models/Solicitud/Precalificacion.Route.php",
		uploadAsync: true,
		showRemove: false,
		showUpload: false,
		showBrowse: true,
		showClose: false,
		showCaption: false,
		browseLabel: '',
		removeLabel: '',
		initialPreviewAsData: true, // defaults markup
		preferIconicPreview: true, // this will force thumbnails to display icons for following file extensions
		previewFileIconSettings: { // configure your icon file extensions
				'doc': '<i class="fas fa-file-word text-info"></i>',
				'xlsx': '<i class="fas fa-file-excel text-success"></i>',
				'pptx': '<i class="fas fa-file-powerpoint text-danger"></i>',
				'txt': '<i class="fas fa-file-alt text-info"></i>',
				'zip': '<i class="fas fa-file-archive text-muted"></i>',
				'htm': '<i class="fas fa-file-code text-info"></i>',
		},
		previewFileExtSettings: { // configure the logic for determining icon file extensions
				'doc': function(ext) {
						return ext.match(/(doc|docx)$/i);
				},
				'xls': function(ext) {
						return ext.match(/(xls|xlsx)$/i);
				},
				'ppt': function(ext) {
						return ext.match(/(ppt|pptx)$/i);
				},
				'zip': function(ext) {
						return ext.match(/(zip|rar|tar|gzip|gz|7z)$/i);
				},
				'htm': function(ext) {
						return ext.match(/(htm|html)$/i);
				},
				'txt': function(ext) {
						return ext.match(/(txt|ini|csv|java|php|js|css|sql)$/i);
				},
				'mov': function(ext) {
						return ext.match(/(avi|mpg|mkv|mov|mp4|3gp|webm|wmv)$/i);
				},
				'mp3': function(ext) {
						return ext.match(/(mp3|wav)$/i);
				}
		},
		fileActionSettings: {
			showRemove: false,
		},
		uploadExtraData: { 
			Action: 'file', 
			ActionPrecalificacion: true,
			Relacion: 'SOL.PRE' // solicitud precalificación
		},
		purifyHtml: true, // this by default purifies HTML data for preview
	}).on("filebatchselected", function(event, files) {
		$("#situacion-fiscal").fileinput("upload");
	}).on('filebeforedelete', function(event, key, data)  {
		var aborted = !window.confirm('Estas seguro de eliminar este archivo?')
		return aborted
	}).on('fileuploaderror', function(event, data, msg) {

	}).on('filedeleted', function(event, key, data) {

	})// filedeleted
}

fileInput()