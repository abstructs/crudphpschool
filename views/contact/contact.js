window.onload = (function() {
    var form = document.getElementById('contact-form-submit');
    form.addEventListener('click', validateInput);
});

// EFFECTS: validates that firstName, lastName and title are not blank, if they are
//          shows a user friendly message and an alert at the top of the page indicating the
//          number of errors.
function validateInput() {
    var title = document.getElementById('title');
    var firstName = document.getElementById('firstName');
    var lastName = document.getElementById('lastName');
    var error_count = 0;

    error_count += validateFormGroup(title, title.value.length > 0, "Title cannot be blank.");
    error_count += validateFormGroup(firstName, firstName.value.length > 0, "First name cannot be blank.");
    error_count += validateFormGroup(lastName, lastName.value.length > 0, "Last name cannot be blank.");

    if(error_count == 0) {
        return true;
    }

    if(error_count == 1) {
        showAlert("danger", "There is 1 error.");
    } else if(error_count > 1) {
        showAlert("danger", "There are " + error_count + " errors.");
    }

    window.scrollTo(0, 0);

    // showAlert('success', "Submitted!");

    return false;
}

// REQUIRES: there must be a element on the DOM with an id of inputElement.name + "_error",
//           inputElement must be a DOM element
// EFFECTS: selects the "ELEMENT_error" tag and inserts an error message into it if
//          the conditon is not met. Returns 1 if there was an error and 0 if not.
function validateFormGroup(inputElement, condition, error_msg) {
    var elementName = inputElement.name;
    var error_element = document.getElementById(elementName + "_error");
    if(!condition) {
        inputElement.style['border-color'] = 'red';
        inputElement.parentNode.style['color'] = 'red';
        error_element.innerHTML = error_msg;
        error_element.style['color'] = 'red';


        return 1;
    }

    error_element.innerHTML = '';
    inputElement.style['border-color'] = '';
    inputElement.parentNode.style['color'] = '';

    return 0;
}

// REQUIRES: page should have a div with an "alert" id
// EFFECTS: sets the "alert" element equal to an alert with a message
function showAlert(type, msg) {
    var alert = document.getElementById('alert');
    alert.className = 'alert alert-' + type;
    alert.innerHTML = msg;
}