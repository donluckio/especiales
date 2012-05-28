<?php

include_once 'post_db.php';

Class Post{
    
    private $id;
    private $titulo;
    private $texto;
    private $fecha;
    private $imagen;
    
    public function getId(){ return $this->id; }
    public function getTitulo() { return $this->titulo; }
    public function getTexto() { return $this->texto; }
    public function getFecha() { return $this->fecha; }
    public function getImagen() { return $this->imagen; }
    
    public function setId($val){ $this->id = $val; }
    public function setTitulo($val){ $this->titulo = $val; }
    public function setTexto($val){ $this->texto = $val; }
    public function setFecha($val){ $this->fecha = $val; }
    public function setImagen($val){ $this->imagen = $val; }
    
	//devuelve posts ingresando como parametro un TAG O UNA CATEGORÍA...
    public function escribirTitularCat($limite_inicio = 0, $limite_fin = 10, $categoria = 1){
        
        $post_db = new PostDB($this);
        return $post_db->getDataCat($limite_inicio, $limite_fin, $categoria);
        
    }
    
	//devuelve posts ingresando como parametro un TAG Y UNA CATEGORÍA..
    public function escribirTitularCatTag($limite_inicio = 0, $limite_fin = 10, $categoria = 1, $tag = 1){
        
        $post_db = new PostDB($this);
        return $post_db->getDataCatTag($limite_inicio, $limite_fin, $categoria, $tag);
        
    }
    
	//buscador.. el parametro $limite_inicio se usa para el paginador...
    public function busca($limite_inicio = 0, $limite_fin = 10, $categoria = 1, $criterio = 1){
        
        $post_db = new PostDB($this);
        return $post_db->busca($limite_inicio, $limite_fin, $categoria, $criterio);
        
    }
    
	//función para redimensionar una imagen, se le ingresa por parametro "id, alto y ancho del post"..
    public function thumbnail($id = NULL, $h = 70, $w = 100){
        
        $post_db = new PostDB($this);
        return $post_db->thumbnail($id, $h, $w);
        
    }
	
	//función que devuelve el link del post..
	public function getLink($id = NULL){
		
		$post_db = new PostDB($this);
		return $post_db->getLink($id);
		
	}
    
}
?>
