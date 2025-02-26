<?php

namespace Tests\Feature\Controller;

use App\Models\Book;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
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

    #[Test]
    #[Group('controller')]
    public function test_正常系(): void
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


    #[Test]
    #[Group('controller')]
    public function test_存在しないIDの時は404を返却する(): void
    {
        $request = [
            'title' => 'Ruby Book',
            'author' => 'Matz',
        ];
        $response = $this->put('/api/books/12345');
        $response->assertStatus(404);

        $this->assertDatabaseMissing(Book::class, [
            'title' => 'Ruby Book',
            'author' => 'Matz',
        ]);
    }
}
