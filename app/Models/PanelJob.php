<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PanelJob extends Model
{
    protected $fillable = ["title","status","description","type"];
    public function panelJobImages()
    {
        return $this->hasMany(PanelJobImage::class,"panel_id");
    }
}
