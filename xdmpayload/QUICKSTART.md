# Quick Start Guide - xdmpayload

Get up and running with the PayloadCMS + Astro project in 5 minutes!

## Prerequisites

- Node.js v18.20.2+ or v20.9.0+
- npm or pnpm
- MongoDB (local or Docker)

## Option 1: Quick Setup (Recommended)

Run the automated setup script:

```bash
cd xdmpayload
./setup.sh
```

This will:
- Check dependencies
- Create .env file if needed
- Install PayloadCMS dependencies
- Install Astro frontend dependencies

## Option 2: Manual Setup

### Step 1: Install PayloadCMS Backend

```bash
cd xdmpayload
cp .env.example .env
npm install
```

Edit `.env` and configure:
```env
DATABASE_URI=mongodb://127.0.0.1/xdmpayload
PAYLOAD_SECRET=your-secret-key-here
```

### Step 2: Install Astro Frontend

```bash
cd frontend
npm install
```

### Step 3: Start MongoDB

**Using Docker:**
```bash
docker-compose up -d
```

**Using Local MongoDB:**
Ensure MongoDB is running on port 27017

## Running the Project

### Terminal 1: Start PayloadCMS Backend

```bash
cd xdmpayload
npm run dev
```

PayloadCMS will start on http://localhost:3000

**First Time?** Create your admin account at http://localhost:3000/admin

### Terminal 2: Start Astro Frontend

```bash
cd xdmpayload/frontend
npm run dev
```

Astro will start on http://localhost:4321

## What You Can Do Now

### 1. Access PayloadCMS Admin Panel

Visit: http://localhost:3000/admin

- Create your first admin user
- Add blog posts in the Posts collection
- Upload media files
- Manage content

### 2. View Astro Frontend

Visit: http://localhost:4321

- **Home Page**: Introduction and getting started
- **Blog Page**: http://localhost:4321/blog (displays posts from PayloadCMS)

### 3. Test the Integration

1. Go to PayloadCMS admin: http://localhost:3000/admin
2. Create a new post:
   - Click "Posts" in the sidebar
   - Click "Create New"
   - Fill in: Title, Author, Published Date, Content
   - Set Status to "Published"
   - Save
3. Visit the blog page: http://localhost:4321/blog
4. Your post should appear!

## Project URLs

| Service | URL | Purpose |
|---------|-----|---------|
| PayloadCMS Admin | http://localhost:3000/admin | Content management |
| PayloadCMS API | http://localhost:3000/api | REST API |
| GraphQL Playground | http://localhost:3000/api/graphql | GraphQL interface |
| Astro Frontend | http://localhost:4321 | Website |

## Next Steps

### Learn More

- **Integration Guide**: Read `INTEGRATION_GUIDE.md` for API examples
- **Project Documentation**: See `PROJECT_README.md` for architecture
- **Frontend Docs**: Check `frontend/README.md` for Astro details

### Customize

1. **Create Collections**: Add new collections in `src/collections/`
2. **Add Pages**: Create pages in `frontend/src/pages/`
3. **Style**: Modify CSS in Astro components
4. **Configure**: Edit `src/payload.config.ts` and `frontend/astro.config.mjs`

### Deploy

#### PayloadCMS Backend
- Set up MongoDB Atlas
- Deploy to Railway, Render, or DigitalOcean
- Set environment variables

#### Astro Frontend
- Build: `cd frontend && npm run build`
- Deploy to Netlify, Vercel, or Cloudflare Pages

## Troubleshooting

### Port Already in Use

**PayloadCMS (Port 3000)**:
Edit `package.json` scripts:
```json
"dev": "cross-env PORT=3001 NODE_OPTIONS=--no-deprecation next dev"
```

**Astro (Port 4321)**:
Edit `frontend/astro.config.mjs`:
```js
server: {
  port: 4322,
}
```

### MongoDB Connection Failed

- Check MongoDB is running: `docker ps` or `mongosh`
- Verify DATABASE_URI in `.env`
- For Docker: `docker-compose up -d`

### Module Not Found

```bash
# Reinstall dependencies
rm -rf node_modules package-lock.json
npm install
```

### Astro Can't Fetch Data

- Ensure PayloadCMS is running on port 3000
- Check PAYLOAD_API_URL in `frontend/.env`
- Look for CORS errors in browser console

## Common Commands

### PayloadCMS
```bash
npm run dev          # Start development server
npm run build        # Build for production
npm run start        # Start production server
npm run generate:types  # Generate TypeScript types
```

### Astro Frontend
```bash
npm run dev          # Start development server
npm run build        # Build static site
npm run preview      # Preview production build
```

## Getting Help

- PayloadCMS: https://payloadcms.com/docs
- Astro: https://docs.astro.build
- MongoDB: https://docs.mongodb.com

## License

MIT
