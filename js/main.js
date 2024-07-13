function checkPhoneNumber(inputPhoneNumber)
{
  var phoneno = /^\d{10}$/;

  if (/^\d{10}$/.test(inputPhoneNumber)) {
    // alert("Valid Phone Number");
    return true;
} else {
    alert("Invalid number; Phone number must have ten digits")
    number.focus();
    return false;
}

}

function checkEmailForValiity(inputEmail)
{
var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
if (/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(inputEmail)) {
    // alert("Valid Phone Number");
    return true;
} else {
    alert("Invalid email; Please enter emailId without error!")
    number.focus();
    return false;
}

}

function checkForTermsAndConditionsChecked(tAndConditions)
{
    var lfckv = document.getElementById(tAndConditions).checked;
  if(lfckv==true)
              {
                  return true;

              }
              else
              {
                  alert("Please accept terms and conditions.");
                  number.focus();
                  return false;
              }

}

$(function(){
    $("#form-total").steps({
        headerTag: "h2",
        bodyTag: "section",
        transitionEffect: "fade",
        enableAllSteps: true,
        autoFocus: true,
        transitionEffectSpeed: 500,
        titleTemplate : '<div class="title">#title#</div>',
        labels: {
            previous : 'Back',
            next : '<button type="button" class="zmdi-chevron" style="margin-right:100px;display:block;height: 100px;width: 100px;background-color:green;color:white;">Confirm & make payment</button>',
            finish:'',
            current : ''
        },
        onStepChanging: function (event, currentIndex, newIndex) {
          var fullname = $('#first_name').val() + ' ' + $('#last_name').val();
          var email = $('#email').val();
          var phone = parseInt($('#phone').val());
          var udf1 = $('#udf1').val();
          var udf2 = $('#udf2').val();
          var purpose = $('#purpose').val();
          var amount = $('#amount').val();
          // var submit='';



            if(!fullname)
            {
                alert("Please enter your name");
                number.focus();
                  return false;
            }
            var pEmail=checkEmailForValiity(email);
            var pNumber=checkPhoneNumber(phone);
            if(!udf1)
            {
                alert("Please enter the name of the journal.");
                number.focus();
                  return false;
            }
            if(!udf2)
            {
                alert("Please enter the name of the article.");
                number.focus();
                  return false;
            }
            if(!amount)
            {
                alert("Please enter the amount to pay.");
                number.focus();
                  return false;
            }
            if(!purpose)
            {
                alert("Please enter a purpose for the payment");
                number.focus();
                  return false;
            }
            var checkedOrNot=checkForTermsAndConditionsChecked('tAndConditions');
          $('#fullname-val').text(fullname);
          $('#email-val').text(email);
          $('#phone-val').text(phone);
          $('#udf1-val').text(udf1);
          $('#udf2-val').text(udf2);
          $('#purpose-name-val').text(purpose);
          $('#amount-number-val').text(amount);

            return true;
        }
    });
});
