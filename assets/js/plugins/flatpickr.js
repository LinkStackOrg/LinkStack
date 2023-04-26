const datetime = document.querySelectorAll('.flatpickr_datetime')
Array.from(datetime, (elem) => {
  if(typeof flatpickr !== typeof undefined) {
    flatpickr(elem, {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
    })
  }
}) 
const humandate = document.querySelectorAll('.flatpickr_humandate')
Array.from(humandate, (elem) => {
  if(typeof flatpickr !== typeof undefined) {
    flatpickr(elem, {
      altInput: true,
      altFormat: "F j, Y",
      dateFormat: "Y-m-d",
  })
  }
}) 
const minDate = document.querySelectorAll('.flatpickr_minDate')
Array.from(minDate, (elem) => {
  if(typeof flatpickr !== typeof undefined) {
    flatpickr(elem, {
      minDate: "2020-01"
  }
  )
  }
}) 
const maxDate = document.querySelectorAll('.flatpickr_maxDate')
Array.from(maxDate, (elem) => {
  if(typeof flatpickr !== typeof undefined) {
    flatpickr(elem,{
      dateFormat: "d.m.Y",
      maxDate: "15.12.2017"
  }
  
  )
  }
}) 
const specificdisable = document.querySelectorAll('.flatpickr_specificdisable')
Array.from(specificdisable, (elem) => {
  if(typeof flatpickr !== typeof undefined) {
    flatpickr(elem ,
      {
        disable: ["2025-01-30", "2025-02-21", "2025-03-08", new Date(2025, 4, 9) ],
        dateFormat: "Y-m-d",
    }
  )
  }
}) 


const disableexcept = document.querySelectorAll('.flatpickr_disableexcept')
Array.from(disableexcept, (elem) => {
  if(typeof flatpickr !== typeof undefined) {
    flatpickr(elem , {
      enable: ["2025-03-30", "2025-05-21", "2025-06-08", new Date(2025, 8, 9) ]
  }
      
  )
  }
}) 
const multidate = document.querySelectorAll('.flatpickr_multidate')
Array.from(multidate, (elem) => {
  if(typeof flatpickr !== typeof undefined) {
    flatpickr(elem , {
      mode: "multiple",
      dateFormat: "Y-m-d"
  }
      
  )
  }
}) 


const range = document.querySelectorAll('.flatpickrrange')
Array.from(range, (elem) => {
  if(typeof flatpickr !== typeof undefined) {
    flatpickr(elem, {
      mode: "range",
      minDate: "today",
      dateFormat: "Y-m-d",
    })
  }
}) 
const date= document.querySelectorAll('.flatpickrdate')
Array.from(date, (elem) => {
  if(typeof flatpickr !== typeof undefined) {
    flatpickr(elem, {
      minDate: "today",
      dateFormat: "Y-m-d",
    })
  }
})

const time = document.querySelectorAll('.flatpickrtime')
Array.from(time, (elem) => {
  if(typeof flatpickr !== typeof undefined) {
    flatpickr(elem, {
      enableTime: true,
      noCalendar: true,
      dateFormat: "H:i",
    })
  }
}) 


