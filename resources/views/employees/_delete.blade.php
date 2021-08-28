{{ Form::open([ 'method'  => 'delete', 'route' => [ 'employees.destroy', $employee->id ], 'onsubmit' => 'return confirm("Are you sure?")']) }}
    {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
{{ Form::close() }}
