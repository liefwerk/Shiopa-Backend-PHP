<?php

namespace App\Repositories\Item;

//Interface
use App\Contracts\Item\supplierRepositoryInterface;

//Models
use App\Models\Supplier;

class SupplierRepository implements SupplierRepositoryInterface{

    public function supplierSearch($query, $limit){
        return Supplier::where('name', 'LIKE', '%' . $query . '%')
                ->orWhere('email', 'LIKE', '%' . $query . '%')
                ->orWhere('phone', 'LIKE', '%' . $query . '%')
                ->orWhere('company', 'LIKE', '%' . $query . '%')
                ->withCount('item')
                ->orderBy('created_at', 'desc')
                ->paginate($limit);
    }

    public function supplierList($limit){
        return Supplier::withCount('item')
                ->orderBy('created_at', 'desc')->paginate($limit);
    }

    public function supplierGetById($id){
        return Supplier::find($id);
    }

    public function supplierCreate($data){
        return Supplier::create($data);
    }
}