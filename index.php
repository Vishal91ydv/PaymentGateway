<!DOCTYPE html>
<html>

<head>
    <title>How to Integrate Razorpay payment gateway in PHP | tutorialswebsite.com</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    <link rel="stylesheet" href="style.css">

    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="tailwindcss-colors.css">

</head>

<body style="background-repeat: no-repeat; margin-top:20px">

<section class="payment-section">
        <div class="container">
            <div class="payment-wrapper">
                <div class="payment-left">
                    <div class="payment-header">
                        <div class="payment-header-icon"><i class="ri-flashlight-fill"></i></div>
                        <div class="payment-header-title">Game Changer Academy </div>
                        <p class="payment-header-description">
                            You're welcome! It's great to hear that you've received the payment. If you have any more questions or need further assistance, feel free to ask!
                        </p>
                    </div>
                    <div class="payment-content">
                        <div class="payment-body">
                            <div class="payment-plan">
                                <div class="payment-plan-type">PPF</div>
                                <div class="payment-plan-info">
                                    <div class="payment-plan-info-name">Mr. Vishal Yadav</div>
                                    <div class="payment-plan-info-price">Account number</div>
                                </div>
                                <a href="#" class="payment-plan-change"><!---add anything--></a>
                            </div>
                            <div class="payment-summary">
                                <div class="payment-summary-item">
                                    <div class="payment-summary-name">UPI ID</div>
                                    <div class="payment-summary-price">ABC1234689</div>
                                    <a href="#" class="payment-plan-change">Click for QR</a>
                                </div>
                                <div class="payment-summary-item">
                                    <div class="payment-summary-name"></div>
                                    <div class="payment-summary-price"></div>
                                    <a href="#" class="payment-plan-change"></a>
                                </div>
                                <div class="payment-summary-divider"></div>
                                <div class="payment-summary-item payment-summary-total">
                                    <div class="payment-summary-name"></div>
                                    <div class="payment-summary-price"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="payment-right">
                    <form action="index.php" class="payment-form">
                        <h1 class="payment-title">Payment Details</h1>
                        <div class="payment-method">
                            <input type="radio" name="payment-method" id="method-1" checked>
                            <label for="method-1" class="payment-method-item">
                                <img src="images/vishal-signature.jpg" alt="">
                            </label>
                            <input type="radio" name="payment-method" id="method-2">
                            <label for="method-2" class="payment-method-item">
                                <img src="images/mastercard.png" alt="">
                            </label>
                            <input type="radio" name="payment-method" id="method-3">
                            <label for="method-3" class="payment-method-item">
                                <img src="images/paypal.png" alt="">
                            </label>
                            <input type="radio" name="payment-method" id="method-4">
                            <label for="method-4" class="payment-method-item">
                                <img src="images/stripe.png" alt="">
                            </label>
                        </div>
                        <div class="payment-form-group">
                            <input type="email" placeholder=" " class="payment-form-control" name="billing_email" id="billing_email">
                            <label for="email" class="payment-form-label payment-form-label-required">Email Address</label>
                        </div>
                        <div class="payment-form-group">
                            <input type="text" placeholder=" " class="payment-form-control" name="billing_name" id="billing_name">
                            <label for="card-number" class="payment-form-label payment-form-label-required">Customer Name</label>
                        </div>
                        <div class="payment-form-group-flex">
                            <!-- <div class="payment-form-group">
                                <input type="date" placeholder=" " class="payment-form-control" id="expiry-date">
                                <label for="expiry-date" class="payment-form-label payment-form-label-required">Payment Date</label>
                            </div> -->
                            <div class="payment-form-group">
                                <input type="text" placeholder=" " class="payment-form-control" name="billing_mobile" id="billing_mobile">
                                <label for="cvv" class="payment-form-label payment-form-label-required">Phone Number</label>
                            </div>
                        </div>
                        <div class="payment-form-group">
                            <input type="text" placeholder=" " class="payment-form-control" name="payAmount" id="payAmount">
                            <label for="payment-amount" class="payment-form-label payment-form-label-required">Payment Amount (Rs)</label>
                        </div>
                        
                        <button type="submit" id="PayNow" class="payment-form-submit-button"><i class="ri-wallet-line"></i> Pay</button>
                    </form>
                </div>
            </div>
        </div>
    </section>


    <script>
        //Pay Amount
        jQuery(document).ready(function ($) {

            jQuery('#PayNow').click(function (e) {

                var paymentOption = '';
                let billing_name = $('#billing_name').val();
                let billing_mobile = $('#billing_mobile').val();
                let billing_email = $('#billing_email').val();
                var shipping_name = $('#billing_name').val();
                var shipping_mobile = $('#billing_mobile').val();
                var shipping_email = $('#billing_email').val();
                var paymentOption = "netbanking";
                var payAmount = $('#payAmount').val();

                var request_url = "submitpayment.php";
                var formData = {
                    billing_name: billing_name,
                    billing_mobile: billing_mobile,
                    billing_email: billing_email,
                    shipping_name: shipping_name,
                    shipping_mobile: shipping_mobile,
                    shipping_email: shipping_email,
                    paymentOption: paymentOption,
                    payAmount: payAmount,
                    action: 'payOrder'
                }

                $.ajax({
                    type: 'POST',
                    url: request_url,
                    data: formData,
                    dataType: 'json',
                    encode: true,
                }).done(function (data) {

                    if (data.res == 'success') {
                        var orderID = data.order_number;
                        var orderNumber = data.order_number;
                        var options = {
                            "key": data.razorpay_key, // Enter the Key ID generated from the Dashboard
                            "amount": data.userData.amount, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                            "currency": "INR",
                            "name": "Payment Testing Website", //your business name
                            "description": data.userData.description,
                            "image": "https://www.tutorialswebsite.com/wp-content/uploads/2022/02/cropped-logo-tw.png",
                            "order_id": data.userData.rpay_order_id, //This is a sample Order ID. Pass 
                            "handler": function (response) {

                                window.location.replace("http://localhost/My_work/Payment%20Gateway/payment-success.php?oid=" + orderID + "&rp_payment_id=" + response.razorpay_payment_id + "&rp_signature=" + response.razorpay_signature);

                            },
                            "modal": {
                                "ondismiss": function () {
                                    window.location.replace("http://localhost/My_work/Payment%20Gateway/payment-success.php?oid=" + orderID);
                                }
                            },
                            "prefill": { //We recommend using the prefill parameter to auto-fill customer's contact information especially their phone number
                                "name": data.userData.name, //your customer's name
                                "email": data.userData.email,
                                "contact": data.userData.mobile //Provide the customer's phone number for better conversion rates 
                            },
                            "notes": {
                                "address": "Tutorialswebsite"
                            },
                            "config": {
                                "display": {
                                    "blocks": {
                                        "banks": {
                                            "name": 'Pay using ' + paymentOption,
                                            "instruments": [

                                                {
                                                    "method": paymentOption
                                                },
                                            ],
                                        },
                                    },
                                    "sequence": ['block.banks'],
                                    "preferences": {
                                        "show_default_blocks": true,
                                    },
                                },
                            },
                            "theme": {
                                "color": "#3399cc"
                            }
                        };
                        var rzp1 = new Razorpay(options);
                        rzp1.on('payment.failed', function (response) {

                            window.location.replace("http://localhost/My_work/Payment%20Gateway/payment-failed.php?oid=" + orderID + "&reason=" + response.error.description + "&paymentid=" + response.error.metadata.payment_id);

                        });
                        rzp1.open();
                        e.preventDefault();
                    }

                });
            });
        });
    </script>
    <script src="script.js"></script>

</body>

</html>