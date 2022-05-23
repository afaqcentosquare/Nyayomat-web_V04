<?php

namespace App;

use Auth;
use App\Common\Loggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SentMessage extends Model
{
    use SoftDeletes, Loggable;

    const STATUS_PENDING = 1;
    const STATUS_SUCCESS = 2;
    const STATUS_FAILED = 3;
    const STATUS_UNKNOWN = 4;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sent_messages';

    /**
     * The name that will be used when log this model. (optional)
     *
     * @var boolean
     */
    protected static $logName = 'sent_message';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'recipient_phone',
                    'message_id',
                    'text',
                    'cost',
                    'status',
                    'failure_reason'
                ];
}
