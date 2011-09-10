$(function() {
    
    //This function runs on every page!
    $(function(){
            $('#hidetime a').click( function(){
                    $(this).fadeOut();
                    hideOne( 10 );
                    return false;
            })
    });
    
    function hideOne( hide_time ){
            items = $('#winners-grid .member:visible:not(.winner)');
    
            //celebrate when it's over
            if( !items.length ) {
                    celebrate();
            };
            index = Math.floor( Math.random() * items.length );
    
            //limit so it never gets too slow in the middle
            if( hide_time < 200 ){
                    hide_time += 1;
                    //$('.member').css({width:'50px',height:'50px'});
            }
            //slow down at the end
            if( items.length < 10 ) {
                    hide_time += 10;
            }

			//only do the 'puff' effect if there are less than 100 items
			if( items.length < 100 ) {
				$( items.get( index ) ).hide( "puff", { percent: 250 }, hide_time, function(){ hideOne( hide_time ); })
			} else {
				$( items.get( index ) ).hide( hide_time, function(){ hideOne( hide_time ); })
			}
    }
    
    function celebrate(){
            $('#winners-grid div.winner').css({'width':'auto','height':'auto'});
			$('#winners-grid div.winner img').unwrap().animate({
                    width: 400,
                    height: 'auto'
              }, 1000);
			$('#winners-grid div.winner p.member-header').animate({
			        fontSize: 60,
					height: 90,
					lineHeight: 90
			  }, 1000);
    }
    
    
    var time = 10;
 


});