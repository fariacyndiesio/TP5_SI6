 <?php echo validation_errors(); ?>
    <?php echo form_open('articles/inscription') ?>        
        <fieldset><legend>Inscription</legend>
            <label> Nom : </label>
            <input type="text" name="nom" value="" /><br />

            <label> Prenom : </label>
            <input type="text" name="prenom" value="" /><br />

            <label> Nom d'utilisateur : </label>
            <input type="text" name="login" value="" /><br />

            <label> Mot de passe : </label>
            <input type="password" name="mdp1" value="" /><br />                        
        </fieldset>
        <input type="submit" name="submit" value="Envoyer"/>
    </form>
    
