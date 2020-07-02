var showFormCreate = function(){
  ajax_(
  '../../views/Productos/Informacion/Comentarios/Create.php', 
  'post', 
  'html', 
  {}, 
  function(response){
    GlobalOpenModal('modal-review')
    document.getElementById('modal-body-review').innerHTML = response
  })
}

var createReview = function(){
  ajax_(
  '../../models/Productos/Comentarios.Route.php', 
  'POST', 
  'JSON', 
  $('#form-review').serialize(), 
  function(response){
    if (!response.error) {
      GlobalCloseModal('modal-review')
      ListReviews_(true)
      templateAlert(response.typeError, "", response.message, "topRight", "icon-check-circle")
    }else{
      templateAlert(response.typeError, "", response.message, "topRight", "icon-slash")
    }
  })
}

var ListReviews_ = function(Elem){
  let data = {}
  let IdProducto = document.getElementById('ProductoKey')
  let IdCategoria = document.getElementById('CategoriaKey')
  data = { IdProducto: IdProducto.value, IdCategoria: IdCategoria.value, ocultar: Elem }

  ajax_(
  '../../views/Productos/Informacion/Comentarios/List.php', 
  'post', 
  'html', 
  data, 
  function(response){
    document.getElementById('ListReviews').innerHTML = response
  })
}

var ListReviews = function(Elem){
  let data = {}
  let IdProducto = document.getElementById('ProductoKey')
  let IdCategoria = document.getElementById('CategoriaKey')
  data = { IdProducto: IdProducto.value, IdCategoria: IdCategoria.value, ocultar: Elem.getAttribute('boolean') }

  ajax_(
  '../../views/Productos/Informacion/Comentarios/List.php', 
  'post', 
  'html', 
  data, 
  function(response){
    document.getElementById('ListReviews').innerHTML = response
  })
}