<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class File extends Model
{

    protected $fillable = ['name','path','type','report_id'] ;

    public function report()
    {
        return $this->belongsTo(Report::class);
    }

}
