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
            			
            		</div>
            		<div class="col-md-9">
            			
            		</div>
            	</div>

                
                <div class="col-md-12" style="margin-bottom: 20px">
                    {{$question_reponse[0]->questionForum->nom}}
                </div>
                              

            	<div class="row">
            		<div class="col-md-3">
            			<div class="row">
                            <div class="col-md-12">
                            
                            </div>    
                        </div>
            		</div>
            		<div class="col-md-9">
            			@foreach($question_reponse as $row)
            				<div class="col-md-12" style="margin-bottom: 20px">
            					<strong>{{$row->users->nom}}</strong><br>
            					{{$row->description}}
            				</div>
            			@endforeach
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