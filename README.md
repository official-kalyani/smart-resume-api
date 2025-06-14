✅ 1. Start Your Laravel App
If you're not already running it:

php artisan serve

Register a User
POST http://127.0.0.1:8000/api/register

Body (JSON) → raw:


{
  "name": "Test User",
  "email": "test@example.com",
  "password": "password",
  "password_confirmation": "password"
}

✅ 3. Login to Get Token
POST http://127.0.0.1:8000/api/login

Body (JSON):
{
  "email": "test@example.com",
  "password": "password"
}
Copy the access_token from the response. You’ll need it for all protected routes.

4. Set Authorization in Postman
Go to the Authorization tab → choose Bearer Token
Paste your token:
Bearer eyJ0eXAiOiJKV1QiOiJhbGciOiJ...

5. Upload a Resume
POST http://127.0.0.1:8000/api/resumes

Body → form-data:

KEY	TYPE	VALUE
resume	File	Select a .pdf resume
Make sure to set the Authorization (Bearer Token) for this request.
6. View All Resumes
GET http://127.0.0.1:8000/api/resumes

Shows all resumes uploaded by the user, with parsed fields.
 7. View Single Resume
GET http://127.0.0.1:8000/api/resumes/1
(Replace 1 with a valid ID from the list)



9. Delete a Resume
DELETE http://127.0.0.1:8000/api/resumes/1
(Replace 1 with the actual resume ID)

 Step-by-Step: Upload PDF Resume via Postman
Method:
POST

URL:
http://127.0.0.1:8000/api/resumes

Authorization tab:

Type: Bearer Token

Paste your login access_token (from /api/login response)

Headers: (optional, usually auto-set)

Make sure Content-Type is multipart/form-data (automatically set by Postman when you add a file).

Body tab:

Select form-data

Add a single field:

KEY	TYPE	VALUE
resume	File	Click and select a PDF file from your computer

Example:


Send the request.

Go to the Body tab.

Select form-data.

In the Key, type resume.

Change the type of the key from Text ➝ File:

Click on the dropdown beside resume (where it says Text), and select **File**.

Now, in the Value column, click "Select Files" and choose your sample_resume.pdf.
Make sure the Authorization tab has your Bearer Token.

Hit Send again.

3. Search Resumes by Skill
Method: POST

URL: http://127.0.0.1:8000/api/resumes/search

Headers:

Accept: application/json

Authorization: Bearer YOUR_TOKEN_HERE (if using Sanctum auth)

Body (form-data or raw JSON):

{
  "skill": "Laravel"
}
Or in form-data:

Key: skill

Value: Laravel

 Follow these steps:
Go to the Headers tab.

In the first empty row:

Key: Accept

Value: application/json

Make sure the checkbox is ✅ enabled for that row.

Here’s how it should look:

Key	    Value
Accept	application/json


5. Upload PDF Resume via Postman
Method:
POST

URL:
http://127.0.0.1:8000/api/resumes

Authorization tab:

Type: Bearer Token

Paste your login access_token (from /api/login response)

Headers: (optional, usually auto-set)

Make sure Content-Type is multipart/form-data .

Body tab:

Select form-data

Add a single field:

KEY	TYPE	VALUE
resume	File	Click and select a PDF file from your computer

Example:


Send the request.


