<?php

$main_header = get_field('main_header');
$main_text = get_field('main_text');
$main_button_text = get_field('main_button_text');
$main_button_link = get_field('main_button_link');

// Commented out because the second slide is not required anymore

// $secondary_header = get_field('secondary_header');
// $secondary_text = get_field('secondary_text');
// $secondary_button_text = get_field('secondary_button_text');
// $secondary_button_link = get_field('secondary_button_link');

$background_image = get_field('background_image');
$image = ($background_image) ? $background_image : get_template_directory_uri() . '/images/villa-arrigo.jpg';

?>

<header class="entry-header bg-hover">
    <div class="background">
        <img src="<?php echo $image; ?>" />
    </div>
    <div class="wrapper">

        <div class="header-container home">
            <h1 class="entry-title home"><?php echo $main_header; ?></h1>
            
            <?php if ($main_text): ?>
                <p><?php echo $main_text; ?></p>
            <?php endif; ?>

            <a href="<?php echo $main_button_link; ?>" class="btn-link home-main"><?php echo $main_button_text; ?></a>
            
            <?php // Commented out because the second slide is not required anymore ?>
            <!-- <div class="header-container secondary">
                <h2 class="entry-title"><?php //echo $secondary_header; ?></h2>
                
                <?php //if ($secondary_text): ?>
                    <p><?php //echo $secondary_text; ?></p>
                <?php //endif; ?>

                <a href="mailto:<?php // echo $secondary_button_link; ?>" class="btn-link secondary">Email Now</a>
            </div> -->

        </div>

    </div>
</header><!-- .entry-header -->