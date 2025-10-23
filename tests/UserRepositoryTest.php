<?php
use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../src/UserRepository.php';

class UserRepositoryTest extends TestCase {

    private $pdo;
    private $repo;

    protected function setUp(): void {
        // قاعدة بيانات مؤقتة في الرام (مش على الجهاز)
        $this->pdo = new PDO('sqlite::memory:');
        $this->repo = new UserRepository($this->pdo);
        $this->repo->createTable();
    }

    public function testAddAndFetchUsers() {
        // نضيف مستخدم جديد
        $this->repo->addUser('Ahmed', 'ahmed@example.com');
        $this->repo->addUser('Sara', 'sara@example.com');

        // نجيب كل المستخدمين
        $users = $this->repo->getAll();

        // نتحقق
        $this->assertCount(2, $users);
        $this->assertEquals('Ahmed', $users[0]['name']);
        $this->assertEquals('Sara', $users[1]['name']);
    }
}
