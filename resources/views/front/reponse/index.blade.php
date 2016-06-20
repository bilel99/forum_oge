@extends('front.layout.home')
@section('content')
	
<div id="main">
    <div id="content">
        <script src="{{ asset('front/ajax/reponse/index.js') }}" type="text/javascript"></script>
        <link href="{{ asset('admin/css/comments.css') }}" rel="stylesheet" type="text/css" />

        <div>
            @include('admin.layout.error')
            @include('admin.layout.errors_request')
            @include('admin.layout.success')

            <script src="{{ asset('plugins/notificationJs/notie.js') }}" type="text/javascript"></script>
            <div id="message_info"></div>
        </div>

        <section>
            <div class="container">
                @foreach($sujet as $row)
                    <div class="valideSujet" data-id="{{$row->id}}" id="update_{{$row->id}}">
                        @if($row->valider == 0)
                            <h3 class="pasres" style="color: #ad4844;">Sujet non résolue</h3>
                            <h3 class="res" style="float:right;color: #00a157; display:none;">Sujet résolue</h3>
                            <div style="float: right;">
                                {!! Form::open(['route'=>['reponse.updateSujet', ':USUJET_ID'], 'method' => 'UPDATE', 'id'=>'form-update']) !!}
                                    <a class="btn btn-success btn-circle text-uppercase btn-update" href="#"><span class="fa fa-pencil"></span>Valider le sujet</a>
                                {!! Form::close() !!}
                            </div>
                        @else
                            <h3 style="float:right;color: #00a157;">Sujet résolue</h3>
                        @endif
                    </div>
                @endforeach

                <div class="row">
                    @foreach($sujet as $row)
                        <div style="">
                            <h2 style="text-align: center;">{{$row->nom}}</h2>
                            <p>{!! $row->description !!}</p>
                        </div>
                    @endforeach
            		<div class="col-md-12">

                        <div class="comment-tabs">
                            <ul class="nav nav-tabs" role="tablist">
                                @foreach($sujet as $row)
                                    <li class="active"><a href="#comments-logout" role="tab" data-toggle="tab"><h4 class="reviews text-capitalize"><b>{{$row->nom}}</b></h4></a></li>
                                @endforeach
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="comments-logout">
                                    <ul class="media-list">
                                        @if(count($question_reponse) > 0)
                                            @foreach($question_reponse as $row)

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
                                                            <h4 class="media-heading text-uppercase reviews">{{substr($row->users->nom, 0, 1)}} {{$row->users->prenom}}</h4>
                                                            <ul class="media-date text-uppercase reviews list-inline">
                                                                <li class="dd">{{\App\Http\Controllers\Front\HomePageController::instanced()->formatDateComplete($row->created_at)}}</li>
                                                            </ul>
                                                            <p class="media-comment">
                                                                {!! $row->description !!}
                                                            </p>

                                                            @if($row->users->id == Auth::user()->id)
                                                                <div id="trash_<?=$row->id?>">
                                                                    {!! Form::open(['route'=>['reponse.delete', ':REPONSE_ID'], 'method' => 'DELETE', 'id'=>'form-delete']) !!}
                                                                        <a class="btn btn-danger btn-circle text-uppercase btn-delete" href="#"><span class="fa fa-trash-o"></span>Delete</a>
                                                                    {!! Form::close() !!}
                                                                </div>
                                                            @endif
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

                        @foreach($sujet as $row)
                                {!! Form::open(array('route'=>'reponse/store', 'class' => 'form-horizontal')) !!}
                                    <!-- Reponse input-->
                                    {!! Form::hidden('id_question_forum', $row->id, array('class'=>'form-control', 'name'=>'id_question_forum')) !!}
                                    <div class="form-group">
                                        {!! Form::label('reponse', 'Ajouté votre réponse', ['class'=>'col-md-12 control-label', 'for'=>'reponse']) !!}
                                        <div class="col-md-12">
                                            {!! Form::textarea('reponse', '', array('class'=>'form-control', 'name'=>'reponse', 'placeholder' => 'Ajouté votre Réponse au sujet')) !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-11 col-sm-offset-1">
                                                <input type="submit" name="submit" id="submit" class="form-control btn btn-register" value="CREATE">
                                            </div>
                                        </div>
                                    </div>
                                {!!  Form::close() !!}
                        @endforeach

                   </fieldset>
            	</div>
            </div>
        </section>
    </div>
</div><!-- #main -->

@stop
<!-- TINY MCE -->
<script src='//cdn.tinymce.com/4/tinymce.min.js'></script><script src="{{ asset('plugins/tinymce/tinymce.min.js') }}"></script>

<script type="text/javascript">
    tinymce.init({
        selector: "textarea",
        plugins: [
            "advlist autolink lists link image charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
    });
</script>