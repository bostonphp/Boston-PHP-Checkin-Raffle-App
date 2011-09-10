<?php

class RsvpsController extends AppController {

    var $name = 'Rsvps';
    var $mobile = false;

    function beforeFilter() { 

        App::import('Vendor', 'mobile_device_detect/mobile_device_detect');
        $this->mobile = mobile_device_detect();
        $this->set( 'mobile', $this->mobile );

    }

    // Displays a list of people who have RSVPd but not checked in
    function index() {

		$options['conditions'] = array(
						   'Rsvp.checkin' => 0,
						   'Event.enabled' => 1
						   );
		$options['order'] = array( 'Rsvp.name' => 'asc' );
		$options['group'] = array( 'member_id' );
		$rsvps = $this->Rsvp->find('all', $options );
		$this->set( 'rsvps', $rsvps );
		if( $this->mobile == true ) {
			// Grid too intense on mobile devise
				$this->set( 'hideGrid', $rsvps );
		}

    }

    // Searches the RSVP list and returns only those that match keyword
    function search( ) {

		if( !empty( $this->data['Rsvp']['keyword'] ) ) {
			$options['conditions'] = array( 'Rsvp.name LIKE' => "%{$this->data['Rsvp']['keyword']}%", 'Rsvp.checkin' => 0 );
			$options['group'] = array( 'member_id' );
			$rsvps = $this->Rsvp->find('all', $options );
			$this->set( 'rsvps', $rsvps );
			$this->render( 'index' );

		} else {
			$this->redirect( array( 'action' => 'index' ) );
		}

    }


    // Returns a list of random people who are checked-in and displays them in a winner page
    function winner( $limit = 100 ) {

		$options['conditions'] = array(
						   'Rsvp.checkin' => 1,
						   'Event.enabled' => 1,
						   'Rsvp.winner' => 0
						   );
		//$options = array();
		$options['order'] = array( 'rand()' );
		$options['limit'] = 100;
		$options['group'] = array( 'member_id' );

		$rsvps = $this->Rsvp->find('all', $options);
		$this->set( 'rsvps', $rsvps );
		$winner = rand(0, (sizeof($rsvps)-1));
		$this->set( 'winner', $winner );

		$member_id = $rsvps[$winner]['Rsvp']['member_id'];
		$this->Rsvp->updateAll( array('winner'=>true), array('Rsvp.member_id'=>$member_id) );

		$this->render('winner-grid');


    }

    function checkin( $member_id ) {

		$this->Rsvp->updateAll( array('checkin'=>true), array('Rsvp.member_id'=>$member_id) );
		//$Session->setFlash('Thank you for Checking In');
		$this->redirect( array( 'action' => 'index' ) );
    }

}
