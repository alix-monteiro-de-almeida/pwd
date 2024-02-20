<?php

namespace App\Model;

class Category
{
    private ?int $id;

    private ?string $name;

    private ?string $description;

    private ?\DateTime $createdAt;

    private ?\DateTime $updatedAt;

    public function __construct(?int $id = null, ?string $name = null, ?string $description = null, ?\DateTime $createdAt = null, ?\DateTime $updatedAt = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): Category
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): Category
    {
        $this->name = $name;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): Category
    {
        $this->description = $description;
        return $this;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTime $createdAt): Category
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTime $updatedAt): Category
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    public function getProducts(): array
    {
        $pdo = new \PDO('mysql:host=localhost;dbname=pwd', 'root', '');

        $result = [];

        $statement = $pdo->prepare('SELECT * FROM product INNER JOIN clothing ON product.id = clothing.product_id WHERE product.category_id = :category_id');

        $statement->bindValue(':category_id', $this->id, \PDO::PARAM_INT);

        $statement->execute();

        $results = $statement->fetchAll(\PDO::FETCH_ASSOC);

        $statement = $pdo->prepare('SELECT * FROM product INNER JOIN electronic ON product.id = electronic.product_id WHERE product.category_id = :category_id');

        $statement->bindValue(':category_id', $this->id, \PDO::PARAM_INT);

        $statement->execute();

        $results = array_merge($statement->fetchAll(\PDO::FETCH_ASSOC), $results);

        $products = [];

        foreach ($results as $result) {
            if (isset($result['size'])) {
                $products[] = new Clothing(
                    $result['id'],
                    $result['name'],
                    json_decode($result['photos']),
                    $result['price'],
                    $result['description'],
                    $result['quantity'],
                    $result['category_id'],
                    new \DateTime($result['created_at']),
                    $result['updated_at'] ? (new \DateTime($result['updated_at'])) : null,
                    $result['size'],
                    $result['color'],
                    $result['type'],
                );
            } else {
                $products[] = new Electronic(
                    $result['id'],
                    $result['name'],
                    json_decode($result['photos']),
                    $result['price'],
                    $result['description'],
                    $result['quantity'],
                    $result['category_id'],
                    new \DateTime($result['created_at']),
                    $result['updated_at'] ? (new \DateTime($result['updated_at'])) : null,
                    $result['brand'],
                    $result['waranty_fee'],
                );
            }
        }

        return $products;
    }

    public function findOneById(int $id): static|false
    {
        $pdo = new \PDO('mysql:host=localhost;dbname=pwd', 'root', '');
        $sql = "SELECT * FROM category WHERE id = :id";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();
        $category = $statement->fetch(\PDO::FETCH_ASSOC);
        if ($category) {
            return new static(
                $category['id'],
                $category['name'],
                $category['description'],
                new \DateTime($category['created_at']),
                $category['updated_at'] ? (new \DateTime($category['updated_at'])) : null
            );
        }

        return false;
    }

    public function findAll(): array
    {
        $pdo = new \PDO('mysql:host=localhost;dbname=pwd', 'root', '');
        $sql = "SELECT * FROM category";
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $categories = $statement->fetchAll(\PDO::FETCH_ASSOC);
        $results = [];
        foreach ($categories as $category) {
            $results[] = new static(
                $category['id'],
                $category['name'],
                $category['description'],
                new \DateTime($category['created_at']),
                $category['updated_at'] ? (new \DateTime($category['updated_at'])) : null
            );
        }

        return $results;
    }

    public function create(): static
    {
        $pdo = new \PDO('mysql:host=localhost;dbname=pwd', 'root', '');
        $sql = "INSERT INTO category (name, description, created_at) VALUES (:name, :description, :created_at)";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(':name', $this->name);
        $statement->bindValue(':description', $this->description);
        $statement->bindValue(':created_at', (new \DateTime())->format('Y-m-d H:i:s'));
        $statement->execute();
        $this->id = (int)$pdo->lastInsertId();
        return $this;
    }

    public function update(): static
    {
        $pdo = new \PDO('mysql:host=localhost;dbname=pwd', 'root', '');
        $sql = "UPDATE category SET name = :name, description = :description, updated_at = :updated_at WHERE id = :id";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(':name', $this->name);
        $statement->bindValue(':description', $this->description);
        $statement->bindValue(':updated_at', (new \DateTime())->format('Y-m-d H:i:s'));
        $statement->bindValue(':id', $this->id);
        $statement->execute();
        return $this;
    }

}