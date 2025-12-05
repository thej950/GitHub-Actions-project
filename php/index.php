<?php
// Handle form submit
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $servername = "db";
    $username = "root";
    $password = "whizlabs";
    $dbname = "company";

    $name = $_POST["name"];
    $phone = $_POST["mobile"];

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("DB Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO employee (name, mobile) VALUES ('$name', '$phone')";

    if ($conn->query($sql) === TRUE) {
        $msg = "Employee added successfully!";
    } else {
        $msg = "Error: " . $conn->error;
    }
}

// Fetch last 3 employees
$conn = new mysqli("db", "root", "whizlabs", "company");
$last3 = $conn->query("SELECT * FROM employee ORDER BY id DESC LIMIT 3");
?>
<!DOCTYPE html>
<html>
<head>
<title>Employee Registration</title>

<style>
    body {
        margin: 0;
        padding: 0;
        font-family: Arial, Helvetica, sans-serif;
        background: #e6f0ff;
    }

    /* Top Header Image */
    .top-image {
        width: 100%;
        text-align: center;
        padding: 20px 0;
        background: white;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .top-image img {
        width: 260px;
    }

    /* Two-column layout */
    .main-container {
        display: flex;
        justify-content: center;
        gap: 40px;
        margin-top: 40px;
        width: 100%;
    }

    /* Left card (Form) */
    .card {
        background: rgba(255, 255, 255, 0.95);
        width: 380px;
        padding: 25px;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.2);
        text-align: center;
        height: fit-content;
    }

    h2 {
        margin-bottom: 20px;
        color: #003d99;
        font-size: 24px;
    }

    input[type=text] {
        width: 90%;
        padding: 12px;
        margin: 10px 0;
        border: 1px solid #bbb;
        border-radius: 8px;
        font-size: 15px;
    }

    button {
        width: 95%;
        padding: 12px;
        background-color: #007bff;
        border: none;
        color: white;
        font-size: 16px;
        border-radius: 8px;
        cursor: pointer;
        margin-top: 10px;
    }

    button:hover {
        background-color: #0056b3;
    }

    .msg {
        background: #d1e7dd;
        padding: 10px;
        border-radius: 8px;
        color: #0f5132;
        margin-bottom: 15px;
        font-weight: bold;
    }

    /* Right side table */
    .table-box {
        width: 420px;
        background: white;
        padding: 20px;
        border-radius: 16px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    th, td {
        padding: 12px;
        border-bottom: 1px solid #ddd;
        text-align: center;
        font-size: 16px;
    }

    th {
        background: #007bff;
        color: white;
    }

    tr:last-child td {
        border-bottom: none;
    }
</style>

</head>
<body>

<!-- Top Image Banner -->
<div class="top-image">
    <img src="image.png" alt="Company Logo">
</div>

<!-- Two Column Layout -->
<div class="main-container">

    <!-- Left: Registration Form -->
    <div class="card">

        <?php if (!empty($msg)): ?>
            <div class="msg"><?php echo $msg; ?></div>
        <?php endif; ?>

        <h2>Employee Registration</h2>

        <form method="POST">
            <input type="text" name="name" placeholder="Enter employee name" required>
            <input type="text" name="mobile" placeholder="Enter mobile number" required>
            <button type="submit">Add Employee</button>
        </form>

    </div>

    <!-- Right: Table -->
    <div class="table-box">
        <h2>Last 3 Employees</h2>

        <?php if ($last3->num_rows > 0): ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Mobile</th>
            </tr>

            <?php while($row = $last3->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['mobile']; ?></td>
            </tr>
            <?php endwhile; ?>

        </table>
        <?php else: ?>
            <p>No employees found</p>
        <?php endif; ?>

    </div>

</div>

</body>
</html>

