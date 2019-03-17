<?php

namespace tests\models;

use models\PeopleModel;
use PDO;
use PHPUnit\Framework\TestCase;

class PeopleModelTest extends TestCase
{
    static public function setUpBeforeClass()
    {
        $pdo = new PDO("mysql:host=" . getenv('DB_HOST') . ";dbname=" . getenv('DB_NAME'), getenv('DB_USERNAME'), getenv('DB_PASSWORD'));
        $sql = file_get_contents(__DIR__ . '/../testdb.sql');
        $pdo->exec($sql);        
    }

    public function testAdd()
    {
        $personModel = new PeopleModel;
        $result = $personModel->add('Gabiel Garcia Marquez');
        $this->assertEquals($result, '1');
    }

    /**
     * @expectedException exceptions\DBException
     **/
    public function testAddNull()
    {
        $personModel = new PeopleModel;
        $result = $personModel->add(null);        
    }

    public function testAddDulicate()
    {
        try{
            $personModel = new PeopleModel;
            $result = $personModel->add('Gabiel Garcia Marquez');
        } catch(\exceptions\DBException $e){
            $this->assertEquals('Person with this name already exists', $e->getUserFacingMessage());
        }    
    }
    
    public function testGet()
    {
        $personModel = new PeopleModel;
        $id = $personModel->add('David Smith');           
        $person = $personModel->get($id);
        $this->assertEquals($person->name, 'David Smith');        
    }

    public function testEdt()
    {
        $personModel = new PeopleModel;
        $id = $personModel->add('Paul Racliff');           
        $personOriginal = $personModel->get($id);
        $personModel->edit($id, 'Paul Racliff edited');
        $personNew = $personModel->get($id);
        $this->assertEquals($personNew->name, 'Paul Racliff edited');   
        $this->assertNotEquals($personNew->name, $personOriginal->name);       
    }
  
    public function testDelete()
    {
        $personModel = new PeopleModel;
        $id = $personModel->add('Matt');
        $personModel->delete($id);
        $person = $personModel->get($id);
        $this->assertFalse($person);    
    }

    public function testSearch()
    {
        $personModel = new PeopleModel;
        $personModel->add('Juanito');
        $personModel->add('Juan Rodriquez');
        $personModel->add('dujuan');
        $personModel->add('dujuanita');
        $personModel->add('dujuanito');
        $personModel->add('juan');
        $personModel->add('juanella');
        $personModel->add('juan8');
        $personModel->add('9juan');
        $personModel->add('juan cien');
        $results = $personModel->search('juan', 0 , 10);
        $this->assertCount(10, $results); 
        $this->assertNotEmpty($results[0]->person_id);
        $this->assertNotEmpty($results[0]->name);
        $results2 = $personModel->search('juan', 10 , 10);        
        $this->assertEmpty($results2);         
    }

}