@extends('main')
@section('content')
<scrip src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<div class="middle--right-block">
    
    <div class="title">
        <h2>Users Details</h2>
    </div>
    <div class="form">
        <div id="globalerr" style="display: none;">
            <div class="alert alert-danger text-center mt-3" role="alert">
            </div>
        </div>
        <form id="frmcrateuser" name="frmcrateuser" action="{{ url('/admin/users/update') }}" method="POST">
            @csrf
            <input type="hidden" id="id" name="id" value="{{ $user->id }}" />
            <div class="row">
                
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="mb-4 form-group">
                        <label for="FirstName" class="form-label">First Name<span>*</span></label>
                        <input type="text" class="form-control sm-form-control" id="first_name" name="first_name" value="{{ $user->firstname ?? '' }}">
                        <div id="firstnameerr" style="display: none;">
                            <div class="alert alert-danger text-center mt-3" role="alert">
                            </div>
                        </div>
                        <div id="firstnameblk" style="display: none;">
                            <div class="alert text-center mt-3">&nbsp;
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="mb-4 form-group">
                        <label for="LastName" class="form-label">Last Name<span>*</span></label>
                        <input type="text" class="form-control sm-form-control" id="last_name" name="last_name" value="{{ $user->lastname ?? '' }}">
                        <div id="lastnameerr" style="display: none;">
                            <div class="alert alert-danger text-center mt-3" role="alert">
                            </div>
                        </div>
                        <div id="lastnameblk" style="display: none;">
                            <div class="alert text-center mt-3">&nbsp;
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="mb-4 form-group">
                        <label for="LastName" class="form-label">Email<span>*</span></label>
                        <input type="email" class="form-control sm-form-control" id="email" name="email" value="{{ $user->email ?? '' }}">
                        <div id="lastnameerr" style="display: none;">
                            <div class="alert alert-danger text-center mt-3" role="alert">
                            </div>
                        </div>
                        <div id="lastnameblk" style="display: none;">
                            <div class="alert text-center mt-3">&nbsp;
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="mb-4 form-group">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control sm-form-control" id="phone" name="phone" value="{{ $user->phone ?? '' }}">
                        <div id="lastnameerr" style="display: none;">
                            <div class="alert alert-danger text-center mt-3" role="alert">
                            </div>
                        </div>
                        <div id="lastnameblk" style="display: none;">
                            <div class="alert text-center mt-3">&nbsp;
                            </div>
                        </div>
                    </div>
                </div>
            </div>   
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="mb-4 form-group">
                        <label for="status" class="form-label" aria-label="Assign User Role">Status<span>*</span></label>
                        <div class="d-flex">
                            <div class="form-check form-check-inline custom-control-radio">
                                <input class="form-check-input" type="radio" name="status" id="status_yes" style="display:inline-block;" value="1" {{$user->userStatus == 'y' ? 'checked' : ''}}>
                                <label class="form-check-label" for="status_yes">Enable</label>
                            </div>
                            <div class="form-check form-check-inline custom-control-radio">
                            <input class="form-check-input" type="radio" name="status" id="status_no" style="display:inline-block;" value="0" {{$user->userStatus == 'n' ? 'checked' : ''}}>
                                <label class="form-check-label" for="status_no">Disable</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="save--all-acc-data">
                <input type="submit" id="btnsubmit" name="btnsubmit" value="Update" class="btn" />
            </div>
        </form>
    </div>
</div>

@endsection
@section('footersec')
@endsection
                                                            
                                                            