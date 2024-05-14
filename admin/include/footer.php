 <!-- footer start-->
        <footer class="footer">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12 footer-copyright">
                <p class="mb-0 text-center">Copyright 2024 © Vacaysitters All rights reserved.</p>
              </div>
              
            </div>
          </div>
        </footer>
      </div>
    </div>
    <!-- latest jquery-->
    <script src="assets/js/jquery-3.5.1.min.js"></script>
    <!-- feather icon js-->
    <!-- feather icon js-->
    <script src="assets/js/icons/feather-icon/feather.min.js"></script>
    <script src="assets/js/icons/feather-icon/feather-icon.js"></script>
    <!-- Sidebar jquery-->
    <script src="assets/js/sidebar-menu.js"></script>
    <script src="assets/js/config.js"></script>
    <!-- Bootstrap js-->
    <script src="assets/js/bootstrap/popper.min.js"></script>
    <script src="assets/js/bootstrap/bootstrap.min.js"></script>
    <!-- Plugins JS start-->
    <!--  <script src="assets/js/chart/chartist/chartist.js}"></script>
    <script src="assets/js/chart/chartist/chartist-plugin-tooltip.js"></script>  -->
     <script src="assets/js/chart/knob/knob.min.js"></script>
    <script src="assets/js/chart/knob/knob-chart.js"></script> 
   <!--  <script src="assets/js/chart/apex-chart/apex-chart.js"></script>
    <script src="assets/js/chart/apex-chart/stock-prices.js"></script>
    <script src="assets/js/prism/prism.min.js"></script> -->
    <script src="assets/js/clipboard/clipboard.min.js"></script>
    <script src="assets/js/counter/jquery.waypoints.min.js"></script>
    <script src="assets/js/counter/jquery.counterup.min.js"></script>
    <script src="assets/js/counter/counter-custom.js"></script>
    <script src="assets/js/custom-card/custom-card.js"></script>
    <script src="assets/js/notify/bootstrap-notify.min.js"></script>
    
    <!--<script src="{{asset('admin_assets/js/vector-map/jquery-jvectormap-2.0.2.min.js')}}"></script>-->
    <!--<script src="{{asset('admin_assets/js/vector-map/map/jquery-jvectormap-world-mill-en.js')}}"></script>-->
    <!--<script src="{{asset('admin_assets/js/vector-map/map/jquery-jvectormap-us-aea-en.js')}}"></script>-->
    <!--<script src="{{asset('admin_assets/js/vector-map/map/jquery-jvectormap-uk-mill-en.js')}}"></script>-->
    <!--<script src="{{asset('admin_assets/js/vector-map/map/jquery-jvectormap-au-mill.js')}}"></script>-->
    <!--<script src="{{asset('admin_assets/js/vector-map/map/jquery-jvectormap-chicago-mill-en.js')}}"></script>-->
    <!--<script src="{{asset('admin_assets/js/vector-map/map/jquery-jvectormap-in-mill.js')}}"></script>-->
    <!--<script src="{{asset('admin_assets/js/vector-map/map/jquery-jvectormap-asia-mill.js')}}"></script>-->
    
<!--     <script src="assets/js/dashboard/default.js"></script>
 -->  
 
     <script src="assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/js/datatable/datatables/datatable.custom.js"></script>
    <script src="assets/js/notify/index.js"></script>

    <script src="assets/js/datepicker/date-picker/datepicker.js"></script>
    <script src="assets/js/datepicker/date-picker/datepicker.en.js"></script>
    <script src="assets/js/datepicker/date-picker/datepicker.custom.js"></script>
   
    <script src="assets/js/time-picker/jquery-clockpicker.min.js"></script>
    <script src="assets/js/time-picker/highlight.min.js"></script>
<!--     <script src="{{asset('admin_assets/js/time-picker/clockpicker.js')}}"></script>
 -->
    <script src="assets/js/select2/select2.full.min.js"></script>
    <script src="assets/js/select2/select2-custom.js"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="assets/js/script.js"></script>
    <script src="assets/js/theme-customizer/customizer.js"></script>
        <script src="assets/js/owlcarousel/owl.carousel.js"></script>

    <script src="assets/js/general-widget.js"></script>
     <script src="assets/js/height-equal.js"></script>
    <script src="assets/js/tooltip-init.js"></script>
    <!-- 
            <script src="assets/js/chart-widget.js"></script>
<script src="assets/js/chart/apex-chart/chart-custom.js"></script> -->
    <!-- login js-->
    <!-- Plugin used-->
    <style type="text/css">
      .customizer-links{
        display: none;
      }
      .card-footer {
    
     border-top: none !important; 
}

.Active{
   background-color: #24695c !important;
    color: #fff !important;
}
.dropdown{
    padding: 5px !important;
}
.test-new .according-menu{
    display: none !important;
    margin-top:100px;
}
/*.sidebar-user{*/
/*    visibility:hidden ;*/
/*}*/

@media screen and (min-width: 768px) {
    .toggle-sidebar {
        display: none;
        
       
    }
    
    .logo-wrapper{
        margin-left: 50px !important;
    }
}   
@media screen and (min-width:220px) and (max-width: 580px) {
    .toggle-sidebar {
        display: block;
       
    }
    
     .logo-wrapper{
        margin-left: 0px !important;
    }
}   

.setting-primary{
    display: none !important;
}

.set-navs{
    margin-top: 30px !important;
}

.dropdown-basic{
    padding: 0px !important;
}



#doublescroll
{
  overflow: auto; 
  /*overflow-y: hidden; */
  width: 100%;
}
#doublescroll table
{
  margin: 0; 
  padding: 1em; 
 
}
.dropdown-basic .dropdown .dropdown-content{
    height: 130px !important;
    overflow-y: scroll !important;
}

    </style>
   <script type="text/javascript">
  function DoubleScroll(element) {
//var scrollWidth1 = '2000';
    var scrollbar = document.createElement('div');
    scrollbar.appendChild(document.createElement('div'));
    scrollbar.style.overflow = 'auto';
    scrollbar.style.overflowY = 'hidden';
    scrollbar.firstChild.style.width ='2000px';
    scrollbar.firstChild.style.paddingTop = '1px';
    scrollbar.firstChild.appendChild(document.createTextNode('\xA0'));
    scrollbar.onscroll = function() {
        element.scrollLeft = scrollbar.scrollLeft;
    };
    element.onscroll = function() {
        scrollbar.scrollLeft = element.scrollLeft;
    };
    element.parentNode.insertBefore(scrollbar, element);
}

DoubleScroll(document.getElementById('doublescroll'));
</script>

 <style type="text/css">

.dropdown{
    padding: 5px !important;
}
.test-new .according-menu{
    display: none !important;
    margin-top:100px;
}
/*.sidebar-user{*/
/*    visibility:hidden ;*/
/*}*/

@media screen and (min-width: 768px) {
    .toggle-sidebar {
        display: none;
        
       
    }
    
    .logo-wrapper{
        margin-left: 50px !important;
    }
}   
@media screen and (min-width:220px) and (max-width: 580px) {
    .toggle-sidebar {
        display: block;
       
    }
    
     .logo-wrapper{
        margin-left: 0px !important;
    }
}   

.setting-primary{
    display: none !important;
}

.set-navs{
    margin-top: 30px !important;
}

.dropdown-basic{
    padding: 0px !important;
}





    </style>

    <style type="text/css">
.overlay {
  position: fixed;
  width: 100%;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0,0,0,.85);
  z-index: 10000;
}
.popup {
  width: 98%;
  padding: 15px;
  left: 0;
  margin-left: 1%;
  border: 1px solid #ccc;
  border-radius: 10px;
  background: white;
  position: absolute;
  top: -100%;
  box-shadow: 5px 5px 5px #000;
  z-index: 10001;
}

/*.popup p{
   text-align: center !important;
}*/

@media (min-width: 768px) {
  .popup {
    width: 66.66666666%;
    margin-left: 16.666666%;
  }
}
@media (min-width: 992px) {
  .popup {
    width: 50%;
    margin-left: 25%;
  }
}
@media (min-width: 1200px) {
  .popup {
    width: 33.33333%;
    margin-left: 33.33333%;
  }
}

.text-right{
    float: right;
}
</style>

<script>
function showPrompt(msg)
{
  // CREATE A Promise TO RETURN
  var p = new Promise(function(resolve, reject) {
  
    var dialog = $('<div/>', {class: 'popup'})
      .append(
        $('<p/>').html(msg)
      )
      .append(
        $('<div/>', 
            {class: 'text-right'})
          .append($('<button/>', {class: 'btn btn-cancel'}).html('Cancel').on('click', function() {
            $('.overlay').remove();
            // RESOLVE Promise TO false
            resolve(false);
          }))
          .append($('<button/>', {class: 'btn btn-primary'}).html('Ok').on('click', function() {
            $('.overlay').remove();
            // RESOLVE Promise TO true
            resolve(true);
          }))
      );
      
    var overlay = $('<div/>', {class: 'overlay'})
      .append(dialog);
    
    $('body').append(overlay);
    $(dialog).animate({top: '15%'}, 1000);
  });
  
  // RETURN THE Promise
  return p;
}


</script>
   
  </body>
</html>