<!DOCTYPE html>
<html lang="es">
  <head>
    <!-- <title> Contacto </title> -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Head.php'; ?>
    <style>
       
       ol, ul {
        list-style: none;
        }
       
        .blog-list{}

        .blog-item{
        margin: 0 0 20px 0;
        /*padding: 0 0 20px 0;*/
        /*border-bottom: 1px solid #eaeaea;*/
        }
        .blog-item:last-child{
            margin: 0;
            padding: 0;
            border-bottom: none;
        }

        .pagination{
        margin: 40px 0 0 0;
        text-align: center;
        }
 
        .pagination li{
            display: inline;
        }

        .pagination li a{
        border: 1px solid #eaeaea;
        border-radius: 5px;
        padding: 3px 8px;
        text-decoration: none;
        color: #BF202F;
        }

        .pagination li a.active,
        .pagination li a:hover{
        background-color: #BF202F;
        color: #fff;
        }
    </style>
  </head>
  <!-- Body-->
  <body>
    <!-- Header -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Header.php'; ?>
 
<div class="page-title">
      <div class="container">
        <div class="column">
          <h1>Blog Fibremex</h1>
        </div>
        <div class="column">
          <ul class="breadcrumbs">
            <li><a href="../Home/">Home</a>
            </li>
            <li class="separator">&nbsp;</li>
            <li>Blog</li>
          </ul>
        </div>
      </div>
    </div>
    <?php 
	date_default_timezone_set("America/Mexico_City");
	setlocale(LC_TIME, "spanish");
      if (!class_exists("Blog")) {
        include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Blog/Blog.php';
      }
      $Blog = new Blog();
      //$range1 = ($_GET['pag'] - 1) * $Blog->elem_totales_pagination;
      //$range2 = ($_GET['pag']) * $Blog->elem_totales_pagination;
	  //  $range2 = $Blog->elem_totales_pagination;
      $response = (object)$Blog->get("WHERE activo = 'si' AND (pagina='Fibremex' OR pagina='ambas')", "ORDER BY fecha DESC  ", false);
    ?>
    <!-- Page Content-->
    <div class="container padding-bottom-3x mb-1">
    <div class="page-header cf d-flex justify-content-center">
            
            </div>
    <div class="pages">
    <div class="gutter-sizer"></div>
    <div class="grid-sizer"></div>
            
            <ul class="blog-list row">
                
                <?php if ($response->count > 0): ?>
                <?php $con1=1; $con2=1; ?>
                <?php foreach ($response->records as $key => $row): ?>
                <li class="blog-item cf col-4">
                <div class="grid-item">
                    <div class="blog-post">
                    <?php // if ( ((($con2 % 2)!=0) &&  (($con1 % 2)!=0) )  || ( (($con1 % 2)==0) && (($con2 % 2)==0) )): ?>
                    <a class="post-thumb" href="detalle.php?id=<?php echo $row->BlogKey;?>&nom=<?php echo $row->BlogComillas;?>">
                        <img src="../../public/images/img_spl/blog/<?php echo $row->BlogImg;?>" alt="<?php echo $row->BlogTitulo;?>">
                    </a>
                    <?php //endif ?>
                    <div class="post-body">
                        <ul class="post-meta">
                        <li>
                            <i class="icon-clock"></i>
                            <a href="detalle.php?id=<?php echo $row->BlogKey;?>&nom=<?php echo $row->BlogComillas;?>"><?php echo ucwords(strftime( '%B' , strtotime($row->BlogFecha))).' '.strftime(date("j, Y",strtotime($row->BlogFecha)));?></a>
                        </li>
                        </ul>
                        <h1 class="post-title">
                        <a href="detalle.php?id=<?php echo $row->BlogKey;?>&nom=<?php echo $row->BlogComillas;?>"><?php echo $row->BlogTitulo;?></a>
                        </h1>
                        <p><?php echo $row->BlogContenido;?> 
                        <a href='detalle.php?id=<?php echo $row->BlogKey;?>&nom=<?php echo $row->BlogComillas;?>'>Ver más</a>
                        </p>
                    </div>
                    </div>
                </div>
                </li>
                <?php endforeach ?>
                <?php endif ?>
                
            
            </ul>
        </div>
    </div>
    <!-- Footer -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Footer.php'; ?>
    <!-- scripts JS -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Scripts.php'; ?>
  </body>
  <script>
// Setting up variables
const $studentList = $('.blog-list').children();
$('.blog-list').prepend('<div class="notFound"></div>');
$('.notFound').html(`<span>No se encontraron resultados</span>`);
$('.notFound').hide();

// Bulding a list of ten students and displaying them on the page
function showPage(studentList, pageNum=1){
    //console.log(studentList)
    const showPerPage = 6;    
    // hide all students on the page
    $(studentList).hide(); 
   
    // Get start/end for each student based on the page number
    const calcStart = (pageNum) => pageNum === 1 ? 0 : (pageNum - 1) * showPerPage;
    const start = calcStart(pageNum);
    const end = pageNum * showPerPage;
    //console.log(start)
    //console.log(end)
    
    // Looping through all students in studentList
    $(studentList).slice(start,end).each(function(i, li){
        // if student should be on this page number
        // show the student
        
        $(li).fadeIn(50);
        //console.log(li)
    });
}

// Search component
const searchBar = `
    <div class=" col-8 blog-search padding-bottom-1x">
        <input class="form-control form-control-sm" placeholder="Buscar blog...">
    </div>
`;
$('.page-header').append(searchBar);

$('.blog-search input').on('keyup', function(){
    const searchQuery = $(this).val();
    const searchResults = searchStudent($('.blog-list li'), searchQuery.toUpperCase());
    //console.log(searchResults)
    
    showPage(searchResults);
    appendPageLinks(searchResults);
});


// Student search
function searchStudent(element, filter){
    
    $(element).each(function(){         
        if($(this).text().toUpperCase().includes(filter)){
            $(this).show();
        } else {
            $(this).hide();
        }        
    });
    let num = $('.blog-item:not([style*="display: none"])').length;
    let searchRes = $('.blog-item:not([style*="display: none"])');
    num > 0 ? $('.notFound').hide() : $('.notFound').show();
    //console.log(searchRes)
    return searchRes;
};



// Creating all page links based on a list of blog
function appendPageLinks(studentList){
    console.log(studentList)
    // determine how many pages for this student list
    totalPageNum = Math.ceil(studentList.length / 6);
    console.log(totalPageNum)
    // create a page link section
    const pagination = 'pagination';
    // add a page link to the page link section
    // if class the element already exists
    if($('.pagination').length === 0){
        $('.pages').append(`
        <div class="${pagination} padding-top-1x">
            <ul></ul>
        </div>
    `);
    } 
 
    // remove the old page link section from the site
    $('.pagination ul').children().remove();

    if (totalPageNum > 1){
        // 'for' every page
        for(let i=0; i<totalPageNum; i++){
            const pageLink = `
                <li>
                    <a href="#">${i + 1}</a>
                </li>
            `;
            // append our new page link section to the site
            $('.pagination ul').append(pageLink);
        }
    }

    $('.pagination ul li').children().first().addClass('active'); 
        
        // define what happens when you click a link (event listener)
        $('.pagination ul').off('click', 'a').on('click', 'a', function(e){
            
            e.preventDefault();
            const pgNum = parseInt($(e.target).text());
            //console.log(pgNum)
            // Use showPage() to display the page for the link clicked
            //console.log(studentList)
            //console.log(pgNum)
            showPage(studentList, pgNum);
            // mark that link as 'active'
            $(this).parent().siblings().children().removeClass('active');
            $(this).addClass('active');
            
        });
} 

showPage($studentList);
appendPageLinks($studentList);
</script>   
</html>

