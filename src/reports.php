<?php
include "connection_db.php";

if (!isset($_SESSION['user_id'])) {
    $loginMessage = "You need to log in to access your reports.";
} else {
    $user_id = $_SESSION['user_id'];

    $conn = getDatabase();
    $stmt = $conn->prepare("SELECT patient_id FROM patients WHERE user_id = :user_id");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $patient = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($patient) {
        $patient_id = $patient['patient_id'];

        $stmt = $conn->prepare("SELECT * FROM patient_reports WHERE patient_id = :patient_id ORDER BY report_date DESC");
        $stmt->bindParam(':patient_id', $patient_id);
        $stmt->execute();
        $reports = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        echo "Error: Patient data not found for the logged-in user.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Medcare | Reports</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <?php include 'header.php'; ?>

    <div class="container mt-4">
        <div class="card title mb-4">
            <div class="card-body">
                <h2 class="card-title text-center">My Reports</h2>
            </div>
        </div>
        <?php if (isset($loginMessage)) : ?>
            <div class="alert alert-warning" role="alert">
                <?php echo $loginMessage; ?>
            </div>
            <div class="text-center">
                <a href="login.php?redirect=reports.php" class="btn btn-primary">Login</a>
            </div>
        <?php elseif (empty($reports)) : ?>
            <div class="alert alert-info" role="alert">
                No reports available.
            </div>
        <?php else : ?>
            <div class="row justify-content-center">
                <?php foreach ($reports as $report) : ?>
                    <?php
                    $stmt = $conn->prepare("SELECT first_name, last_name FROM doctors WHERE doctor_id = :doctor_id");
                    $stmt->bindParam(':doctor_id', $report['doctor_id']);
                    $stmt->execute();
                    $doctor = $stmt->fetch(PDO::FETCH_ASSOC);
                    ?>

                    <div class="col-md-4"> <!-- Adjust the column width as needed -->
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Report Type: <?php echo $report['report_type']; ?></h5>
                            </div>
                            <div class="card-body">
                                <p class="card-text">Report Date: <?php echo $report['report_date']; ?></p>
                                <p class="card-text">Doctor: <?php echo $doctor['first_name'] . ' ' . $doctor['last_name']; ?></p>
                                <a href="report_data.php?report_id=<?php echo $report['report_id']; ?>" class="btn btn-primary">View Details</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
    <?php include 'footer.php'; ?>
</body>

</html>
