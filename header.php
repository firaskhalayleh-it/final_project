<?php
if (isset($_COOKIE['user_id'])) {
    // User is logged in, display the navigation bar
    echo '<nav class="navbar navbar-expand-lg navbar-light bg-info">
        <a class="navbar-brand" href="index.php">
            <img src="f-logo-and-symbols-template-vector-removebg-preview.png" alt="Firas company logo" height="70" class="mr-2">Firas company system
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="showEmployees.php">Show Employees</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="removeEmployee.php">Remove Employee</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="updateEmployee.php">Update Employee Data</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="employees.php">Add Employee</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="addDepartment.php">Add Department </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="showDepartments.php">Show Departments</a> 
            </li>   
            <li class="nav-item">
                <a class="nav-link" href="showSalaries.php">Show Salaries</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="report.php">Show Report</a>
        </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>';
} else {
    // User is not logged in, provide login link
    echo '<nav class="navbar navbar-expand-lg navbar-light bg-info">
    <a class="navbar-brand" href="index.php">
        <img src="f-logo-and-symbols-template-vector-removebg-preview.png" alt="Firas company logo" height="70" class="mr-2">Firas company system
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
        <li class="nav-item">
        <a class="nav-link" href="signup.php">signup</a>
    </li>
            <li class="nav-item">
                <a class="nav-link" href="login.php">login</a>
            </li>
        </ul>
    </div>
</nav>';}
?>
