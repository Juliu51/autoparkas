<?php

namespace App\Models;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transport extends Model
{

    use HasFactory;
  public function transportTruck () {
      return $this->belongsTo('App\Models\Truck', 'model_id', 'id');
  }
  public  function distance() {
    $distance = ((100 / $this->avarenge_fuel_consumption) * $this->fuel_tank_volume);
    return $this->round_up($distance, 1);
  }
  public function round_up ($value, $precision) {
    $pow = pow (10, $precision) ;
    return (ceil ($pow * $value) + ceil ($pow * $value - ceil ($pow * $value ))) / $pow;
}

use Sortable;
protected $fillable = ['plates' , 'fuel_tank_volume', 'avarenge_fuel_consumption'];
public $sortable = ['plates', 'fuel_tank_volume', 'avarenge_fuel_consumption'];

}
