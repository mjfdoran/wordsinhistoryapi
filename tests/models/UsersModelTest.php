<?php

namespace tests\models;

use models\UsersModel;
use PDO;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Config\Definition\Exception\Exception;

class UsersModelTest extends TestCase
{
    //testing password hash is not part of the model responsibility
    //$passwordHashed = password_hash("Password1@", PASSWORD_DEFAULT);
    //password_verify("Password1@", $passwordHashed)

    //validation of languages needed
    //validation of empty strings


    static public function setUpBeforeClass()
    {
        $pdo = new PDO("mysql:host=" . getenv('DB_HOST') . ";dbname=" . getenv('DB_NAME'), getenv('DB_USERNAME'), getenv('DB_PASSWORD'));
        $sql = file_get_contents(__DIR__ . '/../testdb.sql');
        $pdo->exec($sql);        
    }

    public function testAdd()
    {
        $personModel = new UsersModel;
        $result = $personModel->add('Matt Doran', 'mjf.doran@gmail.com', 'mattdoran', "Password1@", 'en');
        $this->assertEquals($result, '1');        
    }

    /**
     * @expectedException exceptions\DBException
     * @dataProvider nullData
     **/
     public function testAddNull($name, $email, $username, $password, $langauge)
     {
         $userModel = new UsersModel;
         $userModel->add($name, $email, $username, $password, $langauge);
     }

    public function nullData()
    {
        return [
            [null, 'mjf.doran@gmail.com', "mattdoran", "Password1@", 'en'],
            ['matt doran', null, "mattdoran", "Password1@", 'en'],
            ['matt doran', 'mjf.doran@gmail.com', "mattdoran", null, 'en'],
            ['matt doran', 'mjf.doran@gmail.com', "mattdoran", "Password1@", null],
            ['matt doran', 'mjf.doran@gmail.com', null, "Password1@", null],
            [null, null, null, null, null],
        ];
    }

    public function testAllowEmptyString()
    {
        $userModel = new UsersModel;
        $newId = $userModel->add('', '', '', '', '');
        $this->assertTrue(is_numeric($newId));
    }

    public function testUniquenessOfEmail()
    {
        try{
            $userModel = new UsersModel;
            $userModel->add('Matt Doran', 'mjf.doran@gmail.com', 'qwerty', "Password1@", 'es');
        } catch(\exceptions\DBException $e){
            $this->assertEquals('User email or username already exists', $e->getUserFacingMessage());
        }

    }

    public function testUniquenessOfUsername()
    {
        try{
            $userModel = new UsersModel;
            $userModel->add('Matt Doran', 'mjf.doran8@gmail.com', 'mattdoran', "Password1@", 'es');
        } catch(\exceptions\DBException $e){
            $this->assertEquals('User email or username already exists', $e->getUserFacingMessage());
        }
    }


    public function testAllowMultipleNames()
    {
        $userModel = new UsersModel;
        $newId = $userModel->add('Matt Doran', 'mjf2.doran@gmail.com', 'qwerty2', "Password1@", 'es');
        $this->assertTrue(is_numeric($newId));
    }


     public function testEdtOnlyOneColumn()
     {
         $personModel = new UsersModel;
         $id = $personModel->add('Matt Doran', 'mjf.doran11@gmail.com', 'mattdoran11', "Password1@", 'en');
         $user = $personModel->get($id);
         $user->name = 'new name';
         $personModel->edit($user);
         $user = $personModel->get($id);
         $this->assertEquals('new name', $user->name);
         $this->assertEquals('mjf.doran11@gmail.com', $user->email);
     }

    
    public function testDelete()
    {
        $personModel = new UsersModel;
        $id = $personModel->add('Matt Doran', 'mjf.doran111@gmail.com', 'mattdoran111', "Password1@", 'en');
        $user = $personModel->get($id);
        $personModel->delete($id);
        $person = $personModel->get($id);
        $this->assertFalse($person);    
    }

    //todo when quotes are tested i need to make sure that they are not deleted when a user is deleted
}