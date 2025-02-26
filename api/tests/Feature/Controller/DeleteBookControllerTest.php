<?php

namespace Tests\Feature\Controller;

use App\Models\Book;
use Tests\TestCase;


class DeleteBookControllerTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        Book::factory()->create(
            [
                'id' => 1,
                'title' => 'PHP Book',
                'author' => 'PHPER',
            ]
        );
    }

    /**
     * @test
     * @group controller
     */
    public function test_正常系(): void
    {
        $response = $this->delete('/api/books/1');
        $response->assertStatus(204);

        $this->assertDatabaseMissing(Book::class, [
            'title' => 'PHP Book',
            'author' => 'PHPER',
        ]);
    }
}
