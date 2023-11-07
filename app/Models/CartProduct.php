<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartProduct extends Model
{
    use HasFactory;
    protected $table = 'carts_product';
    protected $primaryKey ='id_cart_product';
    public $timestamps = false;
    protected $fillable = [
        'id_cart'
        ,'id_product'
        ,'id_color_product'
        ,'id_plug_product'
        ,'quantity_ordered'];
}
