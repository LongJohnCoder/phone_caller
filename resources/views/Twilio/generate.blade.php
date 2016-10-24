<?xml version="1.0" encoding="UTF-8"?>
<Response>
	
    <Gather action="{{ config('app.url') . "/phone/check-confirmation/{$BusinessListing->id}" }}">
        <Play>https://api.twilio.com/cowbell.mp3</Play>

    </Gather>
</Response>