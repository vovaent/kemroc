<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package kemroc
 */

$footer_cta = get_field('footer_cta', 'option'); // title link hide
$footer_logo = get_field('footer_logo', 'option');
$socials = get_field('socials', 'option'); // icon link
$copyright = get_field('copyright', 'option');
$links = get_field('footer_links', 'option'); // link
$company = get_field('company', 'option'); // company_name address
$contacts = get_field('footer_contacts', 'option'); //link

$footer_nav = get_field('footer_nav', 'option'); //title links-link

?>

<footer class="footer">
	<? if ($footer_cta && !$footer_cta['hide']) : ?>
		<section class="cta-wide">
			<div class="container">
				<div class="cta-wide__inner">
					<div class="cta-content">
						<? if ($footer_cta['title']) : ?>
							<h3 class="title"><?= $footer_cta['title']; ?></h3>
						<? endif; ?>

					</div>
					<? if ($footer_cta['link']) : ?>
						<div class="cta-more">
							<svg width="109" height="17" viewBox="0 0 109 17" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M107.578 10.4806L101.002 15.7232C100.323 16.2638 99.9487 16.5 99.2227 16.5H97.0202C96.2716 16.5 95.7318 16.0993 95.7318 15.4643C95.7318 15.041 95.9499 14.6743 96.2941 14.406L102.783 9.30132C103.045 9.09343 103.135 8.92523 103.135 8.73624C103.135 8.54725 103.062 8.38661 102.783 8.17116L95.7111 2.64127C95.3669 2.3729 95.1487 1.98169 95.1487 1.55835C95.1487 0.898771 95.6866 0.5 96.4371 0.5H98.9425C99.6685 0.5 100.045 0.732459 100.722 1.27675L107.613 6.79719C108.793 7.74026 108.987 8.23919 108.987 8.69088C108.987 9.09532 108.734 9.56213 107.578 10.4825" fill="#5F5F5F" />
								<path d="M88.5507 10.4806L81.975 15.7232C81.296 16.2638 80.9217 16.5 80.1957 16.5H77.9931C77.2445 16.5 76.7047 16.0993 76.7047 15.4643C76.7047 15.041 76.9229 14.6743 77.2671 14.406L83.7562 9.30132C84.0177 9.09343 84.108 8.92523 84.108 8.73624C84.108 8.54725 84.0346 8.38661 83.7562 8.17116L76.684 2.64127C76.3398 2.3729 76.1216 1.98169 76.1216 1.55835C76.1216 0.898771 76.6596 0.5 77.4101 0.5H79.9154C80.6415 0.5 81.0176 0.732459 81.6948 1.27675L88.5864 6.79719C89.7657 7.74026 89.9595 8.23919 89.9595 8.69088C89.9595 9.09532 89.7074 9.56213 88.5507 10.4825" fill="#5F5F5F" />
								<path d="M69.5236 10.4806L62.948 15.7232C62.269 16.2638 61.8947 16.5 61.1686 16.5H58.9661C58.2175 16.5 57.6777 16.0993 57.6777 15.4643C57.6777 15.041 57.8959 14.6743 58.2401 14.406L64.7292 9.30132C64.9906 9.09343 65.0809 8.92523 65.0809 8.73624C65.0809 8.54725 65.0076 8.38661 64.7292 8.17116L57.657 2.64127C57.3128 2.3729 57.0946 1.98169 57.0946 1.55835C57.0946 0.898771 57.6325 0.5 58.383 0.5H60.8884C61.6144 0.5 61.9906 0.732459 62.6677 1.27675L69.5594 6.79719C70.7387 7.74026 70.9324 8.23919 70.9324 8.69088C70.9324 9.09532 70.6804 9.56213 69.5236 10.4825" fill="#5F5F5F" />
								<path d="M50.4966 10.4806L43.9209 15.7232C43.2419 16.2638 42.8676 16.5 42.1416 16.5H39.9391C39.1905 16.5 38.6506 16.0993 38.6506 15.4643C38.6506 15.041 38.8688 14.6743 39.213 14.406L45.7022 9.30132C45.9636 9.09343 46.0539 8.92523 46.0539 8.73624C46.0539 8.54725 45.9805 8.38661 45.7022 8.17116L38.6299 2.64127C38.2857 2.3729 38.0676 1.98169 38.0676 1.55835C38.0676 0.898771 38.6055 0.5 39.356 0.5H41.8613C42.5874 0.5 42.9636 0.732459 43.6407 1.27675L50.5323 6.79719C51.7117 7.74026 51.9054 8.23919 51.9054 8.69088C51.9054 9.09532 51.6534 9.56213 50.4966 10.4825" fill="#5F5F5F" />
								<path d="M31.4696 10.4806L24.8939 15.7232C24.2149 16.2638 23.8406 16.5 23.1146 16.5H20.9121C20.1635 16.5 19.6236 16.0993 19.6236 15.4643C19.6236 15.041 19.8418 14.6743 20.186 14.406L26.6752 9.30132C26.9366 9.09343 27.0269 8.92523 27.0269 8.73624C27.0269 8.54725 26.9535 8.38661 26.6752 8.17116L19.6029 2.64127C19.2587 2.3729 19.0406 1.98169 19.0406 1.55835C19.0406 0.898771 19.5785 0.5 20.329 0.5H22.8343C23.5604 0.5 23.9366 0.732459 24.6137 1.27675L31.5053 6.79719C32.6847 7.74026 32.8784 8.23919 32.8784 8.69088C32.8784 9.09532 32.6263 9.56213 31.4696 10.4825" fill="#5F5F5F" />
								<path d="M12.4426 10.4806L5.86693 15.7232C5.18792 16.2638 4.81362 16.5 4.08759 16.5H1.88504C1.13644 16.5 0.596622 16.0993 0.596622 15.4643C0.596622 15.041 0.814808 14.6743 1.15901 14.406L7.64815 9.30132C7.90959 9.09343 7.99987 8.92523 7.99987 8.73624C7.99987 8.54725 7.92652 8.38661 7.64815 8.17116L0.575932 2.64127C0.231725 2.3729 0.0135422 1.98169 0.0135422 1.55835C0.0135422 0.898771 0.551479 0.5 1.30196 0.5H3.80733C4.53336 0.5 4.90954 0.732459 5.58667 1.27675L12.4783 6.79719C13.6576 7.74026 13.8514 8.23919 13.8514 8.69088C13.8514 9.09532 13.5993 9.56213 12.4426 10.4825" fill="#5F5F5F" />
							</svg>

							<a href="<?= $footer_cta['link']['url']; ?>" class="btn btn-accent btn-rounded arrow-right"><?= $footer_cta['link']['title']; ?></a>
						</div>
					<? endif; ?>
				</div>
			</div>
		</section>
	<? endif; ?>
	<div class="container">
		<div class="footer__inner">
			<div class="col-1">
				<? if ($footer_logo) : ?>
					<a href="<?= site_url(); ?>" class="footer-logo"><img src="<?= $footer_logo['url']; ?>" alt="<?= $footer_logo['alt']; ?>"></a>
				<? endif; ?>
				<? if ($socials) : ?>
					<ul class="socials">
						<? foreach ($socials as $item) : ?>
							<li>
								<a href="<?= $item['link']['url']; ?>"><img src="<?= $item['icon']['url']; ?>" alt=""></a>
							</li>
						<? endforeach; ?>
					</ul>
				<? endif; ?>
				<? if ($copyright) : ?>
					<div class="copyright desktop"><?= $copyright; ?></div>
				<? endif; ?>
				<? if ($links) : ?>
					<ul class="footer-links desktop">
						<? foreach ($links as $item) : ?>
							<li>
								<a href="<?= $item['link']['url']; ?>"><?= $item['link']['title']; ?></a>
							</li>
						<? endforeach; ?>
					</ul>
				<? endif; ?>
			</div>
			<div class="col-2">
				<div class="footer-info">
					<? if ($company) : ?>
						<div class="footer-info__left">
							<? if ($company['company_name']) : ?>
								<span class="company-name"><?= $company['company_name']; ?></span>
							<? endif; ?>

							<? if ($company['address']) : ?>
								<div class="company-address"><?= $company['address']; ?></div>
							<? endif; ?>
						</div>
					<? endif; ?>
					<? if ($contacts) : ?>
						<div class="footer-info__right">
							<? foreach ($contacts as $item) : ?>
								<a href="<?= $item['link']['url']; ?>"><?= $item['link']['title']; ?></a>
							<? endforeach; ?>
						</div>
					<? endif; ?>
				</div>
				<? if ($footer_nav) : ?>
					<div class="footer-nav">
						<? foreach ($footer_nav as $item) : ?>
							<div class="footer-nav__item">
								<? if ($item['title']) : ?>
									<span class="title"><?= $item['title']; ?></span>
								<? endif; ?>
								<? if ($item['links']) : ?>
									<ul>
										<? foreach ($item['links'] as $link) : ?>
											<li>
												<a href="<?= $link['link']['url']; ?>"><?= $link['link']['title']; ?></a>
											</li>
										<? endforeach; ?>
									</ul>
								<? endif; ?>
							</div>
						<? endforeach; ?>
					</div>
				<? endif; ?>
				<? if ($copyright) : ?>
					<div class="copyright mobile"><?= $copyright; ?></div>
				<? endif; ?>
				<? if ($links) : ?>
					<ul class="footer-links mobile">
						<? foreach ($links as $item) : ?>
							<li>
								<a href="<?= $item['link']['url']; ?>"><?= $item['link']['title']; ?></a>
							</li>
						<? endforeach; ?>
					</ul>
				<? endif; ?>
			</div>
		</div>
	</div>
</footer>
<?php wp_footer(); ?>
</div>
</body>

</html>