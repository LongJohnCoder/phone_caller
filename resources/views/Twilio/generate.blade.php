<?xml version="1.0" encoding="UTF-8"?>
<Response>
	
    <Gather action="{{ config('app.url') . "/phone/check-confirmation/{$value->id}" }}">
        <Play loop="10">{{$fpath}}</Play>
        <say>Please press 0 to disconnect or 1 to call now or give us a prefer time to call in 24 hundrade format</say>
        
    </Gather>
</Response>