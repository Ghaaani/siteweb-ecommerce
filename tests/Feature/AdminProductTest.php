<?php

namespace Tests\Feature;

use App\Models\product;
use App\Models\product_category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_category_can_be_created(): void
    {
        $this->post('/product_categories', ['name' => 'Sofas', 'description' => 'Comfy'])
            ->assertRedirect();

        $this->assertDatabaseHas('product_categories', ['name' => 'Sofas']);
    }

    public function test_product_can_be_created_updated_and_deleted(): void
    {
        Storage::fake('local');
        $category = product_category::create(['name' => 'Sofas', 'description' => 'Comfy']);

        $this->post('/products', [
            'image' => UploadedFile::fake()->image('sofa.jpg'),
            'name' => 'Sofa',
            'description' => 'A sofa',
            'price' => 199.5,
            'SKU' => 'SOFA-1',
            'category' => $category->id,
            'BestSeller' => 'on',
        ])->assertRedirect();

        $product = product::firstOrFail();
        $this->assertSame('Best Seller', $product->product_list);
        $this->assertNull($product->inventory_id);

        $this->put("/products/{$product->id}", [
            'name' => 'Sofa XL',
            'description' => 'A bigger sofa',
            'price' => 249,
            'SKU' => 'SOFA-1',
            'category' => $category->id,
        ])->assertRedirect();
        $this->assertSame('Sofa XL', $product->fresh()->name);

        $this->delete("/products/{$product->id}")->assertRedirect();
        $this->assertSame(0, product::count());
    }

    public function test_product_creation_requires_valid_data(): void
    {
        $this->post('/products', [])->assertSessionHasErrors(['image', 'name', 'price', 'SKU']);
    }
}
