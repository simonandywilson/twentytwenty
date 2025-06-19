class CookieModal {
  constructor() {
    this.modal = document.getElementById('cookie-modal');
    this.content = this.modal?.querySelector('[role="document"]');
    this.features = this.modal?.querySelectorAll('input[type="checkbox"][data-cookie-id]');
    this.acceptButton = document.getElementById('cookie-accept');
    this.denyButton = document.getElementById('cookie-deny');
    this.saveButton = document.getElementById('cookie-save');
    
    this.MODAL_OPEN = false;
    this.MINUMUM_FEATURES = ['essential'];
    this.MAXIMUM_FEATURES = [];
    this.CUSTOM_FEATURES = [];
    this.SHOW_ON_FIRST = this.modal?.dataset.showOnFirst === 'true';
    
    // Focus management
    this.lastFocusedElement = null;
    this.focusableElements = [];
    
    if (this.modal) {
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
    Array.prototype.forEach.call(_this.features, feature => {
      feature.addEventListener('change', _ => _this.updateCustomFeatures());
    });
    _this.acceptButton?.addEventListener('click', (e) => {
      e.preventDefault();
      _this.save(_this.MAXIMUM_FEATURES);
    });
    _this.denyButton?.addEventListener('click', (e) => {
      e.preventDefault();
      _this.save(_this.MINUMUM_FEATURES);
    });
    _this.saveButton?.addEventListener('click', (e) => {
      e.preventDefault();
      _this.save(_this.CUSTOM_FEATURES);
    });
    
    // Keyboard navigation
    _this.modal?.addEventListener('keydown', (e) => _this.handleKeyDown(e));
    
    document.querySelector('body').addEventListener('cookies:update', _ => {
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
    const currentElement = document.activeElement;

    // Only trap focus when trying to leave the modal boundaries
    if (e.shiftKey) {
      // Shift + Tab (backward) - only trap if we're at the first element
      if (currentElement === firstElement) {
        e.preventDefault();
        lastElement.focus();
      }
      // Otherwise, allow normal backward tabbing
    } else {
      // Tab (forward) - only trap if we're at the last element
      if (currentElement === lastElement) {
        e.preventDefault();
        firstElement.focus();
      }
      // Otherwise, allow normal forward tabbing
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
      this.content?.querySelectorAll(focusableSelectors.join(',')) || []
    ).filter(el => {
      const computedStyle = getComputedStyle(el);
      const isVisible = el.offsetParent !== null && // Not hidden by display: none
             !el.hasAttribute('hidden') &&
             computedStyle.visibility !== 'hidden' &&
             computedStyle.display !== 'none' &&
             (!el.hasAttribute('aria-hidden') || el.getAttribute('aria-hidden') !== 'true') &&
             !el.classList.contains('hidden'); // Tailwind hidden class
      
      return isVisible;
    });
  }

  loadMaximumFeatures() {
    const _this = this;
    Array.prototype.forEach.call(_this.features, feature => {
      const featureKey = feature.dataset.cookieId?.toLowerCase();
      if (featureKey) {
        _this.MAXIMUM_FEATURES.push(featureKey);
      }
    });
  }

  loadCustomFeatures() {
    const _this = this;
    const cookieStatus = this.getCookie('cookie_status');
    if (cookieStatus) {
      _this.CUSTOM_FEATURES = cookieStatus.split(',');
      
      // Update checkboxes based on saved preferences
      Array.prototype.forEach.call(_this.features, feature => {
        const featureKey = feature.dataset.cookieId?.toLowerCase();
        const isActive = _this.CUSTOM_FEATURES.includes(featureKey);
        feature.checked = isActive;
      });
      
      _this.updateButtons();
    }
  }

  updateCustomFeatures() {
    const _this = this;
    _this.CUSTOM_FEATURES = [];
    
    const checkedFeatures = Array.prototype.filter.call(_this.features, feature => feature.checked);
    Array.prototype.forEach.call(checkedFeatures, feature => {
      const featureKey = feature.dataset.cookieId?.toLowerCase();
      if (featureKey) {
        _this.CUSTOM_FEATURES.push(featureKey);
      }
    });
    
    _this.updateButtons();
  }

  updateButtons() {
    const _this = this;
    if (!_this.acceptButton || !_this.denyButton || !_this.saveButton) return;

    if (_this.CUSTOM_FEATURES.length > 1) {
      _this.acceptButton.classList.add('hidden');
      _this.denyButton.classList.add('hidden');
      _this.saveButton.classList.remove('hidden');
      _this.saveButton.setAttribute('aria-hidden', 'false');
      _this.acceptButton.setAttribute('aria-hidden', 'true');
      _this.denyButton.setAttribute('aria-hidden', 'true');
    } else {
      _this.acceptButton.classList.remove('hidden');
      _this.denyButton.classList.remove('hidden');
      _this.saveButton.classList.add('hidden');
      _this.acceptButton.setAttribute('aria-hidden', 'false');
      _this.denyButton.setAttribute('aria-hidden', 'false');
      _this.saveButton.setAttribute('aria-hidden', 'true');
    }
    
    // Update focusable elements when button visibility changes
    _this.updateFocusableElements();
  }

  save(features) {
    const _this = this;
    _this.triggerEvent('cookies:saved', features);
    _this.setCookie('cookie_status', features.join(','), 365);
    _this.CUSTOM_FEATURES = features;
    _this.closeCookieModal();
  }

  triggerEvent(eventName, data = {}) {
    let customEvent;
    if (window.CustomEvent && typeof window.CustomEvent === 'function') {
      customEvent = new CustomEvent(eventName, { detail: data });
    } else {
      customEvent = document.createEvent('CustomEvent');
      customEvent.initCustomEvent(eventName, true, true, data);
    }
    document.querySelector('body').dispatchEvent(customEvent);
  }

  setCookie(name, value, days) {
    const expires = new Date();
    expires.setTime(expires.getTime() + (days * 24 * 60 * 60 * 1000));
    document.cookie = `${name}=${value};expires=${expires.toUTCString()};path=/;SameSite=Lax`;
  }

  getCookie(name) {
    const nameEQ = name + "=";
    const ca = document.cookie.split(';');
    for (let i = 0; i < ca.length; i++) {
      let c = ca[i];
      while (c.charAt(0) === ' ') c = c.substring(1, c.length);
      if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
  }

  closeCookieModal() {
    const _this = this;
    if (!_this.modal) return;

    // Hide modal
    _this.modal.classList.add('hidden');
    _this.modal.setAttribute('aria-hidden', 'true');
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
    if (!_this.modal) return;

    // Store the last focused element
    _this.lastFocusedElement = document.activeElement;
    
    // Show modal
    _this.modal.classList.remove('hidden');
    _this.modal.setAttribute('aria-hidden', 'false');
    _this.MODAL_OPEN = true;
    
    // Set focus to the modal content
    setTimeout(() => {
      _this.updateFocusableElements();
      if (_this.focusableElements.length > 0) {
        _this.focusableElements[0].focus();
      } else {
        _this.content?.focus();
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