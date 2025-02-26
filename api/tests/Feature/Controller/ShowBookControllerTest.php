<?php


namespace Tests\Feature\Controller;

use App\Models\Book;
use Illuminate\Support\Facades\DB;
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

    /**
     * @test
     * @group controller
     */
    public function 正常系(): void
    {
        $response = $this->get('/api/books/1');
        $response->assertStatus(200);
        $this->assertDatabaseHas(Book::class, [
            'title' => 'PHP Book',
            'author' => 'PHPER',
        ]);
    }
}
