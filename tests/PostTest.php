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

    public function testOpenPostsPage(){
        $this->visit('/')
            ->click('Posts')
            ->seePageIs('/posts');
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
        $this->visit('/posts/create')
            ->see('Submit a post');
    }

    public function testPostsFormValidation()
    {
        $this->visit('/posts/create')
            ->press('Submit')
            ->see('The title field is required')
            ->see('The slug field is required')
            ->see('The description field is required');
    }

    public function testSubmitPostsToDb()
    {
        $this->visit('/posts/create')
            ->type('testing', 'title')
            ->type('testing'.rand(0, 1000), 'slug')
            ->type('My description', 'description')
            ->press('Submit')
            ->seeInDatabase('posts', ['title' => 'testing']);
    }
}
