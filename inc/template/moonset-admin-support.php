<h1>Mooset Theme Support</h1>
<?php settings_errors()?>

<form action="options.php" method="post">
    <?php settings_fields( 'moonset-support-settings' ) ?>
    <?php do_settings_sections( 'moon_theme_support_page' ) ?>
    <?php submit_button() ?>
</form>