<footer class="content-info" role="contentinfo">
  <div class="container-fluid">
    <div class="row">
	    <div class="col-md-3 col-sm-4">
		    <?php dynamic_sidebar('sidebar-footer-first-column'); ?>
	    </div>
	      <div id="footer-login" class="col-md-4 col-sm-8">
		      <section class="widget">
		      <?php
		      if ( is_user_logged_in() ) {
			      global $current_user;
			      get_currentuserinfo();
			      echo '<h3>Logged In As ' . $current_user->user_login . '</h3>';
			      echo '<a href="/documents/" class="btn btn-primary btn-lg center-block">Download Documents</a>';
			      echo '<a href="' . admin_url() . 'post-new.php?post_type=document" class="btn btn-primary btn-lg center-block">Upload Documents</a>';
			      echo '<a href="' . wp_logout_url(home_url()) . '" class="btn btn-primary btn-lg center-block">Logout</a>';
		      } else {
			      echo '<h3>Board Member Login</h3>';
			      $args = array(
				      'echo'           => true,
				      'redirect' => ( '/documents/' ),
				      'form_id'        => 'loginform',
				      'label_username' => __( 'Username' ),
				      'label_password' => __( 'Password' ),
				      'label_remember' => __( 'Remember Me' ),
				      'label_log_in'   => __( 'Log In' ),
				      'id_username'    => 'user_login',
				      'id_password'    => 'user_pass',
				      'id_remember'    => 'rememberme',
				      'id_submit'      => 'wp-submit',
				      'remember'       => false,
				      'value_username' => '',
				      'value_remember' => false
			      );
			      wp_login_form( $args );
		      }
		      ?>
		      </section>
	      </div>
	    <div class="col-md-5 col-sm-12">
	      <?php dynamic_sidebar('sidebar-footer-third-column'); ?>
	    </div>
    </div>
  </div>
</footer>
<!-- Piwik -->
<script type="text/javascript">
	var _paq = _paq || [];
	_paq.push(['trackPageView']);
	_paq.push(['enableLinkTracking']);
	(function() {
		var u="//www.resourceatlanta.com/piwik/";
		_paq.push(['setTrackerUrl', u+'piwik.php']);
		_paq.push(['setSiteId', 44]);
		var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
		g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
	})();
</script>
<noscript><p><img src="//www.resourceatlanta.com/piwik/piwik.php?idsite=44" style="border:0;" alt="" /></p></noscript>
<!-- End Piwik Code -->