<template>
    <div>
        <div class="row middle-xs">
            <div class="col col-xs-6">
                <div class="form-group m-xs-b-4">
                    <label class="form-label">
                        Amount
                    </label>
                    <input v-model="amount" class="form-control">
                </div>
            </div>
            <div class="col col-xs-6">
                <div class="form-group m-xs-b-4">
                  
                </div>
            </div>
        </div>
        <div class="text-right">
            <button class="btn btn-primary btn-block"
                @click="openStripe"
                :class="{ 'btn-loading': processing }"
                :disabled="processing"
            >
                Make Payment
            </button>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'price',
            'serviceTitle',
            'concertId',
            'sellerStripeKey',
        ],
        data() {
            return {
                amount: null,
                stripeHandler: null,
                processing: false,
            }
        },
        computed: {
            description() {
                // if (this.quantity > 1) {
                //     return `${this.quantity} tickets to ${this.concertTitle}`
                // }
                return `${this.serviceTitle}`
            },
            totalPrice() {
                return this.quantity * this.price
            },
            priceInDollars() {
                return (this.price / 100).toFixed(2)
            },
            totalPriceInDollars() {
                return (this.totalPrice / 100).toFixed(2)
            },
            amountInCents() {
              return this.amount * 100;
            },
        },
        methods: {
            initStripe() {
                const handler = StripeCheckout.configure({
                    key: App.stripeSellerPublicKey
                })

                window.addEventListener('popstate', () => {
                    handler.close()
                })

                return handler
            },
            openStripe(callback) {
                this.stripeHandler.open({
                    name: 'Market Place',
                    description: this.description,
                    currency: "usd",
                    allowRememberMe: false,
                    panelLabel: 'Pay ' + this.amount,
                    amount: this.totalPrice,
                    image: '/img/checkout-icon.png',
                    token: this.makePayment,
                })


            },
            makePayment(token) {
                this.processing = true

                axios.post(`/payment`, {
                    email: token.email,
                    amount: this.amountInCents,
                    payment_token: token.id,
                }).then(response => {
                   window.location = `/payment`
                }).catch(response => {
                    this.processing = false
                })
            }
        },
        created() {
            this.stripeHandler = this.initStripe()
        }
    }
</script>
