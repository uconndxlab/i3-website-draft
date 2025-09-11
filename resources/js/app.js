import AOS from 'aos';
import 'aos/dist/aos.css';

document.addEventListener('DOMContentLoaded', () => {
    AOS.init();
    
    // Universal form disable on submit functionality
    initFormDisableOnSubmit();
});

/**
 * Initialize form disable on submit functionality
 * Use data-disable-on-submit="true" on any form to enable this feature
 * Optional: data-submit-text="Custom loading text..." to customize the submit button text
 */
function initFormDisableOnSubmit() {
    const forms = document.querySelectorAll('form[data-disable-on-submit="true"]');
    
    forms.forEach(form => {
        let isSubmitting = false;
        
        form.addEventListener('submit', function(e) {
            // Prevent multiple submissions
            if (isSubmitting) {
                e.preventDefault();
                return false;
            }
            
            isSubmitting = true;
            
            // Find all submit buttons
            const submitButtons = form.querySelectorAll('button[type="submit"], input[type="submit"]');
            
            // Get custom submit text if provided
            const customSubmitText = form.getAttribute('data-submit-text') || 'Please wait...';
            
            // Store original button states
            const originalButtonStates = [];
            
            submitButtons.forEach(button => {
                originalButtonStates.push({
                    element: button,
                    originalText: button.textContent || button.value,
                    originalDisabled: button.disabled
                });
                
                // Update button text and disable
                if (button.tagName === 'BUTTON') {
                    button.textContent = customSubmitText;
                } else {
                    button.value = customSubmitText;
                }
                button.disabled = true;
            });
            
            // Re-enable form if submission fails (for client-side validation errors)
            // This will run on the next tick to allow form validation to occur first
            setTimeout(() => {
                // Check if form is still in the DOM and hasn't been submitted successfully
                if (form.parentNode && !form.hasAttribute('data-submitted')) {
                    // Check for validation errors
                    const hasValidationErrors = form.querySelectorAll(':invalid').length > 0;
                    
                    if (hasValidationErrors) {
                        // Re-enable the form
                        enableForm(form, originalButtonStates);
                        isSubmitting = false;
                    }
                }
            }, 100);
            
            // Mark form as submitted for successful submissions
            form.setAttribute('data-submitted', 'true');
        });
    });
}

/**
 * Re-enable form elements (helper function)
 */
function enableForm(form, originalButtonStates) {
    // Restore original button states
    originalButtonStates.forEach(state => {
        if (state.element.tagName === 'BUTTON') {
            state.element.textContent = state.originalText;
        } else {
            state.element.value = state.originalText;
        }
        state.element.disabled = state.originalDisabled;
    });
    
    // Remove submitted marker
    form.removeAttribute('data-submitted');
}


