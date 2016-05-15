 <?php
    foreach ($articles as $articles): ?>
    <h2><?php echo $articles['titre'] ?></h2>
    <div id="main">
        <?php echo $articles['texte_libre'];?>
    </div>
    <?php endforeach ?>