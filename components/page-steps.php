<?php 
$section_header = get_sub_field('section_header');
$main_header = get_sub_field('main_header');

if (have_rows('steps')):
?>

<section id="<?php echo $section_id; ?>">
    <div class="section-container">
        <div class="wrapper">
            <div class="sections steps">
                <span class="gold-colour"><?php echo $section_header; ?></span>
                <h1><?php echo $main_header; ?></h1>
            
            <?php while (have_rows('steps')): the_row();
                // variables
                $title = get_sub_field('title');
                $step_title = get_sub_field('step_title');
                $image = get_sub_field('image');
                $content = get_sub_field('content');
            ?>
                    <div class="section step">

                        <div class="step-title">
                            <div class="line"></div>
                            <span class="title"><?php echo $step_title; ?></span>
                            <div class="line"></div>
                        </div>

                        <?php if ($image): ?>

                        <div class="images">
                            <img src="<?php echo $image; ?>" />
                        </div>

                        <?php endif; ?>

                        <div class="section-content">
                            <h2><?php echo $title; ?></h2>
                            <div class="content">
                                <?php echo $content; ?>
                            </div>
                        </div>
                    </div>

            <?php endwhile; ?>

            </div>
        </div>
    </div>
</section>

<?php endif; ?>