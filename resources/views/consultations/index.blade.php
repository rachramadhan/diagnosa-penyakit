@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Konsultasi</h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                {!! Form::open(['route' => 'consultation.store']) !!}
                    <!-- Code Field -->
                    <div class="form-group col-sm-6">
                        {!! Form::label('diagnose', 'Keluhan:') !!}
                        {!! Form::textarea('diagnose', null, ['class' => 'form-control']) !!}
                    </div>

                    <!-- Submit Field -->
                    <div class="form-group col-sm-12">
                        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                        <a href="{!! route('consultation.index') !!}" class="btn btn-default">Cancel</a>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection

