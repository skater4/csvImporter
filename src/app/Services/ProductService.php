<?php

namespace App\Services;

use App\Enum\ImportResourceEnum;
use App\Factories\AdapterFactory;
use App\Models\Product;
use App\Repositories\ProductRepository;
use SplFileObject;

class ProductService extends AbstractService
{
    protected ProductRepository $productRepository;

    public function __construct()
    {
        $this->productRepository = new ProductRepository();
    }

    /**
     * @return Product[]
     */
    public function getAll(): array
    {
        return $this->productRepository->getAll();
    }

    public function importCsv(SplFileObject $file): int
    {
        $parser    = AdapterFactory::make(ImportResourceEnum::CSV);
        $importDto = $parser->parse($file);

        $count = 0;
        foreach ($importDto->getItems() as $dto) {
            $product = Product::fromDto($dto);
            $this->productRepository->save($product);
            $count++;
        }

        return $count;
    }
}