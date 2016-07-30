<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostTest extends TestCase
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

    public function testWeSeeAListOfPosts()
    {
        factory(App\Post::class)->create([
            'title' => 'hello2',
        ]);

        $this->visit('/posts')
            ->see('hello2');
    }

    public function testWeSeePostsForm()
    {
        $this->visit('/posts/submit')
            ->see('Submit a post');
    }

    public function testPostsFormValidation()
    {
        $this->visit('/posts/submit')
            ->press('Submit')
            ->see('The title field is required')
            ->see('The slug field is required')
            ->see('The description field is required');
    }

    public function testSubmitPostsToDb()
    {
        $this->visit('/posts/submit')
            ->type('testing', 'title')
            ->type('testing', 'slug')
            ->type('My description', 'description')
            ->press('Submit')
            ->seeInDatabase('posts', ['title' => 'testing']);
    }
}
