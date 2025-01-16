<form method="post">
    <div class="mb-3">
        <label for="category_name" class="form-label">Name</label>
        <input type="text" name="category_name" id="category_name" class="form-control"
               value="<?php echo isset($category['category_name']) ? $category['category_name'] : ""; ?>" required>
    </div>
    <div class="mb-3 d-flex justify-content-end">
        <button type="submit" class="btn <?php echo isset($id) ? "btn-success" : "btn-primary"; ?>"
                name="<?php echo isset($id) ? "edit_button" : "valid_button"; ?>"
                value="submit">
            <?php echo isset($id) ? "Modifier" : "Enregistrer"; ?>
        </button>
    </div>
</form>