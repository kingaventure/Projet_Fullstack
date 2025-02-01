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

    <?php foreach($promotions as $promotion) :?>
        <tr class="table align-middle">
            <td><?php echo $promotion['id']?></td>
            <td><?php echo $promotion['article_name']?></td>
            <td><?php echo $promotion['reduction']?></td>
            <td><?php echo $promotion['start']?></td>
            <td><?php echo $promotion['end']?></td>
            <td>
                <a href="index.php?component=promotions&action=delete&id=<?php echo $promotion['id']?>"
                   onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette promotion ?');">
                    <i class="fa-solid fa-trash text-danger" style="font-size: 20px;"></i>
                </a>
                <a href="index.php?component=promotion&action=edit&id=<?php echo $promotion['id']?>">
                    <i class="fa-solid fa-user-pen" style="color: grey; font-size: 20px;"></i>
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
        <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
            <li class="page-item <?php echo $i === $page ? 'active' : ''; ?>">
                <a class="page-link" href="index.php?component=promotions&page=<?php echo $i; ?>">
                    <?php echo $i; ?>
                </a>
            </li>
        <?php endfor; ?>
    </ul>
</nav>