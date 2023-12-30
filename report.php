<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Employee Salary Chart</title>
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="container mt-4">
        <h2>Employee Salary Chart</h2>

        <canvas id="salaryChart" width="400" height="200"></canvas>

        <?php
        // Your database connection details
        include 'datasource.php';

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Retrieve salary data from the database
        $salaryQuery = "SELECT e.ename, e.ESSN, s.salary FROM employees e JOIN salaries s ON e.id = s.empno";
        $salaryResult = $conn->query($salaryQuery);

        $employeeNames = [];
        $salaries = [];

        if ($salaryResult->num_rows > 0) {
            while ($salaryRow = $salaryResult->fetch_assoc()) {
                $employeeNames[] = $salaryRow['ename'];
                $salaries[] = $salaryRow['salary'];
            }
        }
        ?>

        <script>
            var ctx = document.getElementById('salaryChart').getContext('2d');
            var salaryChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode($employeeNames); ?>,
                    datasets: [{
                        label: 'Salary',
                        data: <?php echo json_encode($salaries); ?>,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    </div>

    <!-- Add Bootstrap JS and Popper.js scripts (required for some Bootstrap features) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
