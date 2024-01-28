<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    use HasFactory;
    protected $fillable = ['brand_id','model_id','name', 'entry_date'];
    public function brand()
    {
        return $this->belongsTo(Brands::class, 'brand_id');
    }
    public function model()
    {
        return $this->belongsTo(Models::class, 'model_id');
    }
}
