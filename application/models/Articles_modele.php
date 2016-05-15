<?php
/**
 * Description of Articles_modele
 * @author cyndie
 */
class Articles_modele extends CI_Model {
    protected $table='utilisateurs';
    
    /**
     * Voici le constructeur dans lequel on charge lla base de données
     */    
    public function __construct(){
        $this->load->database();
    }
    
    /**
     * La fonction get_articles permet de récupérer les articles situés dans la base de données
     */
    public function get_articles($slug = FALSE){
        if ($slug === FALSE){
            //Pour récupérer tous les articles
            $query = $this->db->get('articles');
            return $query->result_array();
        }
        //Pour récupérer un article en fonction de son titre
        $query = $this->db->get_where('articles', array('slug' => $slug));
        return $query->row_array();
    }
    
    /**
     * La fonction get_theme permet de récupérer les thèmes situés dans la base de données
     */    
    public function get_theme($idTheme =FALSE){
        if($idTheme === FALSE){
            $query = $this->db->get('theme');
            return $query->result_array();
        }
        $query = $this->db->get_where('theme',array('idTheme' => $idTheme));
        return $query->row_array(); 
    }
    
    /**
     * La fonction get_utilisateurs permet de récupérer les auteurs situés dans la base de données
     */
    public function get_utilisateurs($id_utilisateur =FALSE){
        if($id_utilisateur === FALSE){
            $query = $this->db->get('utilisateurs');
            return $query->result_array();
        }
        $query = $this->db->get_where('utilisateurs',array('id_utilisateur' => $id_utilisateur));
        return $query->row_array(); 
    }
    
    public function get_selectiontheme($fk_theme=FALSE){
        if($fk_theme === FALSE){
            $query = $this->db->get('articles');
            return $query->result_array();
        }
        $query = $this->db->get_where('articles',array('fk_theme' => $fk_theme));
        return $query->result_array();
    }
    
    public function get_selectionutilisateur($fk_utilisateur){
        if($fk_utilisateur === FALSE){
            $query = $this->db->get('articles');
            return $query->result_array();
        }
        $query = $this->db->get_where('articles',array('fk_utilisateur' => $fk_utilisateur));
        return $query->result_array();
    }
    
    public function set_articles(){
	$this->load->helper('url');
	$slug = url_title($this->input->post('titre'), 'dash', TRUE);
	$data = array(
		'titre' => $this->input->post('titre'),
                'date' => $this->input->post('date'),
                'texte_libre' => $this->input->post('texte_libre'),
                'fk_utilisateur' => $this->input->post('fk_utilisateur'),
		'slug' => $slug,
		'fk_theme' => $this->input->post('fk_theme')
	);
	return $this->db->insert('articles', $data);
    }
    
     public function set_inscription(){
	$this->load->helper('url');
	$slug = url_title($this->input->post('titre'), 'dash', TRUE);
	$data = array(
                'nom' => $this->input->post('nom'),
                'prenom' => $this->input->post('prenom'),
		'login' => $this->input->post('login'),
                'mdp1' => $this->input->post('mdp1')
                
	);
	return $this->db->insert('utilisateurs', $data);
    }
    
    /**
     * La fonction connexionUtilisateur permet de vérifier la connexion
     */
    public function connexionUtilisateur($login,$mdp){
            return $this->db->select('login,mdp1')
                    ->from($this->table)
                    ->where('login',$login)
                    ->where('mdp1',$mdp)
                    ->get()
                    ->result();
    }
}
