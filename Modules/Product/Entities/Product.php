<?php

namespace Modules\Product\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Modules\Media\Support\Traits\MediaRelation;
class Product extends Model
{
    use Translatable;
    use MediaRelation;

    protected $table = 'product__products';
    public $translatedAttributes = [];
    protected $fillable = [
        'id',
        'name',
        'price',
        'description',
        'image'
    ];
}
