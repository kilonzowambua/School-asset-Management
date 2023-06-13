<script type="text/javascript" src="../public/bower_components/jquery/dist/jquery.min.js"></script>
<script type="text/javascript" src="../public/bower_components/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="../public/bower_components/popper.js/dist/umd/popper.min.js"></script>
<script type="text/javascript" src="../public/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<script type="text/javascript" src="../public/bower_components/jquery-slimscroll/jquery.slimscroll.js"></script>

<script type="text/javascript" src="../public/bower_components/modernizr/modernizr.js"></script>

<script type="text/javascript" src="../public/bower_components/chart.js/dist/Chart.js"></script>

<script src="../public/pages/widget/amchart/amcharts.js"></script>
<script src="../public/pages/widget/amchart/serial.js"></script>
<script src="../public/pages/widget/amchart/light.js"></script>
<script src="../public/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript" src="../public/js/SmoothScroll.js"></script>
<script src="../public/js/pcoded.min.js"></script>

<script src="../public/js/vartical-layout.min.js"></script>
<script type="text/javascript" src="../public/pages/dashboard/custom-dashboard.js"></script>
<script type="text/javascript" src="../public/js/script.min.js"></script>

<script type="text/javascript" src="../public/bower_components/pnotify/dist/pnotify.js"></script>
<script type="text/javascript" src="../public/bower_components/pnotify/dist/pnotify.desktop.js"></script>
<script type="text/javascript" src="../public/bower_components/pnotify/dist/pnotify.buttons.js"></script>
<script type="text/javascript" src="../public/bower_components/pnotify/dist/pnotify.confirm.js"></script>
<script type="text/javascript" src="../public/bower_components/pnotify/dist/pnotify.callbacks.js"></script>
<script type="text/javascript" src="../public/bower_components/pnotify/dist/pnotify.animate.js"></script>
<script type="text/javascript" src="../public/bower_components/pnotify/dist/pnotify.history.js"></script>
<script type="text/javascript" src="../public/bower_components/pnotify/dist/pnotify.mobile.js"></script>
<script type="text/javascript" src="../public/bower_components/pnotify/dist/pnotify.nonblock.js"></script>

<script src="../public/assets/pages/user-profile.js"></script>
<script src="../public/assets/js/pcoded.min.js"></script>
<script src="../public/assets/js/vartical-layout.min.js"></script>
<script src="../public/assets/js/jquery.mCustomScrollbar.concat.min.js"></script>

<script type="text/javascript" src="../public/bower_components/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="../public/bower_components/popper.js/dist/umd/popper.min.js"></script>
<script type="text/javascript" src="../public/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<script type="text/javascript" src="../public/bower_components/jquery-slimscroll/jquery.slimscroll.js"></script>

<script type="text/javascript" src="../public/bower_components/modernizr/modernizr.js"></script>
<script type="text/javascript" src="../public/bower_components/modernizr/feature-detects/css-scrollbars.js"></script>

<script type="text/javascript" src="../public/assets/pages/advance-elements/moment-with-locales.min.js"></script>
<script type="text/javascript" src="../public/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="../public/assets/pages/advance-elements/bootstrap-datetimepicker.min.js"></script>

<script type="text/javascript" src="../public/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>

<script type="text/javascript" src="../public/bower_components/datedropper/js/datedropper.min.html"></script>

<script src="../public/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
 <script src="../public/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="../public/assets/pages/data-table/js/jszip.min.js"></script>
<script src="../public/assets/pages/data-table/js/pdfmake.min.js"></script>
<script src="../public/assets/pages/data-table/js/vfs_fonts.js"></script>
<script src="../public/assets/pages/data-table/extensions/buttons/js/dataTables.buttons.min.js"></script>
<!--  -->
<script src="../public/bower_components/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="../public/bower_components/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="../public/assets/pages/data-table/js/dataTables.bootstrap4.min.js"></script>
<script src="../public/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="../public/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

<script src="../public/assets/pages/data-table/extensions/buttons/js/extension-btns-custom.js"></script>
<script src="../public/assets/pages/ckeditor/ckeditor.js"></script>

<script src="../public/assets/pages/chart/echarts/js/echarts-all.js" type="text/javascript"></script>

<script type="text/javascript" src="../public/bower_components/i18next/i18next.min.js"></script>
<script type="text/javascript" src="../public/bower_components/i18next-xhr-backend/i18nextXHRBackend.min.js"></script>
<script type="text/javascript" src="../public/bower_components/i18next-browser-languagedetector/i18nextBrowserLanguageDetector.min.js"></script>
<script type="text/javascript" src="../public/bower_components/jquery-i18next/jquery-i18next.min.js"></script>
<script src="../public/assets/pages/user-profile.js"></script>
<script src="../public/assets/js/pcoded.min.js"></script>
<script src="../public/assets/js/vartical-layout.min.js"></script>
<script src="../public/assets/js/jquery.mCustomScrollbar.concat.min.js"></script>

<script type="text/javascript" src="../public/assets/js/script.js"></script>

<script type="text/javascript" src="../public/assets/js/modal.js"></script>


<script type="text/javascript" src="../public/assets/js/modalEffects.js"></script>
<script type="text/javascript" src="../public/assets/js/classie.js"></script>

 <!-- JavaScript function for displaying the notification -->
 <?php if (isset($success)): ?>
    <!-- Pop Success Alert -->
    <script>
        var cur_value = 1;
        var progress;
        var loader = new PNotify({
            title: '<?php echo $success; ?>',
            text:
                '<div class="progress progress-striped active" style="margin:0">\
                    <div class="progress-bar bg-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0">\
                        <span class="sr-only">0%</span>\
                    </div>\
                </div>',
            addclass: 'bg-primary',
            icon: 'icon-spinner4 spinner',
            hide: false,
            buttons: { closer: false, sticker: false },
            history: { history: false },
            before_open: function (PNotify) {
                progress = PNotify.get().find('div.progress-bar');
                progress
                    .width(cur_value + '%')
                    .attr('aria-valuenow', cur_value)
                    .find('span')
                    .html(cur_value + '%');

                var timer = setInterval(function () {
                    if (cur_value >= 100) {
                        window.clearInterval(timer);
                        loader.remove();
                        return;
                    }
                    cur_value += 1;
                    progress
                        .width(cur_value + '%')
                        .attr('aria-valuenow', cur_value)
                        .find('span')
                        .html(cur_value + '%');
                }, 65);
            },
        });

        console.log('Success notification created:', loader);
    </script>
<?php endif; ?>

    <?php if (isset($err)): ?>
    <script>
        
    var loader = new PNotify({
        title: 'Failed !',
      text: "<?php echo $err; ?>.",
      icon: 'icofont icofont-info-circle',
      type: 'error',
      
    });
    
    </script>
<?php endif; ?>

<?php if (isset($info)): ?>
    <script>
          var loader = new PNotify({
        title: 'Failed !',
      text: "<?php echo $info; ?>.",
      icon: 'icofont icofont-info-circle',
      type: 'info',
      
    });

        console.log('Info notification created:',loader);
    </script>
<?php endif; ?>

