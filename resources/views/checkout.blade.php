<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <script src="https://js.braintreegateway.com/web/3.99.0/js/client.min.js"></script>
    <script src="https://js.braintreegateway.com/web/3.99.0/js/hosted-fields.min.js"></script>
    <script src="https://js.braintreegateway.com/web/dropin/1.30.0/js/dropin.min.js"></script>
    <script src="https://js.braintreegateway.com/web/3.99.0/js/dropin.min.js"></script>

    @vite(['resources/js/app.js'])
    @vite(['resources/js/cv_modal.js'])
</head>

<body>
    <form id="checkout-form" method="post" action="{{ route('checkout.process') }}">
        @csrf
        <div id="bt-dropin"></div>
        <div class="input-container d-none">
            <label for="price">Total:</label>
            <div id="fixed_price">
                <input class="price-input" type="text" id="price" name="price" value="{{ $price }}"
                    readonly>
                <span id="currency">€</span>
            </div>
            <small>You are purchasing {{ $hours }}h at {{ $price }}€.</small>
            <div>
                <button class="btn btn-primary" type="submit">Pay now</button>
                <button class="btn btn-danger" type="button" onclick="resetSession(event)">Cancel</button>
            </div>
        </div>
        <div id="error-message" class="text-danger d-none"></div>
    </form>

    <script>
        var clientToken = {!! json_encode($clientToken->getOriginalContent()['token']) !!};
        console.log("Client Token:", clientToken);

        let isProcessing = false;
        braintree.dropin.create({
            authorization: clientToken,
            container: '#bt-dropin'
        }, function(createErr, instance) {
            if (createErr) {
                console.error('Error in creating the Drop-in:', createErr);
                return;
            }

            checkPaymentOption();

            document.getElementById('checkout-form').addEventListener('submit', function(event) {
                event.preventDefault();

                if (isProcessing) {
                    return;
                }

                isProcessing = true;

                instance.requestPaymentMethod(function(err, payload) {
                    if (err) {
                        isProcessing = false;
                        console.error('Error in the payment method:', err);
                        document.getElementById('error-message').classList.remove('d-none');
                        return;
                    }

                    var nonceInput = document.createElement('input');
                    nonceInput.setAttribute('type', 'hidden');
                    nonceInput.setAttribute('name', 'payment_method_nonce');
                    nonceInput.setAttribute('value', payload.nonce);
                    document.getElementById('checkout-form').appendChild(nonceInput);

                    var priceInput = document.createElement('input');
                    priceInput.setAttribute('type', 'hidden');
                    priceInput.setAttribute('name', 'price');
                    priceInput.setAttribute('value', document.getElementById('price').value);

                    document.getElementById('checkout-form').submit();

                    clear();
                });
            });
        });

        const optionsPay = document.querySelector('.input-container');
        const paymentBraintree = document.getElementById('bt-dropin');

        function checkPaymentOption() {
            const showCardClass = paymentBraintree.querySelector('.braintree-show-card');

            if (showCardClass) {
                optionsPay.classList.remove('d-none');
            } else {
                optionsPay.classList.add('d-none');
            }
        }

        function clear() {
            console.log('clicked');
            optionsPay.classList.add('d-none');
        }

        function resetSession(event) {
            event.preventDefault();
            fetch("{{ route('admin.session.reset') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": '{{ csrf_token() }}'
                },
            }).then(() => {
                window.location.href = "{{ route('admin.sponsorship.index') }}";
            }).catch((error) => {
                isProcessing = false;
                console.error('Error during session reset:', error)
            });
        }
    </script>
</body>

</html>
