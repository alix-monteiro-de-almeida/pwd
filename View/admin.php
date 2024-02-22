<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Model\User;

$user = new User();

$uri = $_SERVER['REQUEST_URI'];

if ($uri == "/admin/users/list") {
    $findUsers = $user->findAll();


} elseif (preg_match("/\/admin\/users\/show\/(\d+)/", $uri, $matches)) {
    $id = intval($matches[1]);
    $findUserById = $user->findOneById($id);
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

    <?php if (isset($findUsers)): ?>
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
            <?php foreach ($findUsers as $user): ?>
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

    <?php if (isset($findUserById)): ?>
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
                    <td><?php echo $findUserById->getId(); ?></td>
                    <td><?php echo $findUserById->getFullname(); ?></td>
                    <td><?php echo $findUserById->getEmail(); ?></td>
                    <td><?php echo $findUserById->getRole(); ?></td>
                </tr>
            </tbody>
        </table>
    <?php endif; ?>
</main>
</body>
</html>
