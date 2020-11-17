@extends('admin.master')
@section('content')
@push('javascript')
    <script type="text/javascript">
      var lastdata = $('#autocomp').html();
      $('body').on('keyup','#searchuser', function() {
        var mydata = '';
        var mysearch = $(this).val();
        $.ajax({
          method: "POST",
          url: '{{route("admin.adminsearch")}}',
          dataType: 'JSON',
          data : {
            '_token' : '{{csrf_token()}}',
            mysearch : mysearch
          },
          success : function(res){
            if (res.length>0) {
              for (var count = 0; count < res.length; count++) {
                mydata+= '<li><a href="'+window.location.href+'/'+res[count].id+'/edit'+'">'+res[count].name+'</a></li>';
              }
            }
            else {
              mydata+= '';
            }
              if (mysearch !='') {
                $('#autocomp').html(mydata);
                }
                else {
                  $('#autocomp').html(lastdata);
                }
          }

        });
      });
    </script>
@endpush

<h1 style="text-align: center">@lang('site.all_admins')</h1>
<div class="form-group" id="my_forms">
  <input type="text" class="form-control" id="searchuser" placeholder="Search Your Users Here (Live Search...)" edit="@lang('site.edit')" del="@lang('site.delete')">
  <div id="autocomp">
  </div>
</div>
@endsection