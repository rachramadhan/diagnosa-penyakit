@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Disease
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($disease, ['route' => ['diseases.update', $disease->id], 'method' => 'patch']) !!}

                        @include('diseases.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection