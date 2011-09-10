<h2>Admininstration</h2>
<p>This page is for Adminstration</p>
<?php echo $html->link( 'Raffle', array('controller'=>'rsvps','action'=>'winner') ); ?>

<?php
    echo $form->create(array('action'=>'copy_data'));
    echo $form->select('Event.id', $events_list, null, array('empty'=>false));
    echo $form->button('Import');
    echo $form->end();
?>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Event</th>
            <th>Active</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach( $events as $event ) { ?>
        <?php // debug( $event ); ?>
            <tr>
                <td><?php echo $event['Event']['id']?></td>
                <td><?php echo $event['Event']['title']?></td>
                <td><?php echo $event['Event']['enabled']?></td>
                <td><?php
                    echo ($event['Event']['enabled']) ? $html->link('De-Activate', array('action'=>'deactivate', $event['Event']['id'])) : $html->link('Activate', array('action'=>'activate', $event['Event']['id']));
                    echo ' | ';
                    echo $html->link('Delete', array('action'=>'delete_event', $event['Event']['id']), null, 'Are you sure?');
                    ?>
                </td>
            </tr>
        <?php } ?>
        <tr>
    </tbody>
</table>
