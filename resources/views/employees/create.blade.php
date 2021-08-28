@extends('home')

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet"/>


@section('content')

<div class="container">

<div class="row">
    <div class="m-2">
            <h2>Employees</h2>
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<div class="col-lg-6" style="max: width 500px;">
    <div class="card">
        <div class="m-4">

            {{ Form::open( ['url' => 'employees', 'class' => 'form', 'file' => true, 'enctype' => 'multipart/form-data'] ) }}
            <form>
            <h3>Add Employee</h3>

            {{ csrf_field() }}

                <div class="form-group">
                    {{ Form::label('photo', 'Photo') }}
                    <br>
                    <img id="preview-image-before-upload" src="{{URL::asset('storage/img/faces/no-profile-picture.png')}}" alt="preview image" style="max-height: 300px;">
                    <p class="mb-2"></p>
                    {{ Form::file('photo', null, ['class' => 'form-control ']) }}
                </div>

                @include('employees._form')

                <div class="btn-group" role="group" aria-label="Basic example">
                    {{ Form::submit('Create', array('class' => 'btn btn-primary')) }}
                </div>
            </form>

            {{ Form::close() }}

        </div>
    </div>
</div>

</div>

@endsection

@push('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery.maskedinput@1.4.1/src/jquery.maskedinput.js" type="text/javascript"></script>

<script>
    $(".phone_mask").mask("+380 (99) 999-99-99");
</script>
<script  type="text/javascript">
$(function () {
    $('#datepicker').datepicker({
       format: 'yyyy-mm-dd'
     });
     autocomlete_plus();
     $( "#position_id" ).change(function() {
        autocomlete_plus();
     });
    function autocomlete_plus() {
        var path = "{{ route('autocomplete') }}";
        var position_id = $( "select#position_id option:checked" ).val();
        //var position_id = $('#position_id').val();
        console.log(position_id);
        $('input.typeahead').typeahead({
            source:  function (query, process) {
                //var position_id = $( "select#position_id option:checked" ).val();
                var position_id = $('#position_id').val();
                console.log(position_id);
                return $.get(path, { query: query, position_id: position_id }, function (data) {
                    console.log(data);
                    return process(data);
                });
            }
        });
    }
});
$(window).trigger('resize');
</script>
<script type="text/javascript">
$(document).ready(function (e) {
   $('#photo').change(function(){
    let reader = new FileReader();
       reader.onload = (e) => {
      $('#preview-image-before-upload').attr('src', e.target.result);
    }
    reader.readAsDataURL(this.files[0]);
   });
});
</script>

@endpush
