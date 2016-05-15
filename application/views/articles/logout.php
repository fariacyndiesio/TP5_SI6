 <?php
    /**
     * Cette page permet de se déconnecter et de détruire la session en cours,
     * puis l'utilisateur est redirigé sur la page d'accueil.
     */
    $this->session->sess_destroy();
    $this->load->view('articles/');
?>
