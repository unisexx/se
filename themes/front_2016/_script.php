<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="media/bootstrap-4.0.0-alpha.2/docs/assets/js/vendor/jquery.min.js"><\/script>')</script>
<script src="media/bootstrap-4.0.0-alpha.2/docs/dist/js/bootstrap.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="media/bootstrap-4.0.0-alpha.2/docs/assets/js/ie10-viewport-bug-workaround.js"></script>
<script src="media/js/holderJS/holder.min.js"></script>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v2.6&appId=136698876474938";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-11835891-3']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>

<script>
$(document).ready(function(){
	$('.newcontent iframe,.newcontent object,.newcontent video').removeAttr("style").removeAttr('width').removeAttr('height').addClass('embed-responsive-item').wrap('<div class="embed-responsive embed-responsive-16by9"></div>');
	
	$(".newcontent img").addClass("img-fluid");
});
</script>