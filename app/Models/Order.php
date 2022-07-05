<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','address1','address2','city','state','country','postalCode','payment_method','status','totalPrice'];


    public function user()
    {
        return $this->belongsTo(User::class);
    } 

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }    

}
