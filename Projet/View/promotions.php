<div class="d-flex justify-content-between align-items-center">
    <a href="index.php?component=users" class="p-3">
        <h2>Liste des utilisateurs</h2>
    </a>
    <a href="index.php?component=categories" class="p-3">
        <h2>Liste des catégories</h2>
    </a>
</div>     
<h1 class="text-center">Liste des promotions</h1>
<div class="text-end me-5">
    <a href="index.php?component=promotion&action=create">
        <i class="fa-solid fa-plus" style="color: grey; font-size: 50px;"></i>
    </a>
</div>
<table class="table">
    <thead>
    <tr>
        <th scope="col"><a href="index.php?component=promotions&sortby=id">#</a></th>
        <th scope="col"><a href="index.php?component=promotions&sortby=article_name">Lié à l'article</a></th>
        <th scope="col"><a href="index.php?component=promotions&sortby=reduction">Réduction</a></th>
        <th scope="col"><a href="index.php?component=promotions&sortby=start">Début</a></th>
        <th scope="col"><a href="index.php?component=promotions&sortby=end">Fin</a></th>
        <th scope="col">Actions</th>
    </tr>
    </thead>
    <tbody>

    <?php foreach($offres as $offre) :?>
        <tr class="table align-middle">
            <td><?php echo $offre['id']?></td>
            <td><?php echo $offre['article_name']?></td>
            <td><?php echo $offre['reduction']?></td>
            <td><?php echo $offre['start']?></td>
            <td><?php echo $offre['end']?></td>
            <td>
                <a href="index.php?component=promotions&action=delete&id=<?php echo $offre['id']?>"
                   onclick="return confirm('Êtes-vous sur de vouloir supprimer');">
                    <i class="fa-solid fa-trash text-danger" style="font-size: 20px;"></i>
                </a>
                <a href="index.php?component=promotion&action=edit&id=<?php echo $offre['id']?>">
                    <i class="fa-solid fa-user-pen" style="color: grey; font-size: 20px;"></i>
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>