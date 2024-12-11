<?php
// Periksa apakah 'menu' ada di URL
if (!isset($_GET['menu'])) {
    header('location:hal_utama.php?menu=report_qa');
    exit();
}
// Query untuk tabel pertama
$sql1 = "SELECT 
            qa_name, 
            qa_nik,
            media,
            agent_name,
            EXTRACT(YEAR FROM score_date) AS year, 
            EXTRACT(MONTH FROM score_date) AS month, 
            COUNT(*) AS total_cnt
        FROM v_qa_performance 
        GROUP BY qa_name, 
        qa_nik, 
        media, 
        year, 
        month 
        ORDER BY qa_name, 
        qa_nik, 
        media, 
        year, 
        month";

$result1 = mysqli_query($GLOBALS["___mysqli_ston"], $sql1);

if (!$result1) {
    die("Query error: " . mysqli_error($GLOBALS["___mysqli_ston"]));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>REPORT</title>
    <meta charset="UTF-8">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .chart-container {
            display: flex;
            justify-content: space-around;
        }
        .chart-box {
            width: 45%;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Dashboard</h1>
        <!-- Formulir Slicer -->
        <form method="POST" action="">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="year">Year</label>
                    <select class="form-control" id="year" name="year">
                        <option value="">Select Year</option>
                        <?php for ($y = 2020; $y <= date("Y"); $y++) {
                            echo "<option value='$y'>$y</option>";
                        } ?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="month">Month</label>
                    <select class="form-control" id="month" name="month">
                        <option value="">Select Month</option>
                        <?php for ($m = 1; $m <= 12; $m++) {
                            $monthName = date("F", mktime(0, 0, 0, $m, 10));
                            echo "<option value='$m'>$monthName</option>";
                        } ?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="qa_name">QA Name</label>
                    <select class="form-control" id="qa_name" name="qa_name">
                        <option value="">Select QA</option>
                        <?php
                        $sql = "SELECT DISTINCT qa_name FROM v_qa_performance";
                        $result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);

                        if ($result && mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $qaName = htmlspecialchars($row['qa_name']);
                                echo "<option value='$qaName'>$qaName</option>";
                            }
                        } else {
                            echo "<option value=''>No QA Found</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>
        <br>
        <!-- Laporan dari Tabel Pertama -->
        <h2 class="mt-5">Performance Report</h2>
        <table class="table table-bordered mt-3"> 
            <thead> 
                <tr> 
                    <th>QA Name</th> 
                    <th>QA NIK</th>
                    <th>Media</th>
                    <th>Year</th> 
                    <th>Month</th> 
                    <th>Total Sample</th>
                </tr> 
            </thead> 
            <tbody> 
                <?php 
                if (isset($result1) && mysqli_num_rows($result1) > 0) {
                     while ($row1 = mysqli_fetch_assoc($result1)) { 
                        echo "<tr> 
                        <td>" . htmlspecialchars($row1["qa_name"]) . "</td> 
                        <td>" . htmlspecialchars($row1["qa_nik"]) . "</td>
                        <td>" . htmlspecialchars($row1["media"]) . "</td>
                        <td>" . htmlspecialchars($row1["year"]) . "</td> 
                        <td>" . htmlspecialchars($row1["month"]) . "</td>
                        <td>" . htmlspecialchars($row1["total_cnt"]) . "</td>
                        </tr>"; 
                    } 
                } else { 
                    echo "<tr><td colspan='6'>No data found</td></tr>"; 
                } 
                ?> 
            </tbody> 
        </table>
        <div class="chart-container">
            <div class="chart-box">
                <canvas id="myChart1" width="400" height="200"></canvas>
            </div>
            <div class="chart-box">
                <canvas id="myChart2" width="400" height="200"></canvas>
            </div>
        </div>
        <script>
        var ctx1 = document.getElementById('myChart1').getContext('2d');
        var myChart1 = new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: [
                    <?php 
                    if (isset($result1)) {
                        $result1->data_seek(0); // Reset pointer hasil query
                        while ($row1 = $result1->fetch_assoc()) {
                            echo "'" . htmlspecialchars($row1["media"]) . " (" . htmlspecialchars($row1["year"]) . "-" . htmlspecialchars($row1["month"]) . ")',";
                        }
                    }
                    ?>
                ],
                datasets: [{
                    label: 'Medai Total Sample',
                    data: [
                        <?php 
                        if (isset($result1)) {
                            $result1->data_seek(0); // Reset pointer hasil query
                            while ($row1 = $result1->fetch_assoc()) {
                                echo htmlspecialchars($row1["total_cnt"]) . ",";
                            }
                        }
                        ?>
                    ],
                    backgroundColor: 'rgba(0, 123, 255, 0.5)',
                    borderColor: 'rgba(0, 123, 255, 1)',
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

        var ctx2 = document.getElementById('myChart2').getContext('2d');
        var myChart2 = new Chart(ctx2, {
            type: 'line',
            data: {
                labels: [
                    <?php 
                    if (isset($result1)) {
                        $result1->data_seek(0); // Reset pointer hasil query
                        while ($row1 = $result1->fetch_assoc()) {
                            echo "'" . htmlspecialchars($row1["qa_name"]) . " (" . htmlspecialchars($row1["month"]) .")',";
                        }
                    }
                    ?>
                ],
                datasets: [{
                    label: 'QA Total Sample',
                    data: [
                        <?php 
                        if (isset($result1)) {
                            $result1->data_seek(0); // Reset pointer hasil query
                            while ($row1 = $result1->fetch_assoc()) {
                                echo htmlspecialchars($row1["total_cnt"]) . ",";
                            }
                        }
                        ?>
                    ],
                    backgroundColor: 'rgba(255, 159, 64, 0.5)',
                    borderColor: 'rgba(255, 159, 64, 1)',
                    borderWidth: 1,
                    fill: false,
                    lineTension: 0.1
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
    <br>
    </div>
    <br>
</body>
</html>