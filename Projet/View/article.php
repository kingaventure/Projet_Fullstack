<div class="container">
    <div class="row">
        <?php if ($search): ?>
            <div class="col-12">
                <h3>Résultats de recherche pour "<?php echo htmlspecialchars($search); ?>"</h3>
            </div>
        <?php endif; ?>
        
        <?php 
        $counter = 0;
        foreach ($articles as $article): 
            if ($counter % 3 === 0): ?>
                <div class="row">
            <?php endif; ?>

            <div class="col-md-4 mt-5">
                <div class="card" style="width: 100%; margin-bottom: 20px;">
                    <img src="./uploads/<?php echo $article['Image']; ?>" class="card-img-top" alt="volcan">
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

    <nav>
    <ul class="pagination justify-content-center mt-4">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <li class="page-item <?php echo $i === $page ? 'active' : ''; ?>">
                <a class="page-link" href="?component=article&page=<?php echo $i; ?>&component=article&search=<?php echo urlencode($search); ?>&category=<?php echo urlencode($category); ?>"><?php echo $i; ?></a>
            </li>
        <?php endfor; ?>
    </ul>
</nav>
</div>
