@extends('admin.layout.home')


@section('content')




<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small>Version 2.0</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('bo')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Info boxes -->
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <a href="{{route('rubrique.index')}}" style="color: #000;">
                    <span class="info-box-icon bg-aqua"><i class="ion ion-pricetags"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Rubriques</span>
                        <span class="info-box-number">liste des rubriques</span>
                    </div><!-- /.info-box-content -->
                </a>
            </div><!-- /.info-box -->
        </div><!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{route('sujet.index')}}" style="color: #000;">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-newspaper-o"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Sujet</span>
                        <span class="info-box-number">Liste des sujets</span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </a>
        </div><!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{route('home')}}" style="color: #000;">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="ion-ios-world-outline"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Allez</span>
                        <span class="info-box-number">sur le site internet</span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </a>
        </div><!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{route('users.index')}}" style="color: #000;">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Members</span>
                        <span class="info-box-number <?= count($users)>1?'ion-happy-outline':'ion-sad-outline' ?>">&nbsp;{{count($users)}} <?= count($users) > 1?'membres inscrits':'membre inscrit' ?></span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </a>
        </div><!-- /.col -->
    </div><!-- /.row -->

    <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="nav-tabs-custom">
                <!-- Tabs within a box -->
                <ul class="nav nav-tabs pull-right">
                    <li class="pull-left header"><i class="fa fa-inbox"></i>Rubrique Créer</li>
                </ul>
                <div class="tab-content no-padding">
                    <!-- Morris chart - Sales -->
                    <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px; margin-left: 10px; margin-top: 20px;">
                        @foreach($rubrique as $row)
                            <ul>
                                <li>
                                    Nom : {{$row->nom}} <div class="enter" /> Status : {{$row->statut}}<br />
                                    text : {{mb_strimwidth($row->description, 0, 100, '...')}} <br />
                                    Date de publication : {{\App\Http\Controllers\Admin\AdminPageController::instanced()->formatDateComplete($row->created_at)}}
                                </li>
                            </ul>
                        @endforeach
                        @if(count($rubrique) == 0)
                            <p style="text-align: center; font-size: 0.7em; text-transform: uppercase;">Aucune rubrique créer</p>
                        @endif
                    </div>
                </div>
            </div><!-- /.nav-tabs-custom -->

        </section><!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-5 connectedSortable">

            <!-- solid sales graph -->
            <div class="box box-solid bg-teal-gradient">
                <div class="box-header">
                    <i class="fa fa-th"></i>
                    <h3 class="box-title">Sujet Créer</h3>

                    <div class="box-tools pull-right">
                        <button class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <!--button class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i></button-->
                    </div>
                </div>
                <div class="box-body border-radius-none">
                    <div class="chart" id="line-chart" style="height: 250px; margin-left: 10px; margin-top: 10px;">
                        @foreach($sujet as $row)
                            <ul>
                                <li>Ecris par : {{$row->users->prenom}} {{substr($row->users->nom, 0, 1)}} <br />
                                    Ce sujet appartient à la rubrique <br />
                                    {{$row->rubrique->nom}} <br />
                                    Nom : {{$row->nom}} <br />
                                    Description : {{mb_strimwidth($row->description, 0, 150, '...')}} <br />
                                    Status : {{$row->statut}} <br />
                                    Date de publication : {{\App\Http\Controllers\Admin\AdminPageController::instanced()->formatDateComplete($row->created_at)}}
                                </li>
                            </ul>
                        @endforeach
                        @if(count($sujet) == 0)
                            <p style="text-align: center; font-size: 0.7em; text-transform: uppercase;">Aucun sujet créer</p>
                        @endif
                    </div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->

        </section><!-- right col -->
    </div><!-- /.row (main row) -->

</section><!-- /.content -->

@stop


