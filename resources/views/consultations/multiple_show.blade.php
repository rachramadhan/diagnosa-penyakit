@foreach( $result as $data )
    <div class="col-md-6">
        @php( $disease = $data['disease'] )
        @php( $percentage = $data['percentage'] )
        @include( 'consultations.data' )
    </div>
@endforeach