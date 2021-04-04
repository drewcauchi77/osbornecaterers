<?php 
$title = get_sub_field('title');
$galleries = get_sub_field('gallery_details');

$link_type = get_sub_field('link_type');
$link_text = get_sub_field('link_text');
$link = get_sub_field($link_type);
$link = ($link_type == 'email') ? 'mailto:' . $link . '?subject=' . $title : $link;

$details = array();

if (have_rows('gallery_details')):
?>

<section id="<?php echo $section_id; ?>">
    <div class="section-container">
        <div class="wrapper">
            <span class="gold-colour"><?php echo $title; ?></span>
        </div>
        <div class="wrapper large">
            <div class="gallery-container">

                <?php if (have_rows('gallery_details')): ?>

                <div class="pos-r">
                    <button class="gallery-nav prev prev-next-btn gold">Prev</button>
                    <button class="gallery-nav next prev-next-btn gold">Next</button>

                    <div class="galleries">
                        
                    <?php $cnt = 0;
                    while (have_rows('gallery_details')) : the_row();
                        $cnt += 1;
                        $class_show = ($cnt == 1) ? 'show' : '';

                        $gallery_title = get_sub_field('gallery_title');
                        $gallery = get_sub_field('gallery');

                        if ($gallery):
                            array_push($details, array(
                                'title' => $gallery_title,
                                'img' => $gallery[0]['ID']
                            )); 
                        ?>
                            <ul class="gallery <?php echo $class_show; ?>" data-gallery="<?php echo $cnt; ?>">
                                <?php $image_cnt = 0;
                                foreach ($gallery as $image): 
                                    $image_cnt += 1;
                                    $show_class = ($image_cnt == 1) ? 'show' : ''; ?>

                                    <li class="<?php echo $show_class; ?>" data-index="<?php echo $image_cnt; ?>">
                                        <img src="<?php echo $image['sizes']['large']; ?>" />
                                    </li>
                                <?php endforeach; ?>
                            </ul>

                        <?php endif; ?>

                    <?php endwhile; ?>

                    </div>
                </div>

                <?php endif; ?>

                <div class="gallery-info">
                    <div class="details">
                        
                        <?php $details_cnt = 0;
                        foreach ($details as $detail): 
                            $details_cnt += 1;
                            $class_show = ($details_cnt == 1) ? 'show' : '';
                        ?>
                            <div class="detail large-wrapper-padding <?php echo $class_show; ?>" data-gallery="<?php echo $details_cnt; ?>">
                                <h2><?php echo $detail['title']; ?></h2>
                            </div>
                        <?php endforeach; ?>

                    </div>

                    <div class="thumbnails">

                        <?php $details_cnt = 0;
                        foreach ($details as $detail): 
                            $details_cnt += 1;
                            $class_show = ($details_cnt == 1) ? 'show' : '';
                        ?>
                            <div class="thumbnail <?php echo $class_show; ?>" data-gallery="<?php echo $details_cnt; ?>">
                                <div class="frame">
                                    <?php echo wp_get_attachment_image($detail['img'], 'full'); ?>
                                </div>
                                <span class="gold-colour full-line"><?php echo $detail['title']; ?></span>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>
                <div class="large-wrapper-padding">
                    <a href="<?php echo $link; ?>" class="btn-link"><?php echo $link_text; ?></a>
                </div>

            </div>
        </div>
    </div>
</section>

<?php endif; ?>