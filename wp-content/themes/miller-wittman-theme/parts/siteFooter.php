<?php
$contact_email = get_field('contact_email', 'options');
?>
<div class="siteFooter">

    <div class="container">
        <div class="siteFooter__top">
            <h5 class="h-2">Let's Talk</h5>
            <?php if( $contact_email ): ?>
                <a class="siteFooter__cta" href="mailto:<?php echo $contact_email ; ?>">
                    <span>Email Us</span>
                    <svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M30.1148 46.1147L33.8855 49.8854L51.7708 32.0001L33.8855 14.1147L30.1148 17.8854L41.5628 29.3334H16.0001V34.6667H41.5628L30.1148 46.1147Z" fill="#AB1A2D"/>
                    </svg>
                </a>
            <?php endif; ?>
        </div>

        <div class="siteFooter__bottom">
            <address class="flow flow--tight">
                <h5 class="text-cap-height"><strong>Miller Wittman</strong></h5>
                <div class="text-cap-height">Minneapolis, MN</div>
                <div class="text-cap-height">(612) 991-0229</div>
                <?php if( $contact_email ): ?>
                    <div class="text-cap-height">
                        <a href="mailto:<?php echo $contact_email; ?>">
                            <?php echo $contact_email; ?>
                        </a>
                    </div>
                <?php endif; ?>
            </address>

            <form method="POST" action="//millerwittman.us16.list-manage.com/subscribe/post?u=8a381db55e7ae148c1382c960&id=5eb9be3e00">
                <strong>Subscribe for updates</strong>
                <div class="siteFooter__subscribe">
                    <input class="siteFooter__textInput" placeholder="Enter email" type="email" name="EMAIL" />
                    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_8a381db55e7ae148c1382c960_5eb9be3e00" tabindex="-1" value=""></div>
                    <button type="submit">
                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15.0573 23.0571L16.9427 24.9425L25.8853 15.9998L16.9427 7.05713L15.0573 8.94246L20.7813 14.6665H8V17.3331H20.7813L15.0573 23.0571Z" fill="#121921"/>
                        </svg>
                    </button>
                </div>
            </form>
        </div>

    </div>

</div>

<div class="bottomline">
    <div class="container">
        <div class="bottomline__layout">
            <div>© <?php echo date( 'Y' ); ?> Miller Wittman Retail Design Group</div>
            <a href="" target="_blank">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6.94048 4.99993C6.94011 5.81424 6.44608 6.54702 5.69134 6.85273C4.9366 7.15845 4.07187 6.97605 3.5049 6.39155C2.93793 5.80704 2.78195 4.93715 3.1105 4.19207C3.43906 3.44699 4.18654 2.9755 5.00048 2.99993C6.08155 3.03238 6.94097 3.91837 6.94048 4.99993ZM7.00048 8.47993H3.00048V20.9999H7.00048V8.47993ZM13.3205 8.47993H9.34048V20.9999H13.2805V14.4299C13.2805 10.7699 18.0505 10.4299 18.0505 14.4299V20.9999H22.0005V13.0699C22.0005 6.89993 14.9405 7.12993 13.2805 10.1599L13.3205 8.47993Z" fill="white"/>
                </svg>
            </a>
        </div>

    </div>
</div>