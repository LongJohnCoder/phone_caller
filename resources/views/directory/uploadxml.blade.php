@extends('layouts.app')
@section('content')
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Directory</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Create Directory
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    {!! Form::open(array('url'=>'directory/savexml','files' => true)) !!}
                                        
                                        <div class="form-group">
                                            <label>Buisness List</label>
                                            {!! Form::hidden('type',$directory,['class'=>'form-control','placeholder'=>'Directory Name']) !!}
                                            {!! Form::file('directory_file','',['class'=>'form-control','required'=>'required','placeholder'=>'Directory Name']) !!}
                                        </div>
                                        
                                        
                                        
                                        {!! Form::submit('Store and Import',['class'=>'btn btn-lg btn-success btn-block']) !!}
                                    {!! Form::close() !!}
                                </div>

                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
@stop