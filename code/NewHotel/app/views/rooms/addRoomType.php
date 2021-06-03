<?php require APPROOT . '/views/inc/header.php'?>
<?php require APPROOT . '/views/inc/navbar.php'?>
<form action="<?php echo URLROOT.'/rooms/addRoomType'?>" method="post">
    <div class="form-group">
        <label for="formGroupExampleInput">Type</label>
        <input type="text" name="typeName" value="<?php echo $data['typeName'];?>" class="form-control" id="formGroupExampleInput" placeholder="Enter Type Name">
    </div>
    <div class="form-group">
        <label for="formGroupExampleInput">Price</label>
        <input type="text" name="price" value="<?php echo $data['price'];?>" class="form-control" id="formGroupExampleInput" placeholder="Enter Price">
    </div>
    <br><br>
        <button type="submit" class="btn btn-primary">Submit</button>
</form>
<?php require APPROOT . '/views/inc/footer.php'?>



