<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <script src="https://js.braintreegateway.com/web/3.99.0/js/client.min.js"></script>
    <script src="https://js.braintreegateway.com/web/3.99.0/js/hosted-fields.min.js"></script>
</head>

<body>
    <form id="checkout-form" method="post" action="{{ route('checkout.process') }}">
        @csrf
        <div id="card-number"></div>
        <div id="cvv"></div>
        <div id="expiration-date"></div>
        <button type="submit">Paga</button>
    </form>

    <script>
        braintree.dropin.create({
            authorization: "{{ $clientToken }}",
            container: '#checkout-form'
        }, function(createErr, instance) {
            document.getElementById('checkout-form').addEventListener('submit', function(event) {
                event.preventDefault();

                instance.requestPaymentMethod(function(err, payload) {
                    // Aggiungi il nonce al modulo
                    var nonceInput = document.createElement('input');
                    nonceInput.setAttribute('type', 'hidden');
                    nonceInput.setAttribute('name', 'payment_method_nonce');
                    nonceInput.setAttribute('value', payload.nonce);
                    document.getElementById('checkout-form').appendChild(nonceInput);

                    // Invia il modulo
                    document.getElementById('checkout-form').submit();
                });
            });
        });
    </script>
</body>

</html>
