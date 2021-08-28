{{ Form::open([ 'method'  => 'delete', 'route' => [ 'positions.destroy', $position->id ], 'onsubmit' => 'return confirm("Are you sure?")']) }}
    {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
{{ Form::close() }}
