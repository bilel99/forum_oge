@extends('front.layout.home')
@section('content')

<script src="{{ asset('front/js/tableFilter.js') }}" type="text/javascript"></script>
<link href="{{ asset('front/css/tableFilter.css') }}" rel="stylesheet" type="text/css" />

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
            			<div class="row">
            				<div class="col-md-12">
            					<a href="{{route('home')}}"><strong>Toutes les rubriques</strong></a>
            				</div>
            				@foreach($rubrique as $row)
            				<div class="col-md-12">
            					<a href="{{route('rubrique/index', $row->id)}}">{{$row->nom}}</a>
            				</div>
            				@endforeach
            			</div>
            		</div>

            		<div class="col-md-9">
						<div class="row">

							<section class="content" style="padding: 10px 0;">
								<div class="col-md-13 ">
									<div class="panel panel-default">
										<div class="panel-body">
											<div class="pull-right">
												<div class="btn-group">
													<?php
														$color = array(	'0' => 'btn-success',
																		'1' => 'btn-warning',
																		'2' => 'btn-danger',
																		'3' => 'btn-default');
													?>
													@if(count($rubrique) == 0)
														<p>Aucune rubrique pour le moment</p>
													@else
														@foreach($rubrique as $key=>$row)
															<button style="" type="button" class="btn <?=$key > 3?$color[$key-1]:$color[$key]?> btn-filter" data-target="<?=$row->nom?>">{{$row->nom}}</button>
														@endforeach
															<button style="" type="button" class="btn btn-default btn-filter" data-target="all">Toutes les rubriques</button>
													@endif
												</div>
											</div>
											<div class="table-container">
												<table class="table">
													<tbody>
														@if(count($question_forum) == 0)
															<p>Aucun sujet pour le moment</p>
														@else
															@foreach($question_forum as $key=>$row)

																<tr data-status="{{$row->rubrique->nom}}">
																	<td>
																		<div class="media">
																			<a href="{{route('reponse/index', $row->id)}}" class="pull-left">
																				<?php
																				$size = 100;
																				$default = "";
																				$gravatar = "http://www.gravatar.com/avatar/" . md5( strtolower( trim($row->users->email))) . "?d=" . urlencode($default) . "&s=" . $size;
																				?>
																				{!! HTML::image($gravatar, 'avatar', array('class' => 'img-responsive img-circle', 'alt'=>'user avatar')) !!}
																			</a>
																			<div class="media-body">
																				<span class="media-meta pull-right">{{\App\Http\Controllers\Front\HomePageController::instanced()->formatDateComplete($row->created_at)}}</span>
																				<h4 class="title">
																					{{$row->nom}}
																					<span class="pull-right pagado">({{$row->rubrique->nom}})<br />
																					<?php $reponse = \App\QuestionReponse::with('questionForum', 'users')->where('id_question_forum', '=', $row->id)->get(); ?>
																					@if(count($reponse) == 0)
																						Aucune réponse
																					@else
																						{{count($reponse)}} réponses
																					@endif

																					</span>
																				</h4>
																				<p class="summary">{!! mb_strimwidth($row->description, 0, 200, '...') !!}</p>
																			</div>
																		</div>
																	</td>
																</tr>

															@endforeach
														@endif
													</tbody>
												</table>
											</div>
										</div>
									</div>
									<div class="content-footer">
									</div>
								</div>
							</section>
						</div>
            		</div>
            	</div>
            </div>
        </section>
    </div>
</div><!-- #main -->

@stop