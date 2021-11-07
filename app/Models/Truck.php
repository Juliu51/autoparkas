<?php

namespace App\Models;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Truck extends Model
{
    use HasFactory;
    public function truckTransport() {
        return $this->hasMany('App\Models\Transport', 'model_id', 'id');
    }
}
