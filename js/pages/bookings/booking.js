(() => {
  const quickBookingButton = document.querySelector('#quickBookingNavButton')
  const customBookingButton = document.querySelector('#customBookingNavButton')
  const quickBooking = document.querySelector('#quickBooking')
  const customBooking = document.querySelector('#customBooking')

  const quickBadge = quickBookingButton.querySelector('.badge')
  const customBadge = customBookingButton.querySelector('.badge')

  quickBookingButton.addEventListener('click', () => {
    setTable(quickBookingButton, customBookingButton, quickBooking, customBooking, quickBadge, customBadge)
  })

  customBookingButton.addEventListener('click', () => {
    setTable(customBookingButton, quickBookingButton, customBooking, quickBooking, customBadge, quickBadge)
  })
})()

function setTable(button, otherButton, table, otherTable, badge, otherBadge) {
  button.setAttribute('aria-current', 'true')
  otherButton.removeAttribute('aria-current')
  otherButton.classList.remove('active')
  button.classList.add('active')
  table.classList.remove('d-none')
  otherTable.classList.add('d-none')
  badge.classList.replace('text-bg-secondary', 'text-bg-primary')
  otherBadge.classList.replace('text-bg-primary', 'text-bg-secondary')
}