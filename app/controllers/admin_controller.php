<?php
class AdminController extends AppController {

	var $name = 'Admin';
	var $uses = array('Meetup', 'Event', 'Rsvp');

	function index() { 

		// Get list of events stored in DB
		$events = $this->Event->find( 'all' );
		$this->set('events', $events );

		// Summarize
		$this->set( 'checkins', $this->Event->Rsvp->find( 'count', array('conditions' => array( 'Rsvp.checkin' => 1 ))));

		// Get a list of meetups to populate list
		$events_list = $this->Meetup->getEvents();
		$this->set('events_list', $events_list);

	}

	function activate( $id ) {
		//$this->Event->updateAll( array('enabled'=>'0'), array('1'=>'1') ); // Disable all
		$this->Event->id = $id;
		$this->Event->saveField( 'enabled', 1 );
		$this->redirect( 'index' );
	}

	function deactivate( $id ) {
		$this->Event->id = $id;
		$this->Event->saveField( 'enabled', 0 );
		$this->redirect( 'index' );

		// $this->Event->updateAll( array('enabled'=>'0'), array('1'=>'1') ); // Disable all
		// $this->redirect( 'index' );
	}


	function delete_event( $id ) {
		$this->Event->deleteAll( array( 'Event.id' => $id ), true );
		$this->redirect( 'index' );
	}

	function copy_data( ) {

		// Create event row

		if( $this->data ) {

			$event = $this->Meetup->getEvent( $this->data["Event"]["id"] );

			$event = array( 'Event' => array(
							 'id' => $event['results'][0]['id'],
							 'title' => $event['results'][0]['name']
							 ));
			//debug( $event);
			$this->Event->save( $event );
		}

		if( empty( $this->data['Event']['id'] ) ) $this->redirect(array('action'=>'index'));

		$event_id = (integer) $this->data["Event"]["id"];


		// Load Meetup model
		//$this->loadModel('Meetup');

		// Get meetup RSVPs
		$rsvps = $this->Meetup->getRsvps( $event_id );

		foreach ( $rsvps as $rsvp ) {
		    $data['Rsvp'][] = array(
					    'event_id' => $event_id,
					    'member_id' => $rsvp['member_id'],
					    'name' => $rsvp['name'],
					    'photo_url' => $rsvp['photo_url'],
					    'comment' => $rsvp['comment']
					   );
		}
		$this->Rsvp->deleteAll( array( 'Rsvp.event_id' => $event_id ) );
		$this->Rsvp->create( $data );
		$this->Rsvp->saveAll( $data["Rsvp"] );
		$this->redirect( array( 'action' => 'index', 'admin'=>false ) );

	}




}
?>
