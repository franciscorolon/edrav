<script type="text/javascript" src="<?=base_url('assets/plugins/colorpicker/js/colorpicker.js')?>"></script>
<script>
    $('#myModal').on('shown.bs.modal', function() {

        /*$('#colorpickerHolder2').ColorPicker({
            flat: true,
            color: '#0000ff',
        	onShow: function (colpkr) {
        		$(colpkr).fadeIn(500);
        		return false;
        	},
        	onHide: function (colpkr) {
        		$(colpkr).fadeOut(500);
        		return false;
        	},
        	onChange: function (hsb, hex, rgb) {
        		$('#colorSelector2 div').css('backgroundColor', '#' + hex);
        	}
        });*/

        $('#colorSelector').ColorPicker({
            color: '#0000ff',
            onShow: function (colpkr) {
                $(colpkr).fadeIn(500);
                return false;
            },
            onHide: function (colpkr) {
                $(colpkr).fadeOut(500);
                return false;
            },
            onChange: function (hsb, hex, rgb) {
                $('#color').val(hex);
                $('#colorSelector div').css('backgroundColor', '#' + hex);
            }
        });

        /*$('#colorpickerHolder2>div').css('position', 'absolute');
        var widt = false;
        $('#colorSelector2').bind('click', function() {
            $('#colorpickerHolder2').stop().animate({height: widt ? 0 : 173}, 500);
            widt = !widt;
        });*/

    });
</script>