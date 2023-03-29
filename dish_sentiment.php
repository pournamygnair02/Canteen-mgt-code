<?php    
   include("../connection/connect.php");
   
   error_reporting(0);
   session_start();
    $user_id = $_SESSION["user_id"];
    if(isset($_POST['check']))
    {
      $prod= $_POST['product'];
        
       
    $sql = "SELECT * FROM review_table,dishes where review_table.product_id=dishes.d_id and review_table.product_id=$prod";
    $result = $db->query($sql);

if ($result->num_rows > 0) {
    $texts = array();
    while ($row = $result->fetch_assoc()) {
        $texts[] = $row["user_review"];
    }
    $url = 'http://127.0.0.1:5000/sentiment';
    $data = json_encode(array('texts' => $texts));
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/json\r\n",
            'method'  => 'POST',
            'content' => $data,
        ),
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $result = json_decode($result, true);

    $positive = $result['positive'];
    $negative = $result['negative'];
    $neutral = $result['neutral'];
    $total = $positive + $negative + $neutral;

    $pos_percent = ($positive / $total) * 100;
    $neg_percent = ($negative / $total) * 100;
    $neu_percent = ($neutral / $total) * 100;
    $pos_accuracy = ($pos_percent > $neg_percent) ? $pos_percent : (100 - $neg_percent);
    $neg_accuracy = ($neg_percent > $pos_percent) ? $neg_percent : (100 - $pos_percent);
    $neutral_accuracy = ($neu_percent > ($pos_percent + $neg_percent)) ? $neu_percent : (100 - ($pos_percent + $neg_percent));

   } else {
    echo "No feedback data found in the database.";
    $pos_percent = 0;
    $neg_percent = 0;
    $neu_percent=0;
    $neu_percent = 0;
    $pos_accuracy = 0;
    $neg_accuracy = 0;
    $neu_accuracy = 0;
    $neutral_accuracy=0;
}
    }
    
  
?>
<!DOCTYPE html>
<html lang="en">
<?php include_once('header.php');?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Dishes analysis</title>
  <!-- base:css -->
  <link rel="stylesheet" href="vendors/typicons/typicons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/vertical-layout-light/style.css">
  <!-- endinject -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
  <link rel="shortcut icon" href="images/favicon.png" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css" 
    integrity="sha512-nNlU0WK2QfKsuEmdcTwkeh+lhGs6uyOxuUs+n+0oXSYDok5qy0EI0lt01ZynHq6+p/tbgpZ7P+yUb+r71wqdXg==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  
  <style>
    
.progress {
  height: 20px;
  border-radius: 10px;
  width:98%;
  margin-left:8px;
  background-color: lightgray;
  overflow: hidden;
}

.progress-bar {
  height: 100%;
  transition: width 0.5s ease;
}
    </style>
</head>
<body>

  
      <div class="main-panel">
        <div class="content-wrapper">

          <div class="row">
          <div class="container-fluid">  
            <br>      
    <h3>Dish Feedback Analysis </h3>
      <form enctype='multipart/form-data' action="" method="POST" class="tm-edit-product-form">
        <div class="input-group mb-3">
        <label for="product" class="col-xl-4 col-lg-4 col-md-4 col-sm-5 col-form-label">Product</label>
            <select class="custom-select col-xl-9 col-lg-8 col-md-8 col-sm-7" name="product" id="product">
                <option disabled selected>Select Dish</option>
                    <?php
                    
                    $sql="SELECT * from dishes";
                    $result = $db-> query($sql);

                    if ($result-> num_rows > 0){
                    while($row = $result-> fetch_assoc()){
                    echo "<option value='".$row['d_id']."'>".$row['title'] ."</option>";
                    }
                    }
                    ?>
            </select>
        </div>
        <div class="input-group mb-3">
          <input type="submit" value="Check" name="check" id="check" class="btn btn-primary"></input>
        </div>
      </form>
    <div class="chart-container">
        <canvas id="sentiment-chart"></canvas>
    </div>
    <div>
    <p>Positive Accuracy: <?php echo $pos_accuracy; ?>%</p>
    <p>Negative Accuracy: <?php echo $neg_accuracy; ?>%</p>
    <p>Neutral Accuracy: <?php echo $neutral_accuracy; ?>%</p>
</div>

          


</div>
</div>
</div>
<script>
        var ctx = document.getElementById('sentiment-chart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Positive', 'Negative', 'Neutral'],
                datasets: [{
                    label: 'Sentiment Analysis percentage',
                    data: [<?php echo $pos_percent; ?>, <?php echo $neg_percent; ?>, <?php echo $neu_percent; ?>],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 10,
                            max: 100
                        }
                    }
                }
            }
        });
    </script>
    </body>
    </html>