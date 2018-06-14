<h1>Moonset Sidebar Options</h1>
<?php 
       settings_errors();
       $profile     = esc_attr(get_option( 'media_uploader'));
       $Firstname   = esc_attr(get_option('first_name')); // get the firstname
       $Lastname    = esc_attr(get_option('last_name'));  // get the lastname
       $description = esc_attr(get_option('user_description'));  // get the description
       $twitter     = esc_attr(get_option('twitter_handler'));  // get the twitter link
       $facebook    = esc_url(get_option('facebook_handler'));  // get the facebook link
       $google      = esc_url(get_option('google_handler'));  // get the google link

?>
<!-- Preview For Sidebar in Custom Menu [Admin Area] -->
<div class="moon-sidebar-preview">
    <div id="pic-preview" class="moon-picture"
        style="background-image: url(<?php echo !empty($profile) ? $profile :  get_template_directory_uri() . '/inc/img/avatar.png' ?>)" alt="<?php bloginfo('name') ?>">
    </div>
    <!-- Full name Section  -->
    <div class="moon-fullname">
        <p>
            <!-- if the name or the last namme is empty put the default paragraph -->
            <?php echo !empty($Firstname) || !empty($Lastname) ? $Firstname . ' ' . $Lastname : 'Your firstname and Lastname'?>
        </p>
    </div>
    <!-- Description Section -->
    <div class="moon-desc">
        <p>
            <!-- if the description is empty put the default description -->
            <?php echo !empty($description) ? $description : 'Write Something About Your Self' ?>
        </p>
    </div>
    <!-- Social Media Section -->
    <div class="moon-social">
        <p>
            <!-- if there's no social media link put the offcial website link -->
            <span class="social"><a target="_blank" href="<?php echo !empty($facebook) ? $facebook : 'https://facebook.com' ?>" ><i class="fab fa-facebook"></i></a></span>
            <span class="social"><a target="_blank" href="<?php echo !empty($twitter) ? $twitter : 'https://twitter.com' ?>" ><i class="fab fa-twitter"></i></a></span>
            <span class="social"><a target="_blank" href="<?php echo !empty($google) ? $google : 'https://gmail.com' ?>" ><i class="fab fa-google-plus-g"></i></a></span>
        </p>
    </div>
</div>

<form action="options.php" method="post" class="moonset-general-form">
    <?php settings_fields('moonset-settings-group') ?>
    <?php do_settings_sections('oscode_moonset') ?>
    <?php submit_button('Save Changes', 'primary', 'btn-submit')?>
</form>
