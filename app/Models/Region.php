<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Region extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'id',
        'name',
        'boundary',
        'status',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    protected $hidden = ['boundary'];

    protected $appends = ['boundary_geojson'];

    public function getBoundaryGeojsonAttribute()
    {
        if (! $this->exists) {
            return null;
        }

        $result = DB::selectOne('SELECT ST_AsGeoJSON(boundary) as geojson FROM regions WHERE id = ?', [$this->id]);

        return $result ? json_decode($result->geojson) : null;
    }
}
