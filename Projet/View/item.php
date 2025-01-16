<?php require './_partials/errors.php'; ?>

<form method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input type="file" name="image" id="image" class="form-control"/>
    </div>
    <div class="mb-3 d-flex align-items-end" id="item-image">
        <?php if (!empty($item) && !empty($item['Image'])) : ?>
            <img class="img-thumbnail" src="./uploads/<?php echo $item['Image']; ?>" width="100"/>
        <?php endif; ?>
    </div>
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
    <label for="category_id" class="form-label">Catégorie</label>
    <select class="form-select" aria-label="Default select example" name="category_id" id="category_id" required>
        <option value="<?php echo isset($item['category_id']) ? $item['category_id'] : ""; ?>" selected>
            <?php echo isset($item['category_id']) ? $item['category_id'] : "Sélectionnez une catégorie"; ?>
        </option>
        <?php foreach($categories as $category) :?>
        <option value="<?php echo $category['category_name']; ?>">
            <?php echo $category['category_name']; ?>
        </option>
        <?php endforeach; ?>
    </select>
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
<script type="module">
    import {handleRemoveImageClick} from "./asset/js/Components/item.js";

    document.addEventListener('DOMContentLoaded', () => {
        handleRemoveImageClick()
    })
</script>