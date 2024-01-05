            </div>
          <!-- END CONTAINER FLUID -->
        </div>
        <!-- END PAGE CONTENT -->
        <!-- START FOOTER -->
        <div class="container-fluid container-fixed-lg footer">
          <div class="copyright sm-text-center">
            <p class="small no-margin pull-left sm-pull-reset">
              <span class="hint-text">Copyright © <?=date('Y')?></span>
              <span class="font-montserrat">EDRAV</span>.
              <span class="hint-text">Todos los derechos Reservados.</span>
              <span class="sm-block"><a href="#" class="m-l-10">Políticas de Privacidad</a></span>
            </p>
            <p class="small no-margin pull-right sm-pull-reset">
                <span class="hint-text">Desarrollado por ®</span>
                <a target="_blank" href="https://www.pix2byte.com">Pix2byte</a>
            </p>
            <div class="clearfix"></div>
          </div>
        </div>
        <!-- END FOOTER -->
      </div>
      <!-- END PAGE CONTENT WRAPPER -->
    </div>
    <!-- END PAGE CONTAINER -->
    <!-- BEGIN VENDOR JS -->
    <script type="text/javascript" src="<?=base_url('assets/plugins/feather-icons/feather.min.js')?>"></script>
        <!-- BEGIN VENDOR JS -->
    <script type="text/javascript" src="<?=base_url('assets/plugins/pace/pace.min.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/plugins/jquery/jquery-3.2.1.min.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/plugins/modernizr.custom.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/plugins/jquery-ui/jquery-ui.min.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/plugins/popper/umd/popper.min.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/plugins/bootstrap/js/bootstrap.min.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/plugins/jquery/jquery-easy.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/plugins/jquery-unveil/jquery.unveil.min.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/plugins/jquery-ios-list/jquery.ioslist.min.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/plugins/jquery-actual/jquery.actual.min.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js')?>"></script>
    <!-- END VENDOR JS -->
    <script type="text/javascript" src="<?=base_url('assets/plugins/tether/js/tether.min.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/plugins/jquery-bez/jquery.bez.min.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/plugins/imagesloaded/imagesloaded.pkgd.min.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/plugins/classie/classie.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/plugins/fancybox/jquery.fancybox.min.js')?>"></script>
    <!-- BEGIN CORE TEMPLATE JS -->
    <script type="text/javascript" src="<?=base_url('assets/pages/js/pages.js')?>"></script>
    <!-- END CORE TEMPLATE JS -->
    <!-- BEGIN PAGE LEVEL JS -->
    <script type="text/javascript" src="<?=base_url('assets/js/scripts_alt.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/js/card.js')?>"></script>
    <!-- END PAGE LEVEL JS -->
    <script type="text/javascript" src="<?=base_url('assets/js/custom_dialogs.js') ?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/js/functions.js') ?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/js/result.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.26.29/dist/sweetalert2.all.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            RootJS = '<?= base_url() ?>';
            Result = new Result();
            <?php
            if (isset($link_active) && (is_array($link_active) || is_object($link_active) ) ) {
                foreach ($link_active as $lnk) {
            ?>
            if($("#<?= $lnk ?>").children("ul").length) {
                // the clicked on <li> has a <ul> as a direct child
                $("#<?= $lnk ?>").addClass('open active');
                $("#<?= $lnk?>").children('ul').css('display', 'block');
            }else{
                $("#<?= $lnk ?>").addClass('active');
            }
            <?php
                }
            }
            ?>
      });
    </script>
    <?=isset($js)?$js:''?>
  </body>
</html>