
## 📄 Smart Resume Uploader & Viewer API

This API allows users to register, login, upload resumes (PDF), view, search, and delete resumes securely using Laravel Sanctum authentication.

---

### 🔐 Authentication Endpoints

#### ➕ Register
- **URL:** `/api/register`
- **Method:** `POST`
- **Body (JSON):**
  ```json
  {
    "name": "tt Doe",
    "email": "tt@example.com",
    "password": "12345678",
    "password_confirmation": "12345678"
  }
  ```
- **Response:** `201 Created`

#### 🔑 Login
- **URL:** `/api/login`
- **Method:** `POST`
- **Body (JSON):**
  ```json
  {
    "email": "tt@example.com",
    "password": "12345678"
  }

  Bearer Token : "3|Js5iETfpYgxRbLtfOrt28dAHPMdUltOeWUh8b1C00ba5f455"
  ```
- **Response:** `200 OK` (includes token)

#### 🚪 Logout
- **URL:** `/api/logout`
- **Method:** `POST`
- **Headers:**
  ```
  Authorization: Bearer {TOKEN}
  ```
- **Response:** `200 OK`

---

### 📁 Resume Management Endpoints (Authenticated)

> All the following endpoints require the `Authorization: Bearer {TOKEN}` header.

#### 📤 Upload Resume
- **URL:** `/api/upload-resumes`
- **Method:** `POST`
- **Headers:**
  ```
  Authorization: Bearer {TOKEN}
  Content-Type: multipart/form-data
  ```
- **Body (form-data):**
  ```
  resume: <PDF File>
  ```
- **Response:** `201 Created`

#### 📋 List All Resumes
- **URL:** `/api/resumes`
- **Method:** `GET`
- **Headers:**
  ```
  Authorization: Bearer {TOKEN}
  ```
- **Response:** `200 OK`

#### 🔍 View a Resume
- **URL:** `/api/resumes/{id}`
- **Method:** `GET`
- **Headers:**
  ```
  Authorization: Bearer {TOKEN}
  ```
- **Response:** `200 OK`

#### ❌ Delete a Resume
- **URL:** `/api/resumes/{id}`
- **Method:** `DELETE`
- **Headers:**
  ```
  Authorization: Bearer {TOKEN}
  ```
- **Response:** `204 No Content`

#### 🔎 Search Resumes
- **URL:** `/api/resumes/search`
- **Method:** `POST`
- **Headers:**
  ```
  Authorization: Bearer {TOKEN}
  Content-Type: application/json
  ```
- **Body (JSON):**
  ```json
  {
    "query": "Laravel Developer"
  }
  ```
- **Response:** `200 OK`

---

### 🧪 Testing with Postman

To test the API:
1. Register or login to receive your token.
2. Use the token in `Authorization: Bearer {TOKEN}` header for all protected routes.
3. Upload a PDF resume, search, or manage existing resumes.

---

### 📦 Tech Stack
- Laravel 10.x
- Laravel Sanctum
- SQLite or MySQL (based on environment)
- File Storage for Resumes
