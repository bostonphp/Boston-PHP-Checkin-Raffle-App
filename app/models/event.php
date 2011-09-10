<?php

class Event extends AppModel {
    
    var $hasMany = array( 'Rsvp' => array(
                                          'className' => 'Rsvp',
                                          'dependent' => true
                                          ) );

}

?>