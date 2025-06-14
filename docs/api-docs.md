# API Documentation

## Authentication

### POST /api/register
- name, email, password

### POST /api/login
- email, password

### POST /api/logout

## Resume

### POST /api/resumes
- Upload PDF file

### GET /api/resumes
- List all resumes

### GET /api/resumes/{id}
- Show one resume

### DELETE /api/resumes/{id}

### GET /api/resumes/search?skill=Laravel
- Filter resumes by skill
