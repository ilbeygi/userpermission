<html>
    
<head>
    <title>add permission</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <span class="btn btn-default">add permission</span>
                        <a class="btn btn-info" href="{{ route('permissions.group.index') }}">permission groups</a>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            @if (Session::has('status'))
                            <div class="alert alert-info">{{ Session::get('status') }}</div>
                            @endif
                            <div class="col-md-12">
                                <a class="btn btn-success" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                    add permission
                                </a>

                                <div class="collapse" id="collapseExample">
                                    <div class="well">
                                        <form method="post" action="{{ route('permissions.access.store') }}" enctype="multipart/form-data">
                                            {!! csrf_field() !!}
                                            <input type="hidden" id="js-example-basic-multiple" name="role_names_id" value="{{ $id }}">
                                            <div class="modal-body">
                                                <label for="name">permissions :</label>
                                                <select class="js-example-basic-multiple form-control" name="access[]" multiple="multiple" style="width: 100%">
                                                    @foreach ($routes as $route)
                                                    <option value="{{ $route->id }}">{{ $route->route_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">cancel</button>
                                                <input type="submit" class="btn btn-primary" value="register permission" >
                                            </div>
                                        </form>
                                    </div>
                                </div>


                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center">row</th>
                                                <th class="text-center">permission group name</th>
                                                <th class="text-center">route</th>
                                                <th class="text-center">action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $count=1; ?>
                                            @foreach ($roles as $role)
                                            <tr>
                                                <th class="text-center" scope="row">{{$count ++}}</th>
                                                <td class="text-center">{{$role->rolenames->role_name}}</td>
                                                <td class="text-center">{{$role->routes->route_name}}</td>
                                                <td class="text-center">
                                                    <form action="{{ route('permissions.access.delete',['id' => $role->id]) }}" method="post">
                                                        {{ csrf_field() }}
                                                        <button type="submit" class="btn btn-danger">delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                                {{ $roles->links() }}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    
</body>