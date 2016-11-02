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
                            Directory List
                            <div class="text-right">
                                <a href="{{ URL::to('directory/add') }}" class="btn btn-success" ><p class="fa fa-plus-square-o"> Add Directory </p></a>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Directory Name</th>
                                        <th>Details</th>
                                        <th>Created At</th>
                                        <th>No Of List</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($Directories as $Directory)
                                    <tr class="gradeA">
                                        <td>{!! $Directory->name!!}</td>
                                        <td>{!! $Directory->description!!}</td>
                                        <td>{!! date("M dS,Y", strtotime($Directory->created_at))!!}</td>
                                        <td class="center"></td>
                                        <td class="center"></td>
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