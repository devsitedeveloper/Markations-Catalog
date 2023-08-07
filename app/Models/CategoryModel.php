<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    use HasFactory;
    protected $table = '';
    protected $guarded = [];

    public function __construct() {
        $this->table = 'tbl_catalog_category' . config('database.suffix');
    }
    
    public function catalogAssign()
    {
        return $this->hasMany(Cource_catalogModel::class,'cat_catalog_id')->orderBy('catalog_id', 'desc');
    }
}
