<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>
<div>
<table>
        <tr>
          <th>User ID</th>
          <th>Username</th>
          <th>Surname</th>
          <th>Role</th>
        </tr>
<?php foreach($data['users'] as $user) : ?>
  <tr>
      <td><?php echo $user->employeeID;?></td>
      <td><?php echo $user->Name;?></td>
      <td><?php echo $user->Surname;?></td>
      <td><?php echo $user->Role;?></td>
      <td><a href="<?php echo URLROOT; ?>/users/editUser/<?php echo $user->employeeID; ?>">Edit</a></td> 
      <td><a href="<?php echo URLROOT; ?>/users/deleteUser/<?php echo $user->employeeID; ?>">Delete</a></td> 

  </tr>
  <?php endforeach; ?>
  </table>
  </div>

<a href = "<?php echo URLROOT; ?>/users/addUser">Add User</a>
<?php require APPROOT . '/views/inc/footer.php'; ?>