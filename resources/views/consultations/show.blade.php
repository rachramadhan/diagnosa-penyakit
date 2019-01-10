@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Konsultasi
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @if ( $disease )
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

                    @else
                        <!-- Diagnose Field -->
                        <div class="form-group">
                            {!! Form::label('diagnose', 'Diagnose:') !!}
                            <p>{!! $diagnose !!}</p>
                        </div>

                        <!-- Result Field -->
                        <div class="form-group">
                            {!! Form::label('result', 'Result:') !!}
                            <p>Penyakit Tidak Ditemukan.</p>
                        </div>
                    @endif
                    <a href="{!! route('consultation.index') !!}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
