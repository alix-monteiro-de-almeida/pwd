<?php

use App\Model\Clothing;
use App\Model\Electronic;


require_once __DIR__ . '/../vendor/autoload.php';

var_dump($_GET);

if (isset($id_product)) {
    $electronicInstance = new Electronic();
    $clothingInstance = new Clothing();

    $electronic = $electronicInstance->findOneById($id_product);
    $clothing = $clothingInstance->findOneById($id_product);

    if ($electronic && $clothing) {
        echo "<h1>Détails du produit</h1>";
        echo "<h2>Nom du produit (Electronic) : " . $electronic->getName() . "</h2>";
        echo "<p>Description du produit (Electronic) : " . $electronic->getDescription() . "</p>";
        echo "<p>Prix du produit (Electronic) : " . $electronic->getPrice() . "</p>";
        echo "<p>Quantité du produit (Electronic) : " . $electronic->getQuantity() . "</p>";

        echo "<h2>Nom du produit (Clothing) : " . $clothing->getName() . "</h2>";
        echo "<p>Description du produit (Clothing) : " . $clothing->getDescription() . "</p>";
        echo "<p>Prix du produit (Clothing) : " . $clothing->getPrice() . "</p>";
        echo "<p>Quantité du produit (Clothing) : " . $clothing->getQuantity() . "</p>";
        
    } elseif ($electronic || $clothing) {
        $product = $electronic ? $electronic : $clothing;
        echo "<h1>Détails du produit</h1>";
        echo "<h2>Nom du produit : " . $product->getName() . "</h2>";
        echo "<p>Description du produit : " . $product->getDescription() . "</p>";
        echo "<p>Prix du produit : " . $product->getPrice() . "</p>";
        echo "<p>Quantité du produit : " . $product->getQuantity() . "</p>";
    } else {
        echo "<p>Le produit n'est pas disponible.</p>";
    }
} else {
    echo "<p>L'ID est invalide.</p>";
}

?>

<!-- <form method="get" action="">
    <label for="id_product">Choisissez l'ID du produit :</label>
    <input type="text" id="id_product" name="id_product">
    <input type="submit" value="Afficher les détails">
</form> -->
