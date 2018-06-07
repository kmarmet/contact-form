(function() {
   const request    = new XMLHttpRequest();
   const errors     = document.querySelector('.contact-error');
   const submit     = document.querySelector('.contact-submit');
   const token      = document.querySelector(".token").value;
   const form       = document.querySelector('.contact-form');
   const checkbox   = document.querySelectorAll('.contact-red-checkbox');
   let inquiryArray = [];
   let modelArray   = [];

   function createPostString(form) {
      let postString = '';

      for (let i = 0; i < form.elements.length; i++) {
         let input = form.elements[i];
         if (!input.name || input.disabled || input.type === 'file' || input.type === 'reset' || input.type === 'submit' || input.type === 'button') {
            continue;
         }
         if ((input.type !== 'checkbox' && input.type !== 'radio') || input.checked) {
            postString += `&${encodeURIComponent(input.name)}=${encodeURIComponent(input.value)}`;
         }
      }
      return postString;
   }

   checkbox.forEach(function(box) {
      box.addEventListener('click', function(event) {
         const clicked      = event.target;
         const input        = clicked.querySelector('input');
         const checkboxType = clicked.getAttribute('data-contact-type');
         let removalIndex   = (`${checkboxType}Array`).indexOf(input.value);

         if (clicked.classList.contains('active')) {
            clicked.classList.remove('active');
            clicked.children[0].checked = false;

            if (checkboxType === 'inquiry') {
               if (removalIndex > -1) inquiryArray.splice(removalIndex, 1);
            }
            else {
               if (removalIndex > -1) modelArray.splice(removalIndex, 1);
            }
         }

         else {
            clicked.classList.add('active');
            clicked.children[0].checked = true;
            checkboxType === 'inquiry' ? inquiryArray.push(input.value) : modelArray.push(input.value);
         }
      });
   });

   // On Submit button click
   submit.addEventListener('click', function(event) {
      event.preventDefault();
      // Check if captcha is checked
      if (grecaptcha.getResponse().length <= 0) {
         event.preventDefault();
      }

      request.onreadystatechange = function() {
         if (this.readyState === 4 && this.status === 200) {
            const array = JSON.parse(this.responseText);
            console.log(array);

            if (array.hasOwnProperty('error') && array['error'].length > 0) {
               grecaptcha.reset();
               onScroll.scrollToTop();
               errors.classList.add('active');
               errors.innerHTML = `<h1>MISSING FIELDS</h1><br> ${array['error']}`;
            }
            else if (array['redirect'] !== '') {
               window.location.replace('/index.php');
            }
            else if (array['redirect'] === '' && array['error'] === '') {
               window.location.replace('/inc/contact-form/contact-confirmation.php');
            }
         }
      };

      request.open('POST', 'inc/contact-form/spamBlocker/validate.php');
      request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      request.send(`response=${grecaptcha.getResponse()}&token=${token}${createPostString(form)}&inquiry_array=${JSON.stringify(inquiryArray)}&model_array=${JSON.stringify(modelArray)}`);
   });
})();
