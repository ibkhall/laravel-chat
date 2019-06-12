<?php

namespace Tests\Features;

use Illuminate\Foundation\Application;
use Khall\Chat\ChatServiceProvider;
use Khall\Chat\Message;
use Khall\Chat\User;
use Orchestra\Testbench\TestCase;

class ChatTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->artisan('vendor:publish --tag=config');
        $this->loadLaravelMigrations();
        $this->loadMigrationsFrom(\dirname(\dirname(__DIR__)) . '/database/migrations');
        User::create([
            'name'     => 'user1',
            'email'    => 'user1@mail.fr',
            'password' => bcrypt('123456')
        ]);
        User::create([
            'name'     => 'user2',
            'email'    => 'user2@mail.fr',
            'password' => bcrypt('123456')
        ]);
    }

    /**
     * @param Application $app
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }

    /**
     * @param Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [ChatServiceProvider::class];
    }

    /**
     * test package.
     */
    public function testPackage()
    {
        $this->assertTrue(true);
    }

    /**
     * Test Get list of conversations for a user.
     */
    public function testGetConversationsList()
    {
        $user = User::find(1);
        $uri = config('khall_chat.route');
        $res = $this->actingAs($user)
            ->get($uri);
        $res->assertStatus(200);
        $res->assertViewHas('users');
        $res->assertViewHas('unread');
    }

    /**
     *Test show Conversation.
     */
    public function testShowConversation()
    {
        $user = User::find(1);
        $user2 = User::find(2);
        $res = $this->actingAs($user)
            ->get(config('khall_chat.route') . '/' . $user2->id);
        $res->assertStatus(200);
        $res->assertViewHas('users');
        $res->assertViewHas('unread');
    }

    /**
     * Test store message.
     */
    public function testStoreMessage()
    {
        $user = User::find(1);
        $user2 = User::find(2);
        $res = $this->actingAs($user)
            ->post(config('khall_chat.route') . '/' . $user2->id, ['content' => 'salut']);
        $res->assertStatus(302);
        $res->assertSessionHas('success');
    }

    /**
     * test get all messages.
     */
    public function testGetAllMessages()
    {
        $mes = Message::all();
        $this->assertIsObject($mes);
    }
}
