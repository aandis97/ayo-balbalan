let current_datetime = new Date()
let formatted_date = current_datetime.getDate() + "-" + (current_datetime.getMonth() + 1) + "-" + current_datetime.getFullYear()
// console.log(formatted_date)

function sweetAlertDefault(html, type, timer ) {
      Swal.fire({
          html: html,
          icon: type,
          timer: timer,
          width: '350px',
          padding: '1em',
          position: 'top-end',
          showCancelButton: false,
          showConfirmButton: false
      });
  }
  
  function sweetAlertLoading(html, timer ) {
      Swal.fire({
          title: html,
          width: '350px',
          padding: '1em',
          position: 'top-end',
          showCancelButton: false,
          showConfirmButton: false,
          timer: timer,
          onBeforeOpen: () => {
              Swal.showLoading()
          }
      })  
  }

  jQuery.validator.addMethod("exactlength", function(value, element, param) {
    return this.optional(element) || value.length == param;
   }, $.validator.format("Please enter exactly {0} characters."));
  
  jQuery.extend(jQuery.validator.messages, {
      required: 'Harus di isi.',
      remote: "Please fix this field xx.",
      email: "Masukan email dengan benar.",
      url: "Please enter a valid URL.",
      date: "Harus format tanggal.",
      dateISO: "Please enter a valid date (ISO).",
      number: "Harus berupa angka.",
      digits: "Please enter only digits.",
      creditcard: "Please enter a valid credit card number.",
      equalTo: "Please enter the same value again.",
      accept: "Please enter a value with a valid extension.",
      maxlength: jQuery.validator.format("Maksimal panjang huruf {0}."),
      minlength: jQuery.validator.format("Minimal panjang huruf {0}."),
      rangelength: jQuery.validator.format("Please enter a value between {0} and {1} characters long."),
      range: jQuery.validator.format("Please enter a value between {0} and {1}."),
      max: jQuery.validator.format("Tidak Lebih dari {0}."),
      min: jQuery.validator.format("Tidak Kurang dari {0}.")
  });


  
function delay(callback, ms) {
    var timer = 0;
    return function() {
        var context = this, args = arguments;
        clearTimeout(timer);
        timer = setTimeout(function () {
        callback.apply(context, args);
        }, ms || 0);
    };
}