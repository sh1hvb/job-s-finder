<?php
use PHPUnit\Framework\TestCase;
use shehab\JobFinder\DBConnection;
class DBConnectionTest extends TestCase
{
    private $host = 'localhost';
    private $dbname = 'placement';
    private $username = 'root';
    private $password = '';
    private $dbConnection;

    public function setUp():void    {
        $this->dbConnection = new DBConnection($this->host, $this->dbname, $this->username, $this->password);
    }

    public function testCreateConnection()
    {
        $this->dbConnection->createConnection();
        $conn = $this->dbConnection->getConnection();
        $this->assertInstanceOf(PDO::class, $conn);
    }
}
