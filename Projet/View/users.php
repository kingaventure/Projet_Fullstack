<div class="d-flex justify-content-between align-items-center">
    <a href="index.php?component=items" class="p-3">
        <h2>Liste des articles</h2>
    </a>
    <a href="index.php?component=promotions" class="p-3">
        <h2>Liste des promotions</h2>
    </a>
</div>     
<h1 class="text-center">Liste des utilisateurs</h1>
<div class="text-end me-5">
    <a href="index.php?component=user&action=create">
        <i class="fa-solid fa-user-plus fa-2xl" style="color: grey; font-size: 50px;"></i>
    </a>
</div>
<table class="table">
    <thead>
    <tr>
        <th scope="col"><a href="index.php?component=users&sortby=id">#</a></th>
        <th scope="col"><a href="index.php?component=users&sortby=username">Username</a></th>
        <th scope="col"><a href="index.php?component=users&sortby=email">Email</a></th>
        <th scope="col"><a href="index.php?component=users&sortby=enabled">Enabled</a></th>
        <th scope="col">Actions</th>
    </tr>
    </thead>
    <tbody>

    <?php foreach($users as $user) :?>
        <tr class="table align-middle">
            <td><?php echo$user['id']?></td>
            <td><?php echo$user['username']?></td>
            <td><?php echo$user['email']?></td>
            <td>
                <a href="index.php?component=users&action=toggle-enabled&id=<?php echo $user['id']?>">
                    <i
                            class="fa-solid
                            <?php
                                echo $user['enabled'] ?
                                    "fa-user-check text-success" :
                                    "fa-user-lock text-danger"
                            ?>"
                    >
                    </i>
                </a>
            </td>
            <td>
                <a
                        href="index.php?component=users&action=delete&id=<?php echo $user['id']?>"
                        onclick="return confirm('Êtes-vous sur de vouloir supprimer');"
                >
                    <i class="fa-solid fa-trash text-danger" style="font-size: 20px;"></i>
                </a>
                <a href="index.php?component=user&action=edit&id=<?php echo $user['id']?>">
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
                <a class="page-link" href="index.php?component=users&page=<?php echo $i; ?>">
                    <?php echo $i; ?>
                </a>
            </li>
        <?php endfor; ?>
    </ul>
</nav>