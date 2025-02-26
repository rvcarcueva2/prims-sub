<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supply extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'brand', 'category', 'unit'];

    public function inventory()
    {
        return $this->hasMany(Inventory::class);
    }
}
