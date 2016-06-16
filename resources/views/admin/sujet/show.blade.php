@extends('admin.layout.home')



@section('content')

    <div class="users_page">

        <?php

        //Session::put('url_current_page','s');
        ?>

        <script src="{{ asset('admin/ajax/reponse/index.js') }}" type="text/javascript"></script>
        <link href="{{ asset('admin/css/comments.css') }}" rel="stylesheet" type="text/css" />


        <section class="content-header">
            <h1>
                Réponse au sujet <b>{{$sujet->nom}}</b>
                <small>Liste</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ ucfirst(route('bo')) }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Réponse</li>
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

                    <div id="table1">
                        <div class="box-body" style="overflow: auto;">

                            <div class="row">
                                <div class="col-sm-10 col-sm-offset-1" id="logout">

                                    <h3>{{substr($sujet->users->nom, 0, 1).'.'.$sujet->users->prenom}} à créer le sujet {{$sujet->nom}} le : {{\App\Http\Controllers\Admin\AdminPageController::instanced()->formatDateComplete($sujet->created_at)}}</h3>
                                    <h4 style="margin-left: 100px;">{{$sujet->description}}</h4>

                                    <div class="comment-tabs">
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li class="active"><a href="#comments-logout" role="tab" data-toggle="tab"><h4 class="reviews text-capitalize"><b>{{$sujet->nom}}</b></h4></a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="comments-logout">
                                                <ul class="media-list">
                                                    @if(count($reponse) > 0)
                                                        @foreach($reponse as $row)

                                                            <li data-id="{{$row->id}}" class="media" id="post_{{$row->id}}">
                                                                <?php
                                                                $size = 100;
                                                                $default = "";
                                                                $gravatar = "http://www.gravatar.com/avatar/" . md5( strtolower( trim($row->users->email))) . "?d=" . urlencode($default) . "&s=" . $size;
                                                                ?>
                                                                <a class="pull-left" href="#">
                                                                    {!! HTML::image($gravatar, 'avatar', array('class' => 'media-object img-circle', 'alt'=>'user avatar')) !!}
                                                                </a>
                                                                <div class="media-body">
                                                                    <div class="well well-lg">
                                                                        <h4 class="media-heading text-uppercase reviews">Kriztine</h4>
                                                                        <ul class="media-date text-uppercase reviews list-inline">
                                                                            <li class="dd">{{\App\Http\Controllers\Admin\AdminPageController::instanced()->formatDateComplete($row->created_at)}}</li>
                                                                        </ul>
                                                                        <p class="media-comment">
                                                                            {{$row->description}}
                                                                        </p>

                                                                        <div id="trash_<?=$row->id?>">
                                                                            {!! Form::open(['route'=>['reponse.destroy', ':REPONSE_ID'], 'method' => 'DELETE', 'id'=>'form-delete']) !!}
                                                                                <a class="btn btn-danger btn-circle text-uppercase btn-delete" href="#"><span class="fa fa-trash-o"></span>Delete</a>
                                                                            {!! Form::close() !!}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>

                                                        @endforeach
                                                    @else
                                                        <p style="text-align: center;">Sujet vide !</p>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div><!-- /.box-body -->
                    </div>

                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>

@stop