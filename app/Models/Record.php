<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;

    protected $table = 'tallyman';

    protected $primaryKey = 'REQUEST_ID';

    protected $fillable = [
        'TO_TYPE', 'FROM_TYPE', 'CARGO_ID', 'units', 'CUSTOMS_STATUS', 'WEIGHT', 'QUANTITY',
        'customs_dekl_nr', 'REMARKS', 'ALCOHOL_NAME', 'CUSTOMS_CODE', 'ALCOHOL_PACKING', 'ALCOHOL_STRENGTH', 'ALCOHOL_VOLUME', 'ALCOHOL_PCS',
        'ALCOHOL_CASES', 'ALCOHOL_COMMENT'
    ];

    public $timestamps = false;
    
}
