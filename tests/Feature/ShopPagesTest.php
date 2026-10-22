<?php

namespace Tests\Feature;

use App\Models\cart_item;
use App\Models\product;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShopPagesTest extends TestCase
{
    use RefreshDatabase;

    private array $pages = [
        '/index', '/shop', '/cart', '/checkout', '/contact', '/about',
        '/wishlist', '/single_product',
    ];

    public function test_all_pages_render_on_an_empty_database(): void
    {
        foreach ($this->pages as $page) {
            $this->get($page)->assertOk();
        }
    }

    public function test_all_pages_render_with_demo_data(): void
    {
        $this->seed(DatabaseSeeder::class);

        foreach ($this->pages as $page) {
            $this->get($page)->assertOk();
        }
    }

    public function test_home_redirects_to_the_shop(): void
    {
        $this->get('/')->assertRedirect('/index');
    }

    public function test_seeder_is_idempotent(): void
    {
        $this->seed(DatabaseSeeder::class);
        $this->seed(DatabaseSeeder::class);

        $this->assertSame(8, product::count());
    }

    public function test_products_by_category_returns_json(): void
    {
        $this->seed(DatabaseSeeder::class);
        $categoryId = product::first()->category_id;

        $this->getJson("/get-products-by-category/{$categoryId}")
            ->assertOk()
            ->assertJsonStructure(['products']);
    }

    public function test_product_can_be_added_to_cart_and_quantity_increments(): void
    {
        $this->seed(DatabaseSeeder::class);
        $product = product::first();

        $this->postJson("/insert-Poduct/{$product->id}")->assertOk();
        $this->postJson("/insert-Poduct/{$product->id}")->assertOk();

        $this->assertSame(1, cart_item::count());
        $item = cart_item::first();
        $this->assertSame(2, (int) $item->quantity);

        $this->postJson("/inc-quantity/{$item->id}")->assertOk();
        $this->assertSame(3, (int) $item->fresh()->quantity);

        $this->postJson("/dec-quantity/{$item->id}")->assertOk();
        $this->assertSame(2, (int) $item->fresh()->quantity);

        $this->get('/cart')->assertOk();
    }

    public function test_cart_item_can_be_removed(): void
    {
        $this->seed(DatabaseSeeder::class);
        $product = product::first();
        $this->postJson("/insert-Poduct/{$product->id}")->assertOk();
        $item = cart_item::first();

        $this->postJson("/remove-product/{$item->id}")->assertOk();

        $this->assertSame(0, cart_item::count());
    }

    public function test_newsletter_signup_persists_and_dedupes(): void
    {
        $this->postJson('/subscribe', ['email' => 'shopper@example.com'])
            ->assertOk()
            ->assertJson(['success' => true]);

        $this->postJson('/subscribe', ['email' => 'shopper@example.com'])
            ->assertOk();

        $this->assertSame(1, \App\Models\subscriber::count());

        $this->postJson('/subscribe', ['email' => 'not-an-email'])
            ->assertStatus(422);
    }

    public function test_contact_message_is_stored(): void
    {
        $this->postJson('/contact', [
            'con_name' => 'Alex Morgan',
            'con_email' => 'alex@example.com',
            'con_subject' => 'Order question',
            'con_message' => 'Where is my order?',
        ])->assertOk()->assertJson(['success' => true]);

        $this->postJson('/contact', ['con_name' => '', 'con_email' => 'bad', 'con_message' => ''])
            ->assertStatus(422);
    }
}
