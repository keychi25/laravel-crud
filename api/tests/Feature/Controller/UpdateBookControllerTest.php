<?php

namespace Tests\Feature\Controller;

use App\Models\Book;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;


class UpdateBookControllerTest extends TestCase
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
        $request = [
            'title' => 'Ruby Book',
            'author' => 'Matz',
        ];
        $response = $this->put('/api/books/1', $request);
        $response->assertStatus(201);

        $this->assertDatabaseHas(Book::class, [
            'title' => 'Ruby Book',
            'author' => 'Matz',
        ]);
    }
}
