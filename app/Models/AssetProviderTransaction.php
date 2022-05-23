<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssetProviderTransaction extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tbl_acp_asset_provider_transaction';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
