<?php

class UserRepository {
    private \PDO $pdo;

    public function __construct(\PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function createTable() {
        $this->pdo->exec("
            CREATE TABLE IF NOT EXISTS users (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                name TEXT,
                email TEXT
            )
        ");
    }

    public function addUser(string $name, string $email): bool {
        $stmt = $this->pdo->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
        return $stmt->execute([$name, $email]);
    }

    public function getAll(): array {
        $stmt = $this->pdo->query("SELECT * FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
