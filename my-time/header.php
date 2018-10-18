<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WP_Bootstrap_Starter
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
<script>
  jQuery(document).ready(function(){
      jQuery(".add-task").click(function(){
          jQuery(".new-task").show();
          jQuery(".add-task").hide();
      });

      jQuery(".done").click(function(){
          jQuery(".new-task").hide();
          jQuery(".done").hide();
          jQuery(".add-task").show();
      });

      jQuery('#task').on('shown.bs.modal', function () {
        jQuery('#add-task').trigger('focus')
      })

      jQuery("#myInput").on("keyup", function() {
        var value = jQuery(this).val().toLowerCase();
        jQuery("#myTable tr").filter(function() {
          jQuery(this).toggle(jQuery(this).text().toLowerCase().indexOf(value) > -1)
        });
      });

      jQuery("#sh").click(function(){
        jQuery("input:text").val("Strong Hold");
    });
  });

    var xport = {
    _fallbacktoCSV: true,
    toXLS: function(tableId, filename) {
      this._filename = (typeof filename == 'undefined') ? tableId : filename;

      //var ieVersion = this._getMsieVersion();
      //Fallback to CSV for IE & Edge
      if ((this._getMsieVersion() || this._isFirefox()) && this._fallbacktoCSV) {
        return this.toCSV(tableId);
      } else if (this._getMsieVersion() || this._isFirefox()) {
        alert("Not supported browser");
      }

      //Other Browser can download xls
      var htmltable = document.getElementById(tableId);
      var html = htmltable.outerHTML;

      this._downloadAnchor("data:application/vnd.ms-excel" + encodeURIComponent(html), 'xls');
    },
    toCSV: function(tableId, filename) {
      this._filename = (typeof filename === 'undefined') ? tableId : filename;
      // Generate our CSV string from out HTML Table
      var csv = this._tableToCSV(document.getElementById(tableId));
      // Create a CSV Blob
      var blob = new Blob([csv], { type: "text/csv" });

      // Determine which approach to take for the download
      if (navigator.msSaveOrOpenBlob) {
        // Works for Internet Explorer and Microsoft Edge
        navigator.msSaveOrOpenBlob(blob, this._filename + ".csv");
      } else {
        this._downloadAnchor(URL.createObjectURL(blob), 'csv');
      }
    },
    _getMsieVersion: function() {
      var ua = window.navigator.userAgent;

      var msie = ua.indexOf("MSIE ");
      if (msie > 0) {
        // IE 10 or older => return version number
        return parseInt(ua.substring(msie + 5, ua.indexOf(".", msie)), 10);
      }

      var trident = ua.indexOf("Trident/");
      if (trident > 0) {
        // IE 11 => return version number
        var rv = ua.indexOf("rv:");
        return parseInt(ua.substring(rv + 3, ua.indexOf(".", rv)), 10);
      }

      var edge = ua.indexOf("Edge/");
      if (edge > 0) {
        // Edge (IE 12+) => return version number
        return parseInt(ua.substring(edge + 5, ua.indexOf(".", edge)), 10);
      }

      // other browser
      return false;
    },
    _isFirefox: function(){
      if (navigator.userAgent.indexOf("Firefox") > 0) {
        return 1;
      }

      return 0;
    },
    _downloadAnchor: function(content, ext) {
        var anchor = document.createElement("a");
        anchor.style = "display:none !important";
        anchor.id = "downloadanchor";
        document.body.appendChild(anchor);

        // If the [download] attribute is supported, try to use it

        if ("download" in anchor) {
          anchor.download = this._filename + "." + ext;
        }
        anchor.href = content;
        anchor.click();
        anchor.remove();
    },
    _tableToCSV: function(table) {
      // We'll be co-opting `slice` to create arrays
      var slice = Array.prototype.slice;

      return slice
        .call(table.rows)
        .map(function(row) {
          return slice
            .call(row.cells)
            .map(function(cell) {
              return '"t"'.replace("t", cell.textContent);
            })
            .join(",");
        })
        .join("\r\n");
    }
  };

  var	clsStopwatch = function() {

  		var	startAt	= 0;
  		var	lapTime	= 0;

  		var	now	= function() {
  				return (new Date()).getTime();
  			};

  		this.start = function() {
  				startAt	= startAt ? startAt : now();
  			};

  		this.stop = function() {

  				lapTime	= startAt ? lapTime + now() - startAt : lapTime;
  				startAt	= 0;
  			};


  		this.reset = function() {
  				lapTime = startAt = 0;
  			};


  		this.time = function() {
  				return lapTime + (startAt ? now() - startAt : 0);
  			};
  	};

    var x = new clsStopwatch();
    var $time;
    var clocktimer;

    function pad(num, size) {
    	var s = "0000" + num;
    	return s.substr(s.length - size);
    }

    function formatTime(time) {
    	var h = m = s = ms = 0;
    	var newTime = '';

    	h = Math.floor( time / (60 * 60 * 1000) );
    	time = time % (60 * 60 * 1000);
    	m = Math.floor( time / (60 * 1000) );
    	time = time % (60 * 1000);
    	s = Math.floor( time / 1000 );
    	ms = time % 1000;

    	newTime = pad(h, 2) + ':' + pad(m, 2) + ':' + pad(s, 2) + ':' + pad(ms, 3);
    	return newTime;
    }

    function show() {
    	$time = document.getElementById('time');
    	update();
    }

    function update() {
    	$time.innerHTML = formatTime(x.time());
    }

    function start() {
    	clocktimer = setInterval("update()", 1);
    	x.start();
    }

    function stop() {
    	x.stop();
    	clearInterval(clocktimer);
    }

    function reset() {
    	stop();
    	x.reset();
    	update();
    }

  </script>

</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'wp-bootstrap-starter' ); ?></a>
    <?php if(!is_page_template( 'blank-page.php' ) && !is_page_template( 'blank-page-with-container.php' )): ?>
	<header id="masthead" class="site-header navbar-static-top <?php echo wp_bootstrap_starter_bg_class(); ?>" role="banner">
        <div class="container2">
            <nav class="navbar navbar-expand-xl p-0">
                <div class="navbar-brand">
                    <?php if ( get_theme_mod( 'wp_bootstrap_starter_logo' ) ): ?>
                        <a href="<?php echo esc_url( home_url( '/' )); ?>">
                            <img src="<?php echo esc_attr(get_theme_mod( 'wp_bootstrap_starter_logo' )); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
                        </a>
                    <?php else : ?>
                        <a class="site-title" href="<?php echo esc_url( home_url( '/' )); ?>"><?php esc_url(bloginfo('name')); ?></a>
                    <?php endif; ?>

                </div>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-nav" aria-controls="" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <?php
                wp_nav_menu(array(
                'theme_location'    => 'primary',
                'container'       => 'div',
                'container_id'    => 'main-nav',
                'container_class' => 'collapse navbar-collapse justify-content-end',
                'menu_id'         => false,
                'menu_class'      => 'navbar-nav',
                'depth'           => 3,
                'fallback_cb'     => 'wp_bootstrap_navwalker::fallback',
                'walker'          => new wp_bootstrap_navwalker()
                ));
                ?>

            </nav>
        </div>
	</header><!-- #masthead -->
    <?php if(is_front_page() && !get_theme_mod( 'header_banner_visibility' )): ?>
        <div id="page-sub-header" <?php if(has_header_image()) { ?>style="background-image: url('<?php header_image(); ?>');" <?php } ?>>
            <div class="container2">
                <h1>
                    <?php
                    if(get_theme_mod( 'header_banner_title_setting' )){
                        echo get_theme_mod( 'header_banner_title_setting' );
                    }else{
                        echo 'Wordpress + Bootstrap';
                    }
                    ?>
                </h1>
                <!--<p>
                    <?php
                    if(get_theme_mod( 'header_banner_tagline_setting' )){
                        //echo get_theme_mod( 'header_banner_tagline_setting' );
                }else{
                        echo esc_html__('To customize the contents of this header banner and other elements of your site, go to Dashboard > Appearance > Customize','wp-bootstrap-starter');
                    }
                    ?>
                </p>-->
                <!--<a href="#content" class="page-scroller"><i class="fa fa-fw fa-angle-down"></i></a>-->
                <div class="clearfix">_________________</div>
                <blockquote>
                  <p class="mb-0">It always seems impossible until it's done.</p>
                  <div class="blockquote-footer"><cite title="Nelson Mandela">Nelson Mandela</cite></div>
                </blockquote>
                <?php if ( is_active_sidebar( 'header_callout' ) ) : ?>

                		<?php dynamic_sidebar( 'header_callout' ); ?>

                <?php endif; ?>

            </div>
        </div>
    <?php endif; ?>
	<div id="content" class="site-content">
		<div class="container2">
			<div class="row2">
                <?php endif; ?>
