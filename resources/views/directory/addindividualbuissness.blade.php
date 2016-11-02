@extends('layouts.app')
@section('content')
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add Business</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Add Business to List OF directory {{$Directories->name}}
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    {!! Form::open(array('url'=>'directory/savebusiness')) !!}
                                        
                                        <div class="form-group">
                                            <label>Company Name</label>
                                            {!! Form::text('company_name','',['class'=>'form-control','required'=>'required','placeholder'=>'Company Name']) !!}
                                            {!! Form::hidden('did',$Directories->id,['class'=>'form-control']) !!}
                                        </div>
                                        <div class="form-group">
                                            <label>Website</label>
                                            {!! Form::url('website','',['class'=>'form-control','required'=>'required','placeholder'=>'Website']) !!}
                                        </div>
                                        <div class="form-group">
                                            <label>Phone</label>
                                            {!! Form::number('phone','',['class'=>'form-control','required'=>'required','placeholder'=>'Phone']) !!}
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            {!! Form::email('email_id','',['class'=>'form-control','required'=>'required','placeholder'=>'Email']) !!}
                                        </div>
                                        <div class="form-group">
                                            <label>Address</label>
											{{ Form::textarea('address', null, ['class' => 'form-control']) }}
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