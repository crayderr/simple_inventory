<?php

namespace Tests\src\Factories;

use Deacero\Api\Product\Domain\Product;


class ProductFactory
{
    public static function create(array $options = []): Product
    {
        $faker      = \Faker\Factory::create();

        $fields = [
            'id'                => (string) $faker->uuid(),
            'name'              => $faker->name(),
            'description'       => $faker->text(),
            'category'          => $faker->word(),
            'price'             => $faker->randomNumber(4),
            'sku'               => $faker->code(),
        ];

        $fields = array_merge($fields, $options);

        return Product::fromPrimitives(
            id:             $fields['id'],
            name:           $fields['name'],
            description:    $fields['description'],
            category:       $fields['category'],
            price:          $fields['price'],
            sku:            $fields['sku'],
        );
    }
}
