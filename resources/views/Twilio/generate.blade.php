<?xml version="1.0" encoding="UTF-8"?>
<Response>
	
    <Gather action="{{ config('app.url') . "/phone/check-confirmation/{$value->id}" }}">
        <Play loop="10">{{$fpath}}</Play>
        
    </Gather>
</Response>