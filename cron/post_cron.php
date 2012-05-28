<?
include_once '../clases/post.php';

$post = new Post();
$path = "../vista/post_view.html";

$tag_rugby = 10155;

$titulares = $post->escribirTitularCat(2, 8, $tag_rugby);

foreach ($titulares as $i){
    
    $titulo = $i->getTitulo();
    $id = $i->getId();
    $link = $i->getLink($id);
    $imagen = $post->thumbnail($id, 260, 260); //Redimensionar Imagenes..
    
    echo $titulo;
    echo $imagen;

}

?>