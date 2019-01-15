<section class="content-header">
    <h1>
        Hasil Analisa
    </h1>
</section>
<div class="content">
    <div class="box box-primary">
        <div class="box-body">
            <div class="row" style="padding-left: 20px">
                @if( $singleReturn )
                    @php( $percentage = $result['percentage'] )
                    @include( 'consultations.single_show' )
                @else
                    @include( 'consultations.multiple_show' )
                @endif
            </div>
            <a href="{!! route('consultation.index') !!}" class="btn btn-default">Back</a>
        </div>
    </div>
</div>
