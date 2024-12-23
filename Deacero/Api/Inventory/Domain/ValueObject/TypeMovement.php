<?php

namespace Deacero\Api\Inventory\Domain\ValueObject;

enum TypeMovement
{
    case in;
    case out;
    case transfer;

    public static function in(): TypeMovement
    {
        return self::in;
    }

    public static function out(): TypeMovement
    {
        return self::out;
    }

    public static function transfer(): TypeMovement
    {
        return self::transfer;
    }

    public function name(): string
    {
        return $this->name;
    }

    public static function create(string $status): TypeMovement
    {
        foreach (self::cases() as $value) {
            if ($status === $value->name) {
                return $value;
            }
        }
    }
}
