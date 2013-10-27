<script>
$(function(){
    $('.all-city-list a').click(function(){
        var id=$(this).attr('href');
        var a=$(id).offset();
        //window.scrollTo(a.left,a.top-80);
		//$.scrollTo(a.top-80,500);
		$("html,body").stop(false,true).animate({scrollTop:a.top-80},400);
    })
})
</script>