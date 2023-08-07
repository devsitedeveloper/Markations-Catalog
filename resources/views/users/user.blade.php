@extends('main')
@section('content')
<style>
.ui-dialog-titlebar-close {
    visibility: hidden;
}
</style>
<div class="middle--right-block">
    <div class="title text-left">
        <h2>Users List</h2>
    </div>

    <div class="data--table-block data--filter-block">
        <div class="datatable--custom-control-block">
            <div class="two--col-block d-flex flex-wrap justify-content-between">
                <div class="filter--sub-block">
                    <div class="dt--cc">
                        <div class="search-block">
                            <input type="search" placeholder="Search" class="form-control search-control" id="txtsearch" name="txtsearch" @if(isset($_REQUEST['txtsearch'])) value="{{ $_REQUEST['txtsearch'] }}" @endif>
                        </div>

                        <select id="statusfilter" name="statusfilter">
                            <option value="">Select User</option>
                            <option value="administrator" @if (isset($_REQUEST['status']) && $_REQUEST['status'] == 'administrator') selected @endif > Administrator</option>
                            <option value="sadministrator" @if (isset($_REQUEST['status']) && $_REQUEST['status'] == 'sadministrator') selected @endif > Super Aadministrator</option>
                            <option value="subscriber" @if (isset($_REQUEST['status']) && $_REQUEST['status'] == 'subscriber') selected @endif > Subscriber</option>
                        </select>

                        <a href="javascript:void(0)" onclick="delete_multi_users();" id="multidel" class="btn multidel">Delete</a>
                    </div>
                </div>
                <div class="text-right">
                    <a href="{{route('users.create')}}" class="btn">Add New Admin User</a>
                </div>
            </div>
            
        </div>
        <table id="users" class="table striped-table">
            <thead>
                <tr>
                    <th class="nosort" width="50px"><input type="checkbox" id="selectall" name="selectall"></th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th class="nosort">Role</th>
                    <th class="nosort">Date & Time</th>
                    <th class="nosort">Status</th>
                    <th class="nosort">Action</th>
                </tr>
            </thead>
            <tbody>
                @if(count($users) > 0)
                @foreach($users as $key => $user)
                    <tr>
                        @if(auth()->user()->id != $user->id)
                            <th class="nosort" width="50px">
                                <input type="checkbox" class="selchk chk_user_ids" data-id="{{ $user->id }}" value="{{ $user->id }}" name="user_id[]">
                            </th>
                        @else
                            <td></td>
                        @endif
                        <td>{{ $user->firstname }}</td>
                        <td>{{ $user->lastname }}</td>
                        <td>{{ $user->email }}</td>
                        @php
                            $set_type = ucfirst($user->user_type);
                            if ($user->user_type == "sadministrator") {
                                $set_type = "Super Administrator";
                            }
                            $status = 'Inactive';
                            if ($user->userStatus == "y") {
                                $status = "Active";
                            }
                        @endphp
                        <td>{{ $set_type }}</td>
                        <td>{{date('M d, Y h:i A', strtotime($user->created_at))}}</td>
                        <td>{{ $status }}</td>
                        <td>
                            <a href="@php echo 'users/'. $user->id .'/edit' @endphp" class="action-icons edit--data"><img src="{{ asset('/public/images/edit.svg') }}" alt="edit"></a>
                            @if($user->user_type != "sadministrator")
                                <a href="javascript:;" id="deleteuser" data-id="{{ $user->id }}" class="action-icons"><img src="{{ asset('/public/images/cancel.svg') }}" alt="delete"></a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                @else
                <tr>
                    <td class="nosort" colspan="6" style="text-align: center;">
                        Sorry, No Users found.
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('footersec')
<script>
    jQuery(document).ready(function() {

        jQuery('#selectall').on('click', function() {
            var cbs = document.getElementsByClassName('selchk');
            for(var i=0; i < cbs.length; i++) {
                cbs[i].checked = jQuery(this).prop('checked');   
            }
        })

        jQuery.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#txtsearch').keypress(function(e){
            if(e.which == 13){
                var url = "{{ route('users.index') }}"+"?txtsearch="+encodeURI($(this).val())+"&status="+$('#statusfilter').val();
                window.location.href = url;
            }
        });
        
        $("#statusfilter").on("change", function() {
            var url = "{{ route('users.index') }}"+"?txtsearch="+encodeURI($('#txtsearch').val())+"&status="+$(this).val();
            window.location.href = url;
        });

        $(document).ready(function() {
            $('#users').DataTable({
                columnDefs: [{
                    targets: 'nosort',
                    orderable: false
                }],
                "order": [[ 1, "asc" ]],
                "searching": false,
                "stateSave": true,
                "dom": '<"controls-wrapper"<"show-table-info"il><"table-pagination"p>>'
            });
        });

        $('#users').on('click', '#deleteuser', function(event) {
            event.preventDefault();
            var id = $(this).data('id');
            
            var message_alert = $('<p>Do you want to remove the user completely?</p>').dialog({
                title: "Delete User",
                closeOnEscape: false,
                modal: true,
                width: 500,
                buttons: {
                    "Cancel": function() {
                        message_alert.dialog('close');
                    },
                    "Accept": function() {
                        var url = '{{ route("usersdestroy", ":id") }}';
                        url = url.replace(':id', id);
                        $.ajax({
                            url: url,
                            type: "DELETE",
                            success: function(data) {
                                
                                console.log(data);
                                window.location.reload(true);
                            }
                        });
                    }
                }
            });
        });
    });  
    
    function delete_multi_users() {
       
        var ids = [];
        $('.chk_user_ids:checked').each(function(i) {
            ids[i] = $(this).val();
        });

        if (ids.length === 0) {
            alert('Please select atleast one user!');
            return false;
        }

        var message_alert = $('<p>Are you sure want to delete users ?</p>').dialog({
            title: "Delete Users",
            closeOnEscape: false,
            modal: true,
            width: 500,
            buttons: {
                "Cancel": function() {
                    message_alert.dialog('close');
                },
                "Accept": function() {
                    $.ajax({
                        url: "{{ route('user.multi.delete') }}",
                        type: 'POST',
                        data: {
                            ids: ids,
                        },
                        dataType: 'json',
                        success: function(data) {
                            window.location.reload(true);
                        }
                    });
                }
            }
        });
    }
</script>

@endsection