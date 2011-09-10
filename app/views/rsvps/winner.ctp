<?php //debug( $rsvps ); ?>
<div id="winners">
<?php foreach ( $rsvps as $key => $member ) { ?>
    <div>
        <p><?php echo $member['Rsvp']['name']; ?></p>
        <p><?php if( $winner == $key ) echo "<strong>winner</strong>"; ?></p>
		<div class="img-wrap">
        <?php
            if ( !empty( $member['Rsvp']['photo_url'] ) ) {
                echo $html->image( $member['Rsvp']['photo_url'], array( 'class' => 'memberPhoto' ) );
            } else {
                echo $html->image( 'http://img2.meetupstatic.com/img/noPhoto_80.gif', array( 'class' => 'memberPhoto' ) );
            } ?>
		</div>
    </div>     
<?php } ?>
</div>