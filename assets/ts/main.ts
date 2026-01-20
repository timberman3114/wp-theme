/**
 * Main TypeScript entry point for DD Web Theme
 */

interface DDWebData {
  ajaxUrl: string;
  nonce: string;
  siteUrl: string;
}

declare const ddWebData: DDWebData;

class DDWebTheme {
  private mobileMenuToggle: JQuery<HTMLElement>;
  private mainNavigation: JQuery<HTMLElement>;
  private siteHeader: JQuery<HTMLElement>;
  private body: JQuery<HTMLElement>;

  constructor() {
    this.mobileMenuToggle = $('.mobile-menu-toggle');
    this.mainNavigation = $('.main-navigation');
    this.siteHeader = $('.site-header');
    this.body = $('body');

    this.init();
  }

  private init(): void {
    this.setupMobileMenu();
    this.setupSmoothScroll();
    this.setupScrollHeader();
    this.setupWindowResize();
  }

  /**
   * Mobile menu toggle functionality
   */
  private setupMobileMenu(): void {
    this.mobileMenuToggle.on('click', () => {
      this.mobileMenuToggle.toggleClass('active');
      this.mainNavigation.toggleClass('active');
      this.body.toggleClass('menu-open');
    });

    // Close mobile menu when clicking outside
    $(document).on('click', (e: JQuery.ClickEvent) => {
      if (
        !$(e.target).closest('.main-navigation').length &&
        !$(e.target).closest('.mobile-menu-toggle').length &&
        this.mainNavigation.hasClass('active')
      ) {
        this.closeMobileMenu();
      }
    });
  }

  /**
   * Close mobile menu
   */
  private closeMobileMenu(): void {
    this.mobileMenuToggle.removeClass('active');
    this.mainNavigation.removeClass('active');
    this.body.removeClass('menu-open');
  }

  /**
   * Smooth scroll for anchor links
   */
  private setupSmoothScroll(): void {
    $('a[href*="#"]:not([href="#"])').on('click', function (this: HTMLElement, e: JQuery.ClickEvent) {
      const href = $(this).attr('href');
      if (!href) return;

      const hash = href.split('#')[1];
      if (!hash) return;

      const target = $(`#${hash}`);
      if (!target.length) return;

      e.preventDefault();
      
      $('html, body').animate(
        {
          scrollTop: target.offset()!.top - 100,
        },
        800
      );
    });
  }

  /**
   * Add class to header on scroll
   */
  private setupScrollHeader(): void {
    $(window).on('scroll', () => {
      if ($(window).scrollTop()! > 100) {
        this.siteHeader.addClass('scrolled');
      } else {
        this.siteHeader.removeClass('scrolled');
      }
    });
  }

  /**
   * Handle window resize
   */
  private setupWindowResize(): void {
    $(window).on('resize', () => {
      if ($(window).width()! > 768) {
        this.closeMobileMenu();
      }
    });
  }

  /**
   * Public method for AJAX calls
   */
  public ajaxCall(action: string, data: Record<string, any> = {}): JQuery.jqXHR {
    return $.ajax({
      url: ddWebData.ajaxUrl,
      type: 'POST',
      data: {
        action,
        nonce: ddWebData.nonce,
        ...data,
      },
    });
  }
}

// Initialize theme on document ready
$(() => {
  new DDWebTheme();
});

// Export for use in other modules if needed
export default DDWebTheme;
