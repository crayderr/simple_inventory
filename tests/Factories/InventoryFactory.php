<?php

namespace Tests\Factories;

use Deacero\Api\Inventory\Domain\Inventory;


class InventoryFactory
{
    public static function create(array $options = []): Inventory
    {
        $faker      = \Faker\Factory::create();

        $fields = [
            'id'                => (string) $faker->uuid(),
            'product_id'        => (string) $faker->uuid(),
            'store_id'          => (string) $faker->uuid(),
            'quantity'          => $faker->randomNumber(2),
            'min_quantity'      => $faker->randomNumber(2),
        ];

        $fields = array_merge($fields, $options);

        return Inventory::fromPrimitives(
            id:          $fields['id'],
            productId:   $fields['product_id'],
            storeId:     $fields['store_id'],
            quantity:    $fields['quantity'],
            minQuantity: $fields['min_quantity'],
        );
    }
}
