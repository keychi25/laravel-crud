<?php


namespace Tests\Feature\Controller;

use App\Models\Book;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;


class IndexBookControllerTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        Book::factory()->create(
            [
                'title' => 'PHP Book',
                'author' => 'PHPER',
            ]
        );
    }

    #[Test]
    #[Group('controller')]
    public function test_正常系(): void
    {
        $response = $this->get('/api/books');
        $response->assertStatus(200);

        $this->assertDatabaseHas(Book::class, [
            'title' => 'PHP Book',
            'author' => 'PHPER',
        ]);
    }
}
