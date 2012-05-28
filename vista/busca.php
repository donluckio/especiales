<?php
	include_once '../controlador/post.php';
	
	include ('../base/h.html');
	include ('../base/l.html');
	
	//creab un objeto de tipo Post
	$post = new Post();
	
	$limite_fin = 10; //limite de posts a imprimir
	$categoria = 7699; //Categoria o tag 
	
	//si se recibe la variable pagina desde el metodo $_GET se la asigna a la variable php $pagina e inicializa las variables php $limite_inicio y $siguente
	if (isset($_GET['pagina'])){
		$pagina = $_GET['pagina'];
		$limite_inicio = $pagina * $limite_fin;
		$siguiente = $pagina - 1;
	}
	else{ //si no recibe nada por $_GET las inicializa en 0
		$pagina = 0;
		$limite_inicio = 0;
		$siguiente = 0;
	}
	
	//si la variable s viene con contenido desde el formulario.. se lo asigna a la variable $criterio
	if(isset($_GET['s'])){
		$criterio = utf8_decode($_GET['s']);
	}
	
	//llama a la funcion busca en la clase Post.php
	$titulares = $post->busca($limite_inicio, $limite_fin, $categoria, $criterio);

	// añadir miniatura al titular y lo imprime
	function imagenTitular($titulares, $post){
		foreach ($titulares as $i){
			$titulo = $i->getTitulo();
		    $id = $i->getId();
		    $imagen = $post->thumbnail($id);    
		    ?>
		    <ul>
		        <li><? echo $imagen ?><? echo $titulo ?></li>
		    </ul>
		    <?
		}
	}
	
	//imprimir en pantalla
	imagenTitular($titulares, $post);
	
?>
	<div>
	    <a href="/vista/busca.php?s=<? echo utf8_encode($criterio) ?>&pagina=<? echo $pagina + 1 ?>">Anteriores</a>
	</div>
	<div>
<?
	//imprime Siguiente cuando la pagina sea mayor que cero
	$link_siguiente = "<a href='/vista/busca.php?s=".$criterio."&pagina=".$siguiente.">Recientes</a>";
	    
	if ($pagina > 0){
		echo '<a href="busca.php?s='.$criterio.'&pagina='.$siguiente.'">Recientes</a>';
	}
		
?> 
	</div>

<? include('../base/p.html'); ?>