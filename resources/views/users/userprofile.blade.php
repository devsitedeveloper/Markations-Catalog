@extends('main')
@section('content')

<div class="middle--right-block">
    <div class="title">
        <h2>Edit Profile</h2>
    </div>

    <div class="form">
        <div id="globalerr" style="display: none;">
            <div class="alert alert-danger text-center mt-3" role="alert">
            </div>
        </div>
        <form id="frmcrateuser" name="frmcrateuser" action="{{ url('/admin/users/edit/')}}" method="POST">
            @csrf    
            <input type="hidden" name="id" id="id" value="{{ $user->id }}">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="mb-4 form-group">
                        <label for="FirstName" class="form-label">First Name<span>*</span></label>
                        <input type="text" class="form-control sm-form-control" id="firstname" name="firstname" value="{{$user->firstname}}">
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
                        <input type="text" class="form-control sm-form-control" id="lastname" name="lastname" value="{{$user->lastname}}">
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
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control sm-form-control" id="phone" name="phone" value="{{$user->phone}}">
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
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="mb-4 form-group">
                        <label for="email" class="form-label">Email<span>*</span></label>
                        <input type="email" class="form-control sm-form-control" id="email" name="email" value="{{$user->email}}">
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
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="mb-4 form-group">
                    <input type="checkbox" name="debug_mode" id="debug_mode" value="y" {{$user->debug_mode == 'y' ? 'checked' : ''}} >&nbsp;Debug Mode
                </div>
            </div>
            <div class="save--all-acc-data">
                <input type="button" id="btnsubmit" name="btnsubmit" value="Save" class="btn" />
            </div>
        </form>
    </div>    
<div>
@section('footersec')
<script type="text/javascript">
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
            var id = $("#id").val();

            var debug_mode = "";
            if($('input[name="debug_mode"]:checked').val() != undefined) {
                debug_mode = $('input[name="debug_mode"]:checked').val();
            }

            var err = '';
            if(err == '') {
                $("#globalerr").css("display","none");
                $.ajax({
                    url: "{{route('user.profile.edit')}}",
                    type: 'POST',
                    data: {
                        id: id,
                        firstname: firstname,
                        lastname: lastname,
                        email: email,
                        debug_mode: debug_mode,
                        phone: phone
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