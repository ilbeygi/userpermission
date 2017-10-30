<html>
    
<head>
    <title>permission groups</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <ul class="nav nav-pills">
                            <li role="presentation" class="active"><a href="/">dashboard</a></li>
                            <li role="presentation"><a href="{{ route('permissions.group.index') }}">permission groups</a></li>
                        </ul>
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            @if (Session::has('status'))
                            <div class="alert alert-info">{{ Session::get('status') }}</div>
                            @endif
                            <div class="col-md-12">


                                <a class="btn btn-success" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                    create a new user group
                                </a>
                                <a class="btn btn-info" role="button" data-toggle="collapse" href="#collapseExample1" aria-expanded="false" aria-controls="collapseExample">
                                    add new route
                                </a>


                                <div class="collapse" id="collapseExample">
                                    <div class="well">
                                        <form method="post" action="{{ route('permissions.group.store') }}" enctype="multipart/form-data">
                                            {!! csrf_field() !!}
                                            <div class="modal-body">
                                                <label for="name">user group title :</label>
                                                <input type="text" class="form-control" name="role_name" id="name" required >
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">cancel</button>
                                                <input type="submit" class="btn btn-primary" value="register user group" >
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="collapse" id="collapseExample1">
                                    <div class="well">
                                        <form method="post" action="{{ route('permissions.route.store') }}" enctype="multipart/form-data">
                                            {!! csrf_field() !!}
                                            <div class="modal-body">
                                                <label for="name">new path name :</label>
                                                <input type="text" class="form-control" name="route" id="name" required >
                                                <label for="name">new route name (Definition name) :</label>
                                                <input type="text" class="form-control" name="route_name" id="name" required >
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">cancel</button>
                                                <input type="submit" class="btn btn-primary" value="register new route" >
                                            </div>
                                        </form>

                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>

                                                <th class="text-center">row</th>
                                                <th class="text-center">user group name</th>
                                                <th class="text-center">action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $count=1; ?>
                                           @foreach ($rolenames as $role)
                                            <tr>
                                                <th class="text-center" scope="row">{{$count ++}}</th>
                                                <td class="text-center">{{$role->role_name}}</td>
                                                <td class="text-center">
                                                    <a class="btn btn-default" href="{{ route('permissions.access.index',['id' => $role->id]) }}">add permissions</a>
                                                </td>
                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                              {{ $rolenames->links() }}
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