@extends('layouts.app')
@section('content')
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Directories</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Buisness List 
                            
							<div class="text-right">
								<a href="{{ URL::to('directory/uploadxml') }}/{!! $directory !!}" class="btn btn-success" ><p class="fa fa-plus-square-o"> Add List </p></a>
                                <a href="" class="btn btn-success callhit" data-id="{!! $directory !!}"><p class="glyphicon glyphicon-phone-alt"> Call </p></a>
							</div>

                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Company Name</th>
                                        <th>Website</th>
                                        <th>Phone</th>
                                        <th>Email_id</th>
                                        <th>Called</th>
                                        <th>subscribed</th>
                                        <th>Call Time</th>
                                        <th>Call Now</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($BusinessListing as $list)
                                    <tr class="gradeA">
                                        <td>{!!  $list->company_name !!}</td>
                                        <td>{!!  $list->website !!}</td>
                                        <td>{!!  $list->phone !!}</td>
                                        <td >{!!  $list->email_id !!}</td>
                                        <td >@if($list->called==1)Yes @else No @endif</td>
                                        <td>@if($list->subscribed==1)Yes @else No @endif</td>
                                        <td>{!!  $list->call_time !!}</td>
                                        <td>@if($list->call_now==1) Yes @else No @endif</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                            
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>
        
        @stop