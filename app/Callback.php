<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Callback extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'callbacks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'content',
                ];

    /**
     * Setters
     */
    public function setContentAttribute($value)
    {
        $this->attributes['content'] = $value ?: 'N/A';
    }
}
