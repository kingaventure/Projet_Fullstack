<div class="d-flex justify-content-between align-items-center">
    <a href="index.php?component=promotions" class="p-3">
        <h2>Liste des promotions</h2>
    </a>
    <a href="index.php?component=items" class="p-3">
        <h2>Liste des articles</h2>
    </a>
</div>     
<h1 class="text-center">Liste des catégories</h1>
<div class="text-end me-5">
    <a href="index.php?component=category&action=create">
    <i class="fa-solid fa-plus" style="color: grey; font-size: 50px;"></i>
    </a>
</div>
<table class="table">
    <thead>
    <tr>
        <th scope="col"><a href="index.php?component=categories&sortby=Id">#</a></th>
        <th scope="col"><a href="index.php?component=categories&sortby=category_name">Name</a></th>
        <th scope="col">Actions</th>
    </tr>
    </thead>
    <tbody>

    <?php foreach($categories as $category) :?>
        <tr class="table align-middle">
            <td><?php echo$category['Id']?></td>
            <td><?php echo$category['category_name']?></td>
            <td>
               <!-- <?php if ($category['Id'] !== $_SESSION['category_id']) : ?> -->
                    <a
                            href="index.php?component=categories&action=delete&Id=<?php echo $category['Id']?>"
                            onclick="return confirm('Êtes-vous sur de vouloir supprimer');"

                    >
                        <i class="fa-solid fa-trash text-danger" style="font-size: 20px;"></i>
                    </a>
                <?php endif; ?>
                <a href="index.php?component=category&action=edit&Id=<?php echo $category['Id']?>">
                <i class="fa-solid fa-pen" style="color: grey; font-size: 20px;"></i>
                </a>

            </td>

        </tr>
    <?php endforeach; ?>
    </tbody>


</table>
