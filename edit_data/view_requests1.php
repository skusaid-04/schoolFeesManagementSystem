<div class="container mt-4">
  <h2 class="mb-4">View Requests</h2>
  <table class="table table-bordered">
    <thead class="table-success">
      <tr>
        <th>ID</th>
        <th>Student Name</th>
        <th>Request Type</th>
        <th>Status</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
        <?php $requests = [
        ['id' => 1, 'student_name' => 'Ali Khan', 'request_type' => 'Transcript', 'status' => 'Pending'],
        ['id' => 2, 'student_name' => 'Sara Ahmed', 'request_type' => 'Certificate', 'status' => 'Approved'],
        ['id' => 3, 'student_name' => 'John Doe', 'request_type' => 'ID Card', 'status' => 'Rejected'],
        ]; ?>
      <?php foreach ($requests as $request): ?>
        <tr>
          <td><?php echo $request['id']; ?></td>
          <td><?php echo $request['student_name']; ?></td>
          <td><?php echo $request['request_type']; ?></td>
          <td><?php echo $request['status']; ?></td>
          <td>
            <a href="edit_request.php?id=<?php echo $request['id']; ?>" class="btn btn-success btn-sm">Edit</a>
            <a href="delete_request.php?id=<?php echo $request['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>