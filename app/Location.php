<?php

namespace App;

use App\Common\Taggable;
use App\Common\Imageable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use SoftDeletes, Imageable, Taggable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'in_location';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['region', 'name'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'location_product');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'location_user');
    }

    public function region()
    {
        return $this->belongsTo(Region::class, 'region');
    }
}
