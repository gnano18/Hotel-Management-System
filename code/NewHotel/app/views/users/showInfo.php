<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT .'/views/inc/navbar.php'; ?>
  
        <h1 class="display-3"><?php echo $data['name']; ?></h1>
        <p class="lead"><?php echo $data['id']; ?></p>
        <p class="lead"><?php echo $data['description']; ?></p>

    <?php require APPROOT . '/views/inc/footer.php'; ?>
