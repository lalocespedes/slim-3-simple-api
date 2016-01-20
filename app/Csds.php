<?php

namespace ly;

use Illuminate\Database\Eloquent\Model;

class Csds extends Model
{
    protected $fillable = ['no_certificado', 'clave', 'status', 'empresa_id'];

    protected $table = 'csds';

    public function empresa()
    {
        return $this->belongsTo('App\Empresa');
    }
}
