<?php
/**
 * Description of Articles
 * 
 * @author cyndie
 */
class Articles extends CI_Controller {
    
    /**
     * Voici le constructeur dans lequel on charge le fichier articles_modele
     * et où l'on initialise la session
     */
    public function __construct(){
        parent::__construct();
        $this->load->model('articles_modele');
        $this->load->library('session');
    }
    
    /**
     * La fonction index fait appel à deux fonctions situées dans articles_modele,
     * get_theme et get_utilisateurs. Cette fonction charge aussi la vue articles/index.
     */
    public function index(){
        $data['theme'] = $this->articles_modele->get_theme();
        $data['utilisateurs'] = $this->articles_modele->get_utilisateurs();
        $data['nom'] = 'Liste des articles';
        $this->load->view('articles/index', $data);
    }
    
    /**
     * @param integer $fk_theme recupère l'id du theme 
     * La fonction view fait appel à la fonction get_selectiontheme située dans articles_modele,
     * s'il n'y a pas d'articles alors on affiche un message,
     * puis on charge la vue articles/view. 
     */
    public function view($fk_theme){
        $data['articles'] = $this->articles_modele->get_selectiontheme($fk_theme);
        if (empty($data['articles'])){                    
            echo "Cet auteur n'a pas encore d'article";
        }
        $this->load->view('articles/view', $data);
    }
    
    /**
     * @param integer $fk_utilisateur récupère l'id de l'auteur
     * La fonction vue fait appel à la fonction get_selectionutilisateur située dans articles_modele,
     * s'il n'y a pas d'articles alors on affiche un message,
     * puis on charge la vue articles/view.
     */
    public function vue($fk_utilisateur){
        $data['articles'] = $this->articles_modele->get_selectionutilisateur($fk_utilisateur);
        if (empty($data['articles'])){
            echo"Cet auteur n'a pas encore d'article";
        }
        $this->load->view('articles/view', $data);
    }
    
    /**
     * La fonction create charge form_validation qui permet de valider le forumaire,
     * pour qu'il puisse être envoyé il faut que tous les champs soient remplis,
     * si un champ est vide alors il y aura marqué required. 
     * Si la validation du formulaire retourne false, le formulaire ne s'envoie pas,
     * mais s'il est correcte alors l'utilisateur est redirigé vers success qui lui
     * confirme que l'article à bien été enregistré
     */
    public function create(){
        $this->load->helper('form');
        $this->load->library('form_validation');
        $data['titre'] = 'Créer un nouvel article';
        $this->form_validation->set_rules('titre', 'Titre', 'required');
        $this->form_validation->set_rules('texte_libre', 'Texte_libre', 'required');
        $this->form_validation->set_rules('date', 'Date', 'required');
        $this->form_validation->set_rules('fk_utilisateur', 'Fk_utilisateur', 'required');
        $this->form_validation->set_rules('slug', 'Slug', 'required');
        $this->form_validation->set_rules('fk_theme', 'Fk_theme', 'required');
         
        if ($this->form_validation->run() === FALSE){
            $this->load->view('articles/create');
        }
        else{
            $this->articles_modele->set_articles();
            $this->load->view('articles/success');
        }
    }
    
    /**
     * La fonction inscription procède de la même façon que la fonction create,
     * et si le forumaire est correct l'utilisateur est redirigé vers success_inscription
     * qui qui lui confirme que son inscription a bien été effectuée.
     */
    public function inscription(){
        $this->load->helper('form');
        $this->load->library('form_validation');            
        $this->form_validation->set_rules('nom', 'nom', 'required');
        $this->form_validation->set_rules('prenom', 'prenom', 'required');
        $this->form_validation->set_rules('login', 'login', 'required');
        $this->form_validation->set_rules('mdp1', 'mdp1', 'required');
        
        if ($this->form_validation->run() === FALSE){
            $this->load->view('articles/inscription');
        }
        else{
            $this->articles_modele->set_inscription();
            $this->load->view('articles/success_inscription');
        }
    }
    
    /**
     * La fonction connexion procède de la même façon que la fonction create et inscription,
     * et si le forumaire est correct l'utilisateur est redirigé vers success_connexion
     * qui qui lui confirme que sa connexion a bien été établie.
     */
    public function connexion(){
        $this->load->helper('form');
        $this->load->library('form_validation');  
        $login=$this->input->post('login');
        $mdp=$this->input->post('mdp1');
        $this->form_validation->set_rules('login', 'login', 'required');
        $this->form_validation->set_rules('mdp1', 'mdp1', 'required');
        $result=$this->articles_modele->connexionUtilisateur($login,$mdp);
        
        if ($this->form_validation->run() === FALSE){
            $this->load->view('articles/connexion');
        }
        elseif($this->form_validation->run() == true && empty($result)){
            $this->session->set_flashdata('noconnect', 'Aucun compte ne correspond a vos identifiants');
            $this->load->view('articles/connexion');
        }
        else{
            $this->session->set_userdata('id_utilisateur',$login);
            $this->load->view('articles/success_connexion');
        }
    }
    
    /**
     * La fonction sessionUtilisateur gère la session de l'utilisateur
     */
    private function sessionUtilisateur(){
        if(!$this->session->userdata(id_utilisateur)){
            $this->load->view('connexion');
        }
    }
    
    /**
     * La fonction logout gère la deconnexion à la session de l'utilisateur,
     * et la redirection à la page d'accueil
     */
    public function logout(){
        $this->session->sess_destroy();
        header('Location: http://localhost/codeignitercyndie/tp5/index.php/articles');
    }
}
       


