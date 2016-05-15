 <?php echo validation_errors(); ?>
    <?php echo form_open('articles/connexion') ?> 
        <fieldset><legend>Se connecter</legend>
            <label> Nom d'utilisateur : </label>
            <input type="text" name="login" value="" /><br />

            <label> Mot de passe : </label>
            <input type="password" name="mdp1" value="" /><br />
        </fieldset>
        <input type="submit" name="submit" value="Connexion"/>
    </form>
   
