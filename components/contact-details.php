<?php

$address_1 = get_field('address_1', 'option');
$address_2 = get_field('address_2', 'option');
$address_3 = get_field('address_3', 'option');
$telephone = get_field('telephone', 'option');
$email = get_field('email', 'option');
$facebook = get_field('facebook', 'option');
$tripadvisor = get_field('tripadvisor', 'option');

$map = get_sub_field('map');
?>

<section id="<?php echo $section_id; ?>">
    <div class="section-container">
        <div class="wrapper">
            <span class="gold-colour">Contact</span>
            <h1>Contact Details</h1>
            <div class="contact-details">
                <div class="address">
                    <h2>Address:</h2>
                    <?php echo $address_1; ?>,<br>
                    <?php echo $address_2; ?>,<br>
                    <?php echo $address_3; ?>
                </div>
                <div class="contact">
                    <h2>Contact:</h2>
                    <p>Telephone: <?php echo $telephone; ?></p>
                    <p>Email: <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></p>
                </div>
                <div class="social">
                    <h2>Social:</h2>
                    <ul>
                        <li><a href="<?php echo $facebook; ?>" target="_blank">Facebook</a></li>
                        <li><a href="<?php echo $tripadvisor; ?>" target="_blank">TripAdvisor</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="wrapper large">
            <div id="map" class="map" data-lat="<?php echo $map['lat']; ?>" data-lng="<?php echo $map['lng']; ?>"></div>
        </div>
    </div>
</section>