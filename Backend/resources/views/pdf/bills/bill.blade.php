<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>Email title or subject</title>

		<style>
            html,
            body {
                margin: 0px;
                padding-left: 40px;
                padding-right: 40px;
            }

            table {
				max-width: 800px;
				margin: auto;
				font-size: 16px;
				line-height: 24px;
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				color: #555;
			}

            .heading {
				color: #aaaaaa;
                text-transform: uppercase;
                font-size: 12px;
			}

            .total {
                font-size: 16px;
            }

            /* -- Helpers -- */
            .text-primary {
                color: #006bff !important;
            }
            .text-white {
                color: #ffffff !important;
            }
            .text-black {
                color: #000000 !important;
            }
            .text-center {
                text-align: center
            }
            table .text-left {
                text-align: left;
            }
            table .text-right {
                text-align: right;
            }
            .border-0 {
                border: none;
            }

            .background-primary {
                background-color: #006bff
            }

            .font-weight-bold {
                font-weight: bold
            }
            .font-weight-normal {
                font-weight: normal
            }

            .pt-0 {
                padding-top: 0px;
            }
            .p-0 {
                padding: 0px;
            }
            .p-5 {
                padding: 5px;
            }
            .p-10 {
                padding: 10px;
            }
            .pl-10 {
                padding-left: 10px;
            }
            .pl-5 {
                padding-left: 5px;
            }
            .py-10 {
                padding-bottom: 10px;
                padding-top: 10px;
            }
            .py-5 {
                padding-bottom: 5px;
                padding-top: 5px;
            }

            .m-0 {
                margin: 0px;
            }
            .mt-30 {
                margin-top: 30px;
            }
            .mb-60 {
                margin-bottom: 60px;
            }
            .my-20 {
                margin-top: 20px;
                margin-bottom: 20px;
            }
            
            .w-10 {
                width: 10%;
            }
            .w-20 {
                width: 20%
            }
            .w-30 {
                width: 30%;
            }
            .w-75 {
                width: 75%;
            }
            .w-100 {
                width: 100%;
            }

            .vertical-align-top {
                vertical-align: top;
            }

            .border-bottom {
                border-bottom: 0.620315px solid #E8E8E8;
            }
		</style>
	</head>

	<body>
        <table cellpadding="0" cellspacing="0" class="invoice-box w-100 mb-60">
            <tr>
                <td>
                    <img class="logo" src="https://logoipsum.com/logo/logo-26.svg" alt="Company Logo">
                </td>
                <td class=" text-right">
                    <h1 class="text-primary">{{ $type }} #{{ $number }}</h1>
                </td>
            </tr>
            <tr class="text-right">
                <td></td>
                <td>
                    <b>Life Style Builders.</b><br />
                    20 Rochdale Road<br />
                    Tunbridge Wells<br />
                    Kent<br />
                    TN1 2JE<br />
                </td>
            </tr>
        </table>

        <table cellpadding="0" cellspacing="0" class="invoice-box w-100">
            <tr>
                <td class="p-0">
                    <table cellpadding="0" cellspacing="0" class="invoice-box w-75 m-0">
                        <thead class="border-bottom text-left background-primary text-white">
                            <tr>
                                <th class="font-weight-normal py-5 pl-5">Bill To</th>
                                <th class="font-weight-normal py-5">Date</th>
                                <th class="font-weight-normal py-5">Due Date</th>
                            </tr>
                        </thead>
                        <tr class="item vertical-align-top">
                            <td class="pl-5">
                                <b>Luna Blogs.</b><br />
                                St James Road<br />
                                Seven Oaks<br />
                                BE1 27H<br />
                            </td>
            
                            <td>{{ $creation_date }}</td>
                            <td>{{ $due_date }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <table cellpadding="0" cellspacing="0" class="invoice-box w-100 mt-30">
            <thead class="border-bottom text-left background-primary text-white">
                <tr>
                    <th class="font-weight-normal py-5 pl-5">#</th>
                    <th class="font-weight-normal py-5">Description</th>
                    <th class="font-weight-normal py-5">Quantity</th>
                    <th class="font-weight-normal py-5">Unit Price</th>
                    <th class="font-weight-normal py-5 text-center">Total</th>
                </tr>
            </thead>
            @foreach($items as $item)
                <tr class="item">
                    <td class="border-bottom pl-5">{{ $loop->index }}</td>
                    <td class="border-bottom pl-5">{{ $item->item->name }}</td>
                    <td class="border-bottom pl-5">{{ $item->quantity }}</td>
                    <td class="border-bottom pl-5">{{ $item->net }}</td>
                    <td class="border-bottom pl-5 text-center">£36.00</td>
                </tr>
            @endforeach
        </table>

        <table class="invoice-box w-100">
            <tr class="heading text-right">
                <td>SubTotal</td>
                <td class="w-10 text-black"><span class="total">£489.60</span></td>
            </tr>
            <tr class="heading text-right" colspan="4">
                <td class="pt-0">VAT</td>
                <td class="w-10 border-bottom pt-0 text-black"><span class="total">20%</span></td>
            </tr>
            <tr class="heading text-right">
                <td>Total</td>
                <td class="w-10 text-primary font-weight-bold"><span class="total text-primary">£612.00</span></td>
            </tr>
        </table>

        <table class="invoice-box w-100">
            <thead class="border-bottom text-left heading">
                <tr>
                    <th class="font-weight-normal py-5 pl-5">Terms & Conditions</th>
                    <th class="font-weight-normal py-5">Notes</th>
                </tr>
            </thead>
            <tr class="item">
                <td class="pl-5">
                    Please pay to our Chase Bank Account<br/>
                    Account Number: 1234567890<br/>
                    Routing Number: 9876543219<br/>
                    <br/>
                    Thank you for your business!
                </td>
                <td class="vertical-align-top">This Invoice is non refundable</td>
            </tr>
        </table>
	</body>
</html>