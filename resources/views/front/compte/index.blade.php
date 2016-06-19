@extends('front.layout.home')
@section('content')

<div id="main">
    <div id="content">

        <div>
            @include('admin.layout.error')
            @include('admin.layout.errors_request')
            @include('admin.layout.success')

            <script src="{{ asset('plugins/notificationJs/notie.js') }}" type="text/javascript"></script>
            <div id="message_info"></div>

        </div>

        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="col-md-12">
                            <?php
                            $size = 150;
                            $default = "";
                            $gravatar = "http://www.gravatar.com/avatar/" . md5( strtolower( trim(Auth::user()->email))) . "?d=" . urlencode($default) . "&s=" . $size;
                            ?>
                            {!! HTML::image($gravatar, 'avatar', array('class' => 'img-circle img-responsive', 'alt'=>'avatar '.Auth::user()->nom.' '.Auth::user()->prenom)) !!}
                        </div>
                        <div class="col-md-12">
                            <a style="text-decoration: none;" type="submit" data-toggle="modal" data-target="#sujet">
                                <h3>Sujets</h3>
                            </a>
                            <span>{{count($sujet)}} sujets créer actuellement</span>

                            <a style="text-decoration: none;" type="submit" data-toggle="modal" data-target="#reponse">
                                <h3>Réponses</h3>
                            </a>
                            <span>{{count($reponse)}} réponses créer actuellement</span>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="col-md-12">
                            {!! Form::open(['class' => 'form-horizontal', 'method' => 'put', 'url' => route('compte/update', Auth::user()->id)]) !!}
                            <fieldset>
                                {!! Form::hidden('id_users', Auth::user()->id, array('class'=>'form-control', 'name'=>'id_users')) !!}
                                        <!-- Nom input-->
                                <div class="form-group">
                                    {!! Form::label('nom', 'Nom :', ['class'=>'col-md-4 control-label', 'for'=>'nom']) !!}
                                    <div class="col-md-4">
                                        {!! Form::input('texte', 'nom', Auth::user()->nom, ['class' => 'form-control input-md', 'name'=>'nom', 'placeholder' => 'nom'])!!}
                                    </div>
                                </div>

                                <!-- Prenom input-->
                                <div class="form-group">
                                    {!! Form::label('prenom', 'Prenom :', ['class'=>'col-md-4 control-label', 'for'=>'prenom']) !!}
                                    <div class="col-md-4">
                                        {!! Form::input('texte', 'prenom', Auth::user()->nom, ['class' => 'form-control input-md', 'name'=>'prenom', 'placeholder' => 'prenom'])!!}
                                    </div>
                                </div>

                                <!-- Email input-->
                                <div class="form-group">
                                    {!! Form::label('email', 'Email :', ['class'=>'col-md-4 control-label', 'for'=>'email']) !!}
                                    <div class="col-md-4">
                                        {!! Form::input('texte', 'email', Auth::user()->email, ['class' => 'form-control input-md', 'name'=>'email', 'placeholder' => 'email'])!!}
                                    </div>
                                </div>

                                <!-- Telephone input-->
                                <div class="form-group">
                                    {!! Form::label('telephone', 'Telephone :', ['class'=>'col-md-4 control-label', 'for'=>'telephone']) !!}
                                    <div class="col-md-4">
                                        {!! Form::input('texte', 'telephone', Auth::user()->telephone, ['class' => 'form-control input-md', 'name'=>'telephone', 'placeholder' => 'telephone'])!!}
                                    </div>
                                </div>

                                <!-- password input-->
                                <div class="form-group">
                                    {!! Form::label('mot_de_passe', 'Mot de passe :', ['class'=>'col-md-4 control-label', 'for'=>'mot de passe']) !!}
                                    <div class="col-md-4">
                                        {!! Form::input('password', 'password', Auth::user()->password, ['class' => 'form-control input-md', 'name'=>'password', 'placeholder' => 'password'])!!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-11 col-sm-offset-1">
                                            <input type="submit" name="submit" id="submit" class="form-control btn btn-register" value="CREATE">
                                        </div>
                                    </div>
                                </div>

                            </fieldset>
                            {!!  Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>





        {{-- Popup show --}}
        <div class="modal fade" id="sujet" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Les sujets</h4>
                        @foreach($sujet as $row)
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
                                    <p>écrit le : {{\App\Http\Controllers\Front\HomePageController::instanced()->formatDateComplete($row->created_at)}}</p>
                                    <br>
                                </center>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>







        {{-- Popup show --}}
        <div class="modal fade" id="reponse" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Les réponses</h4>

                        @foreach($reponse as $row)
                            <div class="modal-body">
                                <center>
                                    <h3 class="media-heading">{{$row->nom}}
                                        <small>
                                            {{$row->users->nom.' '.$row->users->prenom}}
                                        </small>
                                    </h3>
                                </center>
                                <hr>
                                <center>
                                    <h3>Réponse :</h3>
                                    <p>Description : {!! $row->description !!}</p>
                                    <p>écrit le : {{\App\Http\Controllers\Front\HomePageController::instanced()->formatDateComplete($row->created_at)}}</p>
                                    <br>
                                </center>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>


    </div>
</div><!-- #main -->

@stop