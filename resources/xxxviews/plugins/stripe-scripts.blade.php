<script>

  $(document).ready(function () {
    $("#city").on('change', function () {
      var city = $("#city").val();

      $.ajax({
        url: '/customer/region',
        type: 'POST',
        data: {
          'city': city,
          '_token': '{{ csrf_token() }}'
        },
        complete: function (text) {
          $("#region").html(text.responseText);
          var region = $("#region").val();
          $.ajax({
            url: '/customer/location',
            type: 'POST',
            data: {
              'region': region,
              '_token': '{{ csrf_token() }}'
            },
            complete: function (text) {
              $("#location").html(text.responseText);

            },
          });
        },
      });

    });

    $("#region").on('change', function () {

      var region = $("#region").val();
      $.ajax({
        url: '/customer/location',
        type: 'POST',
        data: {
          'region': region,
          '_token': '{{ csrf_token() }}'
        },
        complete: function (text) {
          $("#location").html(text.responseText);

        },
      });


    });

  }); </script>
  <script src = "https://js.stripe.com/v2/" > < /script> <
    script type = "text/javascript" >
    $(document).ready(function () {


      Stripe.setPublishableKey("{{ config('services.stripe.key') }}");

      // target the form
      // on form submission, create a token
      $('#stripe-form').submit(function (e) {
        e.preventDefault();

        var parentNode = $('.login-box').length > 0 ? $(".login-box") : $(".wrapper");

        $('.loader').show();
        parentNode.addClass('blur-filter');

        var form = $(this)

        Stripe.card.createToken(form, function (status, response) {
          if (response.error) {
            form.find('.stripe-errors').text(response.error.message).removeClass('hide');
            $('.loader').hide();
            parentNode.removeClass('blur-filter');
          } else {
            // console.log(response);

            // append the token to the form
            form.append($('<input type="hidden" name="cc_token">').val(response.id));

            // submit the form
            form.get(0).submit();
          }
        });
      });
    });
  </script>