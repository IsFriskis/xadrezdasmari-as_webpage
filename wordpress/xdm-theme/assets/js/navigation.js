/**
 * Navigation functionality for XDM Theme
 *
 * @package XDM_Theme
 */

(function() {
    'use strict';

    // Mobile menu toggle
    const menuToggle = document.querySelector('.menu-toggle');
    const navigation = document.querySelector('.main-navigation');

    if (menuToggle && navigation) {
        menuToggle.addEventListener('click', function() {
            navigation.classList.toggle('toggled');
            
            const expanded = this.getAttribute('aria-expanded') === 'true';
            this.setAttribute('aria-expanded', !expanded);
        });
    }

    // Close menu when clicking outside
    document.addEventListener('click', function(event) {
        if (navigation && navigation.classList.contains('toggled')) {
            if (!navigation.contains(event.target) && !menuToggle.contains(event.target)) {
                navigation.classList.remove('toggled');
                menuToggle.setAttribute('aria-expanded', 'false');
            }
        }
    });

    // Handle keyboard navigation for dropdown menus
    const menuItems = document.querySelectorAll('.main-navigation li');
    
    menuItems.forEach(function(item) {
        const link = item.querySelector('a');
        const submenu = item.querySelector('.sub-menu');
        
        if (link && submenu) {
            // Show submenu on focus
            link.addEventListener('focus', function() {
                item.classList.add('focus');
            });
            
            // Hide submenu when focus leaves the parent item
            item.addEventListener('focusout', function(event) {
                if (!item.contains(event.relatedTarget)) {
                    item.classList.remove('focus');
                }
            });
        }
    });

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {
        anchor.addEventListener('click', function(event) {
            const targetId = this.getAttribute('href');
            
            if (targetId === '#') return;
            
            const target = document.querySelector(targetId);
            
            if (target) {
                event.preventDefault();
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Add 'scrolled' class to header when scrolling
    const header = document.querySelector('.site-header');
    
    if (header) {
        let lastScroll = 0;
        
        window.addEventListener('scroll', function() {
            const currentScroll = window.pageYOffset;
            
            if (currentScroll > 100) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
            
            lastScroll = currentScroll;
        });
    }
})();
