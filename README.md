# xadrezdasmari-as_webpage

A website for Xadrez das Marianas chess community built with Angular and Decap CMS.

## Features

- **Angular Framework**: Modern web application built with Angular
- **Decap CMS**: Git-based content management system for easy content editing
- **Blog Posts**: Create and manage blog posts about chess
- **Pages**: Static pages for About, Contact, etc.

## Getting Started

### Prerequisites

- Node.js (v18 or higher)
- npm

### Installation

```bash
npm install
```

### Development Server

```bash
npm start
```

Navigate to `http://localhost:4200/`. The application will automatically reload if you change any of the source files.

### Build

```bash
npm run build
```

The build artifacts will be stored in the `dist/` directory.

## Decap CMS

This project uses Decap CMS for content management.

### Accessing the CMS

Once deployed, you can access the CMS admin interface at `/admin` (e.g., `http://your-domain.com/admin`).

### CMS Configuration

The CMS configuration is located at `public/admin/config.yml`. You can customize:

- Content collections (blog posts, pages, etc.)
- Fields for each content type
- Media folder location
- Authentication backend

### Content Structure

- **Blog Posts**: Located in `content/blog/`
- **Pages**: Located in `content/pages/`
- **Images**: Uploaded to `public/images/uploads/`

### Authentication

To use Decap CMS in production, you'll need to:

1. Set up a Git Gateway (e.g., Netlify Identity)
2. Configure authentication in `public/admin/config.yml`
3. Enable Git Gateway in your hosting provider

For local development, you can use the test backend by updating the config:

```yaml
backend:
  name: test-repo
```

## Project Structure

```
xadrezdasmari-as_webpage/
├── content/              # Content files
│   ├── blog/            # Blog posts (Markdown)
│   └── pages/           # Static pages (Markdown)
├── public/              # Static assets
│   ├── admin/           # Decap CMS admin interface
│   │   ├── index.html
│   │   └── config.yml
│   └── images/          # Images and media
├── src/                 # Angular application source
│   ├── app/             # Application components
│   └── main.ts          # Application entry point
└── angular.json         # Angular configuration
```

## Contributing

Feel free to submit issues and enhancement requests!

## License

See LICENSE file for details.