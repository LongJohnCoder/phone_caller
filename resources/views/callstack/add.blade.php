@extends('layouts.app')
@section('content')
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Initiate Call</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Create Call Stack
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    {!! Form::open(array('url'=>'callstack/save','files' => true)) !!}
                                        
                                        
                                        <div class="form-group">
                                            <label>Chose Directory</label>
                                            @foreach($direct as $dir)
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="{!! $dir->id !!}" > {!! $dir->name !!}
                                                </label>
                                            </div>
                                        	@endforeach
                                        </div>
                                        <div class="form-group">
                                            <label>Upload Audio File</label>
											{{ Form::file('audio', '', ['class' => 'form-control']) }}
                                        </div>
                                        
                                        {!! Form::submit('Create',['class'=>'btn btn-lg btn-success btn-block']) !!}
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