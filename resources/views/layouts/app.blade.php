<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Bootstrap Admin Theme</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('/cms/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{ asset('/cms/vendor/metisMenu/metisMenu.min.css')}}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('/cms/dist/css/sb-admin-2.css')}}" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="{{ asset('/cms/vendor/morrisjs/morris.css')}}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ asset('/cms/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="">Promotion</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        
                        <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        
                        <li>
                            <a href="{{ URL::to('dashboard') }}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Directories<span class="fa arrow"></span></a>
                            @if(count($direct)!=0)
                            <ul class="nav nav-second-level">
                            	@foreach($direct as $dir)
                                <li>
                                    <a href="{{ URL::to('directory') }}/{!! $dir->id !!}">{!! $dir->name!!}</a>
                                </li>
                                @endforeach
                            </ul>
                            @endif
                            <!-- /.nav-second-level -->
                        </li>
                        
                        
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        @yield('content')
        

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('/cms/vendor/jquery/jquery.min.js')}}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('/cms/vendor/bootstrap/js/bootstrap.min.js')}}"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{ asset('/cms/vendor/metisMenu/metisMenu.min.js')}}"></script>

    <!-- Morris Charts JavaScript -->
    <script src="{{ asset('/cms/vendor/raphael/raphael.min.js')}}"></script>
    <script src="{{ asset('/cms/vendor/morrisjs/morris.min.js')}}"></script>
    <script src="{{ asset('/cms/data/morris-data.js')}}"></script>
	<script src="{{ asset('/cms/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('/cms/vendor/datatables-plugins/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{ asset('/cms/vendor/datatables-responsive/dataTables.responsive.js')}}"></script>

       
    <!-- Custom Theme JavaScript -->
    <script src="{{ asset('/cms/dist/js/sb-admin-2.js')}}"></script>
 `	<script>
            $(document).ready(function() {
                $('#dataTables-example').DataTable({
                    responsive: true,
                });


                $(".callpop").on("click", function()
                {
                    var selected = new Array();
                    $("input:checkbox[name='direc[]']:checked").each(function() {
                        selected.push($(this).val());
                    });
                    var dir=$(this).data("nowdirect");
                    console.log(selected.length);
                    if(selected.length!=0){
                       $.ajax({
                        url: "<?php echo url('/');?>/Ajax/callform",
                        data: {_token: '{!! csrf_token() !!}',directory:dir,select_business:selected},
                        type :"post",
                        success: function( data ) {
                            $(".boxball").html(data);
                            }
                    }); 
                   }else{
                    console.log(selected.length);
                    $(".boxball").html('<h4>Please Select Atlist one buisness to Call</h4>');
                   }

                //return false;
                });

                $(".chkbox").change(function() {                
                    if( $(this).is(":checked") ) {
                        console.log("test");
                        $(".dirt").prop('checked', true);
                    }else{
                        console.log("test2");
                        $(".dirt").prop('checked', false);
                    }
                });
                $(".moveact").on("click", function()
                {
                    var selected = new Array();
                    $("input:checkbox[name='direc[]']:checked").each(function() {
                        selected.push($(this).val());
                    });
                    var dir=$(this).data("nowdirect");
                    console.log(selected.length);
                    if(selected.length!=0){
                       $.ajax({
                        url: "<?php echo url('/');?>/Ajax/moveto",
                        data: {_token: '{!! csrf_token() !!}',directory:dir,select_business:selected},
                        type :"post",
                        success: function( data ) {
                            $(".modal-body").html(data);
                            }
                    }); 
                   }else{
                    $(".modal-body").html('<h4>Please Select Atlist one buisness to move or Copy</h4>');
                   }
                    

                });
            });
    </script>
</body>

</html>
