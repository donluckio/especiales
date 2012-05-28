<?php

include_once 'mysql.php';
include_once 'post.php';

Class PostDB {

    private $post;
    private $db;

    public function __construct() {

        $numargs = func_num_args();
        $this->db = new MySQL();

        if ($numargs == 1) {

            $arg_list = func_get_args();
            $post = $arg_list[0];
            $this->post = $post;
        }
    }

    public function getDataCat($limite_inicio, $limite_fin, $categoria) {

        $i = 0;
        $result = array();
        $query = $this->db->query("SELECT * FROM wp_posts 
                                   INNER JOIN wp_term_relationships 
                                   ON wp_posts.ID = wp_term_relationships.object_id 
                                   WHERE term_taxonomy_id = $categoria
                                   AND post_type='post' 
                                   AND post_status='publish' 
                                   ORDER BY wp_posts.post_date 
                                   DESC LIMIT $limite_inicio, $limite_fin");

        while ($row = $this->db->fetch_array($query)) {

            $post = new Post();
            $post->setId($row['ID']);
            $post->setTitulo( utf8_encode($row['post_title']));
            $post->setTexto( utf8_encode($row['post_content']));

            $result[$i] = $post;
            $i++;
        }

        return $result;
    }
    
        public function busca($limite_inicio, $limite_fin, $categoria, $criterio) {

        $i = 0;
        $result = array();
        $query = $this->db->query("SELECT * FROM wp_posts 
                                   INNER JOIN wp_term_relationships 
                                   ON wp_posts.ID = wp_term_relationships.object_id 
                                   WHERE term_taxonomy_id = $categoria
                                   AND post_type='post' 
                                   AND post_status='publish'
                                   AND post_title LIKE '%" . $criterio . "%'
                                   ORDER BY wp_posts.post_date 
                                   DESC LIMIT $limite_inicio, $limite_fin");

        while ($row = $this->db->fetch_array($query)) {

            $post = new Post();
            $post->setId($row['ID']);
            $post->setTitulo( utf8_encode($row['post_title']));

            $result[$i] = $post;
            $i++;
        }

        return $result;
    }

    public function getDataCatTag($limite_inicio, $limite_fin, $categoria, $tag) {

        $i = 0;
        $result = array();
        $query = $this->db->query("SELECT * FROM wp_posts 
                                   INNER JOIN wp_term_relationships 
                                   ON wp_posts.ID = wp_term_relationships.object_id 
                                   WHERE term_taxonomy_id = $categoria
                                   OR term_taxonomy_id = $tag
                                   AND post_type='post' 
                                   AND post_status='publish' 
                                   ORDER BY wp_posts.post_date 
                                   DESC LIMIT $limite_inicio, $limite_fin");

        while ($row = $this->db->fetch_array($query)) {

            $post = new Post();
            $post->setId($row['ID']);
            $post->setTitulo( utf8_encode($row['post_title']));

            $result[$i] = $post;
            $i++;
        }

        return $result;
    }

    public function thumbnail($id, $h, $w) {
        $link_img = "";
        $query = $this->db->query("SELECT * 
                                   FROM wp_postmeta 
                                   WHERE post_id='$id' 
                                   AND meta_key='_thumbnail_id'");

        while ($row = $this->db->fetch_array($query)) {

            $meta_value = $row['meta_value'];
            $query2 = $this->db->query("SELECT * 
                                        FROM wp_postmeta 
                                        WHERE post_id='$meta_value' 
                                        AND meta_key='_wp_attached_file'");

            while ($row2 = $this->db->fetch_array($query2)) {

                $imagen = $row2['meta_value'];
                $link_img = "<img src='http://elespecial.biobiochile.cl/script/php/timthumb.php?src=http://media.biobiochile.cl/wp-content/uploads/" . $imagen . "&h=$h&w=$w' />";
            }
        }

        return utf8_encode($link_img);
    }
	
	public function getLink($id){
		
		$query = $this->db->query("SELECT `post_name` , `post_date` 
                               FROM `wp_posts` 
								               WHERE `post_status` = 'publish'
								               AND `post_type` = 'post'
								               AND `ID` = $id");
								   
		while ($row = $this->db->fetch_array($query)) {
			
			$link = $row['post_name'];
			$fecha = $row['post_date'];
			
		}
		
		$lista_fecha = explode("-", $fecha);
		$lista_dia = explode(" ", $lista_fecha[2]);
		
		$ano = $lista_fecha[0];
		$mes = $lista_fecha[1];
		$dia = $lista_dia[0];
		
		$ruta = $ano . "/" . $mes . "/" . $dia . "/";
		
		return $ruta . $link . ".shtml";
		
	}

}

?>