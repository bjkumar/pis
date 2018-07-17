<span id="take_pg_content" class="take_pg_content"> 
  
<!--header end-->

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Data Analysis</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <p style="color: black;font-weight:bold;">Project Received Graph</p>
                            <canvas id="lineChart_pro_rec"></canvas>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <p style="color: black;font-weight:bold;">Project Delivered Graph</p>
                            <canvas id="lineChart_pr_del"></canvas>
                        </div>

                    </div>


                    <div class="x_content">
                        <div class="ln_solid"></div>
                         <div class="col-md-6 col-sm-6 col-xs-6">
                            <p style="color: black;font-weight:bold;">Working Hour Report</p>
                            <canvas id="barchart_working_hour"></canvas>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <p style="color: black;font-weight:bold;">QC Hour Report</p>
                            <canvas id="barChartQcHour"></canvas>
                        </div>
                      </div>
                    
                    
                    <div class="x_content">
                        <div class="ln_solid"></div>
                         <div class="col-md-6 col-sm-6 col-xs-6">
                            <p style="color: black;font-weight:bold;">Total Hour Report</p>
                            <canvas id="barChartTotlHour"></canvas>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <p style="color: black;font-weight:bold;">Billing Hour Report</p>
                            <canvas id="barChartbillingHour"></canvas>
                        </div>

                    </div>
                </div>
            </div>



        </div>
    </div>
</div>
<!-- /page content -->
<!-- Please wait area show  -->
<div class="please_wait">
    <p>
        <span id="please_wait_text">Please Wait</span><img src="<?php echo SITE_URL; ?>asset/images/loading.gif" id="please_wait_image"/><br/>
    <div class="loading" id="show_message_text">Please Wait..</div>
</p>
</div> <!-- Please wait area end  --> 
<!-- footer -->
<!-- Datatables -->
<script src="<?php echo SITE_URL; ?>asset/js/Chart.min.js"></script>

<script>

    /* ***************************** project delivered ****************************************** */

    var p_del = document.getElementById("lineChart_pr_del");
    new Chart(p_del, {
        type: "line",
        data: {
            labels: ["", "Jan", "Feb", "Mar", "Apr", "May", "June", "Jul", "Aug","Sep","Oct","Nov","Dec"],
            // labels: [],
            datasets: [{
                    label: "EDIT",
                    backgroundColor: "#c0504d4d",
                    borderColor: "#c0504d",
                    pointBorderColor: "rgba(38, 185, 154, 0.7)",
                    pointBackgroundColor: "rgba(38, 185, 154, 0.7)",
                    pointHoverBackgroundColor: "#fff",
                    pointHoverBorderColor: "rgba(220,220,220,1)",
                    pointBorderWidth: 1,
                    data: [0, <?php
foreach ($edit_del as $ed_del) {
    echo $ed_del['total'] . ',';
}
?>]
                }, {
                    label: "PLP",
                    backgroundColor: "#1F497D4D",
                    borderColor: "#1F497D",
                    pointBorderColor: "rgba(3, 88, 106, 0.70)",
                    pointBackgroundColor: "rgba(3, 88, 106, 0.70)",
                    pointHoverBackgroundColor: "#fff",
                    pointHoverBorderColor: "rgba(151,187,205,1)",
                    pointBorderWidth: 1,
                    data: [0, <?php
foreach ($plp_del as $plp_del) {
    echo $plp_del['total'] . ',';
}
?>]
                }, {
                    label: "RPM",
                    backgroundColor: "#d4d10533",
                    borderColor: "#d4d105",
                    pointBorderColor: "rgba(3, 88, 106, 0.70)",
                    pointBackgroundColor: "rgba(3, 88, 106, 0.70)",
                    pointHoverBackgroundColor: "#fff",
                    pointHoverBorderColor: "rgba(151,187,205,1)",
                    pointBorderWidth: 1,
                    data: [0, <?php
foreach ($rpm_del as $rpm_de) {
    echo $rpm_de['total'] . ',';
}
?>]
                }]
        }
    })

    /* ***************************** project received ****************************************** */

    var p_rec = document.getElementById("lineChart_pro_rec");
    new Chart(p_rec, {
        type: "line",
        data: {
            labels: ["", "Jan", "Feb", "Mar", "Apr", "May", "June", "Jul", "Aug","Sep","Oct","Nov","Dec"],
            // labels: [],
            datasets: [{
                    label: "EDIT",
                    backgroundColor: "#c0504d4d",
                    borderColor: "#c0504d",
                    pointBorderColor: "rgba(38, 185, 154, 0.7)",
                    pointBackgroundColor: "rgba(38, 185, 154, 0.7)",
                    pointHoverBackgroundColor: "#fff",
                    pointHoverBorderColor: "rgba(220,220,220,1)",
                    pointBorderWidth: 1,
                    data: [0,<?php
foreach ($edi_ed as $edi_e) {
    echo $edi_e['total'] . ',';
}
?>]
                }, {
                    label: "PLP",
                    backgroundColor: "#1F497D4D",
                    borderColor: "#1F497D",
                    pointBorderColor: "rgba(3, 88, 106, 0.70)",
                    pointBackgroundColor: "rgba(3, 88, 106, 0.70)",
                    pointHoverBackgroundColor: "#fff",
                    pointHoverBorderColor: "rgba(151,187,205,1)",
                    pointBorderWidth: 1,
                    data: [0,<?php
foreach ($plp_ed as $plp_e) {
    echo $plp_e['total'] . ',';
}
?>]
                }, {
                    label: "RPM",
                    backgroundColor: "#d4d10533",
                    borderColor: "#d4d105",
                    pointBorderColor: "rgba(3, 88, 106, 0.70)",
                    pointBackgroundColor: "rgba(3, 88, 106, 0.70)",
                    pointHoverBackgroundColor: "#fff",
                    pointHoverBorderColor: "rgba(151,187,205,1)",
                    pointBorderWidth: 1,
                    data: [0,<?php
foreach ($rpm_ed as $rpm_e) {
    echo $rpm_e['total'] . ',';
}
?>]
                }]
        }
    })
  
/* ***************************** Working Hour Chart ****************************************** */
  
        var f_working_hr = document.getElementById("barchart_working_hour");
        new Chart(f_working_hr, {type: "bar",
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "June", "Jul", "Aug","Sep","Oct","Nov","Dec"],
                datasets: [
                    {
                        label: "Edit",
                        backgroundColor: "#c0504d",
                        data: [<?php
foreach ($edi_ed as $edi_edhr) {
    echo $edi_edhr['working_hour'] . ',';
}
?>]
                    },
                    {
                        label: "PLP",
                        backgroundColor: "#1F497D",
                        data: [<?php
foreach ($plp_ed as $plp_ehr) {
    echo $plp_ehr['working_hour'] . ',';
}
?>]
                    },
                    {
                        label: "RPM",
                        backgroundColor: "#d4d105",
                        data: [<?php
foreach ($rpm_ed as $rpm_ehr) {
    echo $rpm_ehr['working_hour'] . ',';
}
?>]
                    }

                ]},
            options: {scales: {yAxes: [{ticks: {beginAtZero: !0}}]}}}
        )
    
/* *****************************QC Hour Chart ****************************************** */
     
        var f_qchr = document.getElementById("barChartQcHour");
        new Chart(f_qchr, {type: "bar",
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "June", "Jul", "Aug","Sep","Oct","Nov","Dec"],
                datasets: [
                    {
                        label: "Edit",
                        backgroundColor: "#c0504d",
                        data: [<?php
foreach ($edi_ed as $edi_edhr) {
    echo $edi_edhr['qc_hour'] . ',';
}
?>]
                    },
                    {
                        label: "PLP",
                        backgroundColor: "#1F497D",
                        data: [<?php
foreach ($plp_ed as $plp_ehr) {
    echo $plp_ehr['qc_hour'] . ',';
}
?>]
                    },
                    {
                        label: "RPM",
                        backgroundColor: "#d4d105",
                        data: [<?php
foreach ($rpm_ed as $rpm_ehr) {
    echo $rpm_ehr['qc_hour'] . ',';
}
?>]
                    }

                ]},
            options: {scales: {yAxes: [{ticks: {beginAtZero: !0}}]}}}
        )
  
  /* *****************************Total Hour Chart ****************************************** */
  
  var f_totlhr = document.getElementById("barChartTotlHour");
        new Chart(f_totlhr, {type: "bar",
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "June", "Jul", "Aug","Sep","Oct","Nov","Dec"],
                datasets: [
                    {
                        label: "Edit",
                        backgroundColor: "#c0504d",
                        data: [<?php
foreach ($edi_ed as $edi_edhr) {
    echo $edi_edhr['total_hour'] . ',';
}
?>]
                    },
                    {
                        label: "PLP",
                        backgroundColor: "#1F497D",
                        data: [<?php
foreach ($plp_ed as $plp_ehr) {
    echo $plp_ehr['total_hour'] . ',';
}
?>]
                    },
                    {
                        label: "RPM",
                        backgroundColor: "#d4d105",
                        data: [<?php
foreach ($rpm_ed as $rpm_ehr) {
    echo $rpm_ehr['total_hour'] . ',';
}
?>]
                    }

                ]},
            options: {scales: {yAxes: [{ticks: {beginAtZero: !0}}]}}}
        )
        
        
        /* *****************************Billing Hour Chart ****************************************** */
  
  var f_blnghr = document.getElementById("barChartbillingHour");
        new Chart(f_blnghr, {type: "bar",
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "June", "Jul", "Aug","Sep","Oct","Nov","Dec"],
                datasets: [
                    {
                        label: "Edit",
                        backgroundColor: "#c0504d",
                        data: [<?php
foreach ($edi_ed as $edi_edhr) {
    echo $edi_edhr['billing_hour'] . ',';
}
?>]
                    },
                    {
                        label: "PLP",
                        backgroundColor: "#1F497D",
                        data: [<?php
foreach ($plp_ed as $plp_ehr) {
    echo $plp_ehr['billing_hour'] . ',';
}
?>]
                    },
                    {
                        label: "RPM",
                        backgroundColor: "#d4d105",
                        data: [<?php
foreach ($rpm_ed as $rpm_ehr) {
    echo $rpm_ehr['billing_hour'] . ',';
}
?>]
                    }

                ]},
            options: {scales: {yAxes: [{ticks: {beginAtZero: !0}}]}}}
        )
</script>
</span> 