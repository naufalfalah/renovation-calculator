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
    if (currentStep >= totalSteps) {
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
        }
    }

    showStep(currentStep);
}

function prevStep() {
    if (currentStep <= 1) {
        return;
    }
    currentStep--;

    if (currentStep === 6) {
        const step2 = document.querySelector('[data-step="2"]');
        const checkboxes = step2.querySelectorAll('input[type="checkbox"]');

        if (checkboxes.length > 0 && !checkboxes[3].checked) {
            currentStep--;
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

function clearFieldErrors(elements) {
    elements.forEach(el => {
        el.classList.remove('error-input');
        const errors = el.querySelectorAll('.error-message');
        errors.forEach(error => error.remove());
    });
}

document.querySelectorAll('.clear-selection').forEach(button => {
    button.addEventListener('click', function () {
        const name = this.getAttribute('data-target');
        document.querySelectorAll(`input[name="${name}"]`).forEach(radio => {
            radio.checked = false;
        });
    });
});

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
        const propertySizeValue = propertySizeInput.value.trim();
        if (!propertySizeValue) {
            showError(propertySizeInput.parentElement, 'Please enter the property size');
            isValid = false;
        } else if (parseInt(propertySizeValue, 10) > 999) {
            showError(propertySizeInput.parentElement, 'Property size cannot be greater than 999.');
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

                relatedCheckbox.removeEventListener('click', preventUncheck);
            } else {
                relatedCheckbox.disabled = false;
                relatedCheckbox.checked = true;

                relatedCheckbox.addEventListener('click', preventUncheck);
            }
        }
    });
});

function preventUncheck(e) {
    e.preventDefault();
    this.checked = true;
}

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
    const re = /^[89]\d{7}$/;
    return re.test(phone);
}

function validateContactInfo() {
    let isValid = true;

    const fullName = document.getElementById('fullName');
    const email = document.getElementById('email');
    const countryCode = document.getElementById('countryCode');
    const contactNumber = document.getElementById('contactNumber');
    const acceptTerms = document.querySelector('input[name="accept_terms"]');
    const contactNumberGroupError = document.getElementById('contactNumberGroupError');

    const errorMessages = document.querySelectorAll('[data-step="8"] .error-message');
    errorMessages.forEach(msg => msg.remove());

    if (fullName.value.trim() === '') {
        showError(fullName.parentElement, 'Full name is required.');
        isValid = false;
    }

    if (email.value.trim() === '') {
        showError(email.parentElement, 'Email is required.');
        isValid = false;
    } else if (!validateEmail(email.value)) {
        showError(email.parentElement, 'Please enter a valid email address.');
        isValid = false;
    }

    if (contactNumber.value.trim() === '') {
        showError(contactNumberGroupError, 'Contact number is required.');
        isValid = false;
    } else if (!validatePhone(contactNumber.value)) {
        showError(contactNumberGroupError, 'Contact number must be 8 digits and start with 8 or 9.');
        isValid = false;
    }

    // Error container
    const errorContainer = document.querySelector('[data-step="8"] .error-container');
    errorContainer.innerHTML = '';

    if (!acceptTerms.checked) {
        errorContainer.innerHTML += `<p style="color:red;">You must accept the terms of service.</p>`;
        isValid = false;
    }

    return isValid;
}

// Realtime validation for inputs
const fullNameInput = document.getElementById('fullName');
const emailInput = document.getElementById('email');
const contactNumberInput = document.getElementById('contactNumber');

fullNameInput.addEventListener('input', () => {
    validateContactInfo();
});

emailInput.addEventListener('input', () => {
    validateContactInfo();
});

contactNumberInput.addEventListener('input', () => {
    validateContactInfo();
});

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
            console.log("response", response);
            if (response.success) {
                console.log('Submit Success 🎉');

                document.querySelector('#budgetRangeDisplay').textContent = response.data.budget_range;
                document.querySelector('#userEmailDisplay').textContent = response.data.email;

                const downloadLink = document.querySelector('#downloadLink');

                downloadLink.href = response.data.pdf_url;

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
