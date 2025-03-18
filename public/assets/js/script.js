let currentStep = 1;

function showStep(step) {
    const steps = document.querySelectorAll('.form-step');

    steps.forEach((stepElement) => {
        const stepNum = parseInt(stepElement.getAttribute('data-step'), 10);

        if (stepNum === step) {
            stepElement.classList.remove('hidden');
            stepElement.classList.add('active');
        } else {
            stepElement.classList.add('hidden');
            stepElement.classList.remove('active');
        }
    });
}

function nextStep() {
    const totalSteps = document.querySelectorAll('.form-step').length;
    if (currentStep === totalSteps) {
        console.log("You've reached the final step!");
        return;
    }
    currentStep++;

    if (currentStep === 3) {
        const step2 = document.querySelector('[data-step="2"]');
        const checkboxes = step2.querySelectorAll('input[type="checkbox"]');

        if (checkboxes.length > 0 && !checkboxes[0].checked) {
            currentStep++;
        }
    }

    if (currentStep === 4) {
        const step2 = document.querySelector('[data-step="2"]');
        const checkboxes = step2.querySelectorAll('input[type="checkbox"]');

        if (checkboxes.length > 0 && !checkboxes[1].checked) {
            currentStep++;
        }
    }

    if (currentStep === 5) {
        const step2 = document.querySelector('[data-step="2"]');
        const checkboxes = step2.querySelectorAll('input[type="checkbox"]');

        if (checkboxes.length > 0 && !checkboxes[2].checked) {
            currentStep++;
        }
    }

    if (currentStep === 6) {
        const step2 = document.querySelector('[data-step="2"]');
        const checkboxes = step2.querySelectorAll('input[type="checkbox"]');

        if (checkboxes.length > 0 && !checkboxes[3].checked) {
            currentStep++;
            return;
        }
    }

    showStep(currentStep);
}

function prevStep() {
    currentStep--;

    if (currentStep === 1) {
        return;
    }

    if (currentStep === 6) {
        const step2 = document.querySelector('[data-step="2"]');
        const checkboxes = step2.querySelectorAll('input[type="checkbox"]');

        if (checkboxes.length > 0 && !checkboxes[3].checked) {
            currentStep--;
            return;
        }
    }

    if (currentStep === 5) {
        const step2 = document.querySelector('[data-step="2"]');
        const checkboxes = step2.querySelectorAll('input[type="checkbox"]');

        if (checkboxes.length > 0 && !checkboxes[2].checked) {
            currentStep--;
        }
    }

    if (currentStep === 4) {
        const step2 = document.querySelector('[data-step="2"]');
        const checkboxes = step2.querySelectorAll('input[type="checkbox"]');

        if (checkboxes.length > 0 && !checkboxes[1].checked) {
            currentStep--;
        }
    }

    if (currentStep === 3) {
        const step2 = document.querySelector('[data-step="2"]');
        const checkboxes = step2.querySelectorAll('input[type="checkbox"]');

        if (checkboxes.length > 0 && !checkboxes[0].checked) {
            currentStep--;
        }
    }

    showStep(currentStep);
}

const prevButtons = document.querySelectorAll('.prev-btn');
prevButtons.forEach(button => {
    button.addEventListener('click', () => {
        prevStep();
    });
});

function showError(element, message) {
    const error = document.createElement('div');
    error.classList.add('error-message');
    error.style.color = 'red';
    error.style.marginTop = '5px';
    error.textContent = message;
    element.appendChild(error);
}

// Step 1
document.addEventListener('DOMContentLoaded', function () {
    const nextBtn1 = document.querySelector('.next-btn#nextBtn1');

    nextBtn1.addEventListener('click', function (e) {
        e.preventDefault();
        let isValid = true;

        const errorMessages = document.querySelectorAll('.error-message');
        errorMessages.forEach(msg => msg.remove());

        const propertyTypeRadios = document.querySelectorAll('input[name="property_type"]');
        if (![...propertyTypeRadios].some(radio => radio.checked)) {
            showError(propertyTypeRadios[0].closest('.form-group'), 'Please select a property type');
            isValid = false;
        }

        const propertyStatusRadios = document.querySelectorAll('input[name="property_status"]');
        if (![...propertyStatusRadios].some(radio => radio.checked)) {
            showError(propertyStatusRadios[0].closest('.form-group'), 'Please select a property status');
            isValid = false;
        }

        const propertySizeInput = document.querySelector('input[name="size"]');
        if (!propertySizeInput.value.trim()) {
            showError(propertySizeInput.parentElement, 'Please enter the property size');
            isValid = false;
        }

        const roomSelects = document.querySelectorAll('select[name^="number_of_rooms"]');
        roomSelects.forEach(select => {
            if (!select.value) {
                const roomName = select.dataset.name || 'room';
                showError(select.parentElement, `Please select number of ${roomName}s`);
                isValid = false;
            }
        });

        if (isValid) {
            nextStep();
        }
    });
});

const roomSelects = document.querySelectorAll('select[name^="number_of_rooms"]');
roomSelects.forEach(select => {
    select.addEventListener('change', function () {
        const roomId = this.getAttribute('id').replace('number_of_room_', '');
        const selectedValue = this.value;

        const relatedCheckbox = document.querySelector(`input[type="checkbox"][data-id="${roomId}"]`);

        if (relatedCheckbox) {
            if (selectedValue === '0' || selectedValue === '') {
                relatedCheckbox.disabled = true;
                relatedCheckbox.checked = false;
            } else {
                relatedCheckbox.disabled = false;
            }
        }
    });
});

// Step 2
document.addEventListener('DOMContentLoaded', function () {
    const nextBtn2 = document.querySelector('.next-btn#nextBtn2');

    nextBtn2.addEventListener('click', function (e) {
        e.preventDefault();
        let isValid = true;

        const errorMessages = document.querySelectorAll('.error-message');
        errorMessages.forEach(msg => msg.remove());

        const checkboxes = document.querySelectorAll('[data-step="2"] input[type="checkbox"][name="rooms[]"]');
        const errorContainer = document.querySelector('[data-step="2"] .error-container') || checkboxes[0]?.parentElement;

        const isChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);

        if (!isChecked) {
            if (errorContainer) {
                showError(errorContainer, `Please select at least one room`);
            }
            isValid = false;
        }

        if (isValid) {
            nextStep();
        }
    });
});

// Step 3
document.addEventListener('DOMContentLoaded', function () {
    const nextBtnStep3 = document.querySelector('[data-step="3"] .next-btn');

    nextBtnStep3.addEventListener('click', function (e) {
        e.preventDefault();
        let isValid = true;

        const errorMessages = document.querySelectorAll('[data-step="3"] .error-message');
        errorMessages.forEach(msg => msg.remove());
        const errorContainer = document.querySelector('[data-step="3"] .error-container') || radios[0]?.parentElement;

        const inputs = document.querySelectorAll(`input[name^="main[living]"]`);
        let hasChecked = false;
        inputs.forEach(input => {
            if (input.checked) {
                hasChecked = true;
            }
        });

        if (!hasChecked) {
            if (errorContainer) {
                showError(errorContainer, `Please select at least one work package`);
            }
            isValid = false;
        }

        if (isValid) {
            nextStep();
        }
    });
});

// Step 4
document.addEventListener('DOMContentLoaded', function () {
    const nextBtnStep4 = document.querySelector('[data-step="4"] .next-btn');

    nextBtnStep4.addEventListener('click', function (e) {
        e.preventDefault();
        let isValid = true;

        const errorMessages = document.querySelectorAll('[data-step="4"] .error-message');
        errorMessages.forEach(msg => msg.remove());
        const errorContainer = document.querySelector('[data-step="4"] .error-container') || radios[0]?.parentElement;

        const inputs = document.querySelectorAll(`input[name^="main[kitchen]"]`);
        let hasChecked = false;
        inputs.forEach(input => {
            if (input.checked) {
                hasChecked = true;
            }
        });

        if (!hasChecked) {
            if (errorContainer) {
                showError(errorContainer, `Please select at least one work package`);
            }
            isValid = false;
        }

        if (isValid) {
            nextStep();
        }
    });
});

// Step 5
document.addEventListener('DOMContentLoaded', function () {
    const nextBtnStep5 = document.querySelector('[data-step="5"] .next-btn');

    nextBtnStep5.addEventListener('click', function (e) {
        e.preventDefault();
        let isValid = true;

        const errorMessages = document.querySelectorAll('[data-step="5"] .error-message');
        errorMessages.forEach(msg => msg.remove());
        const errorContainer = document.querySelector('[data-step="5"] .error-container') || radios[0]?.parentElement;

        const inputs = document.querySelectorAll(`input[name^="main[bedroom]"]`);
        let hasChecked = false;
        inputs.forEach(input => {
            if (input.checked) {
                hasChecked = true;
            }
        });

        if (!hasChecked) {
            if (errorContainer) {
                showError(errorContainer, `Please select at least one work package`);
            }
            isValid = false;
        }


        if (isValid) {
            nextStep();
        }
    });
});

// Step 6
document.addEventListener('DOMContentLoaded', function () {
    const nextBtnStep6 = document.querySelector('[data-step="6"] .next-btn');

    nextBtnStep6.addEventListener('click', function (e) {
        e.preventDefault();
        let isValid = true;

        const errorMessages = document.querySelectorAll('[data-step="6"] .error-message');
        errorMessages.forEach(msg => msg.remove());
        const errorContainer = document.querySelector('[data-step="6"] .error-container') || radios[0]?.parentElement;

        const inputs = document.querySelectorAll(`input[name^="main[bathroom]"]`);
        let hasChecked = false;
        inputs.forEach(input => {
            if (input.checked) {
                hasChecked = true;
            }
        });

        if (!hasChecked) {
            if (errorContainer) {
                showError(errorContainer, `Please select at least one work package`);
            }
            isValid = false;
        }

        if (isValid) {
            nextStep();
        }
    });
});

// Step 7
document.addEventListener('DOMContentLoaded', function () {
    const nextBtnStep7 = document.querySelector('[data-step="7"] .next-btn');

    nextBtnStep7.addEventListener('click', function (e) {
        e.preventDefault();
        let isValid = true;

        const errorMessages = document.querySelectorAll('[data-step="7"] .error-message');
        errorMessages.forEach(msg => msg.remove());

        if (isValid) {
            nextStep();
        }
    });
});

// Validate email regex
function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

// Validate phone number (basic numeric check)
function validatePhone(phone) {
    const re = /^[0-9]{6,15}$/; // Customize min-max length as needed
    return re.test(phone);
}

// Remove previous error highlights
function clearFieldErrors(elements) {
    elements.forEach(el => {
        el.classList.remove('error-input');
        const small = el.parentNode.querySelector('small');
        if (small) {
            el.parentNode.removeChild(small);
        }
    });
}

function validateContactInfo() {
    let isValid = true;

    const fullName = document.getElementById('fullName');
    const email = document.getElementById('email');
    const countryCode = document.getElementById('countryCode');
    const contactNumber = document.getElementById('contactNumber');
    const acceptTerms = document.querySelector('input[name="accept_terms"]');
    const contactNumberGroupError = document.getElementById('contactNumberGroupError');

    // Clear all previous error highlights
    clearFieldErrors([fullName, email, contactNumber, countryCode]);

    // Error container
    const errorContainer = document.querySelector('[data-step="8"] .error-container');
    errorContainer.innerHTML = '';

    if (fullName.value.trim() === '') {
        showError(fullName.parentElement, 'Full name is required.');
        isValid = false;
    }

    if (!validateEmail(email.value)) {
        showError(email.parentElement, 'Please enter a valid email address.');
        isValid = false;
    }

    if (countryCode.value.trim() === '') {
        showError(contactNumberGroupError, 'Please select a country code.');
        isValid = false;
    }

    if (contactNumber.value.trim() === '') {
        showError(contactNumberGroupError, 'Please enter a valid contact number.');
        isValid = false;
    }

    if (!acceptTerms.checked) {
        errorContainer.innerHTML += `<p style="color:red;">You must accept the terms of service.</p>`;
        isValid = false;
    }

    return isValid;
}

document.querySelector('[data-step="8"] .submit-btn').addEventListener('click', function (e) {
    e.preventDefault();

    if (validateContactInfo()) {
        console.log('Contact Info Valid ✅');

        const form = document.querySelector('#renovationForm');
        const formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            body: formData,
        })
        .then(response => response.json())
        .then(response => {
            if (response.success) {
                console.log('Submit Success 🎉');

                document.querySelector('#budgetRangeDisplay').textContent = response.data.budget_range;
                document.querySelector('#userEmailDisplay').textContent = response.data.email;

                console.log("nextStep")
                nextStep();
            } else {
                console.log('Submit Failed ❌', data);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    } else {
        console.log('Contact Info Not Valid ❌');
    }
});

function restart() {
    location.reload();
}

document.getElementById('restartBtn').addEventListener('click', restart);
