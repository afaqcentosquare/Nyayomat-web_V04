<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MerchantDeposit extends Model
{

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tbl_acp_merchant_deposit';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
