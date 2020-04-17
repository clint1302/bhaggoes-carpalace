<style>
.main-navigation ul a {
	    color: #0bcafa;
		font-size: 14px;
    font-weight: bold;
	padding: 32px 14px 17px;
}
.active{
color:red !important
}
</style>
  <script>
    $(document).ready(function() {
        var url = window.location; 
        var element = $('li a').filter(function() {
        return this.href == url || url.href.indexOf(this.href) == 0; }).parent().addClass('active');
        if (element.is('li')) { 
             element.addClass('active').parent().parent('li').addClass('active')
         }
    });
    </script>
<header id="header" style="border-bottom: 12px solid white;">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
					<div class="cs-logo">
						<div class="cs-media"  style="padding:0px !Important">
							<figure><a href="index.php"><img src="assets/images/new_logo.png" alt="" /></a></figure>
						</div>
					</div>
				</div>
				<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
					<div class="cs-main-nav pull-right">
						<nav class="main-navigation">
							<ul>
								<li><a href="index.php" id="a1"  class="" onclick="a();">Home</a></li>
								<li><a href="auto-grid.php" class="" id="a2" onclick="b();">Inventory</a></li>
								<li><a href="auto-grid-preowned.php" class="" id="a3" onclick="c();">Pre-owned cars</a></li>
								<li><a href="auto-discount-cars.php" class="" id="a4" onclick="d();">Extra discount cars</a></li>
								<!--<li><a href="blog-listing-medium.php">News</a></li>-->
								<li><a href="about-us.php"  id="a5" class="" onclick="e();">About Us</a></li>
								<li><a href="contact-us.php" id="a6" class="" onclick="f();">Contact us</a></li>
							</ul>
						</nav>
	</header>
	 