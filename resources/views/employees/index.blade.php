@extends('home')

@section('content')
<div class="container-fluid m-2">
    <div class="row">
        <div class="m-2">
                <h2>Employees</h2>
        </div>
    </div>
    {{$dataTable->table()}}
</div>
@endsection

@push('scripts')
    {{$dataTable->scripts()}}
@endpush
