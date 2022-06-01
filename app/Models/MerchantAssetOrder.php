<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MerchantAssetOrder extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tbl_acp_merchant_asset_order';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function transactions()
    {
        return $this->hasMany(MerchantTransaction::class, 'order_id', 'id');
    }

    public function nextReceipt()
    {
        return $this->hasone(MerchantTransaction::class, 'order_id', 'id');
    }

    public function engagedTransaction()
    {
        return $this->hasMany(MerchantTransaction::class, 'asset_id', 'asset_id');
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'order_units' => 'int'
    ];
}
