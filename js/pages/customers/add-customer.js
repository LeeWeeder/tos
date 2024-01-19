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
      var formData = new FormData(document.querySelector("#form"))
      fetch("../../process/add-customer-process.php", {
        method: "POST",
        body: formData
      }).then((response) => {
        response.text()
      }).then(text => {
        console.log(text)
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