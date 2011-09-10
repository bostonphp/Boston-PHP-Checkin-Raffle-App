<?php if( empty( $rsvps ) ) { echo $this->element('rsvp_off'); return; } ?>

<div id="hidetime"><a href="#">Pick a winner!</a></div>

<h2>And the winner is...</h2>

<div id="winners-grid" class="group">
<?php foreach ( $rsvps as $key => $member ) { ?>
    <div class='member <?php if( $winner == $key ) echo "winner"; ?>' id='<?php echo $key; ?>'>
        <p class='member-header'>
        <?php echo $member['Rsvp']['name']; ?>
        </p>            
		<div class="img-wrap group">
        <?php
            if ( !empty( $member['Rsvp']['photo_url'] ) ) {
		// Change to thumb to load faster
                if( $winner != $key ) {
        	    $member['Rsvp']['photo_url'] = str_replace('member_','thumb_', $member['Rsvp']['photo_url']);                    
                }
                echo $html->image( $member['Rsvp']['photo_url'], array( 'class' => 'memberPhoto' ) );
            } else {
                echo $html->image( 'http://img2.meetupstatic.com/img/noPhoto_80.gif', array( 'class' => 'memberPhoto' ) );
            } ?>
	    </div>
    </div>     
<?php } ?>
</div>  