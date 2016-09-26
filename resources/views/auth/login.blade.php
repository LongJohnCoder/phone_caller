@extends('layouts.login')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        {!! Form::open(array('url'=>'user/signin')) !!}
                            <fieldset>
                                <div class="form-group">
                                    {!! Form::email('user_email_id','',['class'=>'form-control','required'=>'required','placeholder'=>'Email ID']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::password('user_password',['class'=>'form-control','required'=>'required','placeholder'=>'Password']) !!}
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div>
                                {!! Form::submit('Login',['class'=>'btn btn-lg btn-success btn-block']) !!}
                            </fieldset>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>    
@stop