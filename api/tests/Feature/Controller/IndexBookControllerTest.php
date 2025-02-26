<?php


namespace Tests\Feature\Controller;

use App\Models\Book;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;


class IndexBookControllerTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        DB::table('books')->insert([
            [
                'title' => 'PHP Book',
                'author' => 'PHPER',
            ],
        ]);
    }

    /**
     * @test
     * @group controller
     */
    public function 正常系(): void
    {
        $response = $this->get('/api/books');
        $response->assertStatus(200);

        $this->assertDatabaseHas(Book::class, [
            'title' => 'PHP Book',
            'author' => 'PHPER',
        ]);
    }
}
