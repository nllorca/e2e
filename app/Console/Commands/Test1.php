<?php

namespace App\Console\Commands;

use App\Console\Commands\Classes\Product;
use Illuminate\Console\Command;

class Test1 extends Command
{
    private const PRODUCT_STATUS_ACTIVE = 'ACTIVE';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test1';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test 1';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $importedJson = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'products.json');
        $importedData = json_decode($importedJson, true);

        if (is_null($importedData) || !isset($importedData['products'])) {
            die("Invalid JSON.\n");
        }

        $activeProducts = array_filter($importedData['products'], function(array $importedProduct) {
            return isset($importedProduct['status']) && $importedProduct['status'] === self::PRODUCT_STATUS_ACTIVE;
        });
        
        foreach ($activeProducts as $activeProduct) {
            echo Product::parse($activeProduct)->toJSON(true) . "\n";
        }
    }
}
