<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route as Route;
use Illuminate\Http\Request;
use App\Models\CategoryModel;

class Cource_catalogModel extends Model
{
    use HasFactory;
    protected $table = '';
    protected $guarded = [];

    public function __construct() {
        $this->table = 'tbl_catalogs' . config('database.suffix');
    }

    public function getCatalogs(Request $request)
    {
        $data = $request->all();
        $getCatalogs = Cource_catalogModel::where('cat_catalog_id', $data['categoryId'])
            ->select('catalog_id', 'catalog_title', 'is_ses')
            ->get();

        return response()->json(['getCatalogs' => $getCatalogs]);
    }

    public function change_session(Request $request)
    {
        if ($_POST['value']) {

            $catalogs = Cource_catalogModel::where('catalog_id',  $_POST['value'])->get();
            
            $getslug = CategoryModel::where('id', $catalogs[0]->cat_catalog_id)->get()->first();
            
            $slug = (!empty($getslug) && !empty($getslug->slug)) ? $getslug->slug : null;
            session(['catalogID' => $_POST['value'], 'cat_year' => str_replace(' ', '', $catalogs[0]->academic_year), 'catalogSlug' => $slug, 'categoryId' => $catalogs[0]->cat_catalog_id, 'catalogType' => $getslug->catalog_type]);
            $redirectURL = $request->server('HTTP_REFERER');
            
            $status = array('status' => 'success', 'msg' => 'Status changed successfully.','url' => $redirectURL);
            return response()->json($status);

        } else {

            $status = array('status' => 'fail', 'msg' => 'Something Went Wrong! Please Try After Sometime');
            return response()->json($status);
        }
    }
}
