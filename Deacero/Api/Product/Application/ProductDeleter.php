<?php

declare(strict_types=1);

namespace Deacero\Api\Product\Application;

use Deacero\Api\Product\Domain\ProductRepository;


final class ProductDeleter
{
    public function __construct(
        private readonly ProductRepository $repository
    ) {
    }

    public function handle(
        string $id,
    ): void {

        $product = $this->repository->find($id);

        // $product->delete(); //TODO: Se implementa si hubiera Eventos

        $this->repository->delete($product);
    }
}
