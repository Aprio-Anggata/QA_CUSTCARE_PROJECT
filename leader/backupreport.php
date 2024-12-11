<?php
// Periksa apakah 'menu' ada di URL
if (!isset($_GET['menu'])) {
    header('location:hal_utama.php?menu=report');
    exit();
}

// Query untuk tabel pertama
$sql1 = "SELECT 
            agent_name, 
            EXTRACT(YEAR FROM score_date) AS year, 
            EXTRACT(MONTH FROM score_date) AS month, 
            SUM(sum_score) AS total_sum_score, 
            COUNT(*) AS total_cnt, 
            SUM(sum_score) / COUNT(*) AS average_score 
        FROM v_performance 
        GROUP BY agent_name, year, month 
        ORDER BY agent_name, year, month";

// Eksekusi query untuk tabel pertama
$result1 = mysqli_query($GLOBALS["___mysqli_ston"], $sql1);

// Cek apakah query berhasil dijalankan
if (!$result1) {
    die("Query error: " . mysqli_error($GLOBALS["___mysqli_ston"]));
}

// Query untuk tabel kedua
$sql2 = "SELECT 
            agent_name, 
            EXTRACT(YEAR FROM score_date) AS year, 
            EXTRACT(MONTH FROM score_date) AS month, 
            (SUM(cnt_greeting) + SUM(cnt_verification) + SUM(cnt_tov) + SUM(cnt_pk) + SUM(cnt_cg)) AS Sum_total_finding, 
            SUM(cnt_greeting) AS finding_greeting,
            SUM(cnt_verification) AS finding_Verification,
            SUM(cnt_tov) AS finding_Tone_of_voice,
            SUM(cnt_pk) AS finding_product_knowledge,
            SUM(cnt_cg) AS finding_Closing_greeting,
            SUM(cnt_cp) AS Total_Complimentery
        FROM v_mistake 
        GROUP BY agent_name, year, month 
        ORDER BY agent_name, year, month";

// Eksekusi query untuk tabel kedua
$result2 = mysqli_query($GLOBALS["___mysqli_ston"], $sql2);

// Cek apakah query berhasil dijalankan
if (!$result2) {
    die("Query error: " . mysqli_error($GLOBALS["___mysqli_ston"]));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>REPORT</title>
    <meta charset="UTF-8">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
            </div>
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>
        <br>
        <!-- Laporan dari Tabel Pertama -->
        <h2 class="mt-5">Performance Report</h2>
        <table class="table table-bordered mt-3"> 
            <thead> 
                <tr> 
                    <th>Agent Name</th> 
                    <th>Year</th> 
                    <th>Month</th> 
                    <th>Total Score</th> 
                    <th>Total Sample</th> 
                    <th>Average Score</th> 
                </tr> 
            </thead> 
            <tbody> 
                <?php 
                // Cek apakah query telah dieksekusi dan hasilnya ada 
                if (isset($result1) && mysqli_num_rows($result1) > 0) {
                     while ($row1 = mysqli_fetch_assoc($result1)) { 
                        echo "<tr> 
                        <td>" . htmlspecialchars($row1["agent_name"]) . "</td> 
                        <td>" . htmlspecialchars($row1["year"]) . "</td> 
                        <td>" . htmlspecialchars($row1["month"]) . "</td> 
                        <td>" . htmlspecialchars($row1["total_sum_score"]) . "</td> 
                        <td>" . htmlspecialchars($row1["total_cnt"]) . "</td> 
                        <td>" . htmlspecialchars($row1["average_score"]) . "</td> 
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
                            echo "'" . htmlspecialchars($row1["agent_name"]) . " (" . htmlspecialchars($row1["year"]) . "-" . htmlspecialchars($row1["month"]) . ")',";
                        }
                    }
                    ?>
                ],
                datasets: [{
                    label: 'Average Score',
                    data: [
                        <?php 
                        if (isset($result1)) {
                            $result1->data_seek(0); // Reset pointer hasil query
                            while ($row1 = $result1->fetch_assoc()) {
                                echo htmlspecialchars($row1["average_score"]) . ",";
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
                            echo "'" . htmlspecialchars($row1["agent_name"]) . " (" . htmlspecialchars($row1["year"]) . "-" . htmlspecialchars($row1["month"]) . ")',";
                        }
                    }
                    ?>
                ],
                datasets: [{
                    label: 'Total Score',
                    data: [
                        <?php 
                        if (isset($result1)) {
                            $result1->data_seek(0); // Reset pointer hasil query
                            while ($row1 = $result1->fetch_assoc()) {
                                echo htmlspecialchars($row1["total_sum_score"]) . ",";
                            }
                        }
                        ?>
                    ],
                    backgroundColor: 'rgba(255, 99, 132, 0.5)',
                    borderColor: 'rgba(255, 99, 132, 1)',
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
        <!-- Laporan dari Tabel Kedua -->
        <h2 class="mt-5">Finding Mistake Report</h2>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Agent Name</th>
                    <th>Year</th>
                    <th>Month</th>
                    <th>Total Finding</th>
                    <th>Finding Greeting</th>
                    <th>Finding verifications</th>
                    <th>Finding Tone of Voice</th>
                    <th>Finding Product knowledge</th>
                    <th>Finding Closing Greeting</th>
                    <th>Complimentary</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Cek apakah query telah dieksekusi dan hasilnya ada
                    if (isset($result2) && mysqli_num_rows($result2) > 0) {
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                            echo "<tr>
                                    <td>" . htmlspecialchars($row2["agent_name"]) . "</td>
                                    <td>" . htmlspecialchars($row2["year"]) . "</td>
                                    <td>" . htmlspecialchars($row2["month"]) . "</td>
                                    <td>" . htmlspecialchars($row2["Sum_total_finding"]) . "</td>
                                    <td>" . htmlspecialchars($row2["finding_greeting"]) . "</td>
                                    <td>" . htmlspecialchars($row2["finding_Verification"]) . "</td>
                                    <td>" . htmlspecialchars($row2["finding_Tone_of_voice"]) . "</td>
                                    <td>" . htmlspecialchars($row2["finding_product_knowledge"]) . "</td>
                                    <td>" . htmlspecialchars($row2["finding_Closing_greeting"]) . "</td>
                                    <td>" . htmlspecialchars($row2["Total_Complimentery"]) . "</td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='10'>No data found</td></tr>";
                    }
                ?>
            </tbody>
        </table>
        
        <!-- Grafik Tren Kesalahan -->
        <h2 class="mt-5">Mistake Trend Report</h2>
        <canvas id="myMistakeTrendChart" width="800" height="400"></canvas>
        <script>
            var ctx = document.getElementById('myMistakeTrendChart').getContext('2d');
            var myMistakeTrendChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [
                        <?php 
                        if (isset($result2)) {
                            $result2->data_seek(0); // Reset pointer hasil query
                            while ($row2 = $result2->fetch_assoc()) {
                                echo "'" . htmlspecialchars($row2["agent_name"]) . " (" . htmlspecialchars($row2["year"]) . "-" . htmlspecialchars($row2["month"]) . ")',";
                            }
                        }
                        ?>
                    ],
                    datasets: [
                        {
                            label: 'Greeting',
                            data: [
                                <?php 
                                if (isset($result2)) {
                                    $result2->data_seek(0); // Reset pointer hasil query
                                    while ($row2 = $result2->fetch_assoc()) {
                                        echo htmlspecialchars($row2["finding_greeting"]) . ",";
                                    }
                                }
                                ?>
                            ],
                            backgroundColor: 'rgba(255, 99, 132, 0.5)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Verification',
                            data: [
                                <?php 
                                if (isset($result2)) {
                                    $result2->data_seek(0); // Reset pointer hasil query
                                    while ($row2 = $result2->fetch_assoc()) {
                                        echo htmlspecialchars($row2["finding_Verification"]) . ",";
                                    }
                                }
                                ?>
                            ],
                            backgroundColor: 'rgba(54, 162, 235, 0.5)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Tone of Voice',
                            data: [
                                <?php 
                                if (isset($result2)) {
                                    $result2->data_seek(0); // Reset pointer hasil query
                                    while ($row2 = $result2->fetch_assoc()) {
                                        echo htmlspecialchars($row2["finding_Tone_of_voice"]) . ",";
                                    }
                                }
                                ?>
                            ],
                            backgroundColor: 'rgba(75, 192, 192, 0.5)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Product Knowledge',
                            data: [
                                <?php 
                                if (isset($result2)) {
                                    $result2->data_seek(0); // Reset pointer hasil query
                                    while ($row2 = $result2->fetch_assoc()) {
                                        echo htmlspecialchars($row2["finding_product_knowledge"]) . ",";
                                    }
                                }
                                ?>
                            ],
                            backgroundColor: 'rgba(153, 102, 255, 0.5)',
                            borderColor: 'rgba(153, 102, 255, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Closing Greeting',
                            data: [
                                <?php 
                                if (isset($result2)) {
                                    $result2->data_seek(0); // Reset pointer hasil query
                                    while ($row2 = $result2->fetch_assoc()) {
                                        echo htmlspecialchars($row2["finding_Closing_greeting"]) . ",";
                                    }
                                }
                                ?>
                            ],
                            backgroundColor: 'rgba(255, 206, 86, 0.5)',
                            borderColor: 'rgba(255, 206, 86, 1)',
                            borderWidth: 1
                        }
                    ]
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
        <!-- Tombol Export -->
        <!-- <form method="post" action="export.php">
            <button type="submit" class="btn btn-success">Export to CSV</button>
        </form> -->
    </div>
    <br>
    <br>
</body>
</html>
