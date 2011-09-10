<?php

class Rsvp extends AppModel {
    
    var $belongsTo = array("Event");

    function copyRsvpData( $event_id ) {
	
	// Get meetup RSVPs
	$rsvps = $this->Meetup->getRsvps( $event_id );
        
        foreach ( $rsvps['results'] as $rsvp ) {
            $data['Rsvp'][] = array( 'name' => $rsvp['name'] );
        }
        
        return( $data );

    }

}
?>