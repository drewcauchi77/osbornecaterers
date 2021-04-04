<?php

// Gets all the product categories of Woocommerce
// Hide empty to set to true to hide empty product categories
$args = array(
    'taxonomy'   => 'product_cat',
    'orderby'    => 'name',
    'order'      => 'ASC', 
    'hide_empty' => false,
);
$product_categories = get_terms($args);
?>

<div class="wrapper product-categories-container">

    <?php
    // Going through the categories
    foreach($product_categories as $category){

        // Check if category has a parent to show it in the header of the same category
        if($category->parent !== 0){
            $parentCategory = get_term_by('id', $category->parent, 'product_cat');
        }

        // When the two categories are seasonal items and uncategorized - do nothing - no show
        if($category->name !== 'Seasonal Items' && $category->name !== 'Uncategorized'){
            
            // Get the thumbnail id image of the product category
            $thumbnail_id = get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true );
            
            // Get the url of the image
            $image = wp_get_attachment_url( $thumbnail_id ); ?>
            <div class="single-category-box" style="background-image:url('<?php echo $image; ?>');">

                <div class="background-container">
                    <div class="category-details">
                        <?php 
                        // Get the parent category and show parent category name if not empty
                        if($parentCategory->name !== ''){ ?>
                            <span class="parent-category-name"><?php echo $parentCategory->name; ?></span>
                        <?php } ?>
                        <h2 class="category-name"><?php echo $category->name; ?></h2>
                        <div class="view-products">
                            <?php $link = get_term_link( $category->term_id, 'product_cat' );?>
                            <a href="<?php echo $link; ?>">
                                <span class="view-text">VIEW PRODUCTS</span>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
            
        <?php
            // Reset parent category to empty otherwise it will keep showing previous set parent category
            $parentCategory = '';   
        }

    }
    ?>

</div>