<?php


use Mclav\GestionProduit\UserManager;

class testUserManager extends \PHPUnit\Framework\TestCase
{
    function testAddUser()
    {
        $user = new UserManager();
        $user->addUser("Toto", "toto@gmail.com", "Papa");
        $result = $user->getUsers();
        $this->assertEquals("Toto", $result[0]["name"]);
    }
    function testAddUserEmailException()
    {
        $user = new UserManager();
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Email invalide.");
        $user->addUser("Toto", "Toto", "Papa");
    }

    function testUpdateUser()
    {
        $user = new UserManager();
        $user->addUser("Toto", "toto@gmail.com", "Papa");
        $result = $user->getUsers();
        $resultId = $result[0]["id"];
        $user->updateUser($resultId, "Tata", "toto@gmail.com", "Papa");
        $updatedResult = $user->getUsers();
        $this->assertEquals("Tata", $updatedResult[0]["name"]);
    }
    function testRemoveUser()
    {
        $user = new UserManager();
        $user->addUser("Toto", "toto@gmail.com", "Papa");
        $result = $user->getUsers();
        $resultId = $result[0]["id"];
        $user->removeUser($resultId);
        $this->assertEmpty($user->getUsers());
    }

    function testGetUsers()
    {
        $users = new UserManager();
        $users->addUser("Toto", "toto@gmail.com", "Papa");
        $users->addUser("Tata", "tata@gmail.com", "Mama");
        $result = $users->getUsers();
        $this->assertCount(2, $result
        );
    }

    function testInvalidUpdateThrowsException()
    {
        $user = new UserManager();
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Utilisateur introuvable.");
        $user->updateUser($user->getUser(2)["id"], "Toto", "toto@gmail.com", "Papa");
    }

    function testInvalidDeleteThrowsException()
    {
        $user = new UserManager();
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Utilisateur introuvable.");
        $user->removeUser($user->getUser(2)["id"]);
    }
}