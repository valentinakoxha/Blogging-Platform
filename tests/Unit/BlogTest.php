<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Blog;

class BlogTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_blog()
    {
        $blog = Blog::factory()->make([
            'title' => 'My Blog',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
        ]);

        $this->assertEquals('My Blog', $blog->title);
        $this->assertEquals('Lorem ipsum dolor sit amet, consectetur adipiscing elit.', $blog->description);
    }
}






