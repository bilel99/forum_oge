@extends('front.layout.home')
@section('content')
	

<div id="wrapper">

<header>
    <div class="container clearfix">
        <h1 id="logo">
            Forum Oge
        </h1>
        <nav>
            <a href="">Accueil</a>
        </nav>
    </div>
</header><!-- /header -->

<div id="main">
    <div id="content">
        <section>
            <div class="container">
            	<div class="row">
            		<div class="col-md-3">
            			Utilisateur
            		</div>
            		<div class="col-md-9">
            			{!! Form::open(array('route'=>'question/store', 'class' => 'form-horizontal')) !!}
							<fieldset>
								{!! Form::hidden('id_users', Auth::user()->id, array('class'=>'form-control', 'name'=>'id_users')) !!}
								<!-- Select Rubrique -->
								<div class="form-group">  	
								  	{!! Form::label('id_rubrique', 'Rubrique :', ['class'=>'col-md-4 control-label', 'for'=>'id_rubrique']) !!}
									<div class="col-md-4">
								  		{!! Form::select('id_rubrique', $rubriques, '', ['class'=>'form-control']) !!}
									</div>
								</div>

								<!-- Titre input-->
								<div class="form-group">
								  	{!! Form::label('nom', 'Titre :', ['class'=>'col-md-4 control-label', 'for'=>'nom']) !!}  
								  	<div class="col-md-4">				  		
								  		{!! Form::input('texte', 'nom', null, ['class' => 'form-control input-md', 'name'=>'nom', 'placeholder' => 'titre', 'required'=>'required'])!!}
								  	</div>
								</div>

								<!-- Question input-->
								<div class="form-group">
								  	{!! Form::label('description', 'Question :', ['class'=>'col-md-4 control-label', 'for'=>'description']) !!}  
								  	<div class="col-md-4">
								  		{!! Form::input('texte', 'description', null, ['class' => 'form-control input-md', 'name'=>'description', 'placeholder' => 'question', 'required'=>'required'])!!}	
								  	</div>
								</div>

								<!-- Button -->
								<div class="form-group">
								  	{!! Form::label('validation', 'Validation :', ['class'=>'col-md-4 control-label', 'for'=>'validation']) !!}
							  		<div class="col-md-8">
							    		<button id="valider" tyme="submit" name="valider" class="btn btn-success">Valider</button>
							    		<button id="annuler" name="annuler" class="btn btn-danger">Annuler</button>
							  		</div>
								</div>
							</fieldset>
						{!!  Form::close() !!}
            		</div>
            	</div>
            </div>
        </section>
    </div>
</div><!-- #main -->


<footer>
<div id="info-bar">
    <div class="container clearfix">
        <span class="all-tutorials"><a href="http://bootsnipp.com/cppratikcp">← all tutorials</a></span>
        <span class="back-to-tutorial"><a href="https://www.facebook.com/pratik.chauhan.cp">CHUAHAN PRATIK</a></span>
    </div>
</div><!-- /#top-bar -->
</footer><!-- /footer -->



</div><!-- /#wrapper -->
@stop