<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
</div>
</div>
<footer class="an-footer">
  <p>COPYRIGHT 2019 © MEDNOTES. ALL RIGHTS RESERVED</p>
</footer>
<!-- end an-footer -->
</div>
<!-- end .MAIN-WRAPPER --> 
<script src="<?=base_url()?>assets/js-plugins/jquery-3.1.1.min.js" type="text/javascript"></script> 
<script src="<?=base_url()?>assets/js-plugins/bootstrap.min.js" type="text/javascript"></script> 
<script src="<?=base_url()?>assets/js-plugins/moment.min.js" type="text/javascript"></script> 
<script src="<?=base_url()?>assets/js-plugins/daterangepicker.js" type="text/javascript"></script> 
<script src="<?=base_url()?>assets/js-plugins/wow.min.js" type="text/javascript"></script> 
<script src="<?=base_url()?>assets/js-plugins/perfect-scrollbar.jquery.min.js" type="text/javascript"></script> 
<script src="<?=base_url()?>assets/js-plugins/selectize.min.js" type="text/javascript"></script> 
<script src="<?=base_url()?>assets/js-plugins/owl.carousel.min.js" type="text/javascript"></script> 
<script src="<?=base_url()?>assets/js-plugins/Chart.min.js" type="text/javascript"></script> 
<script src="<?=base_url()?>assets/js-plugins/circle-progress.min.js" type="text/javascript"></script> 

<!--  MAIN SCRIPTS START FROM HERE  above scripts from plugin   --> 
<script src="<?=base_url()?>assets/js/customize-chart.js" type="text/javascript"></script> 
<script src="<?=base_url()?>assets/js/scripts.js" type="text/javascript"></script> 
<script type="text/javascript" src="<?=base_url()?>assets/js/datatables.min.js"></script> 
<script>
    $(function(){
		$(".js-toggle-sidebar").click(function(){
			$(".profile-con").toggle();
		});
	});
    </script> 
<!--pie chart--> 

<script src= "<?=base_url()?>assets/js-plugins/zingchart.min.js"></script> 

<script>
  $(document).ready(function() {
      $('#example').DataTable({
    "searching": false,
    "lengthChange": false
    });
  });
  </script> 
<script>
    var myConfig = {
      type: "pie",
	  backgroundColor: '',
      plot: {
        borderColor: "#2e8653",
        borderWidth: 1,
        // slice: 90,
        valueBox: {
          placement: 'in',
          text: '%t\n%npv%',
          fontFamily: "Open Sans",
		  fontColor: "#87c593"
        },
        tooltip: {
          fontSize: '16',
          fontFamily: "Open Sans",
          padding: "5 10",
          text: "%npv%"
        },
        animation: {
          effect: 2,
          method: 5,
          speed: 900,
          sequence: 1,
          delay: 3000
        }
      },
      source: {
        text: '',
        fontColor: "#000",
        fontFamily: "Open Sans"
      },
      title: {
        fontColor: "#000",
        text: '',
        align: "left",
        offsetX: 10,
        fontFamily: "Open Sans",
        fontSize: 25
      },
      subtitle: {
        offsetX: 10,
        offsetY: 10,
        fontColor: "#000",
        fontFamily: "Open Sans",
        fontSize: "16",
        text: '',
        align: "left"
      },
      plotarea: {
        margin: "20 0 0 0"
      },
      series: [{
        values: [200.38],
        text: "EYE",
        backgroundColor: '#f5f6fa',
      }, {
        values: [200.94],
        text: "NOSE",
        backgroundColor: '#f5f6fa',
      /*  detached: true*/
      }, {
        values: [200.52],
        text: 'LEG',
        backgroundColor: '#f5f6fa',
/*        detached: true*/
      },/* {
        text: 'Safari',
        values: [9.69],
        backgroundColor: '#6877e5'
      },*/ {
        text: 'EAR',
        values: [300.48],
        backgroundColor: '#f5f6fa'
      }]
    };

    zingchart.render({
      id: 'myChart',
      data: myConfig,
      height: '100%',
      width: '100%'
    });
  </script>
</body>
</html>
