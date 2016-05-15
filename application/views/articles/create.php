 <?php echo validation_errors(); ?>
    <?php if (isset($_SESSION['id_utilisateur'])){
        echo form_open('articles/create'); ?>
            <label for="titre">Titre</label>
            <input type="text" name="titre" /><br />
                
            <label for="date">Date</label>
            <input type="date" name="date" /><br />
                
            <label for="texte_libre">Saisissez votre texte</label>
            <textarea type="text" name="texte_libre"></textarea><br />
              
            <label for="fk_utilisateur">Numéro d'utilisateur</label>
            <input type="text" name="fk_utilisateur" /><br />
                
            <label for="slug">Slug</label>
            <input type="text" name="slug" /><br />
              
            <label for="fk_theme">Numéro du thème</label>
            <input type="text" name="fk_theme" /><br />
                
            <input type="submit" name="submit" value="Créer un nouvel article" />
        <?php } else{ echo "Veuillez vous connecter "; } ?>
    </form>
    
