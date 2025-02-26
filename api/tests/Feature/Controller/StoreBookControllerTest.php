<?php


namespace Tests\Feature\Controller;

use App\Models\Book;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;


class StoreBookControllerTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    #[Test]
    #[Group('controller')]
    public function test_正常系(): void
    {
        $post = [
            'title' => 'PHP Book',
            'author' => 'PHPER',
        ];
        $response = $this->post('/api/books', $post);
        $response->assertStatus(201);

        $this->assertDatabaseHas(Book::class, [
            'title' => 'PHP Book',
            'author' => 'PHPER',
        ]);
    }

    #[Test]
    #[Group('controller')]
    public function test_タイトルは必須であること(): void
    {
        $post = [
            'title' => '',
            'author' => 'PHPER',
        ];
        $response = $this->post('/api/books', $post);
        $response->assertStatus(422);
    }

    #[Test]
    #[Group('controller')]
    public function test_作者は必須であること(): void
    {
        $post = [
            'title' => 'PHP Book',
            'author' => '',
        ];
        $response = $this->post('/api/books', $post);
        $response->assertStatus(422);
    }
}
