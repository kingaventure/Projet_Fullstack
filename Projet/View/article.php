<div class="container">
    <?php 
    $counter = 0;
    foreach ($articles as $article): 
        if ($counter % 3 === 0): ?>
            <div class="row">
        <?php endif; ?>

        <div class="col-md-4">
            <div class="card" style="width: 100%; margin-bottom: 20px;">
                <img src="https://letsenhance.io/static/8f5e523ee6b2479e26ecc91b9c25261e/1015f/MainAfter.jpg" class="card-img-top" alt="volcan">
                <div class="card-body">
                    <h4 class="card-title"><?php echo $article['Name']; ?></h4>
                    <h6 class="card-title">Catégorie : <?php echo $article['Category']; ?></h6>
                    <h6 class="card-title">Prix : <?php echo $article['Prix']; ?>$</h6>
                    <h6 class="card-title">Nombre restant : <?php echo $article['Stock']; ?></h6>
                    <p class="card-text"><?php echo $article['Description']; ?></p>
                    <?php if ($article['Stock'] > 0): ?>
                        <a href="#" class="btn btn-primary">Acheter</a>
                    <?php else: ?>
                        <button class="btn btn-secondary" disabled>Rupture</button>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <?php 
        $counter++; 
        if ($counter % 3 === 0 || $counter === count($articles)): ?>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</div>