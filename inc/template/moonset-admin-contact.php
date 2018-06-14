<h1>Settings Options</h1>

<?php settings_errors() ?>

<p> User this shortcode to activate the contact form inside a page or a post</p>
<code> [contact_form] </code>

<form action="options.php" method="post">
    <?php settings_fields( 'moonset-contact-settings' ) ?>
    <?php do_settings_sections( 'moon_contact_settings_section' ) ?>
    <?php submit_button() ?>
</form>