<div class="row">
        <div class="col-md-12" >
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Monthly Recap Report</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-wrench"></i></button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                  </ul>
                </div>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-8">
                  <p class="text-center">
                    <strong><?php echo date('Y-m-d H-s-d') ?></strong>
                  </p>

                  <div class="chart">
                    <!-- Sales Chart Canvas -->
                    <canvas id="barChart" style="height:390px"></canvas>
                  </div>
                  <!-- /.chart-responsive -->
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                  <p class="text-center">
                    <strong>Data Tahun <?php echo date('Y'); ?></strong>
                  </p>

                  <div class="progress-group">
                    <div class="info-box bg-red">
                      <a href="<?php echo base_url('laporan/pdf'); ?>" style="color: white;">
                        <span class="info-box-icon"><i class="ion ion-ios-cloud-download-outline"></i></span>
                      </a>

                      <div class="info-box-content">
                        <span class="info-box-text">Data Prestatsi <?php echo date('Y'); ?> </span>
                        <span class="info-box-number"></span> <br>

                        <div class="progress">
                          <div class="progress-bar" style="width: 100%"></div>
                        </div>
                        <span class="progress-description">
                            Universitas Budi Luhur 
                        </span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                  </div>
                  <!-- /.progress-group -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- ./box-body -->
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>

          <script>
            $(function() {
              

                var areaChartData = {
                  labels  : [<?php foreach($kategori as $k){echo "'".$k->ireng."',";} ?>],
                  datasets: [
                    {
                      label               : 'Digital Goods',
                      fillColor           : 'rgba(60,141,188,0.9)',
                      strokeColor         : 'rgba(60,141,188,0.8)',
                      pointColor          : '#3b8bba',
                      pointStrokeColor    : 'rgba(60,141,188,1)',
                      pointHighlightFill  : '#fff',
                      pointHighlightStroke: 'rgba(60,141,188,1)',
                      data                : [<?php foreach($jlh as $k){echo $k->jumlah.",";} ?>]
                    }
                  ]
                }
                //-------------
                  //- BAR CHART -
                  //-------------
                  var barChartCanvas                   = $('#barChart').get(0).getContext('2d')
                  var barChart                         = new Chart(barChartCanvas)
                  var barChartData                     = areaChartData
                  // barChartData.datasets[1].fillColor   = '#00a65a'
                  // barChartData.datasets[1].strokeColor = '#00a65a'
                  // barChartData.datasets[1].pointColor  = '#00a65a'
                  var barChartOptions                  = {
                    //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
                    scaleBeginAtZero        : true,
                    //Boolean - Whether grid lines are shown across the chart
                    scaleShowGridLines      : true,
                    //String - Colour of the grid lines
                    scaleGridLineColor      : 'rgba(0,0,0,.05)',
                    //Number - Width of the grid lines
                    scaleGridLineWidth      : 1,
                    //Boolean - Whether to show horizontal lines (except X axis)
                    scaleShowHorizontalLines: true,
                    //Boolean - Whether to show vertical lines (except Y axis)
                    scaleShowVerticalLines  : true,
                    //Boolean - If there is a stroke on each bar
                    barShowStroke           : true,
                    //Number - Pixel width of the bar stroke
                    barStrokeWidth          : 2,
                    //Number - Spacing between each of the X value sets
                    barValueSpacing         : 5,
                    //Number - Spacing between data sets within X values
                    barDatasetSpacing       : 1,
                    //String - A legend template
                    legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
                    //Boolean - whether to make the chart responsive
                    responsive              : true,
                    maintainAspectRatio     : true
                  }

                  barChartOptions.datasetFill = false
                  barChart.Bar(barChartData, barChartOptions)
                })

          </script>

