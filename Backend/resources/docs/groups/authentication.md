# Authentication


## Login


Login into the system.

> Example request:

```bash
curl -X POST \
    "http://sittracker.test/api/v1/auth/login" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"email":"vel","password":"ut"}'

```

```javascript
const url = new URL(
    "http://sittracker.test/api/v1/auth/login"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "vel",
    "password": "ut"
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());
```


> Example response (200):

```json
{
    "token_type": "Bearer",
    "expires_in": 31536000,
    "access_token": "XXXX",
    "refresh_token": "XXXX"
}
```
> Example response (422):

```json
{
    "message": "The given data was invalid.",
    "errors": {
        "email": [
            "The email field is required."
        ]
    }
}
```
<div id="execution-results-POSTapi-v1-auth-login" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-auth-login"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-auth-login"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-auth-login" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-auth-login"></code></pre>
</div>
<form id="form-POSTapi-v1-auth-login" data-method="POST" data-path="api/v1/auth/login" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-auth-login', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/auth/login</code></b>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>email</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="email" data-endpoint="POSTapi-v1-auth-login" data-component="body" required  hidden>
<br>
Email Address</p>
<p>
<b><code>password</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="password" data-endpoint="POSTapi-v1-auth-login" data-component="body" required  hidden>
<br>
Password</p>

</form>


## Register


Register into the system.

> Example request:

```bash
curl -X POST \
    "http://sittracker.test/api/v1/auth/register" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"first_name":"ut","last_name":"reprehenderit","email":"nostrum","password":"fuga","company_name":"deleniti","company_telephone_number":"reprehenderit","company_postal_code":"recusandae","company_address":"quos"}'

```

```javascript
const url = new URL(
    "http://sittracker.test/api/v1/auth/register"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "first_name": "ut",
    "last_name": "reprehenderit",
    "email": "nostrum",
    "password": "fuga",
    "company_name": "deleniti",
    "company_telephone_number": "reprehenderit",
    "company_postal_code": "recusandae",
    "company_address": "quos"
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());
```


> Example response (200):

```json
{
    "token_type": "Bearer",
    "expires_in": 31536000,
    "access_token": "XXXX",
    "refresh_token": "XXXX"
}
```
> Example response (422):

```json
{
    "message": "The given data was invalid.",
    "errors": {
        "first_name": [
            "The first name field is required."
        ],
        "email": [
            "The email has already been taken."
        ]
    }
}
```
<div id="execution-results-POSTapi-v1-auth-register" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-auth-register"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-auth-register"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-auth-register" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-auth-register"></code></pre>
</div>
<form id="form-POSTapi-v1-auth-register" data-method="POST" data-path="api/v1/auth/register" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-auth-register', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/auth/register</code></b>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>first_name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="first_name" data-endpoint="POSTapi-v1-auth-register" data-component="body" required  hidden>
<br>
First Name</p>
<p>
<b><code>last_name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="last_name" data-endpoint="POSTapi-v1-auth-register" data-component="body" required  hidden>
<br>
Last Name</p>
<p>
<b><code>email</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="email" data-endpoint="POSTapi-v1-auth-register" data-component="body" required  hidden>
<br>
Email</p>
<p>
<b><code>password</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="password" data-endpoint="POSTapi-v1-auth-register" data-component="body" required  hidden>
<br>
Password</p>
<p>
<b><code>company_name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="company_name" data-endpoint="POSTapi-v1-auth-register" data-component="body" required  hidden>
<br>
Company Name</p>
<p>
<b><code>company_telephone_number</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="company_telephone_number" data-endpoint="POSTapi-v1-auth-register" data-component="body" required  hidden>
<br>
Company Telephone</p>
<p>
<b><code>company_postal_code</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="company_postal_code" data-endpoint="POSTapi-v1-auth-register" data-component="body" required  hidden>
<br>
Company Postal Code</p>
<p>
<b><code>company_address</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="company_address" data-endpoint="POSTapi-v1-auth-register" data-component="body" required  hidden>
<br>
Company Address</p>

</form>


## Logout

<small class="badge badge-darkred">requires authentication</small>

Logout out of the system.

> Example request:

```bash
curl -X GET \
    -G "http://sittracker.test/api/v1/auth/logout" \
    -H "Authorization: Bearer {YOUR_AUTH_KEY}" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://sittracker.test/api/v1/auth/logout"
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
{}
```
<div id="execution-results-GETapi-v1-auth-logout" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-v1-auth-logout"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-auth-logout"></code></pre>
</div>
<div id="execution-error-GETapi-v1-auth-logout" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-auth-logout"></code></pre>
</div>
<form id="form-GETapi-v1-auth-logout" data-method="GET" data-path="api/v1/auth/logout" data-authed="1" data-hasfiles="0" data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-auth-logout', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/v1/auth/logout</code></b>
</p>
<p>
<label id="auth-GETapi-v1-auth-logout" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="GETapi-v1-auth-logout" data-component="header"></label>
</p>
</form>



