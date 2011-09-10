<h2>Join Boston PHP</h2>
<p>You don't show up on the RSVP list because you are either not a member, or you were never RSVPd to the event</p>
<?php echo $html->link( 'Join Now', 'http://www.meetup.com/bostonphp/join', array('class'=>'button') );?>
 or 
<?php echo $html->link( 'RSVP to the event', 'http://www.meetup.com/bostonphp/calendar/13701966/rsvp/t/nr1o_yes/?response=3', array('class'=>'button') );?>
 or
<?php echo $html->link( 'Go Back', array('controller'=>'rsvps'), array('class'=>'button') );?>