<div class="form-group">
    {{ Form::label('name', 'Name') }}
    {{ Form::text('name',  null, ['class' => 'form-control ']) }}
</div>


<div class="form-group">
    {{ Form::label('phone', 'Phone') }}
    {{ Form::text('phone', null, ['class' => 'form-control phone_mask']) }}
</div>

<div class="form-group">
    {{ Form::label('email', 'Email') }}
    {{ Form::email('email', null, ['class' => 'form-control ']) }}
</div>

<div class="form-group">
    {{ Form::label('position_id', 'Position') }}
    {{ Form::select('position_id', App\Models\Position::pluck('position', 'id'), null, ['class' => 'form-control ']) }}
</div>

<div class="form-group">
    {{ Form::label('salary', 'Salary') }}
    {{ Form::text('salary', null, ['class' => 'form-control ']) }}
</div>

<div class="form-group">
    {{ Form::label('head_id', 'Head') }}
    @if (@$employee)
        {{ Form::hidden('head_id',  null, ['class' => 'form-control', 'invisible' , 'secret']) }}
        {{ Form::text('head_name', App\Models\Employee::find($employee->head_id)->name, ['class' => 'form-control typeahead']) }}
    @else
        {{ Form::text('head_id', null, ['class' => 'form-control typeahead']) }}
    @endif
</div>


<div class="form-group date">
    {{ Form::label('date_employment', 'Date of employment') }}
    {{ Form::text('date_employment', null, array('class' => 'form-control','id' => 'datepicker')) }}
</div>


