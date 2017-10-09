<script>
window.App = {
    csrfToken: '{{ csrf_token() }}',
    stripePublicKey: '{{ config('services.stripe.key') }}',
    stripeSellerPublicKey: '{{ session('stripe_seller_public_key') }}',
}
</script>
