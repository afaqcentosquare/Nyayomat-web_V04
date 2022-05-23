<?php

namespace App;

use Auth;
use App\Common\Loggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use SoftDeletes, Loggable;

    const STATUS_PENDING = 1;
    const STATUS_SUCCESS = 2;
    const STATUS_FAILED = 3;
    const STATUS_UNKNOWN = 4;

    const TYPE_MPESA = 1;
    const TYPE_CASH = 2;
    const TYPE_CREDIT = 3;
    const TYPE_WALKIN = 4;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'accounts';

    /**
     * The name that will be used when log this model. (optional)
     *
     * @var boolean
     */
    protected static $logName = 'account';

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
                    'user_id',
                    'amount',
                    'disbursement_id',
                    'order_id',
                    'type',
                    'transaction_date',
                    'created_at',
                ];

    /**
     * Get the user associated with the model.
    */
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }
}
