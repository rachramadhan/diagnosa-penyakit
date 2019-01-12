<script type="text/javascript">
    $(document).on('submit', '#consultation-form', function(){
        url = $(this).attr('action');
        data = $(this).serialize();
        $.ajax({
            dataType: 'html',
            type: 'POST',
            url: url,
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            data: data

        }).done(function(response){
            $("#errors").addClass('hide');
            $("#answer").removeClass('hide');

            $("#answer").html( response );

        }).fail(function(errors) {
            $("#errors").removeClass('hide');
            $("#answer").addClass('hide');

        });
    })
</script>