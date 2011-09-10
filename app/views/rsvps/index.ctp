<?php if( empty( $rsvps ) && !isset($this->data['Rsvp']['keyword']) ) { echo $this->element('rsvp_off'); return; } ?>

<div class="instructions">
<?php
    echo $form->create('Rsvp', array('action' => 'search', 'id' => 'search'));
    echo "My meetup member name is...";
    echo $form->text('keyword', array('label'=>'Member name', 'type'=>'text'));
    echo $form->button('Search', array('type'=>'submit', 'class'=>'button'));
    // echo $html->link("What if I'm not listed here?", array('controller'=>'pages', 'action'=>'display', 'join'), array('class'=>'muted'));
    echo $form->end();
?>
</div>
<p>Search for your name, then click to <strong>Check In</strong> and enter the raffle!</p>

<?php if( !isset($hideGrid) ) : ?>
<?php

if( $mobile == true) {
    // echo '<h1>Tap Twice to Checkin</h1>';
    $mobileClass = 'mobile';
    } else {
    $mobileClass = 'checkin';
    }
?>
<div id="checkin-grid">
<?php foreach ( $rsvps as $key => $member ) { ?>
    <div class='member' id='<?php echo $key; ?>'>
        <p class='member-header'>
        <?php echo $member['Rsvp']['name']; ?>
        </p>
		<div class="img-wrap">
        <?php
            if ( !empty( $member['Rsvp']['photo_url'] ) ) {

		// Change to thumb for faster loading
		$member['Rsvp']['photo_url'] = str_replace('member_','thumb_', $member['Rsvp']['photo_url']);
                echo $html->image( $member['Rsvp']['photo_url'], array( 'class' => 'memberPhoto' ) );
            } else {
                echo $html->image( 'http://img2.meetupstatic.com/img/noPhoto_80.gif', array( 'class' => 'memberPhoto' ) );
            } ?>
        </div>
		<?php echo $html->link('<span>Check In</span>',array('action'=>'checkin', $member['Rsvp']['member_id']), array('class'=>"button {$mobileClass}", 'escape'=>false), 'Check in now?');?>
    </div>
<?php } ?>
</div>
<div class='sum'><p><?php echo sizeof( $rsvps ); ?> Total</p></div>
<?php endif; ?>
