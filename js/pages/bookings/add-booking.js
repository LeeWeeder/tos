function showCustomerHelpBlock(input, customers, customerHelpBlock) {
  const inputValue = input.value.toLowerCase()
  var shouldShowButton
  var isInTheList

  if (inputValue.length == 0) {
    shouldShowButton = false
  } else {
    shouldShowButton = true
    for (var i = 0; i < customers.length; i++) {
      fullName = customers[i]['fullName'].toLowerCase()
      if (fullName == inputValue) {
        isInTheList = true
        break
      } else {
        isInTheList = false
      }
    }
    if (shouldShowButton && isInTheList) {
      customerHelpBlock.classList.add('visually-hidden')
    } else {
      customerHelpBlock.classList.remove('visually-hidden')
    }
  }
}

(() => {
  const aTags = document.querySelectorAll("a:not(.not-exit)")
  const modal = new bootstrap.Modal("#confirmLeavingModal")
  const confirmLink = document.getElementById("confirmLink")

  Array.from(aTags).forEach(a => {
    a.addEventListener("click", event => {
      event.preventDefault()
      const link = a.getAttribute("href")
      confirmLink.setAttribute("href", link)
      modal.show()
    })
  })

  var customers
  fetch("../../process/customers.php")
    .then(response => response.json())
    .then(data => {
      customers = data
    })

  var packages
  fetch("../../process/packages.php")
    .then(response => response.json())
    .then(data => {
      packages = data
    })

  const customerHelpBlock = document.querySelector('#customerHelpBlock')

  const customerInput = document.querySelector('#customer')
  customerInput.addEventListener('input', () => {
    showCustomerHelpBlock(customerInput, customers, customerHelpBlock)
  })

  const addCustomerModal = new bootstrap.Modal("#addCustomerModal")
  const addCustomerModalToggle = document.querySelector('#addCustomerModalToggler')
  const addCustomerFirstNameInput = document.querySelector('#form #firstName')

  addCustomerModalToggle.addEventListener("click", () => {
    showModal(addCustomerFirstNameInput, customerInput, addCustomerModal)
  })

  customerInput.addEventListener('keydown', event => {
    if (event.key == 'Enter') {
      if (customerInput.value.length == 0) {
        return
      }

      for (var i = 0; i < customers.length; i++) {
        if (customers[i]['fullName'].toLowerCase() == customerInput.value.toLowerCase()) {
          return
        }
      }

      event.preventDefault()
      showModal(addCustomerFirstNameInput, customerInput, addCustomerModal)
    }
  })

  document.querySelector('#addCustomerModal').addEventListener('shown.bs.modal', () => {
    addCustomerFirstNameInput.focus()
  })

  var quickBook = document.querySelector('#quickBook');

  var addBookingsForm = document.querySelector('#addBookingsForm')
  addBookingsForm.addEventListener('submit', event => {
    if (!addBookingsForm.checkValidity()) {
      event.preventDefault()
      event.stopPropagation()
    }
    addBookingsForm.classList.add('was-validated')
  })


  var form = document.querySelector('.needs-validation')
  form.addEventListener('submit', function (event) {
    const checkboxes = document.querySelectorAll("#addCustomerModal input[type = 'checkbox']")
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

  quickBook.addEventListener('change', function () {
    window.location.replace('custom-booking.php')
  });

  const startDateQuickBookInput = document.querySelector('#startDateQuickBook')
  var today = new Date()
  today.setDate(today.getDate() + 2)
  today = today.toISOString().split('T')[0];
  startDateQuickBookInput.min = today;

  // Ready made Package selection
  const startDateHelpBlock = document.querySelector("#startDateHelpBlock")
  const packageSelection = document.getElementsByName('package')

  startDateQuickBookInput.addEventListener('input', () => {
    var value = document.querySelector('input[name="package"]:checked').value.replace(/[^0-9]/g, '');
    var startDate = new Date(startDateQuickBookInput.value)
    let options = { month: 'long', day: 'numeric', year: 'numeric' };
    startDate.setDate(startDate.getDate() + packages[parseInt(value)]['duration'])
    startDate = startDate.toLocaleDateString("en-US", options)
    startDateHelpBlock.innerHTML = "Your tour will end on " + startDate
  })

  packageSelection.forEach(input => {
    input.addEventListener('change', () => {
      if (input.checked) {
        var value = input.value.replace(/[^0-9]/g, '');
        var startDate = new Date(startDateQuickBookInput.value)
        let options = { month: 'long', day: 'numeric', year: 'numeric' };
        startDate.setDate(startDate.getDate() + packages[parseInt(value)]['duration'])
        startDate = startDate.toLocaleDateString("en-US", options)
        if (startDate == 'Invalid Date') {
          return
        }
        startDateHelpBlock.innerHTML = "Your tour will end on " + startDate
      }
    })
  })

})()

function setFullName(firstName, middleInitial, lastName) {
  if (middleInitial.length == 0) {
    return firstName = " " + lastName;
  }

  return firstName + " " + middleInitial + ". " + lastName;
}

function showModal(inputTo, inputFrom, modal) {
  inputTo.value = inputFrom.value
  modal.show()
}