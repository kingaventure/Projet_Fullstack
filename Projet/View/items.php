<div class="d-flex justify-content-between align-items-center">
    <a href="index.php?component=categories" class="p-3">
        <h2>Liste des catégories</h2>
    </a>
    <a href="index.php?component=users" class="p-3">
        <h2>Liste des utilisateurs</h2>
    </a>
</div>    
<h1 class="text-center">Liste des Articles</h1>
<div class="text-end me-5">
    <a href="index.php?component=item&action=create">
    <i class="fa-solid fa-plus" style="color: grey; font-size: 50px;"></i>
    </a>
</div>
<table class="table">
    <thead>
    <tr>
        <th scope="col"><a href="index.php?component=items&sortby=Id">#</a></th>
        <th scope="col"><a href="index.php?component=items&sortby=Name">Nom</a></th>
        <th scope="col"><a href="index.php?component=items&sortby=Description">Description</a></th>
        <th scope="col"><a href="index.php?component=items&sortby=category_id">Catégorie</a></th>
        <th scope="col"><a href="index.php?component=items&sortby=Image">Image</a></th>
        <th scope="col"><a href="index.php?component=items&sortby=Prix">Prix</a></th>
        <th scope="col"><a href="index.php?component=items&sortby=Stock">Stock</a></th>
        <th scope="col">Actions</th>
    </tr>
    </thead>
    <tbody>

    <?php foreach($items as $item) :?>
        <?php $category = getArticleCategoryNames($pdo, $item['category_id']);
        $item['category_id'] = $category['category_name']; ?>
        <tr class="table align-middle">
            <td><?php echo $item['Id']?></td>
            <td><?php echo $item['Name']?></td>
            <td><?php echo $item['Description']?></td>
            <td><?php echo $item['category_id']?></td>
            <td><img src="./uploads/<?php echo $item['Image']?>" width="200" height="100"></td>
            <td><?php echo $item['Prix']?></td>
            <td><?php echo $item['Stock']?></td>
            <td>
                <a
                    href="index.php?component=items&action=delete&Id=<?php echo $item['Id']?>"
                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?');"
                >
                    <i class="fa-solid fa-trash text-danger" style="font-size: 20px;"></i>
                </a>
                <a href="index.php?component=item&action=edit&id=<?php echo $item['Id']?>">
                    <i class="fa-solid fa-pen" style="color: grey; font-size: 20px;"></i>
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>