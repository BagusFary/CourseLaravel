<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $table = 'invoices';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];


    public function orders()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
}
