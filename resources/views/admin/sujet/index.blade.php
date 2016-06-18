@extends('admin.layout.home')



@section('content')

    <div class="users_page">

        <script src="{{ asset('admin/ajax/sujet/index.js') }}" type="text/javascript"></script>
        <link href="{{ asset('admin/css/search.css') }}" rel="stylesheet" type="text/css" />



        <script>
            $(function() {
                var availableTags = [
                    @foreach($sujet as $row)
                            "{{$row->nom}}",
                    @endforeach
                ];
                $( "#search" ).autocomplete({
                    source: availableTags
                });
            });
        </script>


        <section class="content-header">
            <h1>
                Sujet
                <small>Liste</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ ucfirst(route('bo')) }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Users</li>
            </ol>
        </section>


        <!-- Main content -->
        <div class="content">
            <div class="row">
                <div class="col-xs-12">

                    <div>
                        @include('admin.layout.error')
                        @include('admin.layout.errors_request')
                        @include('admin.layout.success')

                        <script src="{{ asset('plugins/notificationJs/notie.js') }}" type="text/javascript"></script>
                        <div id="message_info"></div>

                    </div>

                    <div class="box-header" style="overflow: auto;">
                        {!! Form::open(array('url' => route('sujet.search'), 'class'=>'search-form')) !!}
                        <div class="form-group has-feedback">
                            <label for="search" class="sr-only">Search</label>
                            <input type="text" class="form-control" name="search" id="search" placeholder="search">
                            <span class="glyphicon glyphicon-search form-control-feedback"></span>
                        </div>
                        {!! Form::close() !!}

                    </div><!-- /.box-header -->


                    <div id="table1">
                        <div class="box-body" style="overflow: auto;">
                            <table class="datatable table table-bordered table-striped" style="overflow: auto;" id="matable">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>id_rubrique</th>
                                    <th>id_users</th>
                                    <th>nom</th>
                                    <th>description</th>
                                    <th>valider</th>
                                    <th>status</th>
                                    <th>created_at</th>

                                    <th></th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>id_rubrique</th>
                                    <th>id_users</th>
                                    <th>nom</th>
                                    <th>description</th>
                                    <th>valider</th>
                                    <th>status</th>
                                    <th>created_at</th>

                                    <th></th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($sujet as $row)

                                    <tr data-id="{{$row->id}}">
                                        <td>{{$row->id}}</td>
                                        <td>{{$row->rubrique->nom}}</td>
                                        <td>{{substr($row->users->nom, 0, 1).' '.$row->users->prenom}}</td>
                                        <td>{{$row->nom}}</td>
                                        <td>{{$row->description}}</td>
                                        <td>{{$row->valider==1?'résolue':'non résolue'}}</td>
                                        <td id="statut_<?=$row->id?>">{{$row->statut}}</td>
                                        <td>{{\App\Http\Controllers\Admin\AdminPageController::instanced()->formatDateComplete($row->created_at)}}</td>

                                        <td>
                                            <!--button type="submit" class="btn btn-danger glyphicon glyphicon-trash " data-toggle="modal" data-target="#{{ $row->id  }}"></button-->
                                            <a type="submit" class="fa fa-eye fa-2x" data-toggle="modal" data-target="#{{ $row->id  }}"></a><br />
                                            <a class="fa fa-question-circle fa-2x" href="{{ route('sujet.show', $row->id) }}"></a><br />
                                            <!-- AJAX Change status, 1 ou 0 'Actif'|'Inactif' -->

                                            <div id="trash_<?=$row->id?>" style="display: none;">
                                                {!! Form::open(['route'=>['sujet.destroy', ':SUJET_ID'], 'method' => 'DELETE', 'id'=>'form-delete']) !!}
                                                <a style="margin-left: 0px;" href="#" class="fa fa-trash-o fa-2x btn-delete"></a>
                                                {!! Form::close() !!}
                                            </div>

                                            <div id="valable_<?=$row->id?>" style="display: none;">
                                                {!! Form::open(['route'=>['sujet.actif', ':SUJET_ID'], 'method' => 'ACTIF', 'id'=>'form-actif']) !!}
                                                <a style="margin-left: 0px;" href="#" class="fa fa-thumbs-o-up fa-2x btn-actif"></a>
                                                {!! Form::close() !!}
                                            </div>

                                        </td>
                                    </tr>

                                    {{-- Popup show --}}
                                    <div class="modal fade" id="{{ $row->id  }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title">Sujet : {{$row->nom}}</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <center>
                                                        <h3 class="media-heading">{{$row->nom}}
                                                            <small>
                                                                {{$row->rubrique->nom}}
                                                                {{$row->users->nom.' '.$row->users->prenom}}
                                                            </small>
                                                        </h3>
                                                    </center>
                                                    <hr>
                                                    <center>
                                                        <p>Description : {{$row->description}}</p>
                                                        <p>valider : {{$row->valider == 1?'Sujet terminer':'Sujet non résolue'}}</p>
                                                        <p>statut : {{$row->statut}}</p>
                                                        <p>écrit le : {{\App\Http\Controllers\Admin\AdminPageController::instanced()->formatDateComplete($row->created_at)}}</p>
                                                        <br>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach


                                </tbody>
                            </table>
                            <div style="margin-left: 40%;" class="paginate">
                                {!! $sujet->render() !!}
                            </div>
                        </div><!-- /.box-body -->
                    </div>




                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>

@stop