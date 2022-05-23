<?php

namespace App;


use Illuminate\Database\Eloquent\Model;


class CategoryProduct extends Model
{
    
    protected $table = 'category_product';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['category_id','product_id',];

    
}
