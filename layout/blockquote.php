<?php if ( $content = get_sub_field( 'content' ) ) : ?>
<div class="blockquoteSection"  data-aos="<?php echo getRandomAnimation(); ?>">
<?php $animation = get_sub_field( 'background_animation'); ?>
	<?php if ( $animation[0] == 'yes' ) : ?>
    <?php include ('shapeAnimation.php') ?>
    <?php endif; ?>
    <div class="wrap">
        <div class="custom-grid centerContent">
            <div class="grid-8 grid-tablet-10">
                <div class="blockquote m-b-l text-center">
                    <?php echo $content; ?>
                </div>
                
                <?php if ( $author = get_sub_field( 'author' ) ) : ?>
                    <div class="blockquoteAuthor grid-12 text-center">
                        <h3> <?php echo $author; ?> </h3>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
