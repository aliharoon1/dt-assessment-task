<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = ['account_id', 'product_id', 'order_id', 'quantity', 'stock_type', 'transfer_id', 'product_detail_id'];

    protected $table = 'users';

    public function jobs()
    {
        return $this->hasmany(Job::class, 'product_id');
    }
}
