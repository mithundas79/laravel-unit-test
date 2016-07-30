<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SeederTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testPostTable()
    {
        factory(App\Post::class)->create([
            'title' => 'Hello',
        ]);
        $this->seeInDatabase('posts', ['title' => 'Hello']);
    }
}
