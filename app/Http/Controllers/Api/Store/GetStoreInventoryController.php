<?php

namespace App\Http\Controllers\Api\Store;

use App\Http\Controllers\Controller;
use App\Http\Requests\Store\GetStoreInventoryRequest;
use App\Models\Inventory;

class GetStoreInventoryController extends Controller
{
    public function __invoke(GetStoreInventoryRequest $request, string $storeId)
    {
        $inventory = Inventory::select('inventories.id', 'product_id', 'store_id', 'quantity', 'products.name', 'products.price')
            ->join('products', 'products.id', '=', 'inventories.product_id')
            ->where('store_id', $storeId)
            ->simplePaginate($request->limit);

        return response()->json($inventory);
    }
}
