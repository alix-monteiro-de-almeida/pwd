<?php

require_once '../vendor/autoload.php';

use App\Model\Clothing;
use App\Model\Electronic;
use App\Controller\ShopController;

$shopController = new ShopController();

$electronicInstance = new Electronic();

$clothingInstance = new Clothing();

$electronics = $electronicInstance->findAll();

$clothings = $clothingInstance->findAll();

$shopIndex = $shopController->index('shop');


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My-little-Mvc</title>
</head>
    <body>
        <main>
            <h1>All my Electronics</h1>

            <ul>
                <?php foreach ($electronics as $electronic) : ?>
                    <li>
                        <h2><?= $electronic->getName() ?></h2>
                        <p><?= $electronic->getDescription() ?></p>
                        <p><?= $electronic->getPrice() ?></p>
                        <p><?= $electronic->getBrand() ?></p>
                        <p><?= $electronic->getWarantyFee() ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>

            <h1>All my Clothings</h1>

            <ul>
                <?php foreach ($clothings as $clothing) : ?>
                    <li>
                        <h2><?= $clothing->getName() ?></h2>
                        <p><?= $clothing->getDescription() ?></p>
                        <p><?= $clothing->getPrice() ?></p>
                        <p><?= $clothing->getSize() ?></p>
                        <p><?= $clothing->getType() ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        </main>
    </body>
</html>