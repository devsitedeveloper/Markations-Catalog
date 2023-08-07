@extends('main')
@section('content')
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <div class="middle--right-block">  
        <div class="title">
            <h2>Change Password</h2>
        </div>
        <div class="form">
            <div id="globalerr" style="display: none;">
                <div class="alert alert-danger text-center mt-3" role="alert">
                </div>
            </div>
            <form id="frmcrateuser" name="frmcrateuser" action="/users/update" method="POST">
                <input type="hidden" id="id" name="id" value="{{ $user->id }}" />
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="mb-3 form-group">
                            <label for="Password" class="form-label">Current Password</label>
                            <input type="password" class="form-control sm-form-control" id="oldpassword" name="oldpassword" autocomplete="new-password">
                            <div id="oldpassworderr" style="display: none;">
                                <div class="alert alert-danger text-center mt-3" role="alert">
                                </div>
                            </div>
                            <div id="oldpasswordblk" style="display: none;">
                                <div class="alert text-center mt-3">&nbsp;
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="mb-3 form-group">
                            <label for="Password" class="form-label">Password</label>
                            <input type="password" class="form-control sm-form-control" id="password" name="password" autocomplete="new-password">
                            <div id="passworderr" style="display: none;">
                                <div class="alert alert-danger text-center mt-3" role="alert">
                                </div>
                            </div>
                            <div id="passwordblk" style="display: none;">
                                <div class="alert text-center mt-3">&nbsp;
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">    
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="mb-3 form-group">
                            <label for="ConfirmPassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control sm-form-control" id="confirmpassword" name="confirmpassword">
                            <div id="confirmpasswordblk" style="display: none;">
                                <div class="alert text-center mt-3">&nbsp;
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </form>
        </div>

        <div class="edit--table-block">
            <div class="save--all-acc-data">
                <input type="button" id="btnsubmit" name="btnsubmit" value="Save" class="btn" />
            </div>
        </div>

    </div>
@endsection
@section('footersec')
<script type="text/javascript">
    jQuery(document).ready(function() {
        var formsubmitting = false;
        var ischange = false;

        $("#frmcrateuser :input").change(function() {
            ischange = true;
        });

        jQuery.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        jQuery('#btnsubmit').on('click', function(){
            var oldpassword = $('#oldpassword').val();
            var password = $('#password').val();
            var confirmpassword = $('#confirmpassword').val();
            var id =  $('#id').val();
            var err = '';
            
            if(err == '') {
                $("#globalerr").css("display","none");
                $.ajax({
                    url: "{{route('savepassword')}}",
                    type: "POST",
                    data: {
                        id: id,
                        oldpassword: oldpassword,
                        password: password,
                        password_confirmation: confirmpassword,
                    },
                    dataType: 'json',
                    success: function(data) {
                        if(data.success) {
                            if(data.err == '') {
                                ischange = false;
                                formsubmitting = true;
                                window.location.href = "{{route('home')}}";
                            } else {
                                $("#oldpassworderr").css("display","none");
                                $("#passworderr").css("display","none");
                                $("#globalerr .alert").html(data.err);
                                $("#globalerr").css("display","block");
                                document.getElementById('globalerr').scrollIntoView();
                            }
                            
                        }
                        if(data.error) {
                            if(data.error.oldpassword) {
                                $("#oldpassworderr .alert").html(data.error.oldpassword[0]);
                                $("#oldpassworderr").css("display","block");
                            } else {
                                $('#oldpasswordblk').css('display',"block");
                                $("#oldpassworderr").css("display","none");
                            }
                            if(data.error.password) {
                                $("#passworderr .alert").html(data.error.password[0]);
                                $("#passworderr").css("display","block");
                            } else {
                                $('#passwordblk').css('display',"block");
                                $("#passworderr").css("display","none");
                            }
                        }
                    }
                });
            }

        })
    });
</script>
@endsection
    
 