<?xml version="1.0" encoding="UTF-8"?>
<Response>
	<Play loop="1">{{$fpath}}</Play>
    <Gather action="{{ $location}}" finishOnKey="*" >
        
        <Say>Please press 0 to disconnect or 1 to call now or give us a prefer time to call in 24 hundrade format and then press star</Say>
        
    </Gather>
</Response>