<div class="sharepost">
	<h4>Share this Post</h4>
	<ul class="social">
		<li><a target="_blank" href="https://www.facebook.com/share.php?u=<?php echo base_url() . $page_detail->guid; ?>&title=<?php echo $page_detail->content[$language_id]->title; ?>">&nbsp;<i class="fa fa-facebook fa-lg"></i>&nbsp;</a></li>
		<li><a target="_blank" href="https://twitter.com/home?status=<?php echo base_url() . $page_detail->guid; ?>+<?php echo $page_detail->content[$language_id]->title; ?>"><i class="fa fa-twitter fa-lg"></i></a></li>
		<li><a target="_blank" href="https://plus.google.com/share?url=<?php echo base_url() . $page_detail->guid; ?>"><i class="fa fa-google-plus fa-lg"></i></a></li>
	</ul>
</div>
