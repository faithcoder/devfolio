<?php
/**
 * Homepage contact section.
 *
 * @package devfolio
 */

$contact_label = devfolio_get_theme_mod_value( 'devfolio_contact_label', 'Get in touch' );
$contact_title = devfolio_get_theme_mod_value( 'devfolio_contact_title', 'Contact' );
$contact_desc  = devfolio_get_theme_mod_value( 'devfolio_contact_desc', "Tell me what you're building (or what's broken). I'll reply with a clear next step." );
$contact_email = devfolio_get_theme_mod_value( 'devfolio_contact_email', 'you@example.com' );
$contact_btn   = devfolio_get_theme_mod_value( 'devfolio_contact_button_text', 'Send a Message' );
?>
<!-- Contact -->
<section id="contact" class="devfolio-section">
  <div class="devfolio-container">
    <div class="devfolio-contact-box devfolio-glass devfolio-anim">
      <div class="devfolio-content">
        <p class="devfolio-label"><?php echo esc_html( $contact_label ); ?></p>
        <h2><?php echo esc_html( $contact_title ); ?></h2>
        <p><?php echo esc_html( $contact_desc ); ?></p>
        <a href="mailto:<?php echo antispambot( sanitize_email( $contact_email ) ); ?>" class="devfolio-btn devfolio-btn-glow">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
          <?php echo esc_html( $contact_btn ); ?>
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-7-7 7 7-7 7"/></svg>
        </a>
      </div>
    </div>
  </div>
</section>
