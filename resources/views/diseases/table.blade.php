<table class="table table-responsive" id="diseases-table">
    <thead>
        <tr>
            @auth
                <th>Code</th>
            @endauth
            <th>Name</th>
            <th>Description</th>
            @auth
                <th>Diagnose</th>
                <th colspan="3">Action</th>
            @endauth
        </tr>
    </thead>
    <tbody>
    @foreach($diseases as $disease)
        <tr>
            @auth
                <td>{!! $disease->code !!}</td>
            @endauth
            <td>{!! $disease->name !!}</td>
            <td>{!! $disease->description !!}</td>
            @auth
                <td>{!! $disease->diagnose !!}</td>
                <td>
                    {!! Form::open(['route' => ['diseases.destroy', $disease->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('diseases.show', [$disease->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('diseases.edit', [$disease->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            @endauth
        </tr>
    @endforeach
    </tbody>
</table>