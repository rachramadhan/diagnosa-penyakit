<!-- Code Field -->
<div class="form-group">
    {!! Form::label('code', 'Code:') !!}
    <p>{!! $disease->code !!}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{!! $disease->name !!}</p>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', 'Description:') !!}
    <p>{!! $disease->description !!}</p>
</div>

<!-- Diagnose Field -->
<div class="form-group">
    {!! Form::label('diagnose', 'Diagnose:') !!}
    <p>{!! $disease->diagnose !!}</p>
</div>