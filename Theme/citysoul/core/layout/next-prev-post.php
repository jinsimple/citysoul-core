<div class="next-back-post">
    <div class="prev-post pull-left col-md-6 col-sm-6 col-xs-12">
        <span class="prev-link text-more text-active">
        	<i class="fa fa-angle-left"></i>
        	<?php previous_post_link('%link', 'Preview post', TRUE); ?> 
        </span>
        <div class="clearfix"></div>
        <span class="text-title link-to-post pull-left">
        	<?php previous_post_link('%link', '%title', TRUE); ?> 
        </span>
    </div>

    <div class="prev-post pull-right col-md-6 col-sm-6 col-xs-12">
        <span class="prev-link text-more pull-right text-active">
        	<?php next_post_link('%link', 'Next post', TRUE); ?> 
        	<i class="fa fa-angle-right"></i>
        </span>
        <div class="clearfix"></div>
        <span class="text-title link-to-post text-right pull-right">
        	<?php next_post_link('%link', '%title', TRUE); ?> 
        </span>
    </div>
</div><!--End .next-back-post-->