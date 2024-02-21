<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Model\User;

$user = new User();

$usersList = $user->findAll();

$userById = $user->findOneById($id);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pwd</title>
</head>
    <body>
        <main>
            <h1>Admin Panel</h1>
            <h2>All users registered</h2>
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

            <h2>User by Id</h2>
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
                    <?php foreach ($userById as $user): ?>
                        <tr>
                            <td><?php echo $user->getId(); ?></td>
                            <td><?php echo $user->getFullname(); ?></td>
                            <td><?php echo $user->getEmail(); ?></td>
                            <td><?php echo $user->getRole(); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </main>
    </body>
</html>