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

            <?php $category = getArticleCategoryNames($pdo, $article['category_id']);
            $article['category_id'] = $category['category_name']; ?>
            
            <div class="col-md-4 mt-5">
                <div class="card" style="width: 100%; margin-bottom: 20px;">
                    <img src="./uploads/<?php echo $article['Image']; ?>" class="card-img-top" alt="volcan">
                    <div class="card-body">
                        <h4 class="card-title"><?php echo $article['Name']; ?></h4>
                        <h6 class="card-title">Catégorie : <?php echo $article['category_id']; ?></h6>
                        <h6 class="card-title">Prix : <?php echo $article['Prix']; ?>$</h6>
                        <h6 class="card-title">Nombre restant : <?php echo $article['Stock']; ?></h6>
                        <p class="card-text"><?php echo substr($article['Description'],0 , 50); ?> ...</p>
                        <?php if ($article['Stock'] > 0): ?>
                            <button class="buyBtn btn btn-primary" data-article-name="<?php echo $article['Name']; ?>" data-article-price="<?php echo $article['Prix']; ?>" data-article-stock="<?php echo $article['Stock']; ?>">Acheter</button>
                        <?php else: ?>
                            <button class="buyBtn btn btn-secondary" disabled>Rupture</button>
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

    <style>
        .card{
            height: 600px;
        }
        .card img{
            height: 60%;
            place-items: center;
            object-fit: cover;
        }

    </style>

    <nav>
    <ul class="pagination justify-content-center mt-4">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <li class="page-item <?php echo $i === $page ? 'active' : ''; ?>">
                <a class="page-link" href="?component=article&page=<?php echo $i; ?>&component=article&search=<?php echo urlencode($search); ?>&category=<?php echo urlencode($category_id); ?>"><?php echo $i; ?></a>
            </li>
        <?php endfor; ?>
    </ul>
    </nav>
</div>

<div class="toast-container position-absolute top-0 end-0 p-3">
    <div
        class="toast align-items-center text-white bg-success border-0"
        role="alert"
        aria-live="assertive"
        aria-atomic="true"
        id="toast-message"
    >
        <div class="d-flex">
            <div class="toast-body">
            Ajouté au panier avec succès
        </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="modal-close-btn">Fermer</button>
                <button type="button" class="btn btn-primary" id="modal-valid-btn">Valider et réinitialiser</button>
            </div>
        </div>
    </div>
</div>

<script src="./asset/js/Services/cart.js"></script>