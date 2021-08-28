@extends('home')

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet"/>


@section('content')

<div class="container">

<div class="row">
    <div class="m-2">
            <h2>Position</h2>
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

            {{ Form::model($position, ['url' => ['positions', $position->id ], 'class' => 'form', 'file' => true, 'enctype' => 'multipart/form-data']) }}

            {{ csrf_field() }}
            {{ method_field('PATCH') }}

            <form>
                <div class="row">
                    <div class="col-sm-6">
                        <h3>Edit Positions</h3>
                    </div>
                    @if ($count > 1)
                    <div class="col-sm-6">
                        <h4> has dependencies <span class="badge badge-secondary">{{ $count }}</span></h4>
                    </div>
                    @endif
                </div>

                <div class="form-group">
                    {{ Form::label('position', 'Position') }}
                    {{ Form::text('position',  null, ['class' => 'form-control']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('level', 'Level') }}
                    {{ Form::text('level',  null, ['class' => 'form-control', 'readonly' => 'true']) }}
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <p><b>Created at:</b> {!! \Carbon\Carbon::parse($position->created_at)->format('Y-m-d') !!}</p>
                        <p><b>Updated at:</b> {!! \Carbon\Carbon::parse($position->updated_at)->format('Y-m-d') !!}</p>
                    </div>
                    <div class="col-sm-6">
                        <p><b>Admin created ID:</b> {!! $position->admin_created_id!!}</p>
                        <p><b>Admin updated ID:</b> {!! $position->admin_updated_id!!}</p>
                    </div>
                </div>


                <div class="btn-group" role="group" aria-label="Basic example">
                    {{ Form::submit('Update', array('class' => 'btn btn-primary')) }}
                </div>
            </form>

            {{ Form::close() }}

        </div>
    </div>
</div>

</div>

@endsection

@push('scripts')

@endpush
