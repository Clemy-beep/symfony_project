<?php 

declare(strict_types=1);
namespace App\Tests\Unit;

use PHPUnit\Framework\TestCase;

use App\Entity\Article;
use App\Entity\User;

class ArticleTest extends TestCase{
    private Article $article;

    protected function setUp():void {
        parent::setUp();
        $this->article = new Article();
    }

    public function testGetTitle():void {
        $value = "newx title";
        $response = $this->article->setTitle($value);

        self::assertInstanceOf(Article::class, $response);
        self::assertEquals($value, $this->article->getTitle());
    }

    public function testGetContent():void {
        $value = " newx content";
        $response = $this->article->setContent($value);

        self::assertInstanceOf(Article::class, $response);
        self::assertEquals($value, $this->article->getContent());
    }
    
    public function testGetAuthor():void {
        $value = new User();
        $response = $this->article->setAuthor($value);
        
        self::assertInstanceOf(Article::class, $response);
        self::assertCount(1, $this->article->getAuthor());
        self::assertTrue($this->article->getAuthor()->contains($value));
    }
}
