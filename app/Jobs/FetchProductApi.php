<?php

namespace App\Jobs;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Services\ProductApiService;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FetchProductApi implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $pService = new ProductApiService();
        $total = 100;
        for ($skip = 0; $skip < $total; $skip += 10) {
            $products = $pService->fetch('https://dummyjson.com/products?limit=10&skip='.$skip)['products'];
            foreach ($products as $product) {
                $category = Category::whereName($product['category'])->first();
                if (empty($category))
                    $category = Category::create(['name' => $product['category']]);

                $brand = Brand::whereName($product['brand'])->first();
                if (empty($brand))
                    $brand = Brand::create(['name' => $product['brand']]);

                $new_product = Product::find($product['id']);

                if (empty($new_product)) {
                    $product['category_id'] = $category->id;
                    $product['brand_id'] = $brand->id;
                    Product::create($product);
                }
            };
        }
    }
}
