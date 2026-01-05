# woocommerce-category-child-archive-template
On a WooCommerce product category page, it checks whether the current category has child categories.  If it has children, it loads one Elementor archive template.  If it has no children, it loads a different Elementor archive template.

What this code does:
On a WooCommerce product category page, it checks whether the current category has child categories.

If it has children, it loads one Elementor archive template.

If it has no children, it loads a different Elementor archive template.

How it works (in one breath):
Before the page renders, WordPress detects the current product_cat, checks for child terms, selects the correct Elementor template ID, and outputs it inside WooCommerce’s normal layout so the theme stays intact.

Why it’s useful:
You get different layouts for browsing categories vs. buying products—without overriding theme files or duplicating templates.
