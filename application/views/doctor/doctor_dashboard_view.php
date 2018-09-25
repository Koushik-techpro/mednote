<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="an-content-body">
      <div class="an-body-topbar wow fadeIn">
        <div class="an-page-title">
          <h2>Dashboard</h2>
        </div>
      </div>
      <!-- end AN-BODY-TOPBAR -->
      
      <div class="an-panel-main-info">
        <div class="row">
          <div class="col-md-3 col-sm-6">
            <div class="an-panel-main-info-single color-cyan with-shadow wow fadeIn" data-wow-delay=".1s"> <i><img src="<?=base_url()?>assets/img/ActivePatients.png" alt=""></i>
              <h2>Patients Seen</h2>
              <h3 class="number">10</h3>
            </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="an-panel-main-info-single lime-green with-shadow wow fadeIn" data-wow-delay=".2s"> <i><img src="<?=base_url()?>assets/img/money-bag.png" alt=""></i>
              <h2>Revenue Collected</h2>
              <h3 class="number">100</h3>
            </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="an-panel-main-info-single with-shadow wow fadeIn" data-wow-delay=".3s"> <i><img src="<?=base_url()?>assets/img/group.png" alt=""></i>
              <h2>Order</h2>
              <h3 class="number">35</h3>
            </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="an-panel-main-info-single soft-pink with-shadow wow fadeIn" data-wow-delay=".4s"> <i><img src="<?=base_url()?>assets/img/staff-people.png" alt=""></i>
              <h2>Total Views</h2>
              <h3 class="number">22</h3>
            </div>
          </div>
        </div>
        <!-- end .ROW -->
        
        <div class="row mt30">
          <div class="col-md-6">
            <table id="" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th colspan="3">Today Schedule</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Time</td>
                  <td>Patient Name</td>
                  <td>Reason for Visit</td>
                </tr>
                <tr>
                  <td>4:00 PM</td>
                  <td>Patient One</td>
                  <td>Reason One</td>
                </tr>
                <tr>
                  <td>4:10 PM</td>
                  <td>Patient Two</td>
                  <td>Reason Two</td>
                </tr>
                <tr>
                  <td>4:20 PM</td>
                  <td>Patient Three</td>
                  <td>Reason Three</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="col-md-6">
            <table id="" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th colspan="3">Tomorrow Schedule</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Time</td>
                  <td>Patient Name</td>
                  <td>Reason for Visit</td>
                </tr>
                <tr>
                  <td>4:00 PM</td>
                  <td>Patient One</td>
                  <td>Reason One</td>
                </tr>
                <tr>
                  <td>4:10 PM</td>
                  <td>Patient Two</td>
                  <td>Reason Two</td>
                </tr>
                <tr>
                  <td>4:20 PM</td>
                  <td>Patient Three</td>
                  <td>Reason Three</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="row mt30">
          <div class="col-md-6">
            <div class="btn-block">
              <h4 class="f-left">Financials</h4>
              <h4 class="f-right">
                <select class="an-form-control" id="">
                  <option>2018</option>
                  <option>2019</option>
                </select>
              </h4>
              <div class="clearfix"></div>
            </div>
            <div class="an-component-body">
              <div class="an-chart-content pad0">
                <canvas class="lineChartGraph"></canvas>
              </div>
            </div>
          </div>
          <div class="col-md-6 text-center">
            <div class="btn-block">
              <h4>Statistics</h4>
            </div>
            <div id='myChart'></div>
          </div>
        </div>
      </div>
    </div>
    <!-- end .AN-PANEL-MAIN-INFO --> 
    
  