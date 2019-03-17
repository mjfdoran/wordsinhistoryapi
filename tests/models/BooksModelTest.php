<?php

namespace tests\models;

use models\BooksModel;
use PDO;
use PHPUnit\Framework\TestCase;

class BooksModelTest extends TestCase
{
    //NOT VALIDATED AT DB LEVEL 
    //adding with no description
    //adding with no language
    //test language invalid - double check

    //searching tested seperately

    static public function setUpBeforeClass()
    {
        $pdo = new PDO("mysql:host=" . getenv('DB_HOST') . ";dbname=" . getenv('DB_NAME'), getenv('DB_USERNAME'), getenv('DB_PASSWORD'));
        $sql = file_get_contents(__DIR__ . '/../testdb.sql');
        $pdo->exec($sql);        
    }


    public function testAddAndDataFormat()
    {
        $booksModel = new BooksModel;
        $result = $booksModel->add('Cien anos de soledad', 'es');
        $this->assertEquals('1', $result);
        $book = $booksModel->get('1', 'es');
        $this->assertEquals('1', $book->id);
        $this->assertEquals('Cien anos de soledad', $book->name);        
        $this->assertNotEmpty($book->created_at);
        $this->assertStringMatchesFormat('%d%d%d%d-%d%d-%d%d %d%d:%d%d:%d%d', $book->created_at);
        $this->assertNotEmpty($book->updated_at);
        $this->assertStringMatchesFormat('%d%d%d%d-%d%d-%d%d %d%d:%d%d:%d%d', $book->updated_at);    
    }
    

    public function testAddingDuplicate()
    {
        try{
            $booksModel = new BooksModel;
            $booksModel->add('Cien anos de soledad', 'es');    
        } catch(\exceptions\DBException $e){            
            $this->assertEquals('Book already exists', $e->getUserFacingMessage());
        }    
    }
  
  
    public function testAddingWithSameNameButDifferentLanguage()
    {
        $booksModel = new BooksModel;
        $result = $booksModel->add('Cien anos de soledad', 'en');    
        $this->assertNotEmpty($result);                
    }

    /**
    * Note this still increments the auto incrementing id field
    * @expectedException exceptions\DBException
    **/
    public function testAddingWithSameNameAndLanguage()
    {
        $booksModel = new BooksModel;
        $result = $booksModel->add('Cien anos de soledad', 'es');        
    }


    public function testNoNameAndNoLanguage()
    {
        $booksModel = new BooksModel;
        $newId = $booksModel->add('', 'en');    
        $this->assertNotEmpty($newId);        
    }

    /**
    * @expectedException Exception
    * this fails on specific model validation
    **/
    public function testNoLanguage()
    {
        $booksModel = new BooksModel;
        $newId = $booksModel->add('abc', '');    
        $this->assertNotEmpty($newId);
    }

    /**
     * @expectedException exceptions\DBException
     **/
    public function testAddingNameNull()
    {
        $booksModel = new BooksModel;
        $booksModel->add(null, 'es');            
    }

    /**
     * @expectedException Exception
     **/
    public function testAddingLanguageNull()
    {
        $booksModel = new BooksModel;
        $booksModel->add('abc', null);            
    }


    public function testAccents()
    {
        $booksModel = new BooksModel;
        $bookId = $booksModel->add('áéíóú', 'es');       
        $book = $booksModel->get($bookId, 'es');        
        $this->assertEquals('áéíóú', $book->name);
    }


    public function testEdit() 
    {
        $booksModel = new BooksModel;
        $newId = $booksModel->add('qwerty', 'es');                
        $bookOriginal = $booksModel->get($newId, 'es');
        sleep(2);//so update at time is different
        $booksModel->edit($newId, 'qwerty-edited', 'es');
        $editedBook = $booksModel->get($newId, 'es');
        $this->assertEquals('qwerty-edited', $editedBook->name);        
        $this->assertNotEquals($bookOriginal->updated_at, $editedBook->updated_at);        
    }


    public function testDelete() 
    {
        $booksModel = new BooksModel;
        $newId = $booksModel->add('qwerty', 'es');
        $booksModel->delete($newId, 'es');
        $deletedBook = $booksModel->get($newId, 'es');
        $this->assertFalse($deletedBook);        
    }

    public function testSearch() 
    {
        $booksModel = new BooksModel;
        //ten books with hello in english - one in spanish
        $newId = $booksModel->add('hello goodbye', 'en');
        $newId = $booksModel->add('hello hello', 'en');
        $newId = $booksModel->add('you say hello', 'en');
        $newId = $booksModel->add('hello good morning', 'en');
        $newId = $booksModel->add('10 hello', 'en');
        $newId = $booksModel->add('hello\'s', 'en');
        $newId = $booksModel->add('hello hello hello', 'en');        
        $newId = $booksModel->add('abchellodef', 'en');        
        $newId = $booksModel->add('nine hellow', 'en');        
        $newId = $booksModel->add('hello ten', 'en');
        $newId = $booksModel->add('hello en español', 'es');  

        $booksEsSingle = $booksModel->search('hello', 0, 1, 'en');
        $firstBookId = $booksEsSingle[0]->book_id;

        $booksEsMultiple = $booksModel->search('hello', 1, 9, 'en');
        foreach($booksEsMultiple as $booksEsMul)
        {
            //assert same record not returned twice
            $this->assertNotEquals($firstBookId, $booksEsMul->book_id);        
        }

        $booksEs = $booksModel->search('hello', 0, 5, 'es');
        $booksEn = $booksModel->search('hello', 0, 5, 'en');
        $this->assertCount(5, $booksEn);    
        $this->assertCount(1, $booksEs);    

        $booksEs2 = $booksModel->search('hello', 4, 5, 'es');
        $this->assertCount(5, $booksEn);

        $booksEs2 = $booksModel->search('hello', 4, 6, 'es');
        $this->assertCount(5, $booksEn);

    }

}