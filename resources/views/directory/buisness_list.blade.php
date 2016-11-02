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
                                <a href="{{ URL::to('directory/individual') }}/{!! $directory !!}" class="btn btn-success" ><p class="fa fa-plus-square-o"> Add Individual Buissness </p></a>
								<a href="{{ URL::to('directory/uploadxml') }}/{!! $directory !!}" class="btn btn-success" ><p class="fa fa-plus-square-o"> Upload Buissness List </p></a>
                                <a href="" class="btn btn-success callhit" data-id="{!! $directory !!}"><p class="glyphicon glyphicon-phone-alt"> Call </p></a>
                                <button type="button" class="btn btn-info btn-lg moveact" data-nowdirect="{!! $directory !!}" data-toggle="modal" data-target="#myModal">Move/Copy</button>
							</div>

                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <td><input type="checkbox" class="chkbox" name="chkone" value="0" /></td>
                                        <th>Company Name</th>
                                        <th>Website</th>
                                        <th>Phone</th>
                                        <th>Email_id</th>
                                        <th>Called</th>
                                        <th>subscribed</th>
                                        <th>Call Time</th>
                                        <th>Called At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($BusinessListMapDirectory as $list)
                                    <tr class="gradeA">
                                        <td><input type="checkbox" class="dirt" name="direc[]" value="{!!  $list->buisness_details->id !!}" /></td>
                                        <td>{!!  $list->buisness_details->company_name !!}</td>
                                        <td>{!!  $list->buisness_details->website !!}</td>
                                        <td>{!!  $list->buisness_details->phone !!}</td>
                                        <td >{!!  $list->buisness_details->email_id !!}</td>
                                        <td >@if($list->buisness_details->called==1)Yes @else No @endif</td>
                                        <td>@if($list->buisness_details->subscribed==1)Yes @else No @endif</td>
                                        <td>{!!  $list->buisness_details->call_time !!}</td>
                                        <td></td>
                                        <td><a href="{{ URL::to('buisness/edit') }}/{!! $list->buisness_details->id !!}"><p class="fa fa-edit"></p></a></td>
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
        



            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Move/Copy Buisness to Directory</h4>
                        </div>
                        <div class="modal-body">
                            <p>...........</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @stop