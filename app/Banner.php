<?php

namespace App;

use App\Common\Imageable;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use Imageable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'banners';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'title',
                    'description',
                    'link',
                    'link_label',
                    'bg_color',
                    'group_id',
                    'columns',
                    'order',
                    'location',
                ];

    /**
     * Get the group for the banner.
     */
    public function group()
    {
        return $this->belongsTo(BannerGroup::class);
    }
    
    /**
     * Get the location for the banner.
     */
    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * Setters
     */
    public function setOrderAttribute($value)
    {
        $this->attributes['order'] = $value ?: 100;
    }
    
    /**
     * Setters
     */
    public function setLocationAttribute($value)
    {
        $this->attributes['location'] = $value ?: 0;
    }

    // public function setOptionsAttribute($value)
    // {
    //     $this->attributes['options'] = serialize($value);
    // }

    // /**
    //  * Getters
    //  */
    // public function getOptionsAttribute($value)
    // {
    //     return unserialize($value);
    // }

}
