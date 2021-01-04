<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;

    protected $table = 'alumnos';

    protected $guarded = [];

    public function padres(){
        return $this->belongsToMany(Padre::class,'alumnos_padres');
    }


    public function apoderados(){
        return $this->belongsToMany(Apoderado::class,'alumnos_apoderados');
    }

    public function departamento(){
        return $this->belongsTo(UbigeoDepartamento::class, 'departamento_id');
    }

    public function provincia(){
        return $this->belongsTo( UbigeoProvincia::class, 'provincia_id');
    }

    public function distrito(){
        return $this->belongsTo( UbigeoDistrito::class, 'distrito_id');
    }
}
