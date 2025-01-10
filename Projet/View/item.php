<?php require './_partials/errors.php'; ?>

<form method="post">
    <div class="mb-3">
        <label for="Name" class="form-label">Nom</label>
        <input type="text" name="Name" id="Name" class="form-control"
               value="<?php echo isset($item['Name']) ? $item['Name'] : ""; ?>" required>
    </div>
    <div class="mb-3">
        <label for="Description" class="form-label">Description</label>
        <input type="text" name="Description" id="Description" class="form-control"
               value="<?php echo isset($item['Description']) ? $item['Description'] : ""; ?>" required>
    </div>
    <div class="mb-3">
        <label for="Category" class="form-label">Catégorie</label>
        <input type="text" name="Category" id="Category" class="form-control"
               value="<?php echo isset($item['Category']) ? $item['Category'] : ""; ?>" required>
    </div>
    <div class="mb-3">
        <label for="Stock" class="form-label">Stock</label>
        <input type="number" name="Stock" id="Stock" class="form-control"
               value="<?php echo isset($item['Stock']) ? $item['Stock'] : ""; ?>" required>
    </div>
    <div class="mb-3">
        <label for="Prix" class="form-label">Prix</label>
        <input type="number" name="Prix" id="Prix" class="form-control"
               value="<?php echo isset($item['Prix']) ? $item['Prix'] : ""; ?>" required>
    </div>
    <div class="mb-3 d-flex justify-content-end">
        <button type="submit" class="btn <?php echo isset($id) ? "btn-success" : "btn-primary"; ?>"
                name="<?php echo isset($id) ? "edit_button" : "valid_button"; ?>">
            <?php echo isset($id) ? "Modifier" : "Enregistrer"; ?>
        </button>
    </div>
</form>