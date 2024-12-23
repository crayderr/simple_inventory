<?php

namespace App\Http\Controllers\Api\Inventory;

use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\GetInventoryAlertResource;

class GetInventoryAlertController extends Controller
{
    public function __invoke(Request $request)
    {
        $inventory = Inventory::select('inventories.id', 'inventories.quantity', 'products.name', 'products.description', 'products.category', 'products.price', 'products.sku')
            ->join('products', 'products.id', '=', 'inventories.product_id')
            ->whereColumn('quantity', '<', 'min_quantity')
            ->simplePaginate($request->limit ?? 15);

        return GetInventoryAlertResource::collection($inventory);
    }
}
