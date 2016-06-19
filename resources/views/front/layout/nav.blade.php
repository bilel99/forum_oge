<div id="wrapper">

    <style>
        .navbar-login
        {
            width: 305px;
            padding: 10px;
            padding-bottom: 0px;
        }

        .navbar-login-session
        {
            padding: 10px;
            padding-bottom: 0px;
            padding-top: 0px;
        }

        .icon-size
        {
            font-size: 87px;
        }
    </style>

    <div style="background-color: #3CB5F9;" class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a style="color:#fff;" href="{{route('home')}}" class="navbar-brand">{{\Config::get('constante.nom_code')}}</a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a style="color:#fff;"  href="{{route('question/index')}}">Créer un sujet</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a style="color:#fff;"  href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span style="color:#fff;"  class="glyphicon glyphicon-user"></span> 
                            <strong style="color:#fff;" >Bienvenue {{substr(Auth::user()->nom, 0, 1)}} {{Auth::user()->prenom}}</strong>
                            <span class="glyphicon glyphicon-chevron-down"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <div class="navbar-login">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <p class="text-center">
                                                <span class="icon-size">
                                                    <?php
                                                    $size = 100;
                                                    $default = "";
                                                    $gravatar = "http://www.gravatar.com/avatar/" . md5( strtolower( trim(Auth::user()->email))) . "?d=" . urlencode($default) . "&s=" . $size;
                                                    ?>
                                                    {!! HTML::image($gravatar, 'avatar', array('class' => 'media-object img-circle', 'alt'=>'user avatar')) !!}
                                                </span>
                                            </p>
                                        </div>
                                        <div class="col-lg-8">
                                            <p class="text-left small">{{Auth::user()->email}}</p>
                                            <p class="text-left">
                                                <a href="{{route('compte/index')}}" class="btn btn-primary btn-block btn-sm">Profil</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <div class="navbar-login navbar-login-session">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <p>
                                                <a href="{{route('root.logout')}}" class="btn btn-danger btn-block">Déconnexion</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>