<?php


namespace Tests\Feature\Controller;

use App\Models\Book;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;


class ShowBookControllerTest extends TestCase
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
        $response = $this->get('/api/books/1');
        $response->assertStatus(200);
        $this->assertDatabaseHas(Book::class, [
            'title' => 'PHP Book',
            'author' => 'PHPER',
        ]);
    }

    #[Test]
    #[Group('controller')]
    public function test_存在しないIDの時は404を返却する(): void
    {
        $response = $this->get('/api/books/12345');
        $response->assertStatus(404);
    }
}
