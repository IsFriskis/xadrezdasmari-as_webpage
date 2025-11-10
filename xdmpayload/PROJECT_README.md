# Xadrez das Mariñas - PayloadCMS + Astro Project

This project combines PayloadCMS (headless CMS) with an Astro frontend for the Xadrez das Mariñas chess club website.

## Project Structure

```
xdmpayload/
├── src/                    # PayloadCMS backend source
│   ├── collections/        # CMS collections (Users, Media, etc.)
│   ├── app/               # Next.js app for PayloadCMS admin
│   └── payload.config.ts  # PayloadCMS configuration
├── frontend/              # Astro frontend
│   ├── src/
│   │   ├── layouts/       # Astro layouts
│   │   ├── pages/         # Astro pages
│   │   └── components/    # Astro components
│   └── public/            # Static assets
├── package.json           # PayloadCMS dependencies
├── .env                   # Environment variables (not in git)
└── README.md             # This file
```

## Prerequisites

- Node.js (v18.20.2 or v20.9.0+)
- MongoDB (local or remote instance)
- npm or pnpm

## Quick Start

### 1. Install PayloadCMS Dependencies

```bash
npm install
# or
pnpm install
```

### 2. Configure Environment

Copy `.env.example` to `.env` and configure:

```env
DATABASE_URI=mongodb://127.0.0.1/xdmpayload
PAYLOAD_SECRET=your-secret-here
```

### 3. Start PayloadCMS Backend

```bash
npm run dev
```

PayloadCMS admin panel will be available at [http://localhost:3000/admin](http://localhost:3000/admin)

### 4. Create Your First Admin User

1. Navigate to [http://localhost:3000/admin](http://localhost:3000/admin)
2. Fill in the form to create your admin account

### 5. Install and Start Astro Frontend

In a new terminal:

```bash
cd frontend
npm install
npm run dev
```

The Astro frontend will be available at [http://localhost:4321](http://localhost:4321)

## Architecture

### Backend (PayloadCMS)

- **Port**: 3000
- **Admin Panel**: http://localhost:3000/admin
- **REST API**: http://localhost:3000/api
- **GraphQL API**: http://localhost:3000/api/graphql

PayloadCMS provides:
- Content management interface
- REST and GraphQL APIs
- Media management with image optimization
- User authentication and authorization
- TypeScript types generation

### Frontend (Astro)

- **Port**: 4321
- **Build**: Static site generation (SSG)

Astro provides:
- Fast, static site generation
- Component-based architecture
- Minimal JavaScript by default
- SEO optimization

## Development Workflow

1. **Define Content Models**: Create collections in PayloadCMS (`src/collections/`)
2. **Add Content**: Use the admin panel to add/edit content
3. **Fetch Data**: Use PayloadCMS API in Astro pages
4. **Build Frontend**: Generate static pages with Astro

## Example: Fetching Data from PayloadCMS in Astro

```astro
---
// In your Astro page
const response = await fetch('http://localhost:3000/api/posts');
const { docs: posts } = await response.json();
---

<div>
  {posts.map(post => (
    <article>
      <h2>{post.title}</h2>
      <p>{post.content}</p>
    </article>
  ))}
</div>
```

## Available Scripts

### PayloadCMS (Root)

- `npm run dev` - Start development server
- `npm run build` - Build for production
- `npm run start` - Start production server
- `npm run generate:types` - Generate TypeScript types

### Astro Frontend (frontend/)

- `npm run dev` - Start development server
- `npm run build` - Build static site
- `npm run preview` - Preview production build

## MongoDB Setup

### Using Docker (Recommended)

The project includes a `docker-compose.yml` file:

```bash
docker-compose up -d
```

### Using Local MongoDB

Install MongoDB locally and ensure it's running on port 27017.

## Production Deployment

### PayloadCMS

1. Set up MongoDB (MongoDB Atlas, Railway, etc.)
2. Set environment variables
3. Build: `npm run build`
4. Start: `npm run start`

### Astro Frontend

1. Build: `cd frontend && npm run build`
2. Deploy the `frontend/dist/` directory to:
   - Netlify
   - Vercel
   - GitHub Pages
   - Any static hosting service

## Configuration

### PayloadCMS Collections

Edit collections in `src/collections/`. Default collections:
- **Users**: Admin users with authentication
- **Media**: File uploads with image optimization

### Astro Configuration

Edit `frontend/astro.config.mjs` for:
- Build settings
- Integrations
- Server options

## Troubleshooting

### MongoDB Connection Issues

- Ensure MongoDB is running
- Check DATABASE_URI in `.env`
- For Docker: `docker-compose up -d`

### Port Conflicts

- PayloadCMS: Change port in `package.json` scripts
- Astro: Change port in `frontend/astro.config.mjs`

## Resources

- [PayloadCMS Documentation](https://payloadcms.com/docs)
- [Astro Documentation](https://docs.astro.build)
- [MongoDB Documentation](https://docs.mongodb.com)

## License

MIT
