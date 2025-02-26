<?php


namespace Tests\Feature\Controller;

use App\Models\Book;
use Tests\TestCase;


class StoreBookControllerTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @test
     * @group controller
     */
    public function 正常系(): void
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
}
