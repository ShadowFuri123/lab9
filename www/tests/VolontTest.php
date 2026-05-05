<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../www/Volont.php';

class VolontTest extends TestCase
{
    private $pdoMock;
    private $volont;


    protected function setUp(): void
    {
        parent::setUp();

        $this->pdoMock = $this->createMock(PDO::class);
        $mockStmt = $this->createMock(PDOStatement::class);

        $this->pdoMock->method('prepare')->willReturn($mockStmt);
        $mockStmt->method('execute')->willReturn(true);

        $this->volont = new Volont($this->pdoMock);
    }


    public function testAdd()
    {
        $result = $this->volont->add("Ivan", 20, "Экология", "Да", "Помощь");


        $this->assertEquals("Volont Ivan added", $result);
    }

    public function testAddEmptyName()
    {
        $volontNoDb = new Volont(null);

        $result = $volontNoDb->add("", 20, "IT", 3, "Consulting");

        $this->assertEquals("Name cannot be empty", $result);
    }
}