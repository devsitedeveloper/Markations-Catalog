@extends('main')
@section('content')
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>

<div class="middle--right-block">
    
    <div class="title">
        <h2>Add Admin User</h2>
    </div>
    <div class="form">
        <div id="globalerr" style="display: none;">
            <div class="alert alert-danger text-center mt-3" role="alert">
            </div>
        </div>
        <form id="frmcrateuser" name="frmcrateuser" action="{{ url('/admin/users/save') }}" method="POST">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="mb-4 form-group">
                        <label for="FirstName" class="form-label">First Name<span>*</span></label>
                        <input type="text" class="form-control sm-form-control" id="firstname" name="firstname">
                        <div id="firstnameerr" style="display: none;">
                            <div class="alert alert-danger text-center mt-3" role="alert">
                            </div>
                        </div>
                        <div id="firstnameerr" style="display: none;">
                            <div class="alert text-center mt-3">&nbsp;
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="mb-4 form-group">
                        <label for="LastName" class="form-label">Last Name<span>*</span></label>
                        <input type="text" class="form-control sm-form-control" id="lastname" name="lastname">
                        <div id="lastnameerr" style="display: none;">
                            <div class="alert alert-danger text-center mt-3" role="alert">
                            </div>
                        </div>
                        <div id="lastnameerr" style="display: none;">
                            <div class="alert text-center mt-3">&nbsp;
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="mb-4 form-group">
                        <label for="email" class="form-label">Email<span>*</span></label>
                        <input type="email" class="form-control sm-form-control" id="email" name="email">
                        <div id="emailerr" style="display: none;">
                            <div class="alert alert-danger text-center mt-3" role="alert">
                            </div>
                        </div>
                        <div id="emailerr" style="display: none;">
                            <div class="alert text-center mt-3">&nbsp;
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="mb-4 form-group">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control sm-form-control" id="phone" name="phone">
                        <div id="phoneerr" style="display: none;">
                            <div class="alert alert-danger text-center mt-3" role="alert">
                            </div>
                        </div>
                        <div id="phoneerr" style="display: none;">
                            <div class="alert text-center mt-3">&nbsp;
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="mb-4 form-group">
                        <label for="password" class="form-label">Password<span>*</span></label>
                        <input type="password" class="form-control sm-form-control" id="password" name="password">
                        <div id="passworderr" style="display: none;">
                            <div class="alert alert-danger text-center mt-3" role="alert">
                            </div>
                        </div>
                        <div id="passworderr" style="display: none;">
                            <div class="alert text-center mt-3">&nbsp;
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="mb-4 form-group">
                        <label for="confirm_password" class="form-label">Confirm Password<span>*</span></label>
                        <input type="password" class="form-control sm-form-control" id="confirmpassword" name="confirmpassword">
                        <div id="cpassworderr" style="display: none;">
                            <div class="alert alert-danger text-center mt-3" role="alert">
                            </div>
                        </div>
                        <div id="cpassworderr" style="display: none;">
                            <div class="alert text-center mt-3">&nbsp;
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="mb-4 form-group">
                        <label for="user_role" class="form-label" aria-label="Assign User Role">User Role</label>
                        <div class="d-flex">
                            <div class="form-check form-check-inline custom-control-radio">
                                <input class="form-check-input" type="radio" name="user_role" id="user_role_admin" checked="" style="display:inline-block;" value="administrator">
                                <label class="form-check-label" for="user_role_admin">Administrator</label>
                            </div>
                            <div class="form-check form-check-inline custom-control-radio">
                            <input class="form-check-input" type="radio" name="user_role" id="user_role_supadmin" style="display:inline-block;" value="sadministrator">
                                <label class="form-check-label" for="user_role_supadmin">Super administrator</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="new_mult_select">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="mb-4 form-group">
                            <label for="catalog_option" class="form-label" aria-label="Assign User Role">Assign Catalog</label>
                            <div class="d-flex">
                                <div class="form-check form-check-inline custom-control-radio">
                                    <input class="form-check-input" type="radio" name="catalog_option" id="catalog_option_all" checked="" style="display:inline-block;" value="all">
                                    <label class="form-check-label" for="catalog_option_all">All</label>
                                </div>
                                <div class="form-check form-check-inline custom-control-radio">
                                <input class="form-check-input" type="radio" name="catalog_option" id="catalog_option_sp" style="display:inline-block;" value="specific">
                                    <label class="form-check-label" for="catalog_option_sp">Specific</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row catalog_assign" style="display:none;">
                    <div class="col-lg-8 col-md-8 col-sm-12">
                        @foreach($catalogs as $catalog) 
                        <div class="mb-4 form-group">
                            <label class="form-check-label" for="status_no">{{$catalog->category_name}}</label>  
                                <div class="d-flex">
                                    @foreach($catalog->catalogAssign as $catalogCat)
                                        <input type="checkbox" role="group" name="catalog_assign[]" id="catalog_assign_{{ $catalogCat->catalog_id }}" value="{{ $catalogCat->catalog_id }} ">&nbsp; {{ $catalogCat->academic_year }} &nbsp;
                                    @endforeach
                                </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="mb-4 form-group">
                        <label for="status" class="form-label" aria-label="Assign User Role">Status<span>*</span></label>
                        <div class="d-flex">
                            <div class="form-check form-check-inline custom-control-radio">
                                <input class="form-check-input" type="radio" name="status" id="status_yes" checked="" style="display:inline-block;" value="1">
                                <label class="form-check-label" for="status_yes">Enable</label>
                            </div>
                            <div class="form-check form-check-inline custom-control-radio">
                            <input class="form-check-input" type="radio" name="status" id="status_no" style="display:inline-block;" value="0">
                                <label class="form-check-label" for="status_no">Disable</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="save--all-acc-data">
                <input type="button" id="btnsubmit" name="btnsubmit" value="Save" class="btn" />
            </div>
        </form>
    </div>    
</div>

@endsection
@section('footersec')
<script type="text/javascript">
    
    $('input[type=radio][name=catalog_option]').change(function() {
        if (this.value == 'specific') {
            $(".catalog_assign").show();
        } else {
            $(".catalog_assign").hide();
        }
    });
    $('input[type=radio][name=user_role]').change(function() {
        if (this.value == 'sadministrator') {
            $(".new_mult_select").hide();
        } else {
            $(".new_mult_select").show();
        }
    });
    
    jQuery(document).ready(function() {
        jQuery.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        jQuery('#btnsubmit').on('click', function(){
            var firstname = $('#firstname').val();
            var lastname = $('#lastname').val(); 
            var email = $("#email").val();
            var phone = $("#phone").val();
            var password = $('#password').val();
            var confirmpassword = $('#confirmpassword').val();
            var user_role = "";
            if($('input[name="user_role"]:checked').val() != undefined) {
                user_role = $('input[name="user_role"]:checked').val();
            }
            var catalog_option = "";
            if($('input[name="catalog_option"]:checked').val() != undefined) {
                catalog_option = $('input[name="catalog_option"]:checked').val();
            }
            var status = "";
            if($('input[name="status"]:checked').val() != undefined) {
                status = $('input[name="status"]:checked').val();
            }

            var catalog_assign = new Array();
            $("input:checked").each(function() {
                catalog_assign.push($(this).val());
            });
            var err = '';
            
            if(err == '') {
                $("#globalerr").css("display","none");
                $.ajax({
                    url: 'save',
                    type: 'POST',
                    data: {
                        firstname: firstname,
                        lastname: lastname,
                        email: email,
                        password: password,
                        password_confirmation: confirmpassword,
                        status: status,
                        user_role: user_role,
                        catalog_option:catalog_option,
                        phone: phone,
                        catalog_assign:catalog_assign
                    },
                    dataType: 'json',
                    success: function(data) {
                        if(data.success) {
                            if(data.err == '') {
                                formsubmitting = true;
                                window.location.href = data.url;
                            } else {
                                $("#globalerr .alert").html(data.err);
                                $("#globalerr").css("display","block");
                                document.getElementById('globalerr').scrollIntoView();
                            }
                        }
                        if(data.error) {
                            
                            if(data.error.firstname) {
                                $("#firstnameerr .alert").html(data.error.firstname[0]);
                                $("#firstnameerr").css("display","block");
                            } else {
                                $('#firstnameblk').css('display',"block");
                                $("#firstnameerr").css("display","none");
                            }
                            if(data.error.lastname) {
                                $("#lastnameerr .alert").html(data.error.lastname[0]);
                                $("#lastnameerr").css("display","block");
                            } else {
                                $('#lastnameblk').css('display',"block");
                                $("#lastnameerr").css("display","none");
                            }
                            if(data.error.email) {
                                $("#emailerr .alert").html(data.error.email[0]);
                                $("#emailerr").css("display","block");
                            } else {
                                $('#emailerrblk').css('display',"block");
                                $("#emailerr").css("display","none");
                            }
                            if(data.error.password) {
                                $("#passworderr .alert").html(data.error.password[0]);
                                $("#passworderr").css("display","block");
                            } else {
                                $('#passwordblk').css('display',"block");
                                $("#passworderr").css("display","none");
                            }
                            
                            if(data.error.email) {
                                $("#emailerr .alert").html(data.error.email[0]);
                                $("#emailerr").css("display","block");
                            } else {
                                $('#emailblk').css('display',"block");
                                $("#emailerr").css("display","none");
                            }
                            $('#confirmpasswordblk').css('display','block');
                            $('#statusblk').css('display',"block");
                        }
                    }
                });
            }
        })
    });
</script>
@endsection

