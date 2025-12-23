# PayloadCMS + Astro Integration Guide

This guide explains how the PayloadCMS backend integrates with the Astro frontend in the xdmpayload project.

## Architecture Overview

```
┌─────────────────┐         ┌─────────────────┐
│   PayloadCMS    │  REST   │      Astro      │
│    Backend      │ ◄─────► │     Frontend    │
│  (Port 3000)    │   API   │   (Port 4321)   │
└─────────────────┘         └─────────────────┘
        │
        ▼
┌─────────────────┐
│    MongoDB      │
│    Database     │
└─────────────────┘
```

## How It Works

### 1. Content Management (PayloadCMS)

PayloadCMS provides:
- **Admin Panel**: http://localhost:3000/admin
- **REST API**: http://localhost:3000/api/{collection}
- **GraphQL API**: http://localhost:3000/api/graphql

Collections are defined in `src/collections/`:
- `Users.ts` - Admin users
- `Media.ts` - File uploads
- `Posts.ts` - Blog posts (example)

### 2. Content Delivery (Astro)

Astro fetches content from PayloadCMS API during build time (SSG):

```javascript
// In any Astro page/component
const response = await fetch('http://localhost:3000/api/posts');
const { docs: posts } = await response.json();
```

### 3. Data Flow

1. **Create Content**: Admin creates/edits content in PayloadCMS admin panel
2. **Store in Database**: PayloadCMS saves to MongoDB
3. **Expose via API**: Content available at REST/GraphQL endpoints
4. **Fetch in Astro**: Astro pages fetch data during build
5. **Generate Static Pages**: Astro generates HTML with content

## PayloadCMS API Examples

### REST API

#### Get all posts
```bash
GET http://localhost:3000/api/posts
```

#### Get published posts only
```bash
GET http://localhost:3000/api/posts?where[status][equals]=published
```

#### Get single post
```bash
GET http://localhost:3000/api/posts/{id}
```

#### Query with filters and sorting
```bash
GET http://localhost:3000/api/posts?where[status][equals]=published&sort=-publishedDate&limit=10
```

### GraphQL API

```graphql
query {
  Posts(where: { status: { equals: "published" } }, sort: "-publishedDate") {
    docs {
      id
      title
      author
      publishedDate
      content
      excerpt
      featuredImage {
        url
        alt
      }
    }
  }
}
```

## Using in Astro Pages

### Example: Blog Page

```astro
---
// src/pages/blog.astro
const PAYLOAD_API_URL = 'http://localhost:3000';

// Fetch published posts, sorted by date
const response = await fetch(
  `${PAYLOAD_API_URL}/api/posts?where[status][equals]=published&sort=-publishedDate`
);
const { docs: posts } = await response.json();
---

<div>
  {posts.map(post => (
    <article>
      <h2>{post.title}</h2>
      <p>By {post.author} on {new Date(post.publishedDate).toLocaleDateString()}</p>
      <p>{post.excerpt}</p>
    </article>
  ))}
</div>
```

### Example: Single Post Page

```astro
---
// src/pages/blog/[id].astro
const { id } = Astro.params;
const PAYLOAD_API_URL = 'http://localhost:3000';

const response = await fetch(`${PAYLOAD_API_URL}/api/posts/${id}`);
const post = await response.json();
---

<article>
  <h1>{post.title}</h1>
  <div set:html={post.content} />
</article>
```

## Creating a New Collection

### 1. Define Collection in PayloadCMS

Create `src/collections/Events.ts`:

```typescript
import type { CollectionConfig } from 'payload'

export const Events: CollectionConfig = {
  slug: 'events',
  admin: {
    useAsTitle: 'title',
  },
  access: {
    read: () => true,
  },
  fields: [
    {
      name: 'title',
      type: 'text',
      required: true,
    },
    {
      name: 'date',
      type: 'date',
      required: true,
    },
    {
      name: 'description',
      type: 'textarea',
      required: true,
    },
  ],
}
```

### 2. Register Collection

Update `src/payload.config.ts`:

```typescript
import { Events } from './collections/Events'

export default buildConfig({
  collections: [Users, Media, Posts, Events],
  // ... rest of config
})
```

### 3. Use in Astro

Create `frontend/src/pages/events.astro`:

```astro
---
const response = await fetch('http://localhost:3000/api/events');
const { docs: events } = await response.json();
---

<div>
  {events.map(event => (
    <div>
      <h3>{event.title}</h3>
      <p>{new Date(event.date).toLocaleDateString()}</p>
      <p>{event.description}</p>
    </div>
  ))}
</div>
```

## Environment Variables

### PayloadCMS (.env)
```env
DATABASE_URI=mongodb://127.0.0.1/xdmpayload
PAYLOAD_SECRET=your-secret-key
```

### Astro (frontend/.env)
```env
PAYLOAD_API_URL=http://localhost:3000
```

## Development Workflow

1. **Start PayloadCMS**:
   ```bash
   npm run dev
   ```
   Access admin at http://localhost:3000/admin

2. **Create/Edit Content**:
   - Log in to admin panel
   - Add posts, media, etc.

3. **Start Astro**:
   ```bash
   cd frontend
   npm run dev
   ```
   View at http://localhost:4321

4. **Build for Production**:
   ```bash
   # Build PayloadCMS
   npm run build
   
   # Build Astro
   cd frontend
   npm run build
   ```

## Authentication

### Protecting Routes

PayloadCMS collections support access control:

```typescript
export const Posts: CollectionConfig = {
  slug: 'posts',
  access: {
    read: () => true,  // Public read
    create: ({ req: { user } }) => !!user,  // Logged in users can create
    update: ({ req: { user } }) => !!user,  // Logged in users can update
    delete: ({ req: { user } }) => !!user,  // Logged in users can delete
  },
  // ...
}
```

## Image Handling

PayloadCMS automatically optimizes images. In Astro:

```astro
---
const response = await fetch('http://localhost:3000/api/posts');
const { docs: posts } = await response.json();
---

{posts.map(post => (
  <img 
    src={`http://localhost:3000${post.featuredImage.url}`}
    alt={post.featuredImage.alt}
  />
))}
```

## Production Considerations

1. **Environment Variables**: Use production URLs
2. **CORS**: Configure PayloadCMS for frontend domain
3. **Caching**: Implement caching strategy for API calls
4. **Incremental Builds**: Rebuild Astro when content changes
5. **Authentication**: Secure PayloadCMS admin panel

## Troubleshooting

### Connection Refused
- Ensure PayloadCMS is running: `npm run dev`
- Check PORT in package.json

### CORS Errors
- Configure CORS in `payload.config.ts`
- Use same domain in production

### Empty Data
- Check collection access rules
- Verify MongoDB connection
- Check collection has data in admin panel

## Resources

- [PayloadCMS Docs](https://payloadcms.com/docs)
- [PayloadCMS API Docs](https://payloadcms.com/docs/rest-api/overview)
- [Astro Docs](https://docs.astro.build)
