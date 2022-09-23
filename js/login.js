const ipnElement = document.querySelector('#pass')
const ipnElement2 = document.querySelector('#pass2')
const btnElement = document.querySelector('#btnPassword')
const btnElement2 = document.querySelector('#btnPassword2')

btnElement.addEventListener('click', function() {
  const currentType = ipnElement.getAttribute('type')
  ipnElement.setAttribute(
    'type',
    currentType === 'password' ? 'text' : 'password'
   
  )
});

  btnElement2.addEventListener('click', function() {
   
    const currentType2 = ipnElement2.getAttribute('type')
    ipnElement2.setAttribute(
      'type',
    
      currentType2 === 'password' ? 'text' : 'password'
    )
  })

