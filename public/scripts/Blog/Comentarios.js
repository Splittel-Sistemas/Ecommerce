var ListReviews = function(){
  let IdB = document.getElementById('BlogKey')
  data = { id: IdB.value }
  ajax_(
  '../../views/Blog/Comentarios/List.php', 
  'post', 
  'html', 
  data,
  function(response){
    document.getElementById('ListReviews').innerHTML = response
  })
}


var showFormCreate = function(IdComent){
  let IdB = document.getElementById('BlogKey')
  data = { idComent: IdComent,idBlog:IdB.value }
  ajax_(
  '../../views/Blog/Comentarios/Create.php', 
  'post', 
  'html', 
  data, 
  function(response){
    GlobalOpenModal('modal-review')
    document.getElementById('modal-body-review').innerHTML = response
  })
}

var createReply = function(){
  
  ajax_(
    '../../models/Blog/Comentarios/Comentarios.Route.php', 
  'POST', 
  'JSON', 
  $('#form-reply').serialize(), 
  function(response){
    if (!response.error) {
      GlobalCloseModal('modal-review')
      ListReviews()
      templateAlert(response.typeError, "", response.message, "topRight", "icon-check-circle")
    }else{
      templateAlert(response.typeError, "", response.message, "topRight", "icon-slash")
    }
  })
}


var createReviewBlog = function(){
  let Comment = document.getElementById('comment-text')
  if(Comment.value!=''){
    ajax_(
    '../../models/Blog/Comentarios/Comentarios.Route.php', 
    'POST', 
    'JSON', 
    $('#form-comment').serialize(), 
    function(response){
      if (!response.error){
        ListReviews()
        Comment.value=''
        templateAlert(response.typeError, "", response.message, "topRight", "icon-check-circle")
      }else{
        templateAlert(response.typeError, "", response.message, "topRight", "icon-slash")
      }
    })
  }else{
    templateAlert(response.typeError, "", 'Ingrese un comentario', "topRight", "icon-slash")
  }
}