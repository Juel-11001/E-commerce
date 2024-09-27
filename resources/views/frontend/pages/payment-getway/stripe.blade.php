<div class="tab-pane fade" id="v-pills-stripe" role="tabpanel" aria-labelledby="v-pills-profile-tab">
    <div class="row">
        <div class="col-xl-12 m-auto">
            <div class="wsus__payment_area">
                <form action="{{ route('user.stripe-payment') }}" method="POST" id="checkout-form">
                    @csrf
                    <input type="hidden" id="stripe-token-id" name="stripe_token">
                    <div id="card-element" class="form-control mb-3"></div>
                    <a href="#" id="pay_btn" class="nav-link common_btn text-center" onclick="createToken()"
                        type="button">Pay with Stripe</a>
                </form>
            </div>
        </div>
    </div>
</div>
@php
    $stripeSetting = App\Models\StripeSetting::first();
@endphp
@push('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        var stripe = Stripe("{{ $stripeSetting->client_id }}");
        var elements = stripe.elements();
        var cardElement = elements.create('card');
        cardElement.mount('#card-element');
        //create function for stripeToken:
        function createToken() {
            document.getElementById('pay_btn').disabled = true;
            stripe.createToken(cardElement).then(function(result) {
                if (typeof result.error != 'undefined') {
                    document.getElementById('pay_btn').disabled = false;
                    alert(result.error.message);
                }
                //create token success:
                if (typeof result.token != 'undefined') {
                    document.getElementById('stripe-token-id').value = result.token.id;
                    document.getElementById('checkout-form').submit();
                }
            });
        }
    </script>
@endpush
