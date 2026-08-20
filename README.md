# Portfolio Contact API

Backend API for the [Ryan Lim WH Portfolio](https://portfolio-ryanlimwh.com), built with Laravel and deployed on Render.

The API handles portfolio contact form submissions, validates and stores messages, verifies hCaptcha submissions, applies rate limiting, and sends email notifications through Resend.

## Features

- Contact form API endpoint
- Request validation
- hCaptcha verification
- PostgreSQL database storage
- Email notifications via Resend API
- Visitor email used as `Reply-To`
- CORS configuration for the portfolio frontend
- IP-based rate limiting
- Production deployment with Docker and Render
- Environment-based configuration for secrets

## Tech Stack

- **Laravel 13**
- **PHP 8.3**
- **PostgreSQL**
- **Resend**
- **hCaptcha**
- **Docker**
- **Render**

## API

### `POST /api/contact`

Accepts a portfolio contact form submission.

#### Request

```json
{
  "name": "John Doe",
  "email": "john@example.com",
  "subject": "Project Inquiry",
  "message": "I'd like to discuss a project with you.",
  "captchaToken": "hcaptcha-token"
}
