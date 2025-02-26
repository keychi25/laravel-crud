<?php

namespace Tests\Feature\Controller;

use App\Models\Book;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
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

    #[Test]
    #[Group('controller')]
    public function test_正常系(): void
    {
        $response = $this->delete('/api/books/1');
        $response->assertStatus(204);

        $this->assertDatabaseMissing(Book::class, [
            'title' => 'PHP Book',
            'author' => 'PHPER',
        ]);
    }

    #[Test]
    #[Group('controller')]
    public function test_存在しないIDの時は404を返却する(): void
    {
        $response = $this->delete('/api/books/12345');
        $response->assertStatus(404);

        $this->assertDatabaseHas(Book::class, [
            'title' => 'PHP Book',
            'author' => 'PHPER',
        ]);
    }
}
