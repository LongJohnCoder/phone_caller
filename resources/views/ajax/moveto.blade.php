@foreach($Directories as $directory)
<div class="alert alert-info">
		Move Or Copy Selected {{$num}} BusinessList To {{$directory->name}} <br><button class="btn btn-success copybuss" data-tocop="{{ $directory->id }}" type="button">Copy</button>  <button class="btn btn-warning movebiss" data-tomov="{{ $directory->id }}" type="button">Move</button>
</div>
<hr>
@endforeach
<input type="hidden" id="list_id" value="{{$sel}}">
<input type="hidden" id="from_id" value="{{$directoryx}}">
<script>
            $(document).ready(function() {
            	$(".copybuss").on("click", function()
                {
                	var to=$(this).data("tocop");
                	var list_id=$("#list_id").val();
                	var from_id=$("#from_id").val();
                	$.ajax({
                        url: "<?php echo url('/');?>/Ajax/moveorcopy",
                        data: {_token: '{!! csrf_token() !!}',to:to,from:from_id,list_id:list_id,type:1},
                        type :"post",
                        success: function( data ) {
                            window.location.reload(true);
                            }
                    	}); 
               	});
                $(".movebiss").on("click", function()
                {
                	var to=$(this).data("tomov");
                	var list_id=$("#list_id").val();
                	var from_id=$("#from_id").val();
                	$.ajax({
                        url: "<?php echo url('/');?>/Ajax/moveorcopy",
                        data: {_token: '{!! csrf_token() !!}',to:to,from:from_id,list_id:list_id,type:2},
                        type :"post",
                        success: function( data ) {
                            window.location.reload(true);
                            }
                    	});
                });
            });
</script>