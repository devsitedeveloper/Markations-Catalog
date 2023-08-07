<!-- jQuery Version 1.11.1 -->

<script src="{{ asset('/public/js/jquery.min.js') }}"></script>
<script src="{{ asset('/public/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('/public/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('/public/js/slick.min.js') }}"></script>
<script src="{{ asset('/public/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/public/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('/public/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('/public/js/intlTelInput-jquery.min.js') }}"></script>
<script src="{{ asset('/public/js/custom.js') }}"></script> 
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.10/sorting/datetime-moment.js"></script>


<script>
  @if(Session::has('message'))
    toastr.options =
    {
      "closeButton" : true,
      "progressBar" : true
    }
   	toastr.success("{{ session()->get('message') }}");
  @endif

  @if(Session::has('error'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.error("{{ session()->get('error') }}");
  @endif

  @if(Session::has('info'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.info("{{ session()->get('info') }}");
  @endif

  @if(Session::has('warning'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.warning("{{ session()->get('warning') }}");
  @endif
</script>

<script type="text/javascript">
  $(document).ready(function () {
      var oldCategory = $('#category').val();
      $('select#category').on('change', function () {
        if (!confirm('Are you sure you want to switch catalog ?')) {
          $('#category').val(oldCategory);
          return;
        } else {
            $.ajax({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              url: '{{ url("admin/course-catalog/getCatalogs") }}',
              type: 'POST',
              data: {'categoryId': this.value},
              success: function (response) {
                $("select#catalogs").empty();
                $.each(response.getCatalogs, function (key, value) {
                    var selected = '';
                    if (value.is_ses == 'y') {
                      selected = "selected";
                    }
                    $("select#catalogs").append('<option value="' + value.catalog_id + '" ' + selected + '>' + value.catalog_title + '</option>');
                });
                change_course_catalog_session($('select#catalogs :selected').val());
              }
            });
            oldCategory = this.value;
          }
      });

      var oldCatalog = $('#catalogs').val();
      $('select#catalogs').on('change', function () {
        if (!confirm('Are you sure you want to switch academic year ?')) {
            $('#catalogs').val(oldCatalog);
            return;
        } else {
            var catalogId = this.value;
            change_course_catalog_session(catalogId);
            oldCatalog = catalogId;
        }
      });
  })

  function change_course_catalog_session(value)
  {
    var id = '';
    $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '{{ url("admin/course-catalog/change_session") }}',
        type: 'POST',
        data: {'id': id, 'value': value},
        success: function (response) {
          
          if (response.status == 'fail')
          {
            alert(response.msg);
          } else {
            if (response.url != "") {
              window.location.href = response.url;
            }
          }
        }
    });
  }
</script>