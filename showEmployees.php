<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Employee List</title>
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="container mt-4">
        <h2>Employee List</h2>

        <!-- Search Bar Form -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get" class="mb-3">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search by name..." name="searchName">
                <select class="custom-select" name="searchDepartment">
                    <option value="" selected>Select Department</option>
                    <?php
                    include 'datasource.php';

                    // Retrieve department names from the database
                    $departmentQuery = "SELECT DISTINCT department FROM employees";
                    $departmentResult = $conn->query($departmentQuery);

                    while ($departmentRow = $departmentResult->fetch_assoc()) {
                        echo '<option value="' . $departmentRow['department'] . '">' . $departmentRow['department'] . '</option>';
                    }

                    // Close the database connection
                    $conn->close();
                    ?>
                </select>
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">Search</button>
                </div>
            </div>
        </form>

        <div class="card-deck">
            <?php
            include 'datasource.php';

            // Retrieve employee data from the database based on search term
            $searchName = isset($_GET['searchName']) ? $_GET['searchName'] : '';
            $searchDepartment = isset($_GET['searchDepartment']) ? $_GET['searchDepartment'] : '';

            $query = "SELECT * FROM employees WHERE ename LIKE '%$searchName%'";

            if (!empty($searchDepartment)) {
                $query .= " AND department = '$searchDepartment'";
            }

            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                $count = 0; // Initialize a counter

                while ($row = $result->fetch_assoc()) {
                    // Check if the current card is a multiple of 5
                    if ($count > 0 && $count % 5 == 0) {
                        echo '</div><div class="card-deck">'; // Start a new row
                    }

                    echo '<div class="card fixed-width m-3">';
                    // Display employee picture
                    $picturePath =  $row['picture'];
                    if (file_exists($picturePath)) {
                        echo '<img src="data: $picturePath ;base64,' . base64_encode(file_get_contents($picturePath)) . '" class="card-img-top" alt="Employee Picture">';
                    } else {
                        echo 'Image not found at: ' . $picturePath;
                    }

                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . $row['ename'] . '</h5>';
                    echo '<p class="card-text">SSN: ' . $row['ESSN'] . '<br>';
                    echo 'Hire Date: ' . $row['hiredate'] . '<br>';
                    echo 'Department: ' . $row['department'] . '</p>';
                    echo '</div>';
                    echo '</div>';

                    $count++; // Increment the counter
                }
            } else {
                echo '<p>No employees found.</p>';
            }

            // Close the database connection
            $conn->close();
            ?>
        </div>
    </div>

    <!-- Add Bootstrap JS and Popper.js scripts (required for some Bootstrap features) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- Add custom style for fixed-width cards -->
    <style>
        .fixed-width {
            width: 18rem;
        }
    </style>
</body>
</html>
