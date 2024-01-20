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

class Accommodation {
  constructor(value) {
    this.star = value.charAt(0)
    switch (value) {
      case "1star":
        this.text = "One Star Hotel"
        break
      case "2star":
        this.text = "Two Star Hotel"
        break
      case "3star":
        this.text = "Three Star Hotel"
        break
      case "4star":
        this.text = "Four Star Hotel"
        break
      case "5star":
        this.text = "Five Star Hotel"
        break
    }
  }
}

class ItineraryDay {
  constructor(day, activities) {
    this.day = day
    this.activities = activities
  }
}

class Commodity {
  constructor(accommodation, food, transportation) {
    this.accommodation = accommodation
    this.food = food
    this.transportation = transportation
  }
}

class Package {
  constructor(title, destination, duration, members, commodity, itinerary, price) {
    this.title = title
    this.destination = destination
    this.duration = duration
    this.members = members
    this.price = price
    this.commodity = commodity
    this.itinerary = itinerary
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
      const customFieldInputs = document.querySelectorAll('input')
      if (quickBook.checked) {
        customFieldInputs.forEach(input => {
          input.removeAttribute('required', 'required')
        })
      } else {
        customFieldInputs.forEach(input => {
          input.setAttribute('required', 'required')
        })
      }
    } else {
      console.log("valid")
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
    window.location.replace('add-new-booking.php')
  });

  const startDateInput = document.querySelector('#customStartDate')
  const endDateInput = document.querySelector('#customEndDate')

  var today = new Date()
  today.setDate(today.getDate() + 2)
  today = today.toISOString().split('T')[0];
  startDateInput.min = today
  startDateInput.addEventListener('input', () => {
    var nextDay = new Date(startDateInput.value)
    try {
      nextDay.setDate(nextDay.getDate() + 1)
      endDateInput.min = nextDay.toISOString().split('T')[0];
      endDateInput.removeAttribute('disabled')
    } catch (e) {
      endDateInput.setAttribute('disabled', 'disabled')
    }

  })

  const summaryFinishButton = document.getElementById("summaryFinishButton")
  const summaryBackButton = document.getElementById("summaryBackButton")

  const basicDetailsNextButton = document.getElementById("basicDetailsNextButton")
  const basicDetailsPart = document.getElementById("basicDetailsPart")
  const itineraryPart = document.getElementById("itineraryPart")
  const summaryPart = document.getElementById("summaryPart")

  function goToPart(currentPart, nextPart) {
    nextPart.classList.remove("d-none")
    currentPart.classList.add("d-none")
  }

  function goToNextPart(currentPart, event) {
    if (!addBookingsForm.checkValidity()) {
      event.preventDefault()
      event.stopPropagation()
    } else {
      var nextPart
      switch (currentPart) {
        case basicDetailsPart:
          nextPart = itineraryPart
          break;
        case itineraryPart:
          nextPart = summaryPart
          break
        default:
          break;
      }
      goToPart(currentPart, nextPart)
      return true
    }

    addBookingsForm.classList.add('was-validated')
    return false
  }

  function goToLastPart(currentPart, lastPart) {
    goToPart(currentPart, lastPart)
  }

  function removeValidation(success) {
    if (success) {
      addBookingsForm.classList.remove('was-validated')
    }
  }

  function loadItineraryPart(numOfDays) {
    const itineraryInputContainerId = "itineraryInputContainer"
    const itineraryInputContainer = document.getElementById(itineraryInputContainerId)
    for (let i = 1; i <= numOfDays; i++) {
      const accordionItem = document.createElement("div")
      accordionItem.setAttribute("class", "accordion-item")

      const accordionHeader = document.createElement("h2")
      accordionHeader.className = "accordion-header"
      accordionHeader.id = "heading" + i

      const accordionCollapse = document.createElement("div")
      accordionCollapse.setAttribute("id", "collapse" + i)
      accordionCollapse.setAttribute("class", "accordion-collapse collapse show")
      accordionCollapse.setAttribute("aria-labelledby", "heading" + i)
      accordionCollapse.setAttribute("data-bs-parent", itineraryInputContainerId)

      const accordionButton = document.createElement("button")
      accordionButton.className = "accordion-button"
      accordionButton.type = "button"
      accordionButton.dataset.bsToggle = "collapse"
      accordionButton.dataset.bsTarget = "#collapse" + i
      accordionButton.setAttribute("aria-expanded", "true")
      accordionButton.setAttribute("aria-controls", "collapse" + i)

      const headerText = document.createElement("span")
      headerText.setAttribute("class", "fw-bold fs-5")
      headerText.innerHTML = "Day " + i

      const accordionBody = document.createElement("div")
      accordionBody.setAttribute("class", "accordion-body p-5")

      const info = document.createElement("div")
      info.setAttribute("class", "card card-tertiary text-tertiary p-3 info")

      const infoP = document.createElement("p")
      infoP.setAttribute("class", "text-muted lh-1")
      infoP.innerHTML = "No activities yet, add one."

      const inputDiv = document.createElement("div")
      inputDiv.setAttribute("class", "mb-3 position-relative d-flex mt-5")

      const label = document.createElement("label")
      label.setAttribute("for", "input" + 1)

      const xmlns = "http://www.w3.org/2000/svg"

      const mapSVG = document.createElementNS(xmlns, "svg")
      mapSVG.setAttributeNS(null, "width", "16")
      mapSVG.setAttributeNS(null, "height", "16")
      mapSVG.setAttributeNS(null, "fill", "rgba(0, 85, 170)")
      mapSVG.setAttribute(null, "viewBox", "0 0 16 16")

      const mapPath = document.createElementNS(xmlns, "path")
      mapPath.setAttributeNS(null, "fill-rule", "evenodd")
      mapPath.setAttributeNS(null, "d", "M16 .5a.5.5 0 0 0-.598-.49L10.5.99 5.598.01a.5.5 0 0 0-.196 0l-5 1A.5.5 0 0 0 0 1.5v14a.5.5 0 0 0 .598.49l4.902-.98 4.902.98a.5.5 0 0 0 .196 0l5-1A.5.5 0 0 0 16 14.5zM5 14.09V1.11l.5-.1.5.1v12.98l-.402-.08a.5.5 0 0 0-.196 0zm5 .8V1.91l.402.08a.5.5 0 0 0 .196 0L11 1.91v12.98l-.5.1z")

      const iconContainer = document.createElement("div")
      iconContainer.setAttribute("class", "icon-container position-absolute")

      const buttonContainer = document.createElement("div")
      buttonContainer.setAttribute("class", "button-container position-absolute")

      const addButton = document.createElement("button")
      addButton.setAttribute("type", "button")
      addButton.setAttribute("class", "btn btn-tertiary")
      addButton.addEventListener("click", () => {
        input.removeEventListener("focusout", focusOut)
        if (input.value.length > 0) {
          addPlaceOrActivity(input, accordionBody, info)
        } else if (input.value.length == 0) {
          input.focus()
          input.setAttribute("style", "box-shadow: 0 0 1px 4px rgba(170, 0, 0, 0.5);")
          mapSVG.setAttributeNS(null, "fill", "rgba(170, 0, 0)")
          input.addEventListener("input", () => {
            input.removeAttribute("style")
            mapSVG.setAttributeNS(null, "fill", "rgba(0, 85, 170)")
          })
          input.addEventListener("focusout", focusOut)
        }
      })

      const addSVG = document.createElementNS(xmlns, "svg")
      addSVG.setAttributeNS(null, "width", "24")
      addSVG.setAttributeNS(null, "height", "24")
      addSVG.setAttributeNS(null, "fill", "rgba(0, 85, 170)")
      addSVG.setAttributeNS(null, "viewBox", "0 0 16 16")

      const addPath = document.createElementNS(xmlns, "path")
      addPath.setAttributeNS(null, "fill-rule", "evenodd")
      addPath.setAttributeNS(null, "d", "M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2")

      const input = document.createElement("input")
      input.setAttribute("type", "text")
      input.setAttribute("class", "form-control ps-5 me-5 py-3")
      input.setAttribute("id", "input" + i)
      input.setAttribute("placeholder", "Add a place or activity")
      input.addEventListener("keydown", event => {
        if (event.key == "Enter") {
          event.preventDefault()
          event.stopPropagation()
          if (input.value.length == 0) {
            input.setAttribute("style", "box-shadow: 0 0 1px 4px rgba(170, 0, 0, 0.5);")
            mapSVG.setAttributeNS(null, "fill", "rgba(170, 0, 0)")
            input.addEventListener("input", () => {
              input.removeAttribute("style")
              mapSVG.setAttributeNS(null, "fill", "rgba(0, 85, 170)")
            })
          } else if (input.value.length > 0) {
            addPlaceOrActivity(input, accordionBody, info)
          }
        }
      })

      function focusOut() {
        input.removeAttribute("style")
        mapSVG.setAttributeNS(null, "fill", "rgba(0, 85, 170)")
      }

      input.addEventListener("focusout", focusOut)

      addSVG.appendChild(addPath)
      addButton.appendChild(addSVG)
      buttonContainer.appendChild(addButton)
      mapSVG.appendChild(mapPath)
      iconContainer.appendChild(mapSVG)
      label.appendChild(iconContainer)
      label.appendChild(buttonContainer)
      inputDiv.appendChild(label)
      inputDiv.appendChild(input)
      info.appendChild(infoP)
      accordionBody.appendChild(info)
      accordionBody.appendChild(inputDiv)
      accordionCollapse.appendChild(accordionBody)
      accordionButton.appendChild(headerText)
      accordionHeader.appendChild(accordionButton)
      accordionItem.appendChild(accordionHeader)
      accordionItem.appendChild(accordionCollapse)
      itineraryInputContainer.appendChild(accordionItem)
    }
  }

  basicDetailsNextButton.addEventListener("click", event => {
    const success = goToNextPart(basicDetailsPart, event)
    removeValidation(success)
    if (success) {
      var endDate = new Date(endDateInput.value)
      var startDate = new Date(startDateInput.value)
      let diffTime = Math.abs(endDate - startDate)
      let duration = Math.ceil(diffTime / (1000 * 60 * 60 * 24))
      loadItineraryPart(duration)
    }
  }, true)

  const itineraryBackButton = document.getElementById("itineraryBackButton")
  itineraryBackButton.addEventListener("click", () => {
    goToLastPart(itineraryPart, basicDetailsPart)
    Array.from(itineraryInputContainer.querySelectorAll(".accordion-item")).forEach(item => {
      itineraryInputContainer.removeChild(item)
    })
  })

  var itineraries = []

  summaryBackButton.addEventListener("click", event => {
    itineraries = []
    document.querySelector("#price").removeAttribute("required")
    goToLastPart(summaryPart, itineraryPart)
  })

  const itineraryNextButton = document.getElementById("itineraryNextButton")

  itineraryNextButton.addEventListener("click", event => {
    const items = itineraryInputContainer.querySelectorAll(".accordion-item")
    for (var i = 0; i < items.length; i++) {
      var activities = items[i].querySelectorAll(".activity")
      if (activities.length == 0) {
        event.preventDefault()
        event.stopPropagation()
        alert("Your package itinerary is empty! Please add at least one activity or place in each day.")
        return
      }
      var activitiesOrPlace = []
      for (var j = 0; j < activities.length; j++) {
        activitiesOrPlace.push(activities[j].querySelector("span").innerHTML + '. ' + activities[j].querySelector("p").innerHTML)
      }
      itineraries.push(new ItineraryDay("Day" + (i + 1), activitiesOrPlace))
      loadPackageSummary()
      const success = goToNextPart(itineraryPart, event)
      removeValidation(success)
    }
  })

  document.addEventListener("keydown", event => {
    if (event.key == "Enter") {
      event.preventDefault()
      event.stopPropagation()
      const formPart = document.querySelector(".form-part:not(.d-none)")
      if (formPart == itineraryPart) {
        const items = itineraryInputContainer.querySelectorAll(".accordion-item")
        for (var i = 0; i < items.length; i++) {
          if (items[i].querySelectorAll(".activity").length == 0) {
            alert("Your package itinerary is empty! Please add at least one activity or place in each day.")
            return
          }
          loadPackageSummary()
          goToNextPart(formPart, event)

          const price = document.querySelector("#price")
          price.setAttribute("required", "required")
          price.focus()
        }
        return
      }
      const success = goToNextPart(formPart, event)
      removeValidation(success)
      if (success) {
        loadItineraryPart(document.getElementById("duration").value)
      }
    }
  })

  function addPlaceOrActivity(inputSource, accordionBody, info) {
    const placeOrActivitiesLength = accordionBody.querySelectorAll(".activity").length + 1
    if (placeOrActivitiesLength > 0) {
      info.classList.add("d-none")
    } else {
      info.classList.remove("d-none")
    }
    const a = document.createElement("div")
    a.setAttribute("class", "card mb-4 position-relative d-flex flex-row activity")
    const b = document.createElement("span")
    const c = document.createElement("button")
    const d = document.createElement("p")
    d.setAttribute("class", "p-3 fw-bold ms-4")
    b.setAttribute("class", "badge text-bg-primary me-2 lh-1 position-absolute p-3 translate-middle")
    c.setAttribute("type", "button")
    c.setAttribute("class", "btn btn-secondary position-absolute end-0 top-50 translate-middle-y")
    c.addEventListener("click", () => {
      accordionBody.removeChild(a)
      const spans = accordionBody.querySelectorAll("span")
      if (spans.length > 0) {
        info.classList.add("d-none")
      } else {
        info.classList.remove("d-none")
      }
      for (var j = 0; j < spans.length; j++) {
        spans[j].innerHTML = j + 1
      }
    })
    c.innerHTML = "Delete"
    b.innerHTML = placeOrActivitiesLength
    d.innerHTML = inputSource.value

    a.appendChild(d)
    a.insertBefore(b, a.lastChild)
    a.appendChild(c)
    accordionBody.insertBefore(a, accordionBody.childNodes[accordionBody.childNodes.length - 2])
    inputSource.value = ""
  }

  function loadPackageSummary() {
    const destination = document.querySelector("#destination")
    const duration = document.querySelector("#duration")
    const members = document.querySelector('#members')
    const accommodation = new Accommodation(document.querySelector("input[name = 'accommodation']:checked").value)
    const food = document.querySelector("input[name = 'food']:checked")
    const transportation = document.querySelector("input[name = 'transportation']:checked")
    const cardContent = document.querySelector("#cardContent")
    let options = { month: 'long', day: 'numeric', year: 'numeric' };
    var startDate = new Date(startDateInput.value)
    var endDate = new Date(endDateInput.value)
    startDate = startDate.toLocaleDateString("en-US", options)
    endDate = endDate.toLocaleDateString("en-US", options)
    cardContent.innerHTML = `
    <div class="mb-3">
    <h6 class="fw-bold">Destination</h6>
    <p>` + destination.value + `</p>
    </div>
    <div class="mb-3">
    <h6 class="fw-bold">Duration</h6>
    <p>` + startDate + " to " + endDate + `</p>
    </div>
    <div class="mb-3">
    <h6 class="fw-bold">Members</h6>
    <p>` + members.value + ` members</p>
    </div>
    <div class="mb-3">
    <h6 class="fw-bold">Accommodation</h6>
    <p>` + accommodation.text + `</p>
    </div>
    <div class="mb-3">
    <h6 class="fw-bold">Food</h6>
    <p class="text-capitalize">` + food.value + `</p>
    </div>
    <div class="mb-3">
    <h6 class="fw-bold">Transportation</h6>
    <p class="text-capitalize">` + transportation.value + `</p>
      `
  }

  summaryFinishButton.addEventListener("click", event => {
    if (!form.checkValidity()) {
      event.preventDefault()
      event.stopPropagation()
    } else {
      event.preventDefault()
      var commodity = new Commodity(
        new Accommodation(document.querySelector("input[name = 'accommodation']:checked").value),
        document.querySelector("input[name = 'food']:checked").value,
        document.querySelector("input[name = 'transportation']:checked").value
      )

      var tourPackage = new Package(
        document.querySelector("#packageTitle").value,
        document.querySelector("#destination").value,
        document.querySelector("#duration").value,
        new Members(document.querySelector("#minNumOfMembers").value, document.querySelector("#maxNumOfMembers").value),
        commodity,
        itineraries,
        document.querySelector("#price").value
      )

      var data = JSON.stringify(tourPackage)
      console.log(data)

      fetch("../../process/create-package-process.php", {
        method: "POST",
        body: data,
        headers: {
          "Content-Type": "application/json; charset=utf-8"
        }
      })
        .then(() => {
          window.location.replace("../../pages/packages/packages.php")
        })

    }


    form.classList.add("was-validated")
  }, true)
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