@if ( $disease )
    @include( 'consultations.data' )

@else
    @include( 'consultations.data_not_found' )

@endif