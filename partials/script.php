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
                    <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0">\
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

