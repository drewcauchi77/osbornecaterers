<?php
// Required to get the slug of the page to eliminate and show accordingly.
global $post;

$post_id = ($is_subpage) ? $parent_id : $post->ID;
$header_text = get_field('header_text', $post_id);

$background_image = get_field('background_image');
$image = ($background_image) ? $background_image : get_template_directory_uri() . '/images/villa-arrigo.jpg';

$isProduct = is_product();
// Get whether a category is a product category or not
$isCategory = is_product_category();

if($isCategory == true){
    $cate = get_queried_object();
    $thumbnail_id = get_woocommerce_term_meta( $cate->term_id, 'thumbnail_id', true );
    // Get the url of the image
    $categoryImage = wp_get_attachment_url( $thumbnail_id );
}
?>

<?php if($isProduct !== true){ ?>
    <header class="entry-header bg-hover">
        <?php if($isCategory !== true){ ?>
            <div class="background">
                <img src="<?php echo $image; ?>" />
            </div>
        <?php }else{ ?>
            <div class="background">
                <img src="<?php echo $categoryImage; ?>" style="filter: grayscale(100%);"/>
            </div>
        <?php } ?>
        
        <?php 
        // To hide wrapper in Online Shop Page and if page is a product
        if($post->post_title !== "Online Shop" && $isCategory !== true){ ?>
            <div class="wrapper">

                <div class="header-container">
                    <h1 class="entry-title"><?php echo get_the_title($post_id); ?></h1>
                    
                    <?php if ($header_text): ?>
                        <p><?php echo $header_text; ?></p>
                    <?php endif; ?>

                    <?php if (have_rows('page_contents', $post_id)): ?>

                        <ol class="contents">
                        
                        <?php 
                        $i = 0;
                        while (have_rows('page_contents', $post_id)): the_row();
                            $content = get_sub_field('content');

                            if ($content):
                                $i += 1;
                                $id = '#' . $i;
                        ?>

                            <li><a href="<?php echo $id; ?>" class="main-link"><?php echo $content; ?></a></li>

                            <?php endif; ?>

                        <?php endwhile; ?>

                        </ol>
                    
                    <?php endif; ?>
                </div>

            </div>
        <?php } ?>
    </header><!-- .entry-header -->
<?php } ?>