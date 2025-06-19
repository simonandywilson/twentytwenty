import './cookie-modal.scss';
import Cookies from 'js-cookie';

function element(selector) {
  return document.querySelector(selector);
}

function allElements(selector) {
  return document.querySelectorAll(selector);
}

function triggerEvent(eventName, data = {}) {
  let customEvent = null;
  if (window.CustomEvent && typeof window.CustomEvent === 'function') {
    customEvent = new CustomEvent(eventName, {detail: data});
  } else {
    customEvent = document.createEvent('CustomEvent');
    customEvent.initCustomEvent(eventName, true, true, data);
  }
  document.querySelector('body').dispatchEvent(customEvent);
}

class CookieModal {
  constructor() {
    this.$COOKIE_MODAL = element('#cookie-modal');
    this.$CONTENT = this.$COOKIE_MODAL?.querySelector('.cookie-modal__content');
    this.$FEATURES = allElements('.cookie-modal__checkbox');
    this.$ACCEPT_BUTTON = element('#cookie-accept');
    this.$DENY_BUTTON = element('#cookie-deny');
    this.$SAVE_BUTTON = element('#cookie-save');

    this.MODAL_OPEN = false;
    this.MINUMUM_FEATURES = ['essential'];
    this.MAXIMUM_FEATURES = [];
    this.CUSTOM_FEATURES = [];
    this.SHOW_ON_FIRST = this.$COOKIE_MODAL?.dataset.showOnFirst === 'true';
    
    // Focus management
    this.lastFocusedElement = null;
    this.focusableElements = [];

    if (this.$COOKIE_MODAL) {
      this.initCookieModal().then(_ => this.registerHooks());
    }
  }

  initCookieModal() {
    const _this = this;
    return new Promise(resolve => {
      _this.loadMaximumFeatures();
      _this.loadCustomFeatures();
      if (_this.CUSTOM_FEATURES.length === 0 && this.SHOW_ON_FIRST) {
        _this.openCookieModal();
      }
      resolve();
    });
  }

  registerHooks() {
    const _this = this;
    Array.prototype.forEach.call(_this.$FEATURES, feature => {
      feature.addEventListener('change', _ => _this.updateCustomFeatures());
    });
    _this.$ACCEPT_BUTTON?.addEventListener('click', (e) => {
      e.preventDefault();
      _this.save(_this.MAXIMUM_FEATURES);
    });
    _this.$DENY_BUTTON?.addEventListener('click', (e) => {
      e.preventDefault();
      _this.save(_this.MINUMUM_FEATURES);
    });
    _this.$SAVE_BUTTON?.addEventListener('click', (e) => {
      e.preventDefault();
      _this.save(_this.CUSTOM_FEATURES);
    });
    
    // Keyboard navigation
    _this.$COOKIE_MODAL?.addEventListener('keydown', (e) => _this.handleKeyDown(e));
    
    element('body').addEventListener('cookies:update', _ => {
      _this.loadCustomFeatures();
      _this.openCookieModal();
    });
  }

  handleKeyDown(e) {
    if (!this.MODAL_OPEN) return;

    switch (e.key) {
      case 'Escape':
        // Don't allow escape to close - user must make a choice
        e.preventDefault();
        break;
      case 'Tab':
        this.handleTabKey(e);
        break;
    }
  }

  handleTabKey(e) {
    this.updateFocusableElements();
    
    if (this.focusableElements.length === 0) return;

    const firstElement = this.focusableElements[0];
    const lastElement = this.focusableElements[this.focusableElements.length - 1];

    if (e.shiftKey) {
      // Shift + Tab (backward)
      if (document.activeElement === firstElement) {
        e.preventDefault();
        lastElement.focus();
      }
    } else {
      // Tab (forward)
      if (document.activeElement === lastElement) {
        e.preventDefault();
        firstElement.focus();
      }
    }
  }

  updateFocusableElements() {
    const focusableSelectors = [
      'input:not([disabled])',
      'button:not([disabled])',
      'select:not([disabled])',
      'textarea:not([disabled])',
      'a[href]',
      '[tabindex]:not([tabindex="-1"])'
    ];

    this.focusableElements = Array.from(
      this.$CONTENT?.querySelectorAll(focusableSelectors.join(',')) || []
    ).filter(el => {
      return el.offsetParent !== null && // Not hidden
             !el.hasAttribute('hidden') &&
             getComputedStyle(el).visibility !== 'hidden';
    });
  }

  loadMaximumFeatures() {
    const _this = this;
    Array.prototype.forEach.call(_this.$FEATURES, feature => {
      const featureKey = feature.dataset.cookieId.toLowerCase();
      _this.MAXIMUM_FEATURES.push(featureKey);
    });
  }

  loadCustomFeatures() {
    const _this = this;
    if (Cookies.get('cookie_status')) {
      _this.CUSTOM_FEATURES = Cookies.get('cookie_status').split(',');
      const activeFeatures = Array.prototype.filter.call(_this.$FEATURES,
        feature => {
          const featureKey = feature.dataset.cookieId.toLowerCase();
          return _this.CUSTOM_FEATURES.indexOf(featureKey) > -1;
        });
      Array.prototype.forEach.call(activeFeatures, feature => {
        feature.setAttribute('checked', true);
      });
      _this.updateButtons();
    }
  }

  updateCustomFeatures() {
    const _this = this;
    _this.CUSTOM_FEATURES = [];
    const checkedFeatures = Array.prototype.filter.call(
      _this.$FEATURES,
      feature => feature.checked,
    );
    Array.prototype.forEach.call(checkedFeatures, feature => {
      const featureKey = feature.dataset.cookieId.toLowerCase();
      _this.CUSTOM_FEATURES.push(featureKey);
    });
    _this.updateButtons();
  }

  save(features) {
    const _this = this;
    triggerEvent('cookies:saved', features);
    _this.setCookie(features);
    _this.CUSTOM_FEATURES = features;
    _this.closeCookieModal();
  }

  updateButtons() {
    let _this = this;
    if (!_this.$ACCEPT_BUTTON || !_this.$DENY_BUTTON || !_this.$SAVE_BUTTON) return;

    if (_this.CUSTOM_FEATURES.length > 1) {
      _this.$ACCEPT_BUTTON.style.display = 'none';
      _this.$DENY_BUTTON.style.display = 'none';
      _this.$SAVE_BUTTON.style.display = 'block';
      _this.$SAVE_BUTTON.setAttribute('aria-hidden', 'false');
      _this.$ACCEPT_BUTTON.setAttribute('aria-hidden', 'true');
      _this.$DENY_BUTTON.setAttribute('aria-hidden', 'true');
    } else {
      _this.$ACCEPT_BUTTON.style.display = 'block';
      _this.$DENY_BUTTON.style.display = 'block';
      _this.$SAVE_BUTTON.style.display = 'none';
      _this.$ACCEPT_BUTTON.setAttribute('aria-hidden', 'false');
      _this.$DENY_BUTTON.setAttribute('aria-hidden', 'false');
      _this.$SAVE_BUTTON.setAttribute('aria-hidden', 'true');
    }
  }

  setCookie(features) {
    Cookies.set('cookie_status', features.join(','), {expires: 365});
  }

  closeCookieModal() {
    const _this = this;
    if (!_this.$COOKIE_MODAL) return;

    // Hide modal
    _this.$COOKIE_MODAL.classList.add('cookie-modal--hidden');
    _this.$COOKIE_MODAL.setAttribute('aria-hidden', 'true');
    _this.MODAL_OPEN = false;
    
    // Restore focus
    if (_this.lastFocusedElement) {
      _this.lastFocusedElement.focus();
    }
    
    // Restore body scroll
    document.body.style.overflow = '';
    
    // Announce to screen readers
    _this.announceToScreenReader('Cookie preferences saved and dialog closed.');
  }

  openCookieModal() {
    const _this = this;
    if (!_this.$COOKIE_MODAL) return;

    // Store the last focused element
    _this.lastFocusedElement = document.activeElement;
    
    // Show modal
    _this.$COOKIE_MODAL.classList.remove('cookie-modal--hidden');
    _this.$COOKIE_MODAL.setAttribute('aria-hidden', 'false');
    _this.MODAL_OPEN = true;
    
    // Set focus to the modal content
    setTimeout(() => {
      _this.updateFocusableElements();
      if (_this.focusableElements.length > 0) {
        _this.focusableElements[0].focus();
      } else {
        _this.$CONTENT?.focus();
      }
    }, 100);
    
    // Prevent background scrolling
    document.body.style.overflow = 'hidden';
    
    // Announce to screen readers
    _this.announceToScreenReader('Cookie preferences dialog opened. Please make your selection.');
  }

  announceToScreenReader(message) {
    const announcement = document.createElement('div');
    announcement.setAttribute('aria-live', 'polite');
    announcement.setAttribute('aria-atomic', 'true');
    announcement.style.position = 'absolute';
    announcement.style.left = '-10000px';
    announcement.textContent = message;
    
    document.body.appendChild(announcement);
    
    setTimeout(() => {
      document.body.removeChild(announcement);
    }, 1000);
  }
}

// Global function for external access
window.cookieBanner = null;

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', _ => {
  window.cookieBanner = new CookieModal();
});

// Global function to reopen modal (for settings links)
window.openCookieModal = function() {
  if (window.cookieBanner) {
    window.cookieBanner.openCookieModal();
  }
};
