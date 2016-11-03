<div class="panel-body">
    <div class="row">
        <div class="col-lg-6">
            {!! Form::open(array('url'=>'api/callconsole/savewithAudio','files' => true)) !!}                
                <div class="form-group">
                    <label>Audio File : {{$AudioList->name}}</label>
                    {!! Form::hidden('list_id',$sel,['class'=>'form-control']) !!}
                    {!! Form::hidden('direct',$directoryx,['class'=>'form-control']) !!}
					{!! Form::hidden('audio',$AudioList->id,['class'=>'form-control']) !!}

                </div>
                <div class="form-group">
                    <label>Usable Text By Twilio</label>
                    {!! Form::text('text_cont','',['class'=>'form-control','required'=>'required','placeholder'=>'Usable Text By Twilio']) !!}
                </div>
                {!! Form::submit('Create',['class'=>'btn btn-lg btn-success btn-block']) !!}
            {!! Form::close() !!}
        </div>
    </div>
</div>