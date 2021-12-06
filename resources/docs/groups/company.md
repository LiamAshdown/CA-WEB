# Company


## Show Company

<small class="badge badge-darkred">requires authentication</small>

Show Company Details which user belongs to

<aside class="notice">permission: view company</aside>

> Example request:

```bash
curl -X GET \
    -G "http://sittracker.test/api/v1/company" \
    -H "Authorization: Bearer {YOUR_AUTH_KEY}" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://sittracker.test/api/v1/company"
);

let headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response => response.json());
```


> Example response (200):

```json
{
    "data": {
        "id": 75,
        "name": "Elfrieda Lynch",
        "telephone_number": "453-553-5061",
        "postal_code": "59750",
        "address": "2086 Walter Streets Apt. 986\nJaidenmouth, CT 88365",
        "logo_path": "",
        "created_at": "2021-04-03T19:49:10.000000Z",
        "updated_at": "2021-04-03T19:49:10.000000Z"
    }
}
```
<div id="execution-results-GETapi-v1-company" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-v1-company"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-company"></code></pre>
</div>
<div id="execution-error-GETapi-v1-company" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-company"></code></pre>
</div>
<form id="form-GETapi-v1-company" data-method="GET" data-path="api/v1/company" data-authed="1" data-hasfiles="0" data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-company', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/v1/company</code></b>
</p>
<p>
<label id="auth-GETapi-v1-company" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="GETapi-v1-company" data-component="header"></label>
</p>
</form>


## Update Company

<small class="badge badge-darkred">requires authentication</small>

Update Company Details

<aside class="notice">permission: update company</aside>

> Example request:

```bash
curl -X POST \
    "http://sittracker.test/api/v1/company/update" \
    -H "Authorization: Bearer {YOUR_AUTH_KEY}" \
    -H "Content-Type: multipart/form-data" \
    -H "Accept: application/json" \
    -F "name=quod" \
    -F "address=quia" \
    -F "postal_code=dolores" \
    -F "telephone_number=sunt" \
    -F "logo=@/tmp/phpWP7NMg" 
```

```javascript
const url = new URL(
    "http://sittracker.test/api/v1/company/update"
);

let headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
};

const body = new FormData();
body.append('name', 'quod');
body.append('address', 'quia');
body.append('postal_code', 'dolores');
body.append('telephone_number', 'sunt');
body.append('logo', document.querySelector('input[name="logo"]').files[0]);

fetch(url, {
    method: "POST",
    headers,
    body,
}).then(response => response.json());
```


> Example response (200):

```json
{
    "message": "Successfully updated company."
}
```
> Example response (422, Validation Error):

```json
{
    "message": "The given data was invalid.",
    "errors": {
        "name": [
            "The name field is required."
        ],
        "address": [
            "The address field is required."
        ],
        "postal_code": [
            "The postal code field is required."
        ],
        "telephone_number": [
            "The telephone number field is required."
        ]
    }
}
```
<div id="execution-results-POSTapi-v1-company-update" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-company-update"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-company-update"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-company-update" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-company-update"></code></pre>
</div>
<form id="form-POSTapi-v1-company-update" data-method="POST" data-path="api/v1/company/update" data-authed="1" data-hasfiles="1" data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"multipart\/form-data","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-company-update', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/company/update</code></b>
</p>
<p>
<label id="auth-POSTapi-v1-company-update" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-v1-company-update" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="name" data-endpoint="POSTapi-v1-company-update" data-component="body" required  hidden>
<br>
Name</p>
<p>
<b><code>address</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="address" data-endpoint="POSTapi-v1-company-update" data-component="body" required  hidden>
<br>
Address</p>
<p>
<b><code>postal_code</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="postal_code" data-endpoint="POSTapi-v1-company-update" data-component="body" required  hidden>
<br>
Postal Code</p>
<p>
<b><code>telephone_number</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="telephone_number" data-endpoint="POSTapi-v1-company-update" data-component="body" required  hidden>
<br>
Telephone Number</p>
<p>
<b><code>logo</code></b>&nbsp;&nbsp;<small>file</small>     <i>optional</i> &nbsp;
<input type="file" name="logo" data-endpoint="POSTapi-v1-company-update" data-component="body"  hidden>
<br>
optional Logo</p>

</form>



