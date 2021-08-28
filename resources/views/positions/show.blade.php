@extends('home')

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet"/>


@section('content')

<div class="container">

<div class="row">
    <div class="m-4">
        <div class="pull-left">
            <h2>positions</h2>

            <!--<a class="btn btn-primary btn-sm" href="{{ route('positions.index') }}"> Back</a>-->
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
        {{ Form::model($position, ['url' => ['positions', $position->id ], 'class' => 'form']) }}

            <form>
            {{ csrf_field() }}
            {{ method_field('PUT') }}

            <div class="row">
                <div class="col-sm-6">
                    <h3>Delete position</h3>
                </div>
                @if ($count > 0)
                <div class="col-sm-6">
                    <h4> has dependencies <span class="badge badge-secondary">{{ $count }}</span></h4>
                </div>
                @endif
            </div>

            <div class="form-group">
                <p class="m-0"><b>Position</b></p>
                {{ $position->position }}
            </div>

            <div class="form-group">
                <p class="m-0"><b>Level</b></p>
                {{ $position->level }}
            </div>

            @if ($count > 0)
                <hr>
                <div class="form-group">
                {{ Form::label('transfer', 'Subordination transfer', ['style' => 'color:red;']) }}
                {{ Form::select('transfer', App\Models\Position::where('position', '<>', $position->position)->pluck('position', 'id'), null, ['class' => 'form-control '] ) }}
                </div>
                <div class="btn-group btn-sm" role="group" aria-label="Basic example">
                    {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                </div>

            @else
                <div class="btn-group btn-sm" role="group" aria-label="Basic example">
                    @include('positions._delete')
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
