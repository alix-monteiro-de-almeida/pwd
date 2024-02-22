<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Model\User;

$user = new User();

// Récupérer l'URI de la requête
$uri = $_SERVER['REQUEST_URI'];

// Vérifier l'URI pour décider quelles données afficher
if ($uri === "/admin/users/list") {
    $usersList = $user->findAll();
    $title = "All Users";
} elseif (preg_match("/\/admin\/users\/show\/(\d+)/", $uri, $matches)) {
    // Si l'URI correspond à "/admin/users/show/[id]", nous récupérons l'ID de l'URI
    $id = intval($matches[1]);
    $userById = $user->findOneById($id);
    $title = "User by ID";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
</head>
<body>
<main>
    <h1>Admin Panel</h1>

    <?php if (isset($title)): ?>
        <h2><?php echo $title; ?></h2>
    <?php endif; ?>

    <?php if (isset($usersList)): ?>
        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Role</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($usersList as $user): ?>
                <tr>
                    <td><?php echo $user->getId(); ?></td>
                    <td><?php echo $user->getFullname(); ?></td>
                    <td><?php echo $user->getEmail(); ?></td>
                    <td><?php echo $user->getRole(); ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <?php if (isset($userById)): ?>
        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Role</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $userById->getId(); ?></td>
                    <td><?php echo $userById->getFullname(); ?></td>
                    <td><?php echo $userById->getEmail(); ?></td>
                    <td><?php echo $userById->getRole(); ?></td>
                </tr>
            </tbody>
        </table>
    <?php endif; ?>
</main>
</body>
</html>
