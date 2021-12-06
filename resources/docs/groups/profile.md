# Profile


## Profile

<small class="badge badge-darkred">requires authentication</small>

Show User profile details

> Example request:

```bash
curl -X GET \
    -G "http://sittracker.test/api/v1/profile" \
    -H "Authorization: Bearer {YOUR_AUTH_KEY}" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://sittracker.test/api/v1/profile"
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
        "first_name": "Bret",
        "last_name": "Frami",
        "email": "davion.walsh@example.com",
        "role": "company admin",
        "permissions": [
            "view user",
            "store user",
            "update user",
            "view company",
            "update company",
            "view customization",
            "update customization"
        ]
    }
}
```
<div id="execution-results-GETapi-v1-profile" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-v1-profile"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-profile"></code></pre>
</div>
<div id="execution-error-GETapi-v1-profile" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-profile"></code></pre>
</div>
<form id="form-GETapi-v1-profile" data-method="GET" data-path="api/v1/profile" data-authed="1" data-hasfiles="0" data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-profile', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/v1/profile</code></b>
</p>
<p>
<label id="auth-GETapi-v1-profile" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="GETapi-v1-profile" data-component="header"></label>
</p>
</form>


## Update Profile Details

<small class="badge badge-darkred">requires authentication</small>



> Example request:

```bash
curl -X POST \
    "http://sittracker.test/api/v1/profile/update" \
    -H "Authorization: Bearer {YOUR_AUTH_KEY}" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"first_name":"nemo","last_name":"necessitatibus","email":"ut","password":"at"}'

```

```javascript
const url = new URL(
    "http://sittracker.test/api/v1/profile/update"
);

let headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "first_name": "nemo",
    "last_name": "necessitatibus",
    "email": "ut",
    "password": "at"
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
    "message": "Successfully updated profile."
}
```
> Example response (422, Validation Error):

```json
{
    "message": "The given data was invalid.",
    "errors": {
        "first_name": [
            "The first name field is required."
        ],
        "last_name": [
            "The last name field is required."
        ],
        "email": [
            "The email field is required."
        ]
    }
}
```
<div id="execution-results-POSTapi-v1-profile-update" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-profile-update"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-profile-update"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-profile-update" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-profile-update"></code></pre>
</div>
<form id="form-POSTapi-v1-profile-update" data-method="POST" data-path="api/v1/profile/update" data-authed="1" data-hasfiles="0" data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-profile-update', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/profile/update</code></b>
</p>
<p>
<label id="auth-POSTapi-v1-profile-update" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-v1-profile-update" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>first_name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="first_name" data-endpoint="POSTapi-v1-profile-update" data-component="body" required  hidden>
<br>
First Name</p>
<p>
<b><code>last_name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="last_name" data-endpoint="POSTapi-v1-profile-update" data-component="body" required  hidden>
<br>
Last Name</p>
<p>
<b><code>email</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="email" data-endpoint="POSTapi-v1-profile-update" data-component="body" required  hidden>
<br>
Email</p>
<p>
<b><code>password</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="password" data-endpoint="POSTapi-v1-profile-update" data-component="body"  hidden>
<br>
optional Password</p>

</form>



