<?php debug( $members) ?>
<table>
    <thead>
        <tr>
            <th>Member</th>
            <th>Photo</th>
            <th>Actions</th>
    </tr>
    </thead>
    <tbody>
<?php foreach ( $members['results'] as $member ) { ?>
    <tr>
        <td><?php echo $member['name']; ?></td>
        <td><img src='<?php echo $member['photo_url']; ?>' /></td>
        <td><?php echo $html->link('Check In',array('action'=>'checkin', $member['member_id']));?></td>
    </tr>        
<?php } ?>
    <tbody>
</table>
