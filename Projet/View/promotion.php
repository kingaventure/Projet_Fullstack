<form method="post">
    <div class="mb-3">
        <label for="article_id" class="form-label">Article ID</label>
        <input type="number" name="article_id" id="article_id" class="form-control"
               value="<?php echo isset($offre['article_id']) ? $offre['article_id'] : ""; ?>" required>
    </div>
    <div class="mb-3">
        <label for="start" class="form-label">Début de l'offre</label>
        <input type="date" name="start" id="start" class="form-control"
               value="<?php echo isset($offre['start']) ? $offre['start'] : ""; ?>" required>
    </div>
    <div class="mb-3">
        <label for="end" class="form-label">Fin de l'offre</label>
        <input type="date" name="end" id="end" class="form-control"
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