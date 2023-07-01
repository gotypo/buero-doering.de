<?php
/**
 * Custom Footer
 *
 * @package      Bootstrap for Genesis
 * @since        1.0
 * @link         http://webdevsuperfast.github.io
 * @author       Rotsen Mark Acob <webdevsuperfast.github.io>
 * @copyright    Copyright (c) 2015, Rotsen Mark Acob
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
*/


/*-------------------
	FOOTER REMOVE/ADD
---------------------*/

remove_action('genesis_footer', 'genesis_do_footer');
remove_action('genesis_footer', 'genesis_footer_markup_open', 5);
remove_action('genesis_footer', 'genesis_footer_markup_close', 15);

add_action( 'genesis_footer', 'pagefooter', 30);
function pagefooter() {


    ob_start();
    dynamic_sidebar('footer-sidebar');
    $sidebar = ob_get_contents();
    ob_end_clean();


    register_nav_menu( 'secondary', 'Secondary Menu' );

    $menusettings = array (
        'menu' => 'secondary',
        'theme_location' => 'secondary',
        'depth'          => 0,
        'menu_class'     => 'menu',
        'echo'           => false,
    );


	$out = '<div class="scrollup-button animated" data-bs-toggle="modal" data-bs-target="#newsletter-modal"><span class="material-icons material-symbols-outlined md-60">mark_email_read</span><span class="title">Newsletter</span></div>
            <footer id="footer" class="site-footer">
            
                <div class="footer-gradient d-none">
                    <svg id="footer-gradient-svg" height="100%" width="100%" data-name="Gruppe 107" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1920 1319" class="divider-gradient">
                          <defs>
                            <clipPath id="clip-path">
                              <rect id="Rechteck_30" data-name="Rechteck 30" width="1920" height="1319" fill="#fff" stroke="#707070" stroke-width="1"></rect>
                            </clipPath>
                            <linearGradient id="linear-gradient" x1="0.5" x2="0.5" y2="1" gradientUnits="objectBoundingBox">
                              <stop offset="0" stop-color="var(--primary-color)" stop-opacity="0"></stop>
                              <stop offset="1" stop-color="var(--primary-color)"></stop>
                              <stop offset="1" stop-color="var(--secondary-color)"></stop>
                              <stop offset="1" stop-color="var(--secondary-color)"></stop>
                            </linearGradient>
                            <linearGradient id="linear-gradient-2" x1="0.5" x2="0.5" y2="1" gradientUnits="objectBoundingBox">
                              <stop offset="0" stop-color="var(--primary-color)" stop-opacity="0"></stop>
                              <stop offset="1" stop-color="var(--secondary-color)"></stop>
                            </linearGradient>
                          </defs>
                          <g id="Komponente_3_8" data-name="Komponente 3 – 8">
                            <g id="Gruppe_maskieren_1" data-name="Gruppe maskieren 1" clip-path="url(#clip-path)">
                              <g id="Gruppe_50" data-name="Gruppe 50" transform="translate(-1175.023 0)" opacity="0.7" style="isolation: isolate">
                                <rect id="Rechteck_26" data-name="Rechteck 26" width="3600" height="700" transform="matrix(0.985, 0.174, -0.174, 0.985, 121.554, 0)" fill="url(#linear-gradient)"></rect>
                                <rect id="Rechteck_27" data-name="Rechteck 27" width="3600" height="699.999" transform="matrix(0.985, -0.174, 0.174, 0.985, 21.185, 629.823)" fill="url(#linear-gradient-2)"></rect>
                              </g>
                            </g>
                          </g>
                    </svg>
                </div>
            
                <div class="container pt-3 pb-3">
                    <div class="row">
                        <div class="col-lg-4 col-md-11 col-sm-12 col-xs-12">
                            <h3>Hier findet ihr uns</h3>
                            <p>buero doering<br>
                            Fachhandel für Ereignisse GmbH<br>
                            Rosenthaler Str. 40 / 41<br>
                            in den Hackeschen Höfen, Hof 1, Aufgang 1<br>
                            10178 Berlin</p>
                        </div>
                        <div class="col-lg-4 col-md-11 col-sm-12 col-xs-12">
                            <h3>So erreicht Ihr uns</h3>
                            <p>
                            <a href="mailto:info@buero-doering.de" title="schreib uns eine Mail">info@buero-doering.de</a><br>
                            <a href="www.buero-doering.de" title="webseite - hier bist du ja schon">www.buero-doering.de</a><br>
                            <a href="tel:00493040054178" title="ruf uns an">+49 30 400 54 178</a></p>
                        </div>
                       
                        <div class="col-lg-3 col-md-11 col-sm-12 col-xs-12">
                            <div class="w-100 d-block">
                                <h3>Social Media</h3>
                                <ul class="socialmedia">
                                    <li><a href="https://www.facebook.com/buerodoering/" target="_blank" title="Buero Doering auf Facecbook"><em class="fab fa-facebook-f"></em></a></li>
                                    <li><a href="https://twitter.com/buerodoering" target="_blank" title="Buero Doering auf Twitter"><em class="fab fa-twitter"></em></a></li>
                                    <li><a href="https://www.instagram.com/buerodoering/" target="_blank" title="Buero Doering auf Instagram"><em class="fab fa-instagram"></em></a></li>
                                    <li><a href="https://www.linkedin.com/company/buerodoering%E2%80%93fachhandelf%C3%BCrereignisse/" target="_blank" title="Buero Doering auf LinkedIn"><em class="fab fa-linkedin"></em></a></li>
                                    <li><a href="https://www.youtube.com/c/FachhandelF%C3%BCrEreignisse" target="_blank" title="Buero Doering auf YouTube"><em class="fab fa-youtube"></em></a></li>
                                </ul>
                            </div>
                            <div class="w-100 d-block mb-5 mb-xl-0 mb-xs-5 mt-0 mt-xl-5 mt-lg-5 mt-md-0">
                               <h3>Part of</h3>
                               <a href="https://www.keychange.eu/" title="Part of keychange" target="_blank">
                                    <img src="/wp-content/themes/bootstrap-doering/assets/images/logo-keychange.svg" class="logo logo-keychange mb-4" alt="Part of Keychange" />                               
                                </a>
                               <a href="https://www.musicdeclares.net/de/" title="Part of MDE" target="_blank">
                                    <img src="/wp-content/themes/bootstrap-doering/assets/images/logo-mde.svg" class="logo logo-keychange" alt="Part of MDE" />                               
                                </a>
                            </div>

                        </div>
                        <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">'.wp_nav_menu( $menusettings ).'</div>

                    </div>
                </div>
            </footer>';

	echo $out;
}

add_action( 'genesis_footer', 'newslettermodal', 40);
function newslettermodal() {


	$out = ' 
 
 <div id="newsletter-modal" class="modal fade" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Newsletter Anmeldung</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

<div id="mc_embed_signup">
                <form action="https://buero-doering.us9.list-manage.com/subscribe/post?u=442272b6e072ecb6373ab67e5&amp;id=5a235bec13&amp;v_id=4409&amp;f_id=001e12e1f0" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                    <div id="mc_embed_signup_scroll">
                    <h3>Abonniere uns!</h3>
                    </label>
                        <input type="email" placeholder="E-Mail Adresse *" value="" name="EMAIL" class="required email form-control" id="mce-EMAIL" required>
                        <span id="mce-EMAIL-HELPERTEXT" class="helper_text"></span>
                    </div>
                    <div id="mergeRow-gdpr" class="mergeRow gdpr-mergeRow content__gdprBlock mc-field-group">
                        <div class="content__gdpr">
                            <label>Datenschutzerklärung</label>
                            <p class="small">buero doering - Fachhandel für Ereignisse GmbH verwendet Ihre Daten, die Sie über dieses Formular zur Verfügung stellen, um mit Ihnen in Kontakt zu treten und Sie über Aktuelles aus dem Fachhandel für Ereignisse zu informieren und Ihnen Empfehlungen aus unserem Netzwerk auszusprechen. Bitte teilen Sie uns mit, auf welche Weise Sie von uns hören möchten:</p>
                            <fieldset class="mc_fieldset gdprRequired mc-field-group d-none" name="interestgroup_field">
                            <label class="checkbox subfield" for="gdpr_5685"><input type="checkbox" id="gdpr_5685" name="gdpr[5685]" value="Y" class="av-checkbox "><span>E-Mail</span> </label><label class="checkbox subfield" for="gdpr_5689"><input type="checkbox" id="gdpr_5689" name="gdpr[5689]" value="Y" class="av-checkbox "><span>Newsletter</span> </label>
                            </fieldset>
                            <p class="small">Sie können Ihre Meinung jederzeit ändern, indem Sie auf den Abmeldelink in der Fußzeile jeder E-Mail klicken, die Sie von uns erhalten, oder indem Sie uns über info@buero-doering.de kontaktieren. Wir werden Ihre Daten mit Respekt behandeln. Für weitere Informationen über unsere Datenschutzpraktiken besuchen Sie bitte unsere Website. Indem Sie unten klicken, stimmen Sie zu, dass wir Ihre Daten in Übereinstimmung mit diesen Bedingungen verarbeiten dürfen.</p>
                        </div>
                    </div>
                    <div style="position: absolute; left: -5000px;" aria-hidden="true">
                        <input type="text" name="b_442272b6e072ecb6373ab67e5_5a235bec13" tabindex="-1" value="">
                    </div>
                    <div class="clear">
                        <input type="submit" value="Anmelden" name="subscribe" id="mc-embedded-subscribe" class="btn">
                    </div>
                </div>
            </form>
            </div>

      </div>
    </div>
  </div>
</div>

 
 

    ';

	echo $out;
}


/*-------------------
	REMOVE FOOTER-TEXT
---------------------*/

add_filter('genesis_footer_creds_text', 'sp_footer_creds_filter');
function sp_footer_creds_filter( $creds ) {
	$creds = '';
	return $creds;
}