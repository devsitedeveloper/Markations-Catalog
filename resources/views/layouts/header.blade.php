@php
$user = auth()->user();

$suffix = config('database.suffix');
    
    $query= "SELECT tcc.* FROM tbl_catalog_category$suffix as tcc 
        JOIN tbl_catalogs$suffix as tc 
        ON tcc.id  = tc.cat_catalog_id
        GROUP BY tcc.category_name,id,slug,date,status,defaultCategory,catalog_type,certificates ";

    $getCategory = DB::select($query);
    
    if (!empty(session('categoryId')))
    {
        $getCategory_curr = DB::table('tbl_catalog_category'.$suffix)
            ->select('*')
            ->where('id', session('categoryId'))
            ->get();
            
    } else {

        $getCategory_curr = DB::table('tbl_catalog_category'.$suffix)
            ->select('*')
            ->where('defaultCategory', '1')
            ->get();
    }
        
   
    $getCatalogs = DB::table('tbl_catalogs'.$suffix)
        ->select('*')
        ->where('cat_catalog_id', $getCategory_curr[0]->id)
        ->get();

@endphp
<header>
    
    <div class="row" >
        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
            <div class="header--user-profile d-flex flex-wrap">
                <select class="form-control" name="category" id="category" title="catalog category" >
                    @if(count($getCategory) > 0)
                        @foreach($getCategory as $cat_records) 
                            @if (!empty(session('categoryId'))) 
                                <option value="{{ $cat_records->id }}" @if( $cat_records->id == session('categoryId') ) selected @endif >
                                    {{ $cat_records->slug . ' - ' . $cat_records->category_name }} 
                                </option>
                            @elseif(empty(session('categoryId')) && $cat_records->defaultCategory == '1')
                                <option value="{{ $cat_records->id }}" @if( $cat_records->defaultCategory == "1") selected @endif>
                                    {{ $cat_records->slug . ' - ' . $cat_records->category_name }} 
                                </option>
                            @else
                                <option value=" {{ $cat_records->id }} ">
                                    {{ $cat_records->slug . ' - ' . $cat_records->category_name }} 
                                </option>
                            @endif
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
    </div>

    <div class="row" >
        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
            <div class="header--user-profile d-flex flex-wrap">
                <select class="form-control" name="catalogs" id="catalogs"  title="catalogs" >
                    @foreach($getCatalogs as $catalog) 
                        @if (!empty(session('catalogID'))) 
                            <option value="{{$catalog->catalog_id}}" @if( $catalog->catalog_id == session('catalogID') ) selected @endif >
                                {{ $catalog->catalog_title }}
                            </option>
                        @elseif(empty(session('catalogID')) && $catalog->is_ses == 'y')
                            <option value="{{ $catalog->catalog_id }}" @if( $catalog->is_ses == "y") selected @endif>
                                {{ $catalog->catalog_title }}
                            </option>
                        @else
                            <option value=" {{ $catalog->catalog_id }} ">
                                {{ $catalog->catalog_title }} 
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    
    <div class="header--user-profile d-flex flex-wrap">
        <span>Hi @php echo implode(" ", array($user->firstname,$user->lastname)); @endphp</span>
        <span>|</span>
        <a href="javascript:;" class="custom-dropdown" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">My Profile</a>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            <li><a class="dropdown-item" href="{{ route('users.profile', ['id'=> $user->id]) }}">Edit Profile</a></li>
            <li><a class="dropdown-item" href="{{ route('changepassword', ['id'=> $user->id]) }}">Change Password</a></li>
            <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
        </ul>
    </div>

</header>
