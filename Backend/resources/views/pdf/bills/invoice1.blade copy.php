<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>Email title or subject</title>


		<style>
            .invoice-box {
				max-width: 800px;
				margin: auto;
				padding: 30px;
				border: 1px solid #eee;
				box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
				font-size: 16px;
				line-height: 24px;
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				color: #555;
			}

            .invoice-box table tr.heading td {
				color: #aaaaaa;
				font-weight: bold;
                text-transform: uppercase
			}

            /* -- Helpers -- */
            .text-primary {
                color: #5851DB;
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

            .p-10 {
                padding: 10px;
            }
            .py-10 {
                padding-bottom: 10px;
                padding-top: 10px;
            }
            
            .w-75 {
                width: 75%;
            }
            .w-100 {
                width: 100%;
            }

            .border-bottom {
                border-bottom: 0.620315px solid #E8E8E8;
            }

            /* -- Reset -- */
            #outlook a {padding:0;} /* Force Outlook to provide a "view in browser" menu link. */ 
            .ExternalClass {width:100%;} /* Force Hotmail to display emails at full width */  
            .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;} /* Forces Hotmail to display normal line spacing.*/ 
            p {margin: 0; padding: 0; font-size: 0px; line-height: 0px;} /* squash Exact Target injected paragraphs */
            table td {border-collapse: collapse;} /* Outlook 07, 10 padding issue fix */
            table {border-collapse: collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; } /* remove spacing around Outlook 07, 10 tables */
            
            /* bring inline */
            img {display: block; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic;}
            a img {border: none;} 
            a {text-decoration: none; color: #000001;} /* text link */
            a.phone {text-decoration: none; color: #000001 !important; pointer-events: auto; cursor: default;} /* phone link, use as wrapper on phone numbers */
            span {font-size: 13px; line-height: 17px; font-family: monospace; color: #000001;}
		</style>
	</head>

	<body>
        <table class="invoice-box" cellpadding="0" cellspacing="0">
            <tr>
                <td colspan="2">
                    Logo Here
                </td>
            </tr>
            <tr>
                <td colspan="2" class="py-10">
                    <b>Infinum Inc.</b><br />
                    340 S LEMON AVE 9714<br />
                    WALNUT, CA 91789<br />
                    VAT: VAT01234567890
                </td>
            </tr>
        </table>

        <table cellpadding="0" cellspacing="0" class="invoice-box w-75">
            <tr>
                <td colspan="2">
                    <h1>Invoice 1234</h1>
                </td>
            </tr>
            <tr class="heading">
                <td>
                    Bill To
                </td>
                <td>
                    Date
                </td>
                <td>
                    Due Date
                </td>
            </tr>
            <tr class="item">
                <td>
                    <b>Infinum Inc.</b><br />
                    340 S LEMON AVE 9714<br />
                    WALNUT, CA 91789<br />
                    VAT: VAT01234567890
                </td>

                <td>$300.00</td>
                <td>$300.00</td>
            </tr>
        </table>

        <table cellpadding="0" cellspacing="0" class="invoice-box w-100">
            <tr class="heading">
                <td class="border-bottom p-10">
                    #
                </td>
                <td class="border-bottom p-10">
                    Description
                </td>
                <td class="border-bottom p-10">
                    Unit
                </td>
                <td class="border-bottom p-10">
                    QTY
                </td>
                <td class="border-bottom p-10">
                    Rate
                </td>
                <td class="border-bottom p-10">
                    Amount
                </td>
            </tr>
            <tr class="item">
                <td class="border-bottom p-10">1</td>
                <td class="border-bottom p-10">Space Shuttle X</td>
                <td class="border-bottom p-10">hours</td>
                <td class="border-bottom p-10">2</td>
                <td class="border-bottom p-10">$120,000.00</td>
                <td class="border-bottom p-10">$240,000.00</td>
            </tr>
        </table>
	</body>
</html>