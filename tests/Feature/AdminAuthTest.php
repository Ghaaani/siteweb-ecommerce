<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_pages_redirect_guests_to_login(): void
    {
        foreach (['/products', '/product_categories', '/aboutus'] as $page) {
            $this->get($page)->assertRedirect('/login');
        }
    }

    public function test_admin_write_routes_are_blocked_for_guests(): void
    {
        $this->post('/products', [])->assertRedirect('/login');
        $this->post('/product_categories', ['name' => 'x', 'description' => 'y'])->assertRedirect('/login');
        $this->delete('/products/1')->assertRedirect('/login');
        $this->assertDatabaseCount('product_categories', 0);
    }

    public function test_public_shop_stays_open_to_guests(): void
    {
        foreach (['/index', '/shop', '/cart', '/contact', '/about', '/checkout'] as $page) {
            $this->get($page)->assertOk();
        }
    }

    public function test_admin_can_log_in_and_out(): void
    {
        User::factory()->create(['email' => 'admin@example.com', 'password' => 'secret-pass']);

        $this->post('/login', ['email' => 'admin@example.com', 'password' => 'secret-pass'])
            ->assertRedirect('/products');
        $this->get('/products')->assertOk();

        $this->post('/logout')->assertRedirect('/index');
        $this->get('/products')->assertRedirect('/login');
    }

    public function test_wrong_password_is_rejected(): void
    {
        User::factory()->create(['email' => 'admin@example.com', 'password' => 'secret-pass']);

        $this->post('/login', ['email' => 'admin@example.com', 'password' => 'nope'])
            ->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_login_is_rate_limited(): void
    {
        for ($i = 0; $i < 5; $i++) {
            $this->post('/login', ['email' => 'a@b.com', 'password' => 'x']);
        }

        $this->post('/login', ['email' => 'a@b.com', 'password' => 'x'])->assertStatus(429);
    }

    public function test_seeder_creates_admin_from_config_only_when_set(): void
    {
        config(['app.admin_email' => null, 'app.admin_password' => null]);
        $this->seed(DatabaseSeeder::class);
        $this->assertDatabaseCount('users', 0);

        config(['app.admin_email' => 'boss@example.com', 'app.admin_password' => 'a-long-password']);
        $this->seed(DatabaseSeeder::class);
        $this->seed(DatabaseSeeder::class);

        $this->assertDatabaseCount('users', 1);
        $this->post('/login', ['email' => 'boss@example.com', 'password' => 'a-long-password'])
            ->assertRedirect('/products');
    }
}
