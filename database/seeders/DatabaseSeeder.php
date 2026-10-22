<?php

namespace Database\Seeders;

use App\Models\about_us;
use App\Models\contact;
use App\Models\product;
use App\Models\product_category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed demo data so every page of the shop renders with content.
     */
    public function run(): void
    {
        // Admin account comes from the environment so no default password ever exists.
        $adminEmail = config('app.admin_email');
        $adminPassword = config('app.admin_password');

        if ($adminEmail && $adminPassword) {
            User::updateOrCreate(
                ['email' => $adminEmail],
                ['name' => 'Admin', 'password' => Hash::make($adminPassword), 'is_admin' => true]
            );
        }

        $categories = collect(['Chairs', 'Lamps', 'Tables'])->map(fn ($name) => product_category::firstOrCreate(
            ['name' => $name],
            ['description' => "$name collection"]
        ));

        // Copy the bundled demo images to where the app expects uploaded product images.
        $target = storage_path('app/public/images/product');
        File::ensureDirectoryExists($target);

        for ($i = 1; $i <= 8; $i++) {
            $source = public_path("client/img/product/$i.jpg");
            if (File::exists($source) && !File::exists("$target/$i.jpg")) {
                File::copy($source, "$target/$i.jpg");
            }

            product::firstOrCreate(
                ['SKU' => "DEMO-$i"],
                [
                    'image' => "$i.jpg",
                    'name' => "Demo product $i",
                    'description' => 'Demo product used to try the shop.',
                    'price' => 19.90 + $i * 5,
                    'category_id' => $categories[$i % 3]->id,
                    'product_list' => $i % 2 ? 'Popular Product' : 'Best Seller',
                ]
            );
        }

        if (!about_us::exists()) {
            about_us::create([
                'titre' => 'About our shop',
                'sous_titre' => 'Furniture made simple',
                'image' => 'client/img/others/about.jpg',
                'description' => 'Demo content for the about page. Edit it from the admin area.',
            ]);
        }

        if (!contact::exists()) {
            contact::create([
                'adresse' => '1 Demo Street, Fes, Morocco',
                'number' => '+212 600 000 000',
                'email' => 'contact@example.com',
            ]);
        }
    }
}
