@extends('home')

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet" />


@section('content')

<div class="container">

    <div class="row">
        <div class="m-2">
            <h2>Positions</h2>
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

                {{ Form::open( ['url' => 'positions', 'class' => 'form'] ) }}
                <form>
                    <h3>Add Position</h3>

                    {{ csrf_field() }}

                    <div class="form-group">
                        {{ Form::label('position', 'Position') }}
                        {{ Form::text('position',  null, ['class' => 'form-control']) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('level', 'Level') }}
                        {{ Form::text('level',  null, ['class' => 'form-control']) }}
                    </div>


                    <div class="btn-group" role="group" aria-label="Basic example">
                        {{ Form::submit('Create', array('class' => 'btn btn-primary')) }}
                        <!--<a class="btn btn-dark btn-sm" href="{{ route('employees.index') }}"> Back</a>-->
                    </div>
                </form>

                {{ Form::close() }}

            </div>
        </div>
    </div>

</div>

@endsection
