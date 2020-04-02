$(document).ready(function() {
    var contacto = $("#contacto");
    //We set our own custom submit function
    contacto.on("submit", function(e) {
      //Prevent the default behavior of a form
      e.preventDefault();
      //Get the values from the form
      var name = $("#name").val();
      var company = $("#company").val();
      var email = $("#email").val();
      var phone = $("#phone").val();
      var message = $("#message").val();
      if (grecaptcha.getResponse() == ""){
        alert("Verifica que no eres un robot!");
        } else {
            //alert("Gracias!);
            //Our AJAX POST
            $.ajax({
                type: "POST",
                url: "php/contacto-enviarMail.php",
                data: {
                    "name": name,
                    "company": company,
                    "email": email,
                    "phone": phone,
                    "message": message,
                    //This will tell the form if user is captcha varified in backend (of course yes if he is there, check line 13).
                    "g-recaptcha-response": grecaptcha.getResponse()
                },
                success: function() {
                    alert("Mensaje Enviado!");
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    alert("ERROR! (servidor)");
                }
            })
        }
    });
  });