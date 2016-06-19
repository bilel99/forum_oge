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
            		<div class="col-md-12">
            			{!! Form::open(array('route'=>'question/store', 'class' => 'form-horizontal')) !!}
							<fieldset>
								{!! Form::hidden('id_users', Auth::user()->id, array('class'=>'form-control', 'name'=>'id_users')) !!}
								<!-- Select Rubrique -->
								<div class="form-group">  	
								  	{!! Form::label('id_rubrique', 'Rubrique', ['class'=>'col-md-12 control-label', 'for'=>'id_rubrique']) !!}
									<div class="col-md-12">
								  		{!! Form::select('id_rubrique', $rubriques, '', ['class'=>'form-control']) !!}
									</div>
								</div>

								<!-- Titre input-->
								<div class="form-group">
								  	{!! Form::label('nom', 'Titre', ['class'=>'col-md-12 control-label', 'for'=>'nom']) !!}
								  	<div class="col-md-12">
										{!! Form::text('nom', '', array('class'=>'form-control', 'name'=>'nom', 'placeholder' => 'nom', 'required'=>'required')) !!}
								  	</div>
								</div>

								<!-- Question input-->
								<div class="form-group">
								  	{!! Form::label('description', 'Question', ['class'=>'col-md-12 control-label', 'for'=>'description']) !!}
								  	<div class="col-md-12">
										{!! Form::textarea('description', '', array('class'=>'form-control', 'name'=>'description', 'placeholder' => 'description')) !!}
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