(() => {
  'use strict'
  var form = document.querySelector('.needs-validation')
  var modal = new bootstrap.Modal(".modal")
  form.addEventListener('submit', function (event) {
    const checkboxes = document.querySelectorAll("input[type = 'checkbox']")
    if (!form.checkValidity()) {
      event.preventDefault()
      event.stopPropagation()
    }
    if (!setValidity(checkboxes, event)) {
      event.preventDefault()
      event.stopPropagation()
    } else {
      var formData = new FormData(document.querySelector("#form"));

      var customer = {}

      formData.forEach((value, key) => {
        if (key === 'paymentMethod') {
          if (!Reflect.has(customer, key)) {
            customer[key] = [value];
          } else {
            customer[key].push(value);
          }
        } else {
          if (!Reflect.has(customer, key)) {
            customer[key] = value;
          } else if (Array.isArray(customer[key])) {
            customer[key].push(value);
          } else {
            customer[key] = [customer[key], value];
          }
        }
      });
      customer['fullName'] = setFullName(customer['firstName'], customer['middleInitial'], customer['lastName'])
      console.log(customer);


      fetch("../../process/add-customer-process.php", {
        method: "POST",
        body: JSON.stringify(customer),
        headers: {
          "Content-Type": 'application/json'
        }
      })
    }
    form.classList.add('was-validated')
  })

  function setValidity(checkboxes, event) {
    var checkedOne = Array.prototype.slice.call(checkboxes).some(x => x.checked)
    if (!checkedOne) {
      event.preventDefault()
      checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener("change", event => {
          setValidity(checkboxes, event)
        })
        checkbox.setCustomValidity("No payment method selected")
      });
    } else {
      checkboxes.forEach(function (checkbox) {
        checkbox.setCustomValidity("")
      });
    }
    return checkedOne
  }
})()

function setFullName(firstName, middleInitial, lastName) {
  const firstNameTitleCase = titleCase(firstName)
  const lastNameTitleCase = titleCase(lastName)
  if (middleInitial.length == 0) {
    return firstNameTitleCase = " " + lastNameTitleCase
  }

  return firstNameTitleCase + " " + titleCase(middleInitial) + ". " + lastNameTitleCase;
}

function titleCase(str) {
  return str
    .toLowerCase()
    .split(' ')
    .map(function (word) {
      return word[0].toUpperCase() + word.substr(1);
    })
    .join(' ');
}