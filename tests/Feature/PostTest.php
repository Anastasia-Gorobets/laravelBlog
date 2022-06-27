<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class PostTest extends TestCase
{


      use RefreshDatabase;


    /**
     * A basic feature test example.
     *
     * @return void
     */
  /*  public function testNoBlogPostsWhenNothingInDatabase()
    {
        $response = $this->get('/posts');

        $response->assertSeeText('No posts');
    }*/

/*    public function testSee1BlogPost(){

        //Arrange
         $post = $this->createDummyBlogPost();

        //Act
        $response = $this->get('/posts');

        //Assert
        $response->assertSeeText('Title1');

        $this->assertDatabaseHas('blog_posts',['title'=>'Title1']);
    }*/

    public function testStoreValid()
    {
        $this->actingAs($this->user());

        $params = [
          'title'=>'Valid title222',
          'content'=>'Valid content text kkkkkkkkkkkkkkk',
        ];

      $this->post('/posts',$params)->assertStatus(302)->assertSessionHas('status');
      $this->assertEquals(session('status'), 'Blog post was created');

    }


   public function testStoreFail()
    {
        $this->actingAs($this->user());

        $params = [
            'title'=>'Text',
            'content'=>'Text',
        ];

     $this->post('/posts',$params)->assertStatus(302)->assertSessionHas('errors');

     $messages = session('errors')->getMessages();

     $this->assertEquals($messages['title'][0], 'The title must be at least 5 characters.');
     $this->assertEquals($messages['content'][0], 'The content must be at least 10 characters.');




    }

   public function testUpdateValid(){
       $this->actingAs($this->user());

       //Arrange
        $post = $this->createDummyBlogPost();
        $this->assertDatabaseHas('blog_posts',['title'=>'New title 1']);
        $params = [
            'title'=>'New title1',
            'content'=>'New content1',
        ];



        $this->put("/posts/{$post->id}",$params)->assertStatus(302)->assertSessionHas('status');
        $this->assertEquals(session('status'), 'Blog post was updated');

        $this->assertDatabaseMissing('blog_posts',['title'=>'Title1']);



    }


 /*   public function testDelete(){
        $this->actingAs($this->user());

        //Arrange
        $post = $this->createDummyBlogPost();
        $this->delete("/posts/{$post->id}")->assertStatus(302)->assertSessionHas('status');
        $this->assertEquals(session('status'), 'Blog post was deleted');
        $this->assertDatabaseMissing('blog_posts',$post->toArray());

    }*/


    private function createDummyBlogPost(){

        return BlogPost::factory()->newTitle()->create();

    }

    public function testComments(){

        $user = $this->user();
        $post = $this->createDummyBlogPost();


        Comment::factory()->count(2)->create(['commentable_id'=>$post->id, 'commentable_type'=>BlogPost::class, 'user_id'=>$user->id]);


        $response = $this->get('/posts');

        $response->assertSeeText('2 comments');





    }


}
