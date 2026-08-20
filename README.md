# Portfolio Contact API

Backend API for my personal portfolio website, built with Laravel and deployed on Render.

The API handles contact form submissions, validates and stores messages, verifies hCaptcha, applies rate limiting, and sends email notifications through Resend.

## Features

- Contact form API
- Request validation
- hCaptcha verification
- PostgreSQL database
- Email notifications via Resend
- Visitor email used as `Reply-To`
- CORS configuration
- IP-based rate limiting
- Docker deployment
- Production deployment with Render
- Environment-based configuration for secrets

## Tech Stack

- Laravel 13
- PHP 8.3
- PostgreSQL
- Resend
- hCaptcha
- Docker
- Render

## API Endpoint

### `POST /api/contact`

Accepts contact form submissions from the portfolio website.

#### Request

```json
{
  "name": "John Doe",
  "email": "john@example.com",
  "subject": "Project Inquiry",
  "message": "I'd like to discuss a project with you.",
  "captchaToken": "hcaptcha-token"
}
```

#### Successful Response

```json
{
  "message": "Contact form submitted successfully."
}
```

## Rate Limiting

The contact endpoint is limited to **5 requests per minute per IP address** to help prevent spam and abuse.

## Email Flow

```text
Portfolio Frontend
       ↓
Laravel API
       ↓
hCaptcha Verification
       ↓
PostgreSQL
       ↓
Resend API
       ↓
Email Notification
```

The visitor's submitted email address is used as the `Reply-To` address, allowing replies to be sent directly to the person who submitted the form.

## Environment Variables

The application uses environment variables for secrets and environment-specific configuration.

```env
APP_ENV=production
APP_DEBUG=false
APP_KEY=

DATABASE_URL=

HCAPTCHA_SECRET_KEY=

RESEND_API_KEY=

MAIL_MAILER=resend
MAIL_FROM_ADDRESS=
MAIL_FROM_NAME=

CONTACT_EMAIL_ADDRESS=
```

Sensitive values are not committed to the repository.

## Local Development

Clone the repository:

```bash
git clone https://github.com/Ryan156/portfolio-api.git
cd portfolio-api
```

Install dependencies:

```bash
composer install
```

Create the environment file:

```bash
cp .env.example .env
```

Generate the application key:

```bash
php artisan key:generate
```

Configure the required environment variables, then run:

```bash
php artisan migrate
```

Start the development server:

```bash
php artisan serve
```

The API will be available at:

```text
http://127.0.0.1:8000
```

## Production

The API is containerized with Docker and deployed on Render.

Production secrets and configuration are provided through Render environment variables rather than being stored in the repository.

## Project Structure

```text
app/
├── Http/
│   └── Controllers/
│       └── ContactController.php
├── Mail/
│   └── ContactReceived.php
└── Models/
    └── Contact.php

database/
└── migrations/
    └── *_create_contacts_table.php

resources/
└── views/
    └── emails/

routes/
└── api.php
```

## Related Project

Portfolio website:

https://portfolio-ryanlimwh.com

---

Built as part of my personal portfolio project to demonstrate full-stack development, API integration, deployment, and production infrastructure.
