<?php

namespace App;

use Auth;
use App\Common\Loggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Disbursement extends Model
{
    use SoftDeletes, Loggable;

    const STATUS_PENDING = 1;        //Default
    const STATUS_SUCCESS = 2;
    const STATUS_FAILED = 3;
    const STATUS_UNKNOWN = 4;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'disbursements';

    /**
     * The name that will be used when log this model. (optional)
     *
     * @var boolean
     */
    protected static $logName = 'disbursement';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'callback_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'user_id',
                    'amount',
                    'recipient_phone',
                    'conversation_id',
                    'originator_conversation_id',
                    'transaction_id',
                    'receiver_name',
                    'charges',
                    'utility_balance',
                    'working_balance',
                    'transaction_completed_at',
                    'status',
                    'failure_reason',
                    'callback_at',
                ];

    /**
     * Get the user associated with the model.
    */
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }
}
