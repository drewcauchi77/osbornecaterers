<?php 
$section_bg = get_sub_field('background_colour');
$container_class = ($section_bg != 'no-bg') ? 'section-container ' . $section_bg : 'section-container';
$btn_link_class = ($section_bg != 'no-bg') ? 'btn-link secondary' : 'btn-link';

$bg_image = get_sub_field('background_image');

$sections_cnt = count(get_sub_field('sections'));
$is_slider = ($sections_cnt > 1) ? true : false;
$container_class = ($sections_cnt > 1) ? $container_class . ' slider' : $container_class;

global $post;

if (have_rows('sections')):
?>

<section id="<?php echo $section_id; ?>" class="section-<?php echo $section_id; ?>">
    <div class="<?php echo $container_class; ?> bg-hover <?php if(!$is_slider){ echo $post->post_name . '-section-container'; } ?>">
        <?php if ($bg_image): ?>

        <div class="background">
            <img src="<?php echo $bg_image; ?>" alt="" />
        </div>

        <?php endif; ?>

        <div class="wrapper pos-r">

        <?php if ($is_slider): ?>
            
            <button class="slider-nav prev prev-next-btn hide">Prev</button>
            <button class="slider-nav next prev-next-btn">Next</button>

        <?php endif; ?>

            <div class="sections sr">

    <?php

    $cnt = 0;

    while (have_rows('sections')): the_row();
        $cnt += 1;

        // variables
        $images = get_sub_field('images');
        $section_header = get_sub_field('section_header');
        $main_header = get_sub_field('main_header');
        $content = get_sub_field('content');
        
        $link_type = get_sub_field('link_type');
        $link_text = get_sub_field('link_text');
        $link = get_sub_field($link_type);
        $link = ($link_type == 'email') ? 'mailto:' . $link . '?subject=' . $main_header : $link;

        $section_class = 'section';
        
        if ($is_slider) {
            $section_class .= ($cnt == 1) ?  ' show section-' . $cnt : ' section-' . $cnt;
        }
    ?>

            <div class="<?php echo $section_class; ?>" data-index="<?php echo $cnt; ?>">

                <?php if ($images): 
                    
                    $img_counter = 1;
                    ?>

                <div class="images">

                    <?php foreach ($images as $image): ?>
                        <img src="<?php echo $image['url']; ?>" class="image-<?php echo $img_counter; ?>">
                        <?php $img_counter++; ?>
                    <?php endforeach; ?>

                </div>

                <?php endif; ?>

                <div class="section-content">
                    <span class="gold-colour"><?php echo $section_header; ?></span>
                    <?php if($main_header !== ''){ ?>
                        <h1><?php echo $main_header; ?></h1>
                    <?php } ?>
                    <div class="content">
                        <?php echo $content; ?>
                    </div>
                    
                    <?php if ($link): ?>
                        <a class="<?php echo $btn_link_class; ?>" href="<?php echo $link; ?>"><?php echo $link_text; ?></a>
                    <?php endif; ?>
                </div>
            </div>

    <?php endwhile; ?>

            </div>
        </div>
    </div>
</section>

<?php endif; ?>