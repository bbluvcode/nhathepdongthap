<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PanelJobImage extends Model
{
    protected $fillable = ["panel_id","image","status"];
    public function panelJob()
    {
        return $this->belongsTo(PanelJob::class,"panel_id");
    }
}
