<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT .'/views/inc/navbar.php'; ?>
    <div>
        <table>
            <tr>
                <th>Type</th>
                <th>ID</th>
                <th>Price</th>
            </tr>
            <?php foreach($data['roomType'] as $roomType) : ?>
                <tr>
                    <td><?php echo $roomType->typeName;?></td>
                    <td><?php echo $roomType->typeID;?></td>
                    <td><?php echo $roomType->price;?></td>
                    <td><a href="<?php echo URLROOT; ?>/rooms/edit/<?php echo $roomType->typeID; ?>">Edit</a></td>
                    <td><a href="<?php echo URLROOT; ?>/rooms/roomType/<?php echo $roomType->typeID; ?>">Delete</a></td>
                </tr>
            <?php endforeach; ?>

        </table>
        <a href="<?php echo URLROOT; ?>/rooms/addRoomType">Add Room Type</a>
    </div>
<?php ?>
<?php require APPROOT . '/views/inc/footer.php'; ?>