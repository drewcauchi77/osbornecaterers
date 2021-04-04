<?php

$menus = get_sub_field('menus');

if ($menus): ?>

<section id="<?php echo $section_id; ?>">
    <div class="section-container">
        <div class="wrapper">
            <div class="gold-colour">Menus</div>
            
            <div class="set-menus pos-r">

            <?php foreach ($menus as $menu):
                $title = get_the_title($menu->ID);
                $price = get_field('price_per_person', $menu->ID);
                $image = get_field('image', $menu->ID); ?>

                <div class="set-menu bg-hover">
                    <div class="background">
                        <img src="<?php echo $image; ?>" />
                    </div>
                    <div class="details">
                        <span class="gold-colour">€<?php echo $price; ?> per person (excl. VAT)</span>
                        <h2>
                            <?php echo $title; ?><br>
                            <span class="num-items"><?php echo sizeof(get_field('menu_items', $menu->ID)); ?> items
                        </h2>
                        <a href="<?php echo get_permalink($menu->ID); ?>" class="view-menu btn-link" data-id="<?php echo $menu->ID; ?>">View Menu</a>
                    </div>
                </div>

            <?php endforeach; ?>

                <div class="menu-details popup">
                    <h1></h1>
                    <span class="gold-colour">€<span class="price"></span> per person (excl. VAT)</span>
                    <ul class="menu-items"></ul>
                    <p>Minimum Order is 25 pax</p>
                    <a class="btn-link" href="javascript:;">Book Now</a>
                    <button class="btn-close">Close</button>
                </div>

            </div>
        </div>
    </div>
</section>

<?php endif; ?>