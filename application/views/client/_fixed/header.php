<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=isset($title_page) ? $title_page.' | ': '';?><?=APPLICATION_NAME?></title>

    <!-- start default --> 
    <link href="<?=base_url();?>assets/client/template/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/client/template/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?=base_url();?>assets/client/template/css/animate.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/client/template/css/style.css" rel="stylesheet">

    <!-- Mainly scripts -->
    <script src="<?=base_url();?>assets/client/template/js/jquery-3.1.1.min.js"></script>
    <script src="<?=base_url();?>assets/client/template/js/popper.min.js"></script>
    <script src="<?=base_url();?>assets/client/template/js/bootstrap.js"></script>
    <script src="<?=base_url();?>assets/client/template/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?=base_url();?>assets/client/template/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="<?=base_url();?>assets/client/template/js/inspinia.js"></script>
    <script src="<?=base_url();?>assets/client/template/js/plugins/pace/pace.min.js"></script>
    <!-- end default --> 

    <!-- awesome-bootstrap-checkbox -->
    <link href="<?=base_url();?>assets/client/template/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">

    <!-- Chosen -->
    <link href="<?=base_url();?>assets/client/template/css/plugins/chosen/bootstrap-chosen.css" rel="stylesheet">
    <script src="<?=base_url();?>assets/client/template/js/plugins/chosen/chosen.jquery.js"></script>

    <!-- Sweet Alert -->
    <link href="<?=base_url();?>assets/client/template/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
    <script src="<?=base_url();?>assets/client/template/js/plugins/sweetalert/sweetalert.min.js"></script>

    <!-- Toastr style -->
    <link href="<?=base_url();?>assets/client/template/css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <script src="<?=base_url();?>assets/client/template/js/plugins/toastr/toastr.min.js"></script>

</head>

<body class="">

    <div id="wrapper">

    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element text-center">
                        <img alt="image" class="rounded-circle" src="<?=$this->session->LOGIN['AVATAR']?>"  style="width:80px;"/>
                        <span class="block m-t-xs font-bold" style="color:#FFF"><?=$this->session->LOGIN['FIRST_NAME']?> <?=$this->session->LOGIN['LAST_NAME']?></span>
                        <span class="block m-t-xs text-muted " style="color:#FFF"><?=$this->session->LOGIN['EMAIL']?> </span>
                        <span class="block m-t-xs text-muted " style="color:#FFF"><a href="<?=base_url()?>logout"><i class="fa fa-sign-out"></i> Sair</a></span>
                        <!--
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="text-muted text-xs block">Art Director <b class="caret"></b></span>
                        </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a class="dropdown-item" href="<?=base_url();?>profile">Meu Perfil</a></li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?=base_url();?>logout">Sair</a></li>
                        </ul>
                        -->
                    </div>
                    <div class="logo-element">
                        DT
                    </div>
                </li>
                <li class="<?=$active_menu == 'dashboard' ? 'active' : ''?>">
                    <a href="<?=base_url()?>dashboard"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
                </li>
                
                <li class="<?=$active_menu == 'trading' ? 'active' : ''?>">
                    <a href="<?=base_url()?>trading"><i class="fa fa-files-o"></i> <span class="nav-label">Operações</span></a>
                </li>

                <li class="<?=$active_menu == 'reports' ? 'active' : ''?>">
                    <a href="<?=base_url()?>reports"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Relatórios</span></a>
                </li>
                <!--
                <li class="<?=$active_menu == 'trading-plan' ? 'active' : ''?>">
                    <a href="<?=base_url()?>trading-plan"><i class="fa fa-files-o"></i> <span class="nav-label">Plano de Operações</span></a>
                </li>

                <li class="<?=$active_menu == 'settings' ? 'active' : ''?>">
                    <a href="<?=base_url()?>settings"><i class="fa fa-cogs"></i> <span class="nav-label">Configurações</span></a>
                </li>

                <li class="landing_link my-5">
                    <a target="_blank" href="landing.html"><i class="fa fa-star"></i> <span class="nav-label">Planos</span> <span class="label label-warning float-right">PRO</span></a>
                </li>
                -->

            </ul>

        </div>
    </nav>

        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
        <div class="navbar-header"><a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i></a></div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <span class="m-r-sm text-muted welcome-message">Bem-vindo(a), <?=$this->session->LOGIN['FIRST_NAME']?>!</span>
                </li>
                <!--
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope"></i>  <span class="label label-warning">16</span>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <div class="dropdown-messages-box">
                                <a class="dropdown-item float-left" href="<?=base_url();?>profile">
                                    <img alt="image" class="rounded-circle" src="<?=base_url();?>assets/client/template/img/a7.jpg">
                                </a>
                                <div class="media-body">
                                    <small class="float-right">46h ago</small>
                                    <strong>Mike Loreipsum</strong> started following <strong>Monica Smith</strong>. <br>
                                    <small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>
                                </div>
                            </div>
                        </li>
                        <li class="dropdown-divider"></li>
                        <li>
                            <div class="text-center link-block">
                                <a href="mailbox.html" class="dropdown-item">
                                    <i class="fa fa-envelope"></i> <strong>Read All Messages</strong>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
                -->
                <!--
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell"></i>  <span class="label label-primary">8</span>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="mailbox.html" class="dropdown-item">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> You have 16 messages
                                    <span class="float-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="dropdown-divider"></li>
                        <li>
                            <div class="text-center link-block">
                                <a href="notifications.html" class="dropdown-item">
                                    <strong>See All Alerts</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
                -->

                <li>
                    <a href="<?=base_url()?>logout">
                        <i class="fa fa-sign-out"></i> Sair
                    </a>
                </li>
            </ul>

        </nav>
        </div>
