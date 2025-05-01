<?php
// Database connection
$host = "localhost";
$user = "kurd";
$password = "1234512345As";
$dbname = "project";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Delete feedback if requested
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM project_collage WHERE id = $id");
    echo "<script>alert('Feedback deleted.'); window.location='admin.php';</script>";
}

// Fetch feedbacks
$result = $conn->query("SELECT * FROM project_collage ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Feedback Panel</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; border: 1px solid #ccc; }
        th { background-color: #333; color: white; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        h1 { text-align: center; }
        .delete-btn { color: red; text-decoration: none; }
    </style>
</head>
<body>
    <h1>Admin Feedback Panel</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Subject</th>
            <th>Comment</th>
            <th>Action</th>
        </tr>

        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['id']) ?></td>
            <td><?= htmlspecialchars($row['fullname']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= htmlspecialchars($row['subject']) ?></td>
            <td><?= htmlspecialchars($row['comment']) ?></td>
            <td><a class="delete-btn" href="admin.php?delete=<?= $row['id'] ?>" onclick="return confirm('Delete this feedback?')">Delete</a></td>
        </tr>
        <?php endwhile; ?>

    </table>
</body>
</html>

<?php
$conn->close();
?>
