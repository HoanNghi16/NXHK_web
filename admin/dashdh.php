<?php
require('./includes/header.php');
require_once __DIR__ . '../../config/database.php';

// ====== DATA CHART BAR ======
$sql = "
    SELECT DATE(created_at) as day, 
           SUM(amount) as total_money,
           SUM(quantity) as total_qty
    FROM orders
    GROUP BY DATE(created_at)
    ORDER BY day ASC
";

$result = $conn->query($sql);

$labels = [];
$money = [];
$qty = [];

while($row = $result->fetch_assoc()){
    $labels[] = $row['day'];
    $money[] = (int)$row['total_money'];
    $qty[] = (int)$row['total_qty'];
}

// ====== DATA PIE ======
$sql2 = "SELECT status, COUNT(*) as total FROM orders GROUP BY status";
$res2 = $conn->query($sql2);

$status_labels = [];
$status_values = [];

while($row = $res2->fetch_assoc()){
    $status_labels[] = "Status ".$row['status'];
    $status_values[] = (int)$row['total'];
}
?>

<h1>THỐNG KÊ ĐƠN HÀNG</h1>
<div class="row justify-content-center">
  
  <!-- Chart trái -->
  <div class="col-md-6">
    <div class="card mb-4">
      <div class="card-body">
        <h5>Biểu đồ doanh thu & số lượng</h5>
        <div class="chart-area">
          <canvas id="myChart"></canvas>
        </div>
      </div>
    </div>
  </div>

  <!-- Chart phải -->
  <div class="col-md-6">
    <div class="card mb-4">
      <div class="card-body">
        <h5>Trạng thái đơn hàng</h5>
        <div class="chart-pie">
          <canvas id="pieChart"></canvas>
        </div>
      </div>
    </div>
  </div>

</div>
<!-- LOAD CHART.JS TRƯỚC -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// ===== BAR CHART =====
new Chart(document.getElementById('myChart'), {
    type: 'bar',
    data: {
        labels: <?= json_encode($labels) ?>,
        datasets: [
            {
                label: 'Doanh thu',
                data: <?= json_encode($money) ?>
            },
            {
                label: 'Số lượng',
                data: <?= json_encode($qty) ?>
            }
        ]
    }
});

// ===== PIE CHART =====
new Chart(document.getElementById('pieChart'), {
    type: 'pie',
    data: {
        labels: <?= json_encode($status_labels) ?>,
        datasets: [{
            data: <?= json_encode($status_values) ?>
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});
</script>

<?php require('./includes/footer.php'); ?>