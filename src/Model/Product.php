<?php

namespace App\Model;

use App\Model\Abstract\AbstractProduct;

class Product extends AbstractProduct
{

    public function __construct(?int $id = null, ?string $name = null, ?array $photos = null, ?int $price = null, ?string $description = null, ?int $quantity = null, ?int $category_id = null, ?\DateTime $createdAt = null, ?\DateTime $updatedAt = null)
    {
        parent::__construct($id, $name, $photos, $price, $description, $quantity, $category_id, $createdAt, $updatedAt);
    }

    // public function findPaginated($page): array
    // {
    // }
}