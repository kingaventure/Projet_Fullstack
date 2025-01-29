<a class="btn btn-secondary" href="http://localhost/Projet_fullstack/Projet/index.php?component=promotions" role="button">Retour</a>
<form method="post" id="promotion-form">
    <div class="mb-3">
        <label for="article_id" class="form-label">Article</label>
        <select class="form-select" aria-label="Default select example" name="article_id" id="article_id" required>
            <option value="<?php echo isset($offre['article_id']) ? $offre['article_id'] : ""; ?>" selected>
                <?php echo isset($offre['article_id']) ? $offre['article_id'] : "Sélectionnez un article"; ?>
            </option>
            <?php foreach ($articles as $article): ?>
                <option value="<?php echo $article['Id']; ?>">
                    <?php echo $article['Name']; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="start" class="form-label">Début de l'offre</label>
        <input type="datetime-local" name="start" id="start" class="form-control"
               value="<?php echo isset($offre['start']) ? $offre['start'] : ""; ?>" required>
    </div>
    <div class="mb-3">
        <label for="end" class="form-label">Fin de l'offre</label>
        <input type="datetime-local" name="end" id="end" class="form-control"
               value="<?php echo isset($offre['end']) ? $offre['end'] : ""; ?>" required>
    </div>
    <div class="mb-3">
        <label for="reduction" class="form-label">Pourcentage de la promotion</label>
        <input type="number" name="reduction" id="reduction" class="form-control"
               value="<?php echo isset($offre['reduction']) ? $offre['reduction'] : ""; ?>" required>
    </div>
    <div class="mb-3 d-flex justify-content-end">
        <button type="submit" class="btn <?php echo isset($id) ? "btn-success" : "btn-primary"; ?>"
                name="<?php echo isset($id) ? "edit_button" : "valid_button"; ?>">
            <?php echo isset($id) ? "Modifier" : "Enregistrer"; ?>
        </button>
    </div>
</form>

<script>
document.getElementById('promotion-form').addEventListener('submit', function(event) {
    const start = document.getElementById('start').value;
    const end = document.getElementById('end').value;

    if (new Date(start) >= new Date(end)) {
        alert('La date de fin doit être postérieure à la date de début.');
        event.preventDefault();
    }
});
</script>