<?php

namespace App\Models\Cache;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * This model is meant to be overloaded with data,
 * for the sake of me learning to use laravel
 * caching mechanism.
 */
class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'basic_description_md',
        'basic_description_html',
        'basic_description_xml',
        'basic_description_yml',
        'basic_description_json',
        'basic_description_csv',
        'basic_description_txt',
        'meta',
        'mesh_base64',
        'decimal_degree_latitude',
        'decimal_degree_longitude',
    ];

    protected $casts = [
        'decimal_degree_latitude'  => 'decimal:5',
        'decimal_degree_longitude' => 'decimal:5',
    ];
}
