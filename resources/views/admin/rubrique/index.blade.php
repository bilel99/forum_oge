@extends('admin.layout.home')



@section('content')

    <div class="users_page">

    <script src="{{ asset('admin/ajax/rubrique/index.js') }}" type="text/javascript"></script>
    <link href="{{ asset('admin/css/search.css') }}" rel="stylesheet" type="text/css" />



    <script>
        $(function() {
            var availableTags = [
                @foreach($rubrique as $row)
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
            Rubrique
            <small>Liste</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ ucfirst(route('bo')) }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Rubrique</li>
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
                    {!! Form::open(array('url' => route('rubrique.search'), 'class'=>'search-form')) !!}
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
                                    <th>nom</th>
                                    <th>description</th>
                                    <th>status</th>
                                    <th>created_at</th>

                                    <th></th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>nom</th>
                                    <th>description</th>
                                    <th>status</th>
                                    <th>created_at</th>

                                    <th></th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($rubrique as $row)

                                    <tr data-id="{{$row->id}}">
                                        <td>{{$row->nom}}</td>
                                        <td>{{$row->description}}</td>
                                        <td id="statut_<?=$row->id?>">{{$row->statut}}</td>
                                        <td>{{\App\Http\Controllers\Admin\AdminPageController::instanced()->formatDateComplete($row->created_at)}}</td>

                                        <td>
                                            <a class="fa fa-pencil-square-o fa-2x" href="{{ route('rubrique.edit', $row->id) }}"></a><br />
                                            <!--button type="submit" class="btn btn-danger glyphicon glyphicon-trash " data-toggle="modal" data-target="#{{ $row->id  }}"></button-->
                                            <a type="submit" class="fa fa-eye fa-2x" data-toggle="modal" data-target="#{{ $row->id  }}"></a><br />
                                            <!-- AJAX Change status, 1 ou 0 'Actif'|'Inactif' -->


                                            <div id="trash_<?=$row->id?>" style="display: none;">
                                                {!! Form::open(['route'=>['rubrique.destroy', ':RUBRIQUE_ID'], 'method' => 'DELETE', 'id'=>'form-delete']) !!}
                                                <a style="margin-left: 0px;" href="#" class="fa fa-trash-o fa-2x btn-delete"></a>
                                                {!! Form::close() !!}
                                            </div>

                                            <div id="valable_<?=$row->id?>" style="display: none;">
                                                {!! Form::open(['route'=>['rubrique.actif', ':RUBRIQUE_ID'], 'method' => 'ACTIF', 'id'=>'form-actif']) !!}
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
                                                    <h4 class="modal-title">Rubrique : {{$row->nom}}</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <center>
                                                        <p>description : {{$row->description}}</p>
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
                                {!! $rubrique->render() !!}
                            </div>
                        </div><!-- /.box-body -->
                    </div>




            </div><!-- /.box -->
        </div><!-- /.col -->
        </div><!-- /.row -->


    </div>




@stop