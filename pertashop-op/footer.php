  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0
    </div>
    <strong>Copyright UPITRA &copy; 2024</strong> - Sistem Informasi Manajemen Keuangan BUMDes Sidomukti Bendungan
  </footer>

  
</div>


<script src="../assets/bower_components/jquery/dist/jquery.min.js"></script>

<script src="../assets/bower_components/jquery-ui/jquery-ui.min.js"></script>

<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>

<script src="../assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<script src="../assets/bower_components/raphael/raphael.min.js"></script>
<script src="../assets/bower_components/morris.js/morris.min.js"></script>

<script src="../assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>


<script src="../assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<script src="../assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

<script src="../assets/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>

<script src="../assets/bower_components/moment/min/moment.min.js"></script>
<script src="../assets/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>

<script src="../assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<script src="../assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

<script src="../assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>

<script src="../assets/bower_components/fastclick/lib/fastclick.js"></script>

<script src="../assets/dist/js/adminlte.min.js"></script>

<script src="../assets/dist/js/pages/dashboard.js"></script>

<script src="../assets/dist/js/demo.js"></script>
<script src="../assets/bower_components/ckeditor/ckeditor.js"></script>
<script src="../assets/bower_components/chart.js/Chart.min.js"></script>

<script>
  $(document).ready(function(){

   // $(".edit").hide();

   $('#table-datatable').DataTable({
    'paging'      : true,
    'lengthChange': false,
    'searching'   : true,
    'ordering'    : false,
    'info'        : true,
    'autoWidth'   : true,
    "pageLength": 50
  });



 });
  
  $('#datepicker').datepicker({
    autoclose: true,
    format: 'dd/mm/yyyy',
  }).datepicker("setDate", new Date());

  $('.datepicker2').datepicker({
    autoclose: true,
    format: 'yyyy/mm/dd',
  });


</script>

<script>
  // Format otomatis saat ketik nominal
  function formatRupiah(angka, prefix){
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
    split = number_string.split(','),
    sisa  = split[0].length % 3,
    rupiah = split[0].substr(0, sisa),
    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if(ribuan){
      separator = sisa ? '.' : '';
      rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? prefix + rupiah : '');
  }

  // Terapkan ke semua input .rupiah
  const rupiahInputs = document.querySelectorAll('.rupiah');
  rupiahInputs.forEach(function(input){
    input.addEventListener('keyup', function(){
      this.value = formatRupiah(this.value, 'Rp ');
    });
  });
</script>

<script>
  var randomScalingFactor = function(){ return Math.round(Math.random()*100)};

  var barChartData = {
    labels : ["Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agu","Sep","Okt","Nov","Des"],
    datasets : [
    {
      label: 'Pemasukan',
      fillColor : "rgba(51, 240, 113, 0.61)",
      strokeColor : "rgba(11, 246, 88, 0.61)",
      highlightFill: "rgba(220,220,220,0.75)",
      highlightStroke: "rgba(220,220,220,1)",
      data : [
      <?php
      for($bulan=1;$bulan<=12;$bulan++){
        $thn_ini = date('Y');
        $pemasukan = mysqli_query($koneksi,"SELECT SUM(output_total) as total_pemasukan from omset_pertashop where month(output_tanggal)='$bulan' and year(output_tanggal)='$thn_ini'");
        $pem = mysqli_fetch_assoc($pemasukan);

        // $total = str_replace(",", "44", number_format($pem['total_pemasukan']));
        $total = $pem['total_pemasukan'];
        if($pem['total_pemasukan'] == ""){
          echo "0,";
        }else{
          echo $total.",";
        }

      }
      ?>
      ]
    },
    {
      label: 'Pengeluaran',
      fillColor : "rgba(255, 51, 51, 0.8)",
      strokeColor : "rgba(248, 5, 5, 0.8)",
      highlightFill : "rgba(151,187,205,0.75)",
      highlightStroke : "rgba(151,187,205,1)",
      data : [
      <?php
      for($bulan=1;$bulan<=12;$bulan++){
        $thn_ini = date('Y');
        $pengeluaran = mysqli_query($koneksi,"select sum(opex_nominal) as total_pengeluaran from opex_pertashop where month(opex_tanggal)='$bulan' and year(opex_tanggal)='$thn_ini'");
        $peng = mysqli_fetch_assoc($pengeluaran);

        // $total = str_replace(",", "44", number_format($peng['total_pengeluaran']));
        $total = $peng['total_pengeluaran'];
        if($peng['total_pengeluaran'] == ""){
          echo "0,";
        }else{

          echo $total.",";
        }
      }
      ?>
      ]
    }
    ]
  }


  var barChartData2 = {
  labels: [
    <?php 
    // Mengambil daftar tahun dari kedua tabel menggunakan UNION
    $tahun = mysqli_query($koneksi, "
      SELECT DISTINCT YEAR(tahun) as tahun FROM (
        SELECT output_tanggal AS tahun FROM omset_pertashop 
        UNION 
        SELECT opex_tanggal AS tahun FROM opex_pertashop
      ) AS combined_years ORDER BY tahun ASC
    ");

    $list_tahun = [];
    while ($t = mysqli_fetch_array($tahun)) {
      $list_tahun[] = $t['tahun'];
      echo "\"{$t['tahun']}\",";
    }
    ?>
    ],
    datasets: [
      {
        label: 'Pemasukan',
        fillColor: "rgba(51, 240, 113, 0.61)",
        strokeColor: "rgba(11, 246, 88, 0.61)",
        highlightFill: "rgba(220,220,220,0.75)",
        highlightStroke: "rgba(220,220,220,1)",
        data: [
          <?php
          foreach ($list_tahun as $thn) {
            $pemasukan = mysqli_query($koneksi, "SELECT SUM(output_total) AS total_pemasukan FROM omset_pertashop WHERE YEAR(output_tanggal) = '$thn'");
            $pem = mysqli_fetch_assoc($pemasukan);
            echo ($pem['total_pemasukan'] ?? 0) . ",";
          }
          ?>
        ]
      },
      {
        label: 'Pengeluaran',
        fillColor: "rgba(255, 51, 51, 0.8)",
        strokeColor: "rgba(248, 5, 5, 0.8)",
        highlightFill: "rgba(151,187,205,0.75)",
        highlightStroke: "rgba(254, 29, 29, 0)",
        data: [
          <?php
          foreach ($list_tahun as $thn) {
            $pengeluaran = mysqli_query($koneksi, "SELECT SUM(opex_nominal) AS total_pengeluaran FROM opex_pertashop WHERE YEAR(opex_tanggal) = '$thn'");
            $peng = mysqli_fetch_assoc($pengeluaran);
            echo ($peng['total_pengeluaran'] ?? 0) . ",";
          }
          ?>
        ]
      }
    ]
  }


  window.onload = function(){
    var ctx = document.getElementById("grafik1").getContext("2d");
    window.myBar = new Chart(ctx).Bar(barChartData, {
    responsive : true,
    animation: true,
    barValueSpacing : 5,
    barDatasetSpacing : 1,
    tooltipFillColor: "rgba(0,0,0,0.8)",
    multiTooltipTemplate: "<%= datasetLabel %> - Rp.<%= value.toLocaleString() %>,-"
  });

  var ctx = document.getElementById("grafik2").getContext("2d");
  window.myBar = new Chart(ctx).Bar(barChartData2, {
    responsive : true,
    animation: true,
    barValueSpacing : 5,
    barDatasetSpacing : 1,
    tooltipFillColor: "rgba(0,0,0,0.8)",
    multiTooltipTemplate: "<%= datasetLabel %> - Rp.<%= value.toLocaleString() %>,-"
  });
  }
</script>

</body>
</html>
