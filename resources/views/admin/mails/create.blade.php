@extends('admin.layout.home')

@section('content')

    <section class="content-header">
        <h1>
            Pages
            <small>Mails - Création -</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ ucfirst(route('bo')) }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Pages</li>
        </ol>
    </section>

    <link href="{{ asset('admin/css/tab.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/form.css') }}" rel="stylesheet">

    <div class="space"></div>
    <div class="container">
        <div class="row">

            <div class="col-md-10 col-md-offset-0">

                <div>
                    @include('admin.layout.success')
                    @include('admin.layout.errors_request')
                    @include('admin.layout.error')
                </div>

                <div class="panel panel-login">
                    <div class="panel-heading">
                        <div class="row">
                            <p>Création d'un modèle de mails</p>
                        </div>
                        <hr>
                    </div>


                    <div class="row">
                        <div style="margin-left: 40px;" class="col-md-11 col-md-offset-0">
                            {!! Form::open(['method' => 'post', 'url' => route('mails.store')]) !!}
                            <div class="panel with-nav-tabs panel-primary">
                                <div class="panel-heading">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#tab1primary" data-toggle="tab">expéditeur</a></li>
                                        <li><a href="#tab2primary" data-toggle="tab">contenu</a></li>
                                    </ul>
                                </div>
                                <div class="panel-body">
                                    <div class="tab-content">
                                        <div class="tab-pane fade in active" id="tab1primary">


                                            <div class="panel panel-login">
                                                <div class="panel-heading">
                                                    <div class="row">
                                                        <p>Création d'un mail</p>
                                                    </div>
                                                    <hr>
                                                </div>
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <!-- List Select via BDD (function List(-laravel-)) -->
                                                            <div class="form-group">
                                                                {!! Form::label('id_langues', 'langues *', array('class' => 'col-md-4 col-md-offset-5 control-label')) !!}
                                                                {!! Form::select('id_langues', $langues, '', ['class'=>'form-control']) !!}
                                                            </div>
                                                            <!-- Fin function List -->

                                                            <div class="form-group">
                                                                {!! Form::label('type', 'type *', array('class' => 'col-md-4 col-md-offset-5 control-label')) !!}
                                                                {!! Form::text('type', '', array('class'=>'form-control', 'name'=>'type', 'placeholder' => 'type', 'required'=>'required')) !!}
                                                            </div>

                                                            <div class="form-group">
                                                                {!! Form::label('nom', 'nom *', array('class' => 'col-md-4 col-md-offset-5 control-label')) !!}
                                                                {!! Form::text('nom', '', array('class'=>'form-control', 'name'=>'nom', 'placeholder' => 'nom', 'required'=>'required')) !!}
                                                            </div>

                                                            <div class="form-group">
                                                                {!! Form::label('exp_nom', 'nom de l\'expéditeur *', array('class' => 'col-md-4 col-md-offset-5 control-label')) !!}
                                                                {!! Form::text('exp_nom', '', array('class'=>'form-control', 'name'=>'exp_nom', 'placeholder' => 'nom de l\'expéditeur', 'required'=>'required')) !!}
                                                            </div>

                                                            <div class="form-group">
                                                                {!! Form::label('exp_email', 'email de l\'expéditeur *', array('class' => 'col-md-4 col-md-offset-5 control-label')) !!}
                                                                {!! Form::email('exp_email', '', array('class'=>'form-control', 'name'=>'exp_email', 'placeholder' => 'email de l\'expéditeur', 'required'=>'required')) !!}
                                                            </div>

                                                            <div class="form-group">
                                                                {!! Form::label('sujet', 'sujet *', array('class' => 'col-md-4 col-md-offset-5 control-label')) !!}
                                                                {!! Form::text('sujet', '', array('class'=>'form-control', 'name'=>'sujet', 'placeholder' => 'sujet', 'required'=>'required')) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="tab-pane fade" id="tab2primary">
                                            <div class="form-group">
                                                {!! Form::label('contenue', 'contenue *', array('class' => 'col-md-4 col-md-offset-5 control-label')) !!}
                                                {!! Form::textarea('contenue', '', array('class'=>'form-control', 'name'=>'contenue', 'placeholder' => 'contenue', 'required'=>'required')) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-10 col-sm-offset-1">
                                        <input type="submit" name="submit" id="submit" class="form-control btn btn-register" value="CREATE">
                                    </div>
                                </div>
                            </div>

                            {!! Form::close() !!}


                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

    @stop




    @section('footer')

    <!-- TINY MCE >
    <script src="{{ asset('plugins/tinymce/jquery.tinymce.min.js') }}"></script>
    <script src="{{ asset('plugins/tinymce/tinymce.min.js') }}"></script>

    <script type="text/javascript">
        tinymce.init({
            selector: "textarea",
            plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste"
            ],
            toolbar: "bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
        });
    </script-->


@stop