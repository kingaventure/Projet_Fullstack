<?php
$promotions = getAllPromotions($pdo);
$currentDate = new DateTime();
?>

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

            <?php 
            $category = getArticleCategoryNames($pdo, $article['category_id']);
            $article['category_id'] = $category['category_name'];

            $articlePromotions = array_filter($promotions, function($promo) use ($article) {
                return $promo['article_id'] == $article['Id'];
            });
            $articlePromotion = reset($articlePromotions);
            $hasPromotion = isset($articlePromotion) && isset($articlePromotion['reduction']) && $articlePromotion['reduction'] > 0;
            $promotionEndDate = $hasPromotion && isset($articlePromotion['end']) ? new DateTime($articlePromotion['end']) : null;
            $isPromotionValid = $hasPromotion && $promotionEndDate && $promotionEndDate > $currentDate;

            if ($isPromotionValid) {
                $originalPrice = $article['Prix'];
                $discount = $articlePromotion['reduction'] / 100;
                $newPrice = $originalPrice - ($originalPrice * $discount);
            } else {
                $originalPrice = $article['Prix'];
                $newPrice = $article['Prix'];
                $articlePromotion['reduction'] = 0;
            }
            ?>

            <div class="col-md-4 mt-5">
                <div class="card" style="width: 100%; margin-bottom: 20px;">
                    <img src="./uploads/<?php echo $article['Image']; ?>" class="card-img-top" alt="volcan">
                    <div class="card-body">
                        <h4 class="card-title"><?php echo $article['Name']; ?></h4>
                        <h6 class="card-title">Catégorie : <?php echo $article['category_id']; ?></h6>

                        <?php if ($isPromotionValid): ?>
                            <h6 class="card-title">
                                Prix :
                                <span style="text-decoration: line-through;"><?php echo $originalPrice; ?>$</span>
                                <?php echo $newPrice; ?>$ (-<?php echo $articlePromotion['reduction']; ?>%)
                            </h6>
                            <h6 class="card-title">
                                Fin de la promotion : <?php echo $promotionEndDate->format('d/m/Y H:i'); ?>
                            </h6>
                        <?php else: ?>
                            <h6 class="card-title">Prix : <?php echo $article['Prix']; ?>$</h6>
                        <?php endif; ?>

                        <h6 class="card-title">Nombre restant : <?php echo $article['Stock']; ?></h6>
                        <p class="card-text"><?php echo substr($article['Description'], 0, 50) . '...'; ?></p>

                        <?php if ($article['Stock'] > 0): ?>
                            <button class="buyBtn btn btn-primary"
                                data-article-name="<?php echo $article['Name']; ?>"
                                data-article-price="<?php echo $newPrice; ?>"
                                data-article-stock="<?php echo $article['Stock']; ?>"
                                data-article-original-price="<?php echo $originalPrice; ?>"
                                data-article-discount="<?php echo $articlePromotion['reduction']; ?>">
                                Acheter
                            </button>
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

    <nav>
        <ul class="pagination justify-content-center mt-4">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?php echo $i === $page ? 'active' : ''; ?>">
                    <a class="page-link"
                       href="?component=article&page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>&category=<?php echo urlencode($category_id); ?>">
                       <?php echo $i; ?>
                    </a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
</div>

<div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cartModalLabel">Votre Panier</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="cartModalBody">
                <!-- Les articles du panier seront affichés ici -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary">Passer à la caisse</button>
            </div>
        </div>
    </div>
</div>

<script src="./asset/js/Services/cart.js"></script>