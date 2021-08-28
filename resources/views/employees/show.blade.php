@extends('home')

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet"/>


@section('content')

<div class="container">

<div class="row">
    <div class="m-4">
        <div class="pull-left">
            <h2>Employees</h2>

            <!--<a class="btn btn-primary btn-sm" href="{{ route('employees.index') }}"> Back</a>-->
        </div>
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
        {{ Form::model($employee, ['url' => ['employees', $employee->id ], 'class' => 'form', 'file' => true, 'enctype' => 'multipart/form-data']) }}
            <form>
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="row">
                <div class="col-sm-6">
                    <h3>Delete Employee</h3>
                </div>
                @if ($count > 0)
                <div class="col-sm-6">
                    <h4> has subordinates <span class="badge badge-secondary">{{ $count }}</span></h4>
                </div>
                @endif
            </div>

                <div class="form-group">
                    {{ Form::label('photo', 'Photo') }}
                    <br>
                    @if ($employee->photo)
                        <img id="preview-image-before-upload" src="{{URL::asset('storage/img/faces')}}/{{$employee->photo}}" alt="preview image" style="max-height: 300px;">
                    @else
                        <img id="preview-image-before-upload" src="{{URL::asset('storage/img/faces/no-profile-picture.png')}}" alt="preview image" style="max-height: 300px;">
                    @endif
                    <p class="mb-2"></p>
                </div>

                <div class="form-group">
                    <p class="m-0"><b>Name</b></p>
                    {{ $employee->name }}
                </div>

                <div class="form-group">
                    <p class="m-0"><b>Phone</b></p>
                    {{ $employee->phone  }}
                </div>

                <div class="form-group">
                    <p class="m-0"><b>Email</b></p>
                    {{ $employee->email }}
                </div>

                <div class="form-group">
                    <p class="m-0"><b>Position</b></p>
                    {{ $employee->position()->first()->position }}
                </div>

                <div class="form-group">
                    <p class="m-0"><b>Salary</b></p>
                    {{ $employee->salary }}
                </div>

                <div class="form-group">
                    <p class="m-0"><b>Head</b></p>
                    {{ App\Models\Employee::find($employee->head_id)->name  }}
                </div>


                <div class="form-group date">
                <p class="m-0"><b>Date of employment</b></p>
                    {{ $employee->date_employment}}
                </div>




            @if ($count > 0)
                <hr>
                <div class="form-group">
                {{ Form::label('transfer', 'Subordination transfer', ['style' => 'color:red;']) }}
                {{ Form::select(
                    'transfer',
                    (new App\Models\Employee)->getListHead($employee->position_id),
                    null,
                    ['class' => 'form-control ']
                ) }}
                </div>
                <div class="btn-group btn-sm" role="group" aria-label="Basic example">
                    {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                </div>

            @else
                <div class="btn-group btn-sm" role="group" aria-label="Basic example">
                    <!--<a class="btn btn-dark btn-sm" href="{{ route('employees.index') }}"> Back</a>-->
                    @include('employees._delete')
                </div>
            @endif
            </form>
            {{ Form::close() }}

        </div>
    </div>
</div>

</div>

@endsection

@push('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>

<script  type="text/javascript">
$(function () {
    $('#datepicker').datepicker({
       format: 'yyyy-mm-dd'
     });
});
</script>
@endpush
