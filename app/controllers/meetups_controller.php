<?php

class MeetupsController extends AppController {

    var $name = 'Meetups';

    function index() {

	debug ($this->Meetup->getEvent( '13924863' ) );

    }
      
      
    function getRsvps( $event_id ) {
    
	$this->Meetup->getRsvps( $event_id );
    }
    
    function checkin() {

	// Define the form schema
	$this->Meetup->_schema = array(
	    'email'		=>array('type'=>'string', 'length'=>255)
	);

	$members = $this->Meetup->getRsvps( '13924863' );
	$this->set( 'members', $members );
    }


        
}
