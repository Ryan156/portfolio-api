# Portfolio API

Laravel REST API powering the contact form for my portfolio website.

## Tech Stack

- Laravel
- PHP
- MySQL
- Eloquent ORM
- hCaptcha
- Resend SMTP
- Cloudflare Email Routing

## Features

- Contact form API
- Server-side validation
- hCaptcha verification
- MySQL persistence
- Email notifications
- Visitor `Reply-To` handling
- API rate limiting
- CORS configuration

## API

### POST `/api/contact`

Accepts:

```json
{
  "name": "John Doe",
  "email": "john@example.com",
  "subject": "Job Opportunity",
  "message": "I'd like to discuss..."
}
