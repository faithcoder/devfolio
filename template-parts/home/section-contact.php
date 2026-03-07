<?php
/**
 * Homepage contact section.
 *
 * @package devfolio
 */

$contact_label = devfolio_get_theme_mod_value( 'devfolio_contact_label', 'Let us talk support' );
$contact_title = devfolio_get_theme_mod_value( 'devfolio_contact_title', 'Need WordPress Support Help?' );
$contact_desc  = devfolio_get_theme_mod_value( 'devfolio_contact_desc', 'For plugin support workflows, troubleshooting systems, or documentation planning, reach me at acc.arif@gmail.com or +8801769179697.' );
$contact_email = devfolio_get_theme_mod_value( 'devfolio_contact_email', 'acc.arif@gmail.com' );
$contact_btn   = devfolio_get_theme_mod_value( 'devfolio_contact_button_text', 'Email Md Abdullah Al Arif' );
$section_id    = devfolio_get_section_id( 'contact' );

if (
	'' === trim( (string) $contact_label ) &&
	'' === trim( (string) $contact_title ) &&
	'' === trim( (string) $contact_desc ) &&
	'' === trim( (string) $contact_email ) &&
	'' === trim( (string) $contact_btn )
) {
	return;
}
?>
<!-- Contact -->
<section id="<?php echo esc_attr( $section_id ); ?>" class="devfolio-section">
  <div class="devfolio-container">
    <div class="devfolio-contact-box devfolio-glass devfolio-anim">
      <div class="devfolio-content">
        <?php if ( ! empty( $contact_label ) ) : ?>
        <p class="devfolio-label"><?php echo esc_html( $contact_label ); ?></p>
        <?php endif; ?>
        <?php if ( ! empty( $contact_title ) ) : ?>
        <h2><?php echo esc_html( $contact_title ); ?></h2>
        <?php endif; ?>
        <?php if ( ! empty( $contact_desc ) ) : ?>
        <p><?php echo esc_html( $contact_desc ); ?></p>
        <?php endif; ?>
        <?php if ( ! empty( $contact_email ) && ! empty( $contact_btn ) ) : ?>
        <a href="mailto:<?php echo antispambot( sanitize_email( $contact_email ) ); ?>" class="devfolio-btn devfolio-btn-glow">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
          <?php echo esc_html( $contact_btn ); ?>
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-7-7 7 7-7 7"/></svg>
        </a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
