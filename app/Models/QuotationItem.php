<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuotationItem extends Model
{
    protected $table = 'quotation_items';
    protected $primaryKey = 'quotation_item_id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'quotation_id',
        'iddetalhe',
        'cdprincipal',
        'dsdetalhe',
        'qtitem',
    ];

    public function quotation()
    {
        return $this->belongsTo(Quotation::class, 'quotation_id', 'quotation_id');
    }

    public function __toString()
    {
        return "<QuotationItem(description={$this->dsdetalhe} code={$this->cdprincipal})>";
    }
}
