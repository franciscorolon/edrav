<link rel="stylesheet" type="text/css" href="<?=base_url('assets/plugins/bootstrap-datepicker/css/datepicker3.css')?>" media="screen">
<link rel="stylesheet" type="text/css" href="<?=base_url('assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.css')?>" media="screen">
<link rel="stylesheet" type="text/css" href="<?=base_url('assets/plugins/dropzone/dropzone.min.css')?>" />
<style>
#incidencia{ min-height:80px; }
#timepicker, .form-control.plaintext[readonly]{ color:#000000;}
</style>
<style>
    #drop_file_zone {
        background-color: #EEE;
        border: 4px dashed #b4b9be;
        width: 100%;
        height: auto;
        min-height: 200px;
        padding: 8px;
        font-size: 18px;
    }

    #drag_upload_file {
        width:50%;
        margin:70px auto 0;
    }
    #drag_upload_file p {
        text-align: center;
        font-size: 20px;
        color: #a0a5aa;
    }
    #drag_upload_file #selectfile {
        display: none;
    }

    .max-upload-size small{
	    font-size: 12px;
		margin: .5em 0;
    }

    .media-content{
        height: 400px;
        width: 100%;
        overflow-y: scroll;
        padding: 15px;
    }

    .media-content img{
	    max-height: 100px;
    }

    .media-content .no-results{
	    width: 50%;
		margin: 70px auto 0;
		text-align: center;
    }

    .select-image-wrap.selected {
		display: block;
	}

    .select-image-wrap {
		padding-top: 0px;
		padding-right: 7px;
		position: absolute;
		right: 30px;
		bottom: 0;
		display: none;
	}

	.select-image-wrap a {
		color: #000;
	}

	.select-image{
    	display: none;
	}

	.card .card-header{
        padding: 10px 20px !important;
	}

    .card .card-header .card-title{
        text-transform: none !important;
    }

    .card .card-header .card-controls{
        margin-top: 20px !important;
    }

	.card.card-image{
    	margin-bottom: 0 !important;
	}

	.card.card-image .card-header{
    	padding: 0px 15px;
	}

	.card.card-image .card-body{
    	min-height: 400px;
	}

	.card-footer{
    	background: none !important;
    	border:none;
	}

	.timeline-content{
    	float: right !important;
	}

	.event-date{
    	left: auto !important;
        right: 118% !important;
        text-align: right !important;
	}

	.container-fluid.sm-p-l-5.bg-master-lighter{
    	padding-left: 0 !important;
	}

	.timeline-container.center.top-circle{
    	margin: 0 !important;
	}

	.card-dropzone h4{
    	padding: 10px 20px;
	}

	.expediente{
    	min-height: 200px !important;
	}

	.drag-n-drop .dz-default.dz-message{
        /*margin-left: 25% !important;
        padding-top: 15% !important;*/
        font-size: 20px;
    }

    .fancybox-button--comment {
        padding: 14px;
    }

    .fancybox-button--comment svg path {
        stroke-width: 0;
    }

    .fancybox-caption textarea{
        height: 100px;
    }

    .fancybox-caption-wrap {
        pointer-events: auto !important;
        /*pointer-events: all !important;*/
    }

    .modal.fade.slide-up.disable-scroll{
        z-index: 99999999;
    }
</style>
<style>
/* Advanced example - Customized layout */

@media all and (min-width: 600px) {
    /* Change color for backdrop */
    .fancybox-custom-layout .fancybox-bg {
        background: #fcfaf9;
    }

    .fancybox-custom-layout.fancybox-is-open .fancybox-bg {
        opacity: 1;
    }

    /* Move caption area to the right side */
    .fancybox-custom-layout .fancybox-caption {
        background: #f1ecec;
        bottom: 0;
        color: #6c6f73;
        left: auto;
        padding: 30px 20px;
        right: 44px;
        top: 0;
        width: 256px;
    }

    .fancybox-custom-layout .fancybox-caption h3 {
        color: #444;
        font-size: 21px;
        line-height: 1.3;
        margin-bottom: 24px;
    }

    .fancybox-custom-layout .fancybox-caption a {
        color: #444;
    }

    /* Remove gradient from caption*/
    .fancybox-custom-layout .fancybox-caption::before {
        display: none;
    }

    /* Adjust content area position */
    .fancybox-custom-layout .fancybox-stage {
        right: 60px;
    }

    /* Align buttons at the right side  */
    .fancybox-custom-layout .fancybox-toolbar {
        background: #3b3b45;
        bottom: 0;
        left: auto;
        right: 0;
        top: 0;
        width: 44px;
    }

    /* Remove background from all buttons */
    .fancybox-custom-layout .fancybox-button {
        background: transparent;
    }

    /* Navigation arrows */
    .fancybox-custom-layout .fancybox-navigation .fancybox-button div {
        padding: 2px;
        background: transparent !important;
    }

    .fancybox-custom-layout .fancybox-navigation .fancybox-button[disabled] {
        color: #ddd;
    }

    .fancybox-custom-layout .fancybox-navigation .fancybox-button:not([disabled]) {
        color: #333;
    }

    /* Reposition right arrow */
    .fancybox-custom-layout .fancybox-button--arrow_right {
        right: 308px;
    }
}

@media all and (min-width: 800px) {

  /* Give space around main area */
  .fancybox-custom-layout .fancybox-outer {
    top: 50px;
    left: 50px;
    bottom: 50px;
    right: 50px;
    margin: auto;
    max-width: 1180px;
    max-height: 495px;
    overflow: visible;
    background: #fff;
    box-shadow: 10px 10px 15px rgba(0,0,0,0.3);
    transition: opacity .3s;
  }

  /* Make it to fade-out while closing */
  .fancybox-custom-layout.fancybox-is-closing .fancybox-outer {
    opacity: 0;
  }

  /* Set color for background element */
  .fancybox-custom-layout .fancybox-bg {
    background: #f6f6f6;
  }

  .fancybox-custom-layout.fancybox-is-open .fancybox-bg {
    opacity: 1;
  }

  /* Move caption area to the right side */
  .fancybox-custom-layout .fancybox-caption-wrap {
    top: 0;
    right: 44px;
    bottom: 0;
    left: auto;
    width: 256px;
    padding: 0;
    background: #333;
    pointer-events: all; /* Make text selectable */
    border-right: 1px solid rgba(255,255,255,.08);
  }

  /* Adjust content area position */
  .fancybox-custom-layout .fancybox-stage {
    right: 300px;
  }

  /* Remove top border from the caption */
  .fancybox-custom-layout .fancybox-caption {
    padding: 30px 20px;
    border: 0;
  }

  /* Align buttons at the right side  */
  .fancybox-custom-layout .fancybox-toolbar {
    top: 0;
    right: 0;
    bottom: 0;
    left: auto;
    width: 44px;
    background: #333;
    border-left: 1px solid #222;
  }

  /* Remove background from all buttons */
  .fancybox-custom-layout .fancybox-button,
  .fancybox-custom-layout .fancybox-navigation button:before {
    background: transparent;
  }

  /* Change arrow color */
  .fancybox-custom-layout .fancybox-navigation button {
    /*color: #333 !important;*/
    padding: 10px;
  }

  /* Reposition arrows */
  /*.fancybox-custom-layout .fancybox-button--arrow_left {
    left: -60px;
  }*/

  .fancybox-custom-layout .fancybox-button--arrow_right {
    /*right: -60px;*/
  }

  .fancybox-custom-layout.fancybox-show-thumbs .fancybox-button--arrow_right {
    right: -272px;
  }

}

.listado-item{
    height: 100px;
    margin-bottom: 10px;
}

.listado-item .image{
    height:100px;
}
</style>
